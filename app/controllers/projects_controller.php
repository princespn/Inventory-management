<?php
class ProjectsController extends AppController {

	var $name = 'Projects';
	var $components = array('Acl', 'Auth', 'Session','RequestHandler');
	var $helpers = array('Html', 'Form','Ajax','Javascript','Js','Csv');
	
	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow(array('login','logout','index','edit','import','menus'));
	}
	
					
		
		function index () {
			
			if((!empty($this->data)) &&(!empty($_POST['submit']))){
				
			$string = explode(",",trim($this->data['Project']['all_item']));
			
				$prsku = 	$string[0];
				$prname = 	$string[1];
	
				if((!empty($prsku)) && (!empty($prname))){
					
					$conditions = array('Project.item_name LIKE' => '%'.$prname.'%','Project.item_sku LIKE' => '%'.$prsku.'%');
				$this->paginate = array('limit' => 1000,'totallimit' => 2000,'order'=>'Project.item_sku  ASC','conditions' => $conditions);
					}
					if((!empty($prsku))){
					
					$conditions = array(
					'OR'=> array('Project.item_name LIKE' => "%$prsku%",'Project.item_sku LIKE' => "%$prsku%"));
					$this->paginate = array('limit' => 1000,'totallimit' => 2000,'order'=>'Project.item_sku  ASC','conditions' => $conditions);
					}
				
		
				$this->set('projects', $this->paginate());
				
			}
			else if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){
			$checkboxid = $_POST['checkid'];
			App::import("Vendor","parsecsv");
			$csv = new parseCSV();
			$filepath = "C:\Users\Administrator\Downloads"."projects.csv";	
			$csv->auto($filepath);			
			$this->set('projects',$this->Project->find('all',array('conditions'=>array('Project.id' => $checkboxid))));
			$this->layout = null;
			$this->autoLayout = false;
			Configure::write('debug', '2');
			}
			else
			{
			$this->Project->recursive = 1;
			$this->paginate = array('limit' => 1000,'totallimit' => 2000,'order'=>'Project.item_sku  ASC');
			$this->set('projects', $this->paginate());
			}
	}
		
		
				
	function import() {
		if (!empty($this->data))
                        { 
		$filename = $this->data['Project']['file']['name'];
				
		$fileExt = explode(".", $filename);
		$fileExt2 = end($fileExt);
							if($fileExt2 == 'csv') {
							if(move_uploaded_file($this->data['Project']['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/app/webroot/files/' . $this->data['Project']['file']['name'])) 
								$messages = $this->Project->import($filename);
								$this->Session->setFlash(__('The Amazon UK Listing was Imports successfully.', true));
								
								if (!empty($messages)){
								$this->set('anything', $messages);
								Configure::write('debug', '2');
								}
									
							}
							else {
								
								$this->Session->setFlash(__('The Amazon UK Listing File format not supported.</br>Please upload .CSV file format only.', true));
							}
	
						}			
						else 
						{
				//$filename = 'Amazon_UK_Inventory-old.csv';
				//$messages = $this->Project->import($filename);
						}
			
		
		}

		


	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid The Amazon UK Listing Id.', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('project', $this->Project->read(null, $id));
	}
	
	
		
	function add($id = null) {
		if (!empty($this->data)) {
			
					
			if ($this->Project->save($this->data['Project'])) {
				$this->Session->setFlash(__('The Amazon UK Listing was created successfully.', true));
				$this->redirect(array('action' => 'index'));
					} 
			else {
				$this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
			
				}
		}
		
		$users = $this->Project->User->find('list');
		$this->set(compact('users'));
	}
	

	function edit($id = null) {
		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Amazon UK Listing Id.', true));
			$this->redirect(array('controller'=>'projects','action' => 'index'));
		}
		if (!empty($this->data)) {//print_r($this->data['Project']);die();
			 
			
				if ($this->Project->save($this->data['Project'])) {
						$this->Session->setFlash(__('The Amazon UK Listing was saved successfully', true));
						$this->redirect(array('controller'=>'projects','action' => 'index'));
						} 
				else {
				$this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
			
					}
		}
		if (empty($this->data)) {
			$this->data = $this->Project->read(null, $id);
		}
		$users = $this->Project->User->find('list');
		$this->set(compact('users'));
	}
	
	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Amazon UK Listing ID in database.', true));
			$this->redirect(array('controller'=>'projects','action'=>'index'));
		}
		else  {
			
				if($this->Project->delete($id))
				{

					$this->Session->setFlash(__('The Amazon UK Listing was deleted successfully.', true));
					$this->redirect(array('controller'=>'projects','action'=>'index'));
				}
			
			}
		$this->Session->setFlash(__('ERROR!! The Amazon UK Listing could not be deleted!', true));
		$this->redirect(array('controller'=>'projects','action' => 'index'));
	}
	



}

