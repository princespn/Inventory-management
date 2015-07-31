<?php
class GermanListing extends AppModel {
	var $name = 'GermanListing';
	var $validate = array(
	'item_sku' => array(
			'inUse' => array(
               		 'rule' => 'notempty',              
               		 'required' => false,
               		 'message' => 'Item SKU is required.'

			),
		),
	
		'item_name' => array(
				'rule-1' => array(
					'rule' => 'notempty',
					 'required' => false,
					 'message' => 'Item Name is required.'
				),
				'rule-2' => array(
					'rule' => array('maxLength', 500),
					'required' => false,
					'message' => 'Item Name must be no long 500 characters .'
				),
			),
		
			'brand_name' => array(
			'notempty' => array(
               		 'rule' => 'notempty',              
               		 'required' => false,
               		 'message' => 'Brand Name is required.'

			),
		),
		'manufacturer' => array(
			'notempty' => array(
               		 'rule' => 'notempty',              
               		 'required' => false,
               		 'message' => 'Manufacture Name is required.'

			),
		),
		'feed_product_type' => array(
			'notempty' => array(
               		 'rule' => 'notempty',              
               		 'required' => false,
               		 'message' => 'Feed product type is required.'

			),
		),
		'product_description' => array(
				'description-1' => array(
					'rule' => 'notempty',
					 'required' => false,
					 'message' => 'Product description is required.'
				),
				'description-2' => array(
					'rule' => array('maxLength', 2000),
					'required' => false,
					'message' => 'Product description must be no long 2000 characters .'
				),
			),
			
		'bullet_point1' => array(
				'rule-1' => array(
					'rule' => 'notempty',
					 'required' => false,
					 'message' => 'Bullet point1 is required.'
				),
				'rule-2' => array(
					'rule' => array('maxLength', 500),
					'required' => false,
					'message' => 'Bullet point1 must be no long 500 characters .'
				),
			),
			'bullet_point2' => array(
				'point-1' => array(
					'rule' => 'notempty',
					 'required' => false,
					 'message' => 'Bullet point2 is required.'
				),
				'point-2' => array(
					'rule' => array('maxLength', 500),
					'required' => false,
					'message' => 'Bullet point2 must be no long 500 characters .'
				),
			),
			'bullet_point3' => array(
				'bullet-1' => array(
					'rule' => 'notempty',
					 'required' => false,
					 'message' => 'Bullet point3 is required.'
				),
				'bullet-2' => array(
					'rule' => array('maxLength', 500),
					'required' => false,
					'message' => 'Bullet point3 must be no long 500 characters .'
				),
			),
			'bullet_point4' => array(
				'maxlength-1' => array(
					'rule' => 'notempty',
					 'required' => false,
					 'message' => 'Bullet point4 is required.'
				),
				'maxlength-2' => array(
					'rule' => array('maxLength', 500),
					'required' => false,
					'message' => 'Bullet point4 must be no long 500 characters .'
				),
			),
			'bullet_point5' => array(
				'rule-1' => array(
					'rule' => 'notempty',
					 'required' => false,
					 'message' => 'Bullet point5 is required.'
				),
				'rule-2' => array(
					'rule' => array('maxLength', 500),
					'required' => false,
					'message' => 'Bullet point5 must be no long 500 characters .'
				),
			),
			
		'quantity' => array(
			'notempty' => array(
               		 'rule' => 'notempty',              
               		 'required' => false,
               		 'message' => 'Quantity is required.'

			),
		),
	);
	
	function import($filename) {
		$i = null; $error = null;
        $filename = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' .$filename; 
		$handle = fopen($filename, "r");
        $header = fgetcsv($handle);
        $return = array(
            //'messages' => array(),
            'errors' => array(),
        );

        while (($row = fgetcsv($handle)) !== FALSE) {
            $i++;
            $data = array();

             foreach ($header as $k=>$head) {
                if (strpos($head,'.')!==false) {
                    $h = explode('.',$head);
				   $data[$h[0]][$h[1]]=(isset($row[$k])) ? $row[$k] : '';
					
                }
               else 
			   {
				   
             $data['GermanListing'][$head]=(isset($row[$k])) ? $row[$k] : '';
                }
				
            }
               
          
				$id = isset($row[0]) ? $row[0] : 0;
			  if (!empty($id)) {	
               $listings = $this->find('all', array('conditions' => array('GermanListing.item_sku' =>$id)));
              if (!empty($listings)){
			   $apiConfig = (isset($listings[0]['GermanListing']) && is_array($listings[0]['GermanListing'])) ? ($listings[0]['GermanListing']) : array(); 
				//debug($apiConfig);
				//debug($data['Project']);
				$data['GermanListing'] = array_merge($apiConfig,$data['GermanListing']);
			  }else {
               
                $this->id = $id;
				
			  }
                 
              }
				else {
                $this->create();
            }
             //debug($data);die();
			 
			$this->set($data);
            if (!$this->validates()) {
				//$this->_flash('warning');
				//$errors = $this->ModelName->invalidFields(); 
				if(!empty($this->validationErrors['item_name'])){
				$limit = $this->validationErrors['item_name'] ;				
                $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				}
				else if(!empty($this->validationErrors['brand_name'])){
					$limit = $this->validationErrors['brand_name'] ;				
                $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				}
				else if(!empty($this->validationErrors['manufacturer'])){
					$limit = $this->validationErrors['manufacturer'] ;				
                $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				}
				else if(!empty($this->validationErrors['feed_product_type'])){
					$limit = $this->validationErrors['feed_product_type'] ;				
                $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				}
				else if(!empty($this->validationErrors['product_description'])){
					$limit = $this->validationErrors['product_description'] ;				
                $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				}
				else if(!empty($this->validationErrors['bullet_point1'])){
					$limit = $this->validationErrors['bullet_point1'] ;				
                $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				}
				else if(!empty($this->validationErrors['bullet_point2'])){
					$limit = $this->validationErrors['bullet_point2'] ;				
                $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				}
				else if(!empty($this->validationErrors['bullet_point3'])){
					$limit = $this->validationErrors['bullet_point3'] ;				
                $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				}
				else if(!empty($this->validationErrors['bullet_point4'])){
					$limit = $this->validationErrors['bullet_point4'] ;				
                $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				}
				else if(!empty($this->validationErrors['bullet_point5'])){
					$limit = $this->validationErrors['bullet_point5'] ;				
                $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				}
				else if(!empty($this->validationErrors['quantity'])){
					$limit = $this->validationErrors['quantity'] ;				
                $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				}
				else { echo "Welcome Amit....";}

		   }
				
            if ($this->saveAll($data,$validate = false)) {
				
               // $return['errors'][] = __(sprintf("Listing Skip Row %d failed to save.",$i), true);
            }/*else {

                $return['messages'][] = __(sprintf('Listing for Row %d was saved.',$i), true);
            }*/
        }
		if (!empty($return['errors'])){
				$err = implode("\n",$return['errors']);
				
				$this->saveField('error',$err,array($this->id = '1'));}
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
