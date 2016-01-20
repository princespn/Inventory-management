<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php __('Reset User'); ?></legend>
<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username',array('readonly'=>'readonly'));
		echo $this->Form->input('email',array('readonly'=>'readonly'));
		//echo $this->Form->input('password', array());
		$modify_by = $session->read('Auth.User.username');
		echo $this->Form->hidden('modify_by',array('value'=>$modify_by));
		echo $this->Form->input('old_password', array('type' => 'password')); 
		echo $this->Form->input('new_password', array('type' => 'password')); 
		echo $this->Form->input('confirm_password', array('type' => 'password')); 
		echo $this->Form->input('phone_no',array('readonly'=>'readonly'));
		echo $this->Form->input('fax_no',array('readonly'=>'readonly'));
		echo $this->Form->input('address',array('readonly'=>'readonly'));
		echo $this->Form->input('city',array('readonly'=>'readonly'));
		echo $this->Form->input('state',array('readonly'=>'readonly'));
		echo $this->Form->input('pin_code',array('readonly'=>'readonly'));
		echo $this->Form->input('country',array('readonly'=>'readonly'));
		echo $this->Form->input('group_id',array('disabled'=>'disabled'));
		echo $this->Form->input('team_id',array('disabled'=>'disabled'));
?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
<ul><?php if($session->read('Auth.User.group_id')=='1') {
//echo $this->Html->link($project['User']['username'], array('controller' => 'users', 'action' => 'view', $project['User']['id']));
?>

		<li><?php echo $this->Html->link(__('New Project', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Projects', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Employee Evaluation', true), array('controller' => 'users', 'action' => 'team')); ?> </li>
		<li><?php echo $this->Html->link(__('Time Sheets', true), array('controller' => 'timesheets', 'action' => 'index')); ?> </li>
<?php 
}
 elseif($session->read('Auth.User.group_id')=='4')
{
?>


<li><?php echo $this->Html->link(__('New Project', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Projects', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('Reset your password', true), array('controller' => 'users', 'action' => 'forgatepw',$session->read('Auth.User.id'))); ?></li>
		
<?php 
}
 elseif($session->read('Auth.User.group_id')=='2')
{
?>
<li><?php echo $this->Html->link(__('List Projects', true), array('action' => 'index')); ?> </li>
<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
<li><?php echo $this->Html->link(__('Time Sheets', true), array('controller' => 'timesheets', 'action' => 'index')); ?> </li>
<li><?php echo $this->Html->link(__('Reset your password', true), array('controller' => 'users', 'action' => 'forgatepw',$session->read('Auth.User.id'))); ?></li>
<?php 
}
 elseif($session->read('Auth.User.group_id')=='3')
{
?>
<li><?php echo $this->Html->link(__('List Projects', true), array('action' => 'index')); ?> </li>
<li><?php echo $this->Html->link(__('Reset your password', true), array('controller' => 'users', 'action' => 'forgatepw',$session->read('Auth.User.id'))); ?></li>



<?php }else{ ?>
<li><?php echo $this->Html->link(__('List Projects', true), array('action' => 'index')); ?> </li>
<li><?php echo $this->Html->link(__('Employee Evaluation', true), array('controller' => 'users', 'action' => 'team')); ?> </li>
<li><?php echo $this->Html->link(__('Time Sheets', true), array('controller' => 'timesheets', 'action' => 'index')); ?> </li>
<li><?php echo $this->Html->link(__('Reset your password', true), array('controller' => 'users', 'action' => 'forgatepw',$session->read('Auth.User.id'))); ?></li>

<?php } ?>
</ul>
</div>
