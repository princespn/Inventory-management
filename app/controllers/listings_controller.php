<?php
class ListingsController extends AppController {

	var $name = 'Listings';
	var $components = array('Acl', 'Auth', 'Session','RequestHandler');
	var $helpers = array('Html', 'Form','Ajax','Javascript','Js','Csv');
	
	function beforeFilter()
	{
		parent::beforeFilter();
		//$this->Auth->allow('*');
		$this->Auth->allow(array('login','logout','index','edit','delete','import'));
		$this->layout = 'defaultFR';
		Configure::write('Config.language', "fra");
		$this->Session->write('Config.language', 'fra');
		setlocale(LC_ALL, 'fr_CA.utf-8');
		
	}
	
			/*function index() {		
		$this->Listing->recursive = 1;
		$this->paginate = array('limit' => 1000,'totallimit' => 2000,'order'=>'Listing.id ASC');
		$this->set('listings', $this->paginate());		
	}*/
		
		function index () {
			
			if((!empty($this->data)) &&(!empty($_POST['submit']))){
				//print_r($this->data['Listing']['all_item']);die();
			$string = explode(",",trim($this->data['Listing']['all_item']));
			
				$prsku = 	$string[0];
				$prname = 	$string[1];
	
		if((!empty($prsku)) && (!empty($prname))){//debug($this->data); die();
			//$conditions = array('Listing.item_sku' => $prsku);
			$conditions = array('Listing.item_name LIKE' => '%'.$prname.'%','Listing.item_sku LIKE' => '%'.$prsku.'%');
		$this->paginate = array('limit' => 1000,'totallimit' => 2000,'order'=>'Listing.item_sku  ASC','conditions' => $conditions);
			}
			if((!empty($prsku))){
			
			$conditions = array(
			'OR'=> array('Listing.item_name LIKE' => "%$prsku%",'Listing.item_sku LIKE' => "%$prsku%"));
			$this->paginate = array('limit' => 1000,'totallimit' => 2000,'order'=>'Listing.item_sku  ASC','conditions' => $conditions);
			}
		
		
		$this->set('listings', $this->paginate());
				
		}
		else if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){
			$checkboxid = $_POST['checkid'];
	App::import("Vendor","parsecsv");
	$csv = new parseCSV();
	$filepath = "C:\Users\Administrator\Downloads"."listings.csv";	
	$csv->auto($filepath);			
	$this->set('listings',$this->Listing->find('all',array('conditions'=>array('Listing.id' => $checkboxid))));
	$this->layout = null;
	$this->autoLayout = false;
	Configure::write('debug', '2');
		}
		else
		{
		$this->Listing->recursive = 1;
		$this->paginate = array('limit' => 1000,'totallimit' => 2000,'order'=>'Listing.item_sku  ASC');
		$this->set('listings', $this->paginate());
		}
	}
	function import() {
		if (!empty($this->data))
                        { 
		$filename = $this->data['Listing']['file']['name'];	
		$fileExt = explode(".", $filename);
		$fileExt2 = end($fileExt);
		if($fileExt2 == 'csv') {
		if(move_uploaded_file($this->data['Listing']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['Listing']['file']['name'])) 
			$messages = $this->Listing->import($filename);
			$this->Session->setFlash(__('The Amazon France Listing was Imports successfully.', true));
			//$this->redirect(array('action' => 'index'));
			$this->set('anything', $messages);
			Configure::write('debug', '2');
				}else {
			
			$this->Session->setFlash(__('The Amazon France Listing File format not supported.</br>Please upload .CSV file format only.', true));
		}
	
						}			
						else 
						{
			//$filename = 'Amazon_UK_Inventory-old.csv';
			//$messages = $this->Listing->import($filename);
				}
			
		
		}

		function download(){
	App::import("Vendor","parsecsv");
	$csv = new parseCSV();
	$filepath = "C:\Users\Administrator\Downloads"."projects.csv";
	
	$csv->auto($filepath);
	$this->set('projects',$this->Listing->find('all'));
	$this->layout = null;
	$this->autoLayout = false;
	Configure::write('App.encoding', 'utf8_unicode_ci');  
	Configure::write('debug', '0');
 }
	
	function edit($id = null) {
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid The Amazon France Listing Id', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {//print_r($id);die();
			 
			 	if ($this->Listing->save($this->data['Listing'])) {
						$this->Session->setFlash(__('The The Amazon France Listing was saved successfully', true));
						$this->redirect(array('action' => 'index'));
						} 
				else {
				$this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
			
					}
		}
		if (empty($this->data)) {
			$this->data = $this->Listing->read(null, $id);
		}
		$users = $this->Listing->User->find('list');
		$this->set(compact('users'));
		    
		
	}
	
	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid The Amazon France Listing ID in database.', true));
			$this->redirect(array('action'=>'index'));
		}
		else  {//print_r($id);die();
			
				if($this->Listing->delete($id))
				{

					$this->Session->setFlash(__('The The Amazon France Listing were deleted successfully.', true));
					$this->redirect(array('action'=>'index'));
				}
			
			}
		$this->Session->setFlash(__('ERROR!! The Amazon France Listing could not be deleted!', true));
		$this->redirect(array('action' => 'index'));
	}
	



}

