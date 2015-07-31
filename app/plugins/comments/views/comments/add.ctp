<?php
$divId = 'comment_add_'.$_model.'_'.$_project_id;
echo $ajax->div($divId); 
$session->flash();
?>
<?php
if ( !empty($successful) ) {
	echo $javascript->codeBlock($ajax->remoteFunction(array(
		'url' => '/comments/index/'.$_model.'/'.$_project_id,
		'update' => 'comments_'.$_model.'_'.$_project_id,
	)));
}
?>

	<script type="text/javascript"> 
	function fresh()
	{
		setTimeout("location.reload()", 400);
	}
	</script>


<?php echo $ajax->form('add', 'post', array('model' => 'Comment','onsubmit' => 'fresh()','enctype' => 'multipart/form-data', 'update' => $divId));?>

 		<?php
		echo $form->input('model', array('type' => 'hidden'));
		echo $form->input('project_id', array('type' => 'hidden'));
		echo $form->input('comment',array('width' =>'11px','height' =>'10px','rows' =>'4','cols' =>'22'));
		echo $form->input('file', array('type' => 'file','name'=>'data[Upload][file][]'));

?>
<div class='reset'>
<?php 
echo $form->button('Submit', array('type'=>'submit'));
echo "&nbsp;&nbsp;&nbsp;&nbsp;";
echo $form->button('Reset', array('type'=>'reset'));
echo $form->end();
?>
</div>
<?php //echo $form->end('Submit');?>

<?php echo $ajax->divEnd($divId); ?>

