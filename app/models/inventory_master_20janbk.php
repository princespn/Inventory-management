<?php
class InventoryMaster extends AppModel {
	var $name = 'InventoryMaster';
	var $validate = array(
	'product_code' => array(
			'Unique' => array(
               		 'rule' => 'isUnique',              
               		 'required' => false,
               		 'message' => 'Product Code is must be Unique.'

			),
		),
	
		'item_sku' => array(
			'notempty' => array(
			'rule' => 'notempty',
			'required' => false,
			'message' => 'Item SKU is required.'
				),
				
			),
		
		'barcodes' => array(
			'notempty' => array(
               		 'rule' => 'notempty',              
               		 'required' => false,
               		 'message' => 'Bar Code is required.'

			),
		),
		'category' => array(
			'notempty' => array(
               		 'rule' => 'notempty',              
               		 'required' => false,
               		 'message' => 'Category Name is required.'

			),
		),
		'browse_nodes' => array(
			'notempty' => array(
               		 'rule' => 'notempty',              
               		 'required' => false,
               		 'message' => 'Browse Nodes is required.'

			),
		),
                 'price' => array(
			'notempty' => array(
               		 'rule' => 'notempty',              
               		 'required' => false,
               		 'message' => 'Price is Required.'

			),
		),
		'title' => array(
				'title-1' => array(
					'rule' => 'notempty',
					 'required' => false,
					 'message' => 'Title name is required.'
				),
				'title-2' => array(
					'rule' => array('maxLength', 500),
					'required' => false,
					'message' => 'Title name must be no long 500 characters .'
				),
			),
			
		
		'description' => array(
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
	);




        
	public function import_inventory($filename)
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
							   
								$data['InventoryMaster'][$head]=(isset($row[$k])) ? $row[$k] : '';
							}
						
						}
					   
				  
							$id = isset($row[0]) ? $row[0] : 0;
						if (!empty($id))
						  {	
					   $projects = $this->find('all', array('conditions' => array('InventoryMaster.product_code' =>$id)));
						if (!empty($projects))
							{
							$apiConfig = (isset($projects[0]['InventoryMaster']) && is_array($projects[0]['InventoryMaster'])) ? ($projects[0]['InventoryMaster']) : array(); 
						//debug($apiConfig);
						//debug($data['Project']);die();
								$data['InventoryMaster'] = array_merge($apiConfig,$data['InventoryMaster']);
							   if((!empty($apiConfig['price'])) && ($apiConfig['price']!= $data['InventoryMaster']['price']))
								{
								$data['InventoryMaster'] = array_merge($apiConfig['price'],$data['InventoryMaster']['price']);
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
                                                                else if(!empty($this->validationErrors['barcodes'])){
								$limit = $this->validationErrors['barcodes'] ;				
								$return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
								$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
									}
								else if(!empty($this->validationErrors['category'])){
								$limit = $this->validationErrors['category'] ;				
								$return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
								$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
									}
								else if(!empty($this->validationErrors['browse_nodes'])){
								$limit = $this->validationErrors['browse_nodes'] ;				
								$return['errors'][] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
								$erritem[] = __(sprintf("Listing Could not be processed due to error on line %d :--- $limit .",$i), true);
									}
								else if(!empty($this->validationErrors['price'])){
								$limit = $this->validationErrors['price'] ;				
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

    


    var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
			
	);
	

       
       var $hasOne = array(
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => false,
                        'conditions' =>  'InventoryMaster.product_code = Project.product_code'
		),
           'Listing' => array(
			'className' => 'Listing',
			'foreignKey' => false,
                        'conditions' =>  'InventoryMaster.product_code = Listing.product_code'
		),
           'GermanListing' => array(
			'className' => 'GermanListing',
			'foreignKey' => false,
                        'conditions' =>  'InventoryMaster.product_code = GermanListing.product_code'
		)
	);
  
	
	

	
 	
}
