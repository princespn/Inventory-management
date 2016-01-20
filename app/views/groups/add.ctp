<?php if($session->read('Auth.User.username')!='admin' && $session->read('Auth.User.group_id')!='1') 
{
header("Location: /dashboard/users/logout/");

}
?>
<div class="groups form">
<?php echo $this->Form->create('Group');?>
	<fieldset>
		<legend><?php __('Add Group'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>

