<?php
class Project extends AppModel {
	var $name = 'Project';
	var $validate = array(
	'product_code' => array(
			'Unique' => array(
               		 'rule' => 'isUnique',              
               		 'required' => false,
               		 'message' => 'Product code is must be Unique.'

			),
		),            
            
            
            'item_sku' => array(
			'notempty' => array(
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
		'standard_price' => array(
			'notempty' => array(
               		 'rule' => 'notempty',              
               		 'required' => false,
               		 'message' => 'Price is required.'

			),
		),
	'recommended_browse_nodes1' => array(
			'notempty' => array(
               		 'rule' => 'notempty',              
               		 'required' => false,
               		 'message' => 'Recommended browse nodes1 is required.'

			),
		),
		
	'generic_keywords1' => array(
				'rule-1' => array(
					'rule' => 'notempty',
					 'required' => false,
					 'message' => 'Generic keywords1 is required.'
				),
				'rule-2' => array(
					'rule' => array('maxLength', 50),
					'required' => false,
					'message' => 'Generic keywords1 must be no long 50 characters .'
				),
		),
		'generic_keywords2' => array(
				'rule-1' => array(
					'rule' => 'notempty',
					 'required' => false,
					 'message' => 'Generic keywords2 is required.'
				),
				'rule-2' => array(
					'rule' => array('maxLength', 50),
					'required' => false,
					'message' => 'Generic keywords2 must be no long 50 characters .'
				),
		),
            'generic_keywords3' => array(
				'rule-1' => array(
					'rule' => 'notempty',
					 'required' => false,
					 'message' => 'Generic keywords3 is required.'
				),
				'rule-2' => array(
					'rule' => array('maxLength', 50),
					'required' => false,
					'message' => 'Generic keywords3 must be no long 50 characters .'
				),
		),
            'generic_keywords4' => array(
				'rule-1' => array(
					'rule' => 'notempty',
					 'required' => false,
					 'message' => 'Generic keywords4 is required.'
				),
				'rule-2' => array(
					'rule' => array('maxLength', 50),
					'required' => false,
					'message' => 'Generic keywords4 must be no long 50 characters .'
				),
		),
             'generic_keywords5' => array(
				'rule-1' => array(
					'rule' => 'notempty',
					 'required' => false,
					 'message' => 'Generic keywords5 is required.'
				),
				'rule-2' => array(
					'rule' => array('maxLength', 50),
					'required' => false,
					'message' => 'Generic keywords5 must be no long 50 characters .'
				),
		),
		
	);
	
	
	public function import($filename)
	{
			$i = null; $error = null;
			$filename = $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' .$filename; 
			$handle = fopen($filename, "r");
			$header = fgetcsv($handle);
			$return = array(
				//'messages' => array(),
				'errors' => array(),
			);

			while (($row = fgetcsv($handle)) !== FALSE)
				{
					$i++;
					$data = array();
					$erritem = array();

					 foreach ($header as $k=>$head)
						{
							if (strpos($head,'.')!==false) 
							{
								$h = explode('.',$head);
								$data[$h[0]][$h[1]]=(isset($row[$k])) ? $row[$k] : '';
								
							}
						   else 
							{
							   
								$data['Project'][$head]=(isset($row[$k])) ? $row[$k] : '';
							}
						
						}
					   
				  
							$id = isset($row[0]) ? $row[0] : 0;
						if (!empty($id))
						  {	
					   $projects = $this->find('all', array('conditions' => array('Project.product_code' =>$id)));
						if (!empty($projects))
							{
							$apiConfig = (isset($projects[0]['Project']) && is_array($projects[0]['Project'])) ? ($projects[0]['Project']) : array(); 
						//debug($apiConfig);
						//debug($data['Project']);die();
								$data['Project'] = array_merge($apiConfig,$data['Project']);
							   if((!empty($apiConfig['standard_price'])) && ($apiConfig['standard_price']!= $data['Project']['standard_price']))
								{
								$data['Project'] = array_merge($apiConfig['standard_price'],$data['Project']['standard_price']);
								$limit = 'Standard Price did not match';				
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
					 //debug($data);
					 
						$this->set($data);
					if (!$this->validates())
						{
								//$this->_flash('warning');
								//$errors = $this->ModelName->invalidFields(); 
								
                                                                if(!empty($this->validationErrors['item_sku'])){
								$limit = $this->validationErrors['item_sku'] ;				
								$return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
								$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
									}
                                                                else if(!empty($this->validationErrors['item_name'])){
								$limit = $this->validationErrors['item_name'] ;				
								$return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
								$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
									}
								else if(!empty($this->validationErrors['brand_name'])){
								$limit = $this->validationErrors['brand_name'] ;				
								$return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
								$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
									}
								else if(!empty($this->validationErrors['manufacturer'])){
								$limit = $this->validationErrors['manufacturer'] ;				
								$return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
								$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
									}
								else if(!empty($this->validationErrors['feed_product_type'])){
								$limit = $this->validationErrors['feed_product_type'] ;				
								$return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
								$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
									}
								else if(!empty($this->validationErrors['product_description'])){
								$limit = $this->validationErrors['product_description'] ;				
								$return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
								$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
									}
								else if(!empty($this->validationErrors['bullet_point1'])){
								$limit = $this->validationErrors['bullet_point1'] ;				
								$return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
								$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
									}
								else if(!empty($this->validationErrors['bullet_point2'])){
								$limit = $this->validationErrors['bullet_point2'] ;				
								$return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
								$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
									}
								else if(!empty($this->validationErrors['bullet_point3'])){
								$limit = $this->validationErrors['bullet_point3'] ;				
								$return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
								$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
									}
								else if(!empty($this->validationErrors['bullet_point4'])){
								$limit = $this->validationErrors['bullet_point4'] ;				
								$return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
								$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
									}
								else if(!empty($this->validationErrors['bullet_point5'])){
								$limit = $this->validationErrors['bullet_point5'] ;				
								$return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
								$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
									}
								else if(!empty($this->validationErrors['quantity'])){
								$limit = $this->validationErrors['quantity'] ;				
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
							if (!empty($id)) {
							$err = implode("\n",$erritem);
							$this->saveField('error',$err,array($this->product_code = $id));	
								
							}else{
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
            //'messages' => array(),
            'errors' => array(),
        );

        while (($row = fgetcsv($handle)) !== FALSE) {
            $i++;
            $data = array();
			$erritem = array();

             foreach ($header as $k=>$head) {
                if (strpos($head,'.')!==false) {
                    $h = explode('.',$head);
				   $data[$h[0]][$h[1]]=(isset($row[$k])) ? $row[$k] : '';
					
                }
               else 
			   {
				   
             $data['Project'][$head]=(isset($row[$k])) ? $row[$k] : '';
                }
				
            }
               
          
				$id = isset($row[0]) ? $row[0] : 0;
			  if (!empty($id)) {	
               $projects = $this->find('all', array('conditions' => array('Project.product_code' =>$id)));
              if (!empty($projects)){
			   $apiConfig = (isset($projects[0]['Project']) && is_array($projects[0]['Project'])) ? ($projects[0]['Project']) : array(); 
				//debug($apiConfig);
				//debug($data['Project']);die();
					$data['Project'] = array_merge($apiConfig,$data['Project']);
				   if((!empty($apiConfig['standard_price'])) && ($apiConfig['standard_price']!= $data['Project']['standard_price']))
					{
					//$data['Project'] = array_merge($apiConfig['standard_price'],$data['Project']['standard_price']);
					//$limit = 'Standard Price did not match';				
					//$return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :$limit.",$i), true);
					//$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :$limit.",$i), true);
					//$data['Project'] = array_merge($apiConfig['error'],$erritem[0]);
					$err = '';
					$this->saveField('error',$err,array($this->id = $i));		
				
					}			  
			  }
			  else {
               
                $this->id = $id;
				
			  }
                 
              }
				else {
                $this->create();
            }
             //debug($data);
			 
			$this->set($data);
                      if (!$this->validates())
                          {
				//$this->_flash('warning');
				//$errors = $this->ModelName->invalidFields(); 
				  if(!empty($this->validationErrors['item_sku'])){
					$limit = $this->validationErrors['item_sku'] ;				
					$return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
					$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
					}
                                    else if(!empty($this->validationErrors['item_name'])){
                                    $limit = $this->validationErrors['item_name'] ;				
                                    $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
                                    $erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
									}
				else if(!empty($this->validationErrors['brand_name'])){
				$limit = $this->validationErrors['brand_name'] ;				
                                 $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				}
				else if(!empty($this->validationErrors['manufacturer'])){
				$limit = $this->validationErrors['manufacturer'] ;				
                                 $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				}
				else if(!empty($this->validationErrors['feed_product_type'])){
				$limit = $this->validationErrors['feed_product_type'] ;				
                                 $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				}
				else if(!empty($this->validationErrors['product_description'])){
				$limit = $this->validationErrors['product_description'] ;				
                               $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				}
				else if(!empty($this->validationErrors['bullet_point1'])){
				$limit = $this->validationErrors['bullet_point1'] ;				
                                 $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				}
				else if(!empty($this->validationErrors['bullet_point2'])){
				$limit = $this->validationErrors['bullet_point2'] ;				
                                 $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				}
				else if(!empty($this->validationErrors['bullet_point3'])){
				$limit = $this->validationErrors['bullet_point3'] ;				
                                  $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				}
				else if(!empty($this->validationErrors['bullet_point4'])){
				$limit = $this->validationErrors['bullet_point4'] ;				
                                 $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				}
				else if(!empty($this->validationErrors['bullet_point5'])){
				$limit = $this->validationErrors['bullet_point5'] ;				
                               $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				}
				else if(!empty($this->validationErrors['quantity'])){
				$limit = $this->validationErrors['quantity'] ;				
                                  $return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
				}
				else { 
				//echo "Welcome Andi....";
				}

		   }
				
            if ($this->saveAll($data,$validate = false)) {
				if (!empty($id)) {
				$err = implode("\n",$erritem);
				$this->saveField('error',$err,array($this->product_code = $id));	
					
				}else{
				$err = implode("\n",$erritem);
				$this->saveField('error',$err,array($this->id = $i));		
					
				}
				
               // $return['errors'][] = __(sprintf("Listing Skip Row %d failed to save.",$i), true);
            }/*else {

                $return['messages'][] = __(sprintf('Listing for Row %d was saved.',$i), true);
            }*/
        }
		/*if (!empty($return['errors'])){
				$err = implode("\n",$return['errors']);
				
				$this->saveField('error',$err,array($this->id = '1'));}*/
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
