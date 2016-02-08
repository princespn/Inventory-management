<?php
 
 App::uses('Component', 'Controller');
App::uses('Hash', 'Utility');
 

 class PaginatorComponent extends Component {
 

    public $settings = array(
        'page' => 1,
         'limit' => 20,
         'maxLimit' => 100,
         'paramType' => 'named'
     );
 

    public $whitelist = array(
         'limit', 'sort', 'page', 'direction'
     );
 

     public function __construct(ComponentCollection $collection, $settings = array()) {
         $settings = array_merge($this->settings, (array)$settings);
         //$this->Controller = $collection->getController();
         parent::__construct($collection, $settings);
     }
 

     public function paginate($object = null, $scope = array(), $whitelist = array()) {
         if (is_array($object)) {
             $whitelist = $scope;
             $scope = $object;
             $object = null;
         }

         $object = $this->_getObject($object);
 
         if (!is_object($object)) {
             throw new MissingModelException($object);
         }
 
         $options = $this->mergeOptions($object->alias);         $options = $this->validateSort($object, $options, $whitelist);
         $options = $this->checkLimit($options);
 
         $conditions = $fields = $order = $limit = $page = $recursive = null;
 
         if (!isset($options['conditions'])) {
             $options['conditions'] = array();
         }
 
         $type = 'all';
 
         if (isset($options[0])) {
             $type = $options[0];
             unset($options[0]);
         }
 
         extract($options);
 
         if (is_array($scope) && !empty($scope)) {
             $conditions = array_merge($conditions, $scope);
         } elseif (is_string($scope)) {
             $conditions = array($conditions, $scope);
         }
         if ($recursive === null) {
             $recursive = $object->recursive;
         }
 
         $extra = array_diff_key($options, compact(
             'conditions', 'fields', 'order', 'limit', 'page', 'recursive'
         ));
 
         if (!empty($extra['findType'])) {
             $type = $extra['findType'];
             unset($extra['findType']);
         }
 
         if ($type !== 'all') {
             $extra['type'] = $type;
         }
 
         if ((int)$page < 1) {
             $page = 1;
         }
         $page = $options['page'] = (int)$page;
 
         if ($object->hasMethod('paginate')) {
             $results = $object->paginate(
                 $conditions, $fields, $order, $limit, $page, $recursive, $extra
             );
         } else {
             $parameters = compact('conditions', 'fields', 'order', 'limit', 'page');
             if ($recursive != $object->recursive) {
                 $parameters['recursive'] = $recursive;
             }
             $results = $object->find($type, array_merge($parameters, $extra));
         }
         $defaults = $this->getDefaults($object->alias);
         unset($defaults[0]);
 
         if (!$results) {
             $count = 0;
         } elseif ($object->hasMethod('paginateCount')) {
             $count = $object->paginateCount($conditions, $recursive, $extra);
         } elseif ($page === 1 && count($results) < $limit) {
             $count = count($results);
         } else {
             $parameters = compact('conditions');
             if ($recursive != $object->recursive) {
                 $parameters['recursive'] = $recursive;
             }
             $count = $object->find('count', array_merge($parameters, $extra));
         }
         $pageCount = (int)ceil($count / $limit);
         $requestedPage = $page;
         $page = max(min($page, $pageCount), 1);
 
         $paging = array(
             'page' => $page,
            'current' => count($results),
            'count' => $count,
            'prevPage' => ($page > 1),
             'nextPage' => ($count > ($page * $limit)),
           'pageCount' => $pageCount,
            'order' => $order,
             'limit' => $limit,
             'options' => Hash::diff($options, $defaults),
             'paramType' => $options['paramType']
         );
 
        if (!isset($this->Controller->request['paging'])) {
           $this->Controller->request['paging'] = array();
         }
        $this->Controller->request['paging'] = array_merge(
            (array)$this->Controller->request['paging'],
             array($object->alias => $paging)
        );
 
        if ($requestedPage > $page) {
             throw new NotFoundException();
        }

       if (!in_array('Paginator', $this->Controller->helpers) &&
            !array_key_exists('Paginator', $this->Controller->helpers)
        ) {
             $this->Controller->helpers[] = 'Paginator';
        }
         return $results;
     }
 

    protected function _getObject($object) {
        if (is_string($object)) {
             $assoc = null;
             if (strpos($object, '.') !== false) {
                 list($object, $assoc) = pluginSplit($object);
            }
             if ($assoc && isset($this->Controller->{$object}->{$assoc})) {
                 return $this->Controller->{$object}->{$assoc};
             }
             if ($assoc && isset($this->Controller->{$this->Controller->modelClass}->{$assoc})) {
                 return $this->Controller->{$this->Controller->modelClass}->{$assoc};
             }
            if (isset($this->Controller->{$object})) {
                 return $this->Controller->{$object};
             }
             if (isset($this->Controller->{$this->Controller->modelClass}->{$object})) {
                 return $this->Controller->{$this->Controller->modelClass}->{$object};
             }
         }
         if (empty($object) || $object === null) {
            if (isset($this->Controller->{$this->Controller->modelClass})) {
                return $this->Controller->{$this->Controller->modelClass};
            }

           $className = null;
            $name = $this->Controller->uses[0];
            if (strpos($this->Controller->uses[0], '.') !== false) {
                 list($name, $className) = explode('.', $this->Controller->uses[0]);
            }
            if ($className) {
                 return $this->Controller->{$className};
            }

             return $this->Controller->{$name};
        }
         return $object;
     }
 

     public function mergeOptions($alias) {
         $defaults = $this->getDefaults($alias);
         switch ($defaults['paramType']) {
             case 'named':
                 $request = $this->Controller->request->params['named'];
                 break;
            case 'querystring':
                 $request = $this->Controller->request->query;
                break;
         }
        $request = array_intersect_key($request, array_flip($this->whitelist));
         return array_merge($defaults, $request);
    }
 

     public function getDefaults($alias) {
         $defaults = $this->settings;
         if (isset($this->settings[$alias])) {
             $defaults = $this->settings[$alias];
         }
        $defaults += array(
             'page' => 1,
             'limit' => 20,
             'maxLimit' => 100,
             'paramType' => 'named'
         );
         return $defaults;
     }

     public function validateSort(Model $object, array $options, array $whitelist = array()) {
         if (empty($options['order']) && is_array($object->order)) {
             $options['order'] = $object->order;
         }
 
         if (isset($options['sort'])) {
             $direction = null;
             if (isset($options['direction'])) {
                 $direction = strtolower($options['direction']);
             }
             if (!in_array($direction, array('asc', 'desc'))) {
                $direction = 'asc';
            }
             $options['order'] = array($options['sort'] => $direction);
         }
 
         if (!empty($whitelist) && isset($options['order']) && is_array($options['order'])) {
             $field = key($options['order']);
             $inWhitelist = in_array($field, $whitelist, true);
             if (!$inWhitelist) {
                 $options['order'] = null;
             }
             return $options;
         }
 
         if (!empty($options['order']) && is_array($options['order'])) {
             $order = array();
             foreach ($options['order'] as $key => $value) {
                 if (is_int($key)) {
                     $key = $value;
                     $value = 'asc';
                }
                 $field = $key;
                 $alias = $object->alias;
                 if (strpos($key, '.') !== false) {
                    list($alias, $field) = explode('.', $key);
                }
                 $correctAlias = ($object->alias === $alias);
 
                if ($correctAlias && $object->hasField($field)) {
                   $order[$object->alias . '.' . $field] = $value;
               } elseif ($correctAlias && $object->hasField($key, true)) {
                     $order[$field] = $value;
                 } elseif (isset($object->{$alias}) && $object->{$alias}->hasField($field, true)) {
                     $order[$alias . '.' . $field] = $value;
                }
             }
             $options['order'] = $order;
         }

         return $options;
     }


     public function checkLimit(array $options) {
         $options['limit'] = (int)$options['limit'];
         if (empty($options['limit']) || $options['limit'] < 1) {
            $options['limit'] = 1;
        }
        $options['limit'] = min($options['limit'], $options['maxLimit']);
       return $options;
    }
 
 }
