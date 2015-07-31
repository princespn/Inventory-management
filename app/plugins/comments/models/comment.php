<?php
class Comment extends CommentsAppModel {

	var $name = 'Comment';
	var $validate = array(	
		'comment' => array('notempty'),
		'model' => array('notempty'),
		'foreign_key' => array('numeric'),
		'creator_id' => array('numeric'),
		'modifier_id' => array('numeric')
		/*'comment' => array('notempty'),
		'model' => array('notempty'),
		'foreign_key' => array('numeric'),
		'creator_id' => array('numeric'),
		'modifier_id' => array('numeric')*/
	);
/*
var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	var $hasMany = array(
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'project_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
*/

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'User' => array('className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Project' => array('className' => 'Project',
								'foreignKey' => 'project_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);
	var $hasMany = array(
		'Upload' => array(
			'className' => 'Upload',
			'foreignKey' => 'comment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>
