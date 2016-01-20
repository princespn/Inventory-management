<?php
class EbayenglishListing extends AppModel {
	var $name = 'EbayenglishListing';
	var $validate = array(
	'product_code' => array(
			'Unique' => array(
               		 'rule' => 'isUnique',              
               		 'required' => false,
               		 'message' => 'Product code is must be Unique.'

			),
		),            
            
            
            'sku' => array(
			'notempty' => array(
               		 'rule' => 'notempty',              
               		 'required' => false,
               		 'message' => 'Item SKU is required.'

			),
		),
		'title' => array(
				'rule-1' => array(
					'rule' => 'notempty',
					 'required' => false,
					 'message' => 'Title is required.'
				),
				'rule-2' => array(
					'rule' => array('maxLength', 500),
					'required' => false,
					'message' => 'Title must be no long 500 characters .'
				),
			),
		
            'price' => array(
			'notempty' => array(
               		 'rule' => 'notempty',              
               		 'required' => false,
               		 'message' => 'Price is required.'

			),
		),
				
		'description' => array(
				'description-1' => array(
					'rule' => 'notempty',
					 'required' => false,
					 'message' => 'Description is required.'
				),
				'description-2' => array(
					'rule' => array('maxLength', 2000),
					'required' => false,
					'message' => 'Description must be no long 2000 characters .'
				),
			),
			
		
			
		'size' => array(
			'notempty' => array(
               		 'rule' => 'notempty',              
               		 'required' => false,
               		 'message' => 'Item Size is required.'

			),
		),
		'brand' => array(
			'notempty' => array(
               		 'rule' => 'notempty',              
               		 'required' => false,
               		 'message' => 'Brand name is required.'

			),
		),
		
		'color' => array(
			'notempty' => array(
               		 'rule' => 'notempty',              
               		 'required' => false,
               		 'message' => 'Color name is required.'

			),
		),
		'color1' => array(
			'notempty' => array(
               		 'rule' => 'notempty',              
               		 'required' => false,
               		 'message' => 'Color1 name is required.'

			),
		),
		'material' => array(
			'notempty' => array(
               		 'rule' => 'notempty',              
               		 'required' => false,
               		 'message' => 'Material  is required.'

			),
		),
	);
	
