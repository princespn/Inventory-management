<?php 
if($session->read('Auth.User.group_id')!='7' && $session->read('Auth.User.group_id')!='6' && $session->read('Auth.User.group_id')!='5' && $session->read('Auth.User.group_id')!='2' && $session->read('Auth.User.group_id')!='1' && $session->read('Auth.User.group_id')!='4' && $session->read('Auth.User.group_id')!='3')

{

$this->requestAction('/users/logout/', array('return'));


}
?>

<?php
echo $javascript->link('test.js');    
?>

<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('email');
		echo $this->Form->input('new_password', array('type' => 'password','class'=>'text_main')); 
		echo $this->Form->input('confirm_password', array('type' => 'password','class'=>'text_main')); 
		$created_by = $session->read('Auth.User.username');
		echo $this->Form->hidden('created_by',array('value'=>$created_by));	
		echo $this->Form->input('group_id');
		?>
		
	
	</fieldset>
<div class='reset'>
<?php 
echo $this->Form->button('Submit the Form', array('type'=>'submit'));
echo "&nbsp;&nbsp;&nbsp;&nbsp;";
echo $this->Form->button('Reset the Form', array('type'=>'reset'));

?>
</div>
<?php
echo $this->Form->end();?>

</div>

