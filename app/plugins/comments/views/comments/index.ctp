<?php 
$divId = 'comments_'.$_model.'_'.$_project_id;
//$ajax->div($divId); ?>

<?php
$paginator->options(array(
	'update' => $divId,
	'url' => $this->params['pass'], 
));
?>

<?php
echo $this->requestAction('/comments/add/'.$_model.'/'.$_project_id, array('return'));
?>
<table cellpadding="0" cellspacing="0">
<tr>
</tr>

<?php 
$i = 0;
foreach ($comments as $comment):

$class = null;
		
		if ($i++ % 2 == 0) {
			//$class = ' class="altrow"';
		}
	?>
	<tr<?php //echo $class;?>>


<?php if ( empty($comments) ) : ?>
<td>
<em>No Comments Posted</em>
</td>
<?php endif; ?>
 <div id="comment_<?php e($comment['Comment']['model']); ?>_<?php e($comment['Comment']['project_id']); ?>" style="background:none;height=20em;">
 <td style="width:14em;background:#dedede;border:1px solid #ffffff;" ><b><?php e($comment['User']['username']);?><i style="font-size:8.5px;">&nbsp;said <?php e($time->relativeTime($comment['Comment']['created'])); ?></i>:</b></td>
 <td style="background:none;"><?php e(nl2br($comment['Comment']['comment'])); echo '<br/>' ;if (!empty($comment['Upload']['0']['name'])){echo $this->Html->link($comment['Upload']['0']['name'], array('controller' => 'comments', 'action' => 'download',$comment['Upload']['0']['name'])); } 
 ?></td></div>
		
<?php endforeach; ?>
</tr>

</table>

<?php //echo $ajax->divEnd($divId); ?>