	function import($filename) {
		$i = null; $error = null;
                $filename = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' .$filename; 
		$handle = fopen($filename, "r");
                $header = fgetcsv($handle);
                $return = array(
                 'errors' => array(),
                    );

        while (($row = fgetcsv($handle)) !== FALSE) 
                {
                              $i++;
                              $data = array();
                              $erritem = array();

                        foreach ($header as $k=>$head) 
                                {
                                     if (strpos($head,'.')!==false) {
                                    $h = explode('.',$head);
				   $data[$h[0]][$h[1]]=(isset($row[$k])) ? $row[$k] : '';
					
					}
					else 
					{
				   
				$data['EbayenglishListing'][$head]=(isset($row[$k])) ? $row[$k] : '';
					}
				
				}
                                    $id = isset($row[0]) ? $row[0] : 0;
                                          if (!empty($id))
                                              {	
                                              $projects = $this->find('all', array('conditions' => array('EbayenglishListing.product_code' =>$id)));
						if (!empty($projects))
							{
							$apiConfig = (isset($projects[0]['EbayenglishListing']) && is_array($projects[0]['EbayenglishListing'])) ? ($projects[0]['EbayenglishListing']) : array(); 
						//debug($apiConfig);
						//debug($data['Project']);die();
								$data['EbayenglishListing'] = array_merge($apiConfig,$data['EbayenglishListing']);
							   if((!empty($apiConfig['price'])) && ($apiConfig['price']!= $data['EbayenglishListing']['price']))
								{
								$data['EbayenglishListing'] = array_merge($apiConfig['price'],$data['EbayenglishListing']['price']);
								$limit = 'Price did not match';				
								$return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :$limit.",$i), true);
								$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :$limit.",$i), true);
								//$data['Project'] = array_merge($apiConfig['error'],$erritem[0]);
								$err = implode("\n",$erritem);
								$this->saveField('error',$err,array($this->id = $i));		
							
								}			  
							}
							else 
							{					   
							$this->id = $id;						
							}
						 
						}
                                                else 
                                                {
                                                $this->create();
                                                }           			 
                                            $this->set($data);
                                     if (!$this->validates()) 
                                        {
                                                        if(!empty($this->validationErrors['sku'])){
                                                        $limit = $this->validationErrors['sku'] ;				
                                                         $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        }
                                                        else if(!empty($this->validationErrors['title'])){
                                                        $limit = $this->validationErrors['title'] ;				
                                                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        }
                                                        else if(!empty($this->validationErrors['description'])){
                                                        $limit = $this->validationErrors['description'] ;				
                                                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        }
                                                        else if(!empty($this->validationErrors['size'])){
                                                        $limit = $this->validationErrors['size'] ;				
                                                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        }
                                                        else if(!empty($this->validationErrors['brand'])){
                                                        $limit = $this->validationErrors['brand'] ;				
                                                         $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        }				
                                                        else if(!empty($this->validationErrors['color'])){
                                                        $limit = $this->validationErrors['color'] ;				
                                                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        }
                                                        else if(!empty($this->validationErrors['color1'])){
                                                        $limit = $this->validationErrors['color1'] ;				
                                                         $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        }
                                                        else if(!empty($this->validationErrors['material'])){
                                                        $limit = $this->validationErrors['material'] ;				
                                                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        }
                                                        else 
                                                        { 
                                                        //echo "Welcome Andi....";
                                                         }

				}
				
                            if ($this->saveAll($data,$validate = false))
                                     {
                                        if (!empty($id))
                                                {
                                            $err = implode("\n",$erritem);
                                            $this->saveField('error',$err,array($this->product_code = $id));	

                                                }
                                             else
                                              {
                                            $err = implode("\n",$erritem);
                                            $this->saveField('error',$err,array($this->id = $i));		
					
                                              }			
               
                                     }
			
        }
	return $return;
        fclose($handle);
}

function update($filename) {
		$i = null; $error = null;
                $filename = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' .$filename; 
		$handle = fopen($filename, "r");
                $header = fgetcsv($handle);
                $return = array(
                 'errors' => array(),
                    );

        while (($row = fgetcsv($handle)) !== FALSE) 
                {
                              $i++;
                              $data = array();
                              $erritem = array();

                        foreach ($header as $k=>$head) 
                                {
                                     if (strpos($head,'.')!==false) {
                                    $h = explode('.',$head);
				   $data[$h[0]][$h[1]]=(isset($row[$k])) ? $row[$k] : '';
					
					}
					else 
					{
				   
				$data['EbayenglishListing'][$head]=(isset($row[$k])) ? $row[$k] : '';
					}
				
				}
                                    $id = isset($row[0]) ? $row[0] : 0;
                                          if (!empty($id))
                                              {	
                                              $projects = $this->find('all', array('conditions' => array('EbayenglishListing.product_code' =>$id)));
						if (!empty($projects))
							{
							$apiConfig = (isset($projects[0]['EbayenglishListing']) && is_array($projects[0]['EbayenglishListing'])) ? ($projects[0]['EbayenglishListing']) : array(); 
						//debug($apiConfig);
						//debug($data['Project']);die();
								$data['EbayenglishListing'] = array_merge($apiConfig,$data['EbayenglishListing']);
							   if((!empty($apiConfig['price'])) && ($apiConfig['price']!= $data['EbayenglishListing']['price']))
								{
								//$data['EbayenglishListing'] = array_merge($apiConfig['price'],$data['EbayenglishListing']['price']);
								$err = '';
								$this->saveField('error',$err,array($this->id = $i));		
							
								}			  
							}
							else 
							{					   
							$this->id = $id;						
							}
						 
						}
                                                else 
                                                {
                                                $this->create();
                                                }           			 
                                            $this->set($data);
                                     if (!$this->validates()) 
                                        {
                                                        if(!empty($this->validationErrors['sku'])){
                                                        $limit = $this->validationErrors['sku'] ;				
                                                         $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        }
                                                        else if(!empty($this->validationErrors['title'])){
                                                        $limit = $this->validationErrors['title'] ;				
                                                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        }
                                                        else if(!empty($this->validationErrors['description'])){
                                                        $limit = $this->validationErrors['description'] ;				
                                                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        }
                                                        else if(!empty($this->validationErrors['size'])){
                                                        $limit = $this->validationErrors['size'] ;				
                                                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        }
                                                        else if(!empty($this->validationErrors['brand'])){
                                                        $limit = $this->validationErrors['brand'] ;				
                                                         $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        }				
                                                        else if(!empty($this->validationErrors['color'])){
                                                        $limit = $this->validationErrors['color'] ;				
                                                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        }
                                                        else if(!empty($this->validationErrors['color1'])){
                                                        $limit = $this->validationErrors['color1'] ;				
                                                         $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        }
                                                        else if(!empty($this->validationErrors['material'])){
                                                        $limit = $this->validationErrors['material'] ;				
                                                        $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                                        }
                                                        else 
                                                        { 
                                                        //echo "Welcome Andi....";
                                                         }

				}
				
                            if ($this->saveAll($data,$validate = false))
                                     {
                                        if (!empty($id))
                                                {
                                            $err = implode("\n",$erritem);
                                            $this->saveField('error',$err,array($this->product_code = $id));	

                                                }
                                             else
                                              {
                                            $err = implode("\n",$erritem);
                                            $this->saveField('error',$err,array($this->id = $i));		
					
                                              }			
               
                                     }
			
        }
	return $return;
        fclose($handle);
}

	
	
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
			
	);
	
	
}
