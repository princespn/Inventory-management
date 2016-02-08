<?php
class InventoryMastersController extends AppController {
   
    var $name = 'InventoryMasters';
	var $components = array('Acl', 'Auth', 'Session','RequestHandler','Paginator');
	var $helpers = array('Html', 'Form','Ajax','Javascript','Js' => array('Jquery'), 'Paginator','Csv');
	
	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow(array('login','logout','index','edit_inventory','import_inventory','delete_inventory','categorieslist','category'));
                $this->Auth->userModel = 'User';  
                $this->Session->activate();
		$this->layout = ($this->request->is("ajax")) ? "ajax" : "default";
			
	} 
	
        
        function categorieslist() {
            $allcategory = $this->InventoryMaster->find('list', array('fields' =>'category','group'=>'category','recursive' => 0));
		return $allcategory;
	}
	
            function index () {
			
			if((!empty($this->data)) &&(!empty($_POST['submit']))){
				
			$string = explode(",",trim($this->data['InventoryMaster']['all_item']));
			
				$prsku = $string[0];
				if(!empty($string[1])){	$prname = $string[1];}	
				if((!empty($prsku)) && (!empty($prname))){
					
					$conditions = array('InventoryMaster.category LIKE' => '%'.$prname.'%','InventoryMaster.category LIKE' => '%'.$prsku.'%');
                                        $this->paginate = array('limit' => 1000,'totallimit' => 2000,'order'=>'InventoryMaster.id  ASC','conditions' => $conditions);
					}
					if((!empty($prsku))){
					
					$conditions = array(
					'OR'=> array('InventoryMaster.product_code LIKE' => "%$prsku%",'InventoryMaster.category LIKE' => "%$prsku%"));
					$this->paginate = array('limit' => 1000,'totallimit' => 2000,'order'=>'InventoryMaster.id  ASC','conditions' => $conditions);
					}
                                    $this->InventoryMaster->recursive = 1;
                                    $this->set('inventorymasters', $this->paginate());
				
			}
			else if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){
                           // echo 'dfbgghbfg';die();
			$checkboxid = $_POST['checkid'];
			App::import("Vendor","parsecsv");
			$csv = new parseCSV();
			$filepath = "C:\Users\Administrator\Downloads"."inventorymasterdb.csv";	
			$csv->auto($filepath);			
			$this->set('inventorymasters',$this->InventoryMaster->find('all',array('conditions'=>array('InventoryMaster.id' => $checkboxid))));
			$this->layout = null;
			$this->autoLayout = false;
			Configure::write('debug', '2');
			}
			else
			{
			$this->InventoryMaster->recursive = 1;//$users = $this->InventoryMaster->User->find('list');
			$this->paginate = array('limit' => 1000,'totallimit' => 2000,'order'=>'InventoryMaster.id  ASC');
			$this->set('inventorymasters', $this->paginate());
			}
	}  
        
                 function category($id) { 
                     //print_r($id);die();
                                            if((!empty($id)))
                                             {

                                             $conditions = array('InventoryMaster.category LIKE' => "%$id%");
                                             $this->paginate = array('limit' => 1000,'totallimit' => 2000,'order'=>'InventoryMaster.id  ASC','conditions' => $conditions);
                                             }
                                         $this->InventoryMaster->recursive = 1;
                                         $this->set('inventorymasters', $this->paginate());
                                    

                            }
        
        
            function import_inventory() {
		if (!empty($this->data))
                        {
		$filename = $this->data['InventoryMaster']['file']['name'];
		$fileExt = explode(".", $filename);
		$fileExt2 = end($fileExt);
							if($fileExt2 == 'csv') {
							if(move_uploaded_file($this->data['InventoryMaster']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['InventoryMaster']['file']['name'])) 
								$messages = $this->InventoryMaster->import_inventory($filename);
								$this->Session->setFlash(__('The Master Inventory was Imports successfully.', true));
								
								if (!empty($messages)){
								$this->set('anything', $messages);
								Configure::write('debug', '2');
								}
									
							}
							else {
								
								$this->Session->setFlash(__('The Master Inventory File format not supported.</br>Please upload .CSV file format only.', true));
							}
	
						}			
						else 
						{
				//$filename = 'inventory_master-old.csv';
			
						}
                                                
        }
       
        
                function edit_inventory($id = null) {
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Database Id.', true));
			$this->redirect(array('controller'=>'inventory_masters','action' => 'index'));
		}
		if (!empty($this->data)) {//print_r($this->data['Project']);die();
			 
			
				if ($this->InventoryMaster->save($this->data['InventoryMaster'])) {
						$this->Session->setFlash(__('The Database was saved successfully', true));
						$this->redirect(array('controller'=>'inventory_masters','action' => 'index'));
						} 
				else {
				$this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
			
					}
		}
		if (empty($this->data)) {
			$this->data = $this->InventoryMaster->read(null, $id);
		}
		$users = $this->InventoryMaster->User->find('list');
		$this->set(compact('users'));
	}
	
	
	function delete_inventory($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Database ID in database.', true));
			$this->redirect(array('controller'=>'inventory_masters','action'=>'index'));
		}
		else  {
			
				if($this->InventoryMaster->delete($id))
				{

					$this->Session->setFlash(__('The Database was deleted successfully.', true));
					$this->redirect(array('controller'=>'inventory_masters','action'=>'index'));
				}
			
			}
		$this->Session->setFlash(__('ERROR!! The Database could not be deleted!', true));
		$this->redirect(array('controller'=>'inventory_masters','action' => 'index'));
	}
	


        
		
	
}