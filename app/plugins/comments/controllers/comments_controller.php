<?php
class CommentsController extends CommentsAppController {

	var $name = 'Comments';
	var $helpers = array('Html', 'Form', 'Ajax', 'Time','Javascript');
	var $components = array('RequestHandler','LoadsysAuth');

	function beforeFilter() {
		parent::beforeFilter();
		$this->LoadsysAuth->allow('index', 'add');
		$this->Auth->allow('*');
	$this->FileUpload->fileModel = 'Comment';  //Upload by default.
		$this->FileUpload->fields = array('name'=> 'file_name', 'type' => 'file_type', 'size' => 'file_size');
		$this->FileUpload->allowedTypes = array( 'image/jpeg', // images
                  'image/jpg', 
                  'image/png', 
                  'image/gif', 
                  'image/tiff', 
                  'image/x-tiff', 
                                  
                  'application/pdf', // pdf
                  'application/x-pdf', 
                  'application/acrobat', 
                  'text/pdf',
                  'text/x-pdf', 
                                  
                  'text/plain', // text
                              
                  'application/msword', // word
		'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                  
                  'application/mspowerpoint', // powerpoint
                  'application/powerpoint',
                  'application/vnd.ms-powerpoint',
                  'application/x-mspowerpoint',
                          
                  'application/x-msexcel', // excel
                  'application/excel',
                  'application/vnd.ms.-excel',
                                  
                  'application/x-compressed', // compressed files
                  'application/x-zip-compressed',
                  'application/zip',
                  'multipart/x-zip',
                  'application/x-tar',
                  'application/x-compressed',
                  'application/x-gzip',
		'application/rtf',
                  'multipart/x-gzip'
                 );
  
	}

	
	function download($name) {
			Configure::write('debug', 0);
			$this->view = 'Media';
	
 			$file = strstr($name, '.','-1');

			$params = array(
			'id' => $name,
			'name' => $file,
			'extension' => 'png',
			'mimeType' => array('png' => 'application/png','jpg' => 'application/jpg','pdf' => 'application/pdf','vnd.ms-powerpoint' => 'application/vnd.ms-powerpoint','docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'), // extends internal list of mimeTypes
			'path' => 'files' . DS
					);
			$this->set($params);
			}

		function index($model, $id) {
			$this->paginate = array(
			'conditions' => array(
				'Comment.model' => $model,
				'Comment.project_id' => $id,
			),
			'contain' => array(
				'Creator',
			),
			'limit' => 200,
			'order' => 'Comment.created  desc',
			'page' => 'first',
		);
		//$this->Comment->recursive = 1;
		$this->set('comments', $this->paginate('Comment'));
		$this->set('_model', $model);
		$this->set('_project_id', $id);
	}

	function add($model = null, $id = null,$uid = null) {
		
		if (!empty($this->data))
		 {
			$model = Set::extract($this->data, 'Comment.model');
			$id = Set::extract($this->data, 'Comment.project_id');
			$a = ClassRegistry::init('Upload');
			
			if ($this->Comment->save($this->data))
				 {
				$comment = $this->Comment->findById($uid);
				//print_r($_REQUEST); die();
						foreach ($this->data['Upload'] as $file) 
							{
						$aa = $a->CustomUpload($file[0],$comment['Comment']['id']);
							}
						$this->Comment->create();
						$this->data = array();
						$this->set('successful', false);
						$this->Session->setFlash(__('The Comment has been saved.', true));
				
					} 
				else 
					{
				$this->Session->setFlash(__('The Comment could not be saved. Please, try again.', true));
					}
			}
			else
			{
				$this->data = array(
					'Comment' => array(
						'model' => $model,
						'project_id' => $id,
					)
				);
			}
		$this->set('_model', $model);
		$this->set('_project_id', $id);
	}

}
?>
