<?php 
if($session->read('Auth.User.group_id')=='4' && $session->read('Auth.User.group_id')=='3')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
 <?php
 if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){

	$line= $projects[0]['Project'];	
	$mapping = array('','','','SKU','','','AM-UK Title','','','','','AM-UK Description','','','AM-UK Standard Price','','','','','','','AM-UK Sale from date','AM-UK Sale end date','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-UK bullet_point 1','AM-UK bullet_point 2','AM-UK bullet_point 3','AM-UK bullet_point 4','AM-UK bullet_point 5','AM-UK Search Terms 1','AM-UK Search Terms 2','AM-UK Search Terms 3','AM-UK Search Terms 1','AM-UK Search Terms 4','AM-UK Search Terms 5','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-UK Colour Map','AM-UK Size Map','','','AM-UK Material');
	echo $csv->addRow($mapping);
	$csv->addRow(array_keys($line));
	foreach ($projects as $project){		
	  $line = $project['Project'];
	  echo $csv->addRow($line);
	}
	$filename='projects';
	echo $csv->render($filename);
	}else{
	
	
	
  ?>
<div class="projects index"><div class="grid_16">
<h2 id="page-heading"><?php __('Amazon UK Listing');?></h2>
<table cellpadding="0" cellspacing="0">
<?php  echo $form->create('Project',array('action'=>'index','id'=>'saveForm')); ?>
	<tr style="color:#ffffff;">
	<th colspan="3"></th>
	<th colspan="3"><?php	echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Product Code,SKU...','class'=>'export_box')); ?></th>
	<th colspan="6"></th>
	</tr>
	<tr style="background:#666666;color:#ffffff;">				
			<th style="width:90px;"><a class="checkall" href="#">Check All</a><?php echo ' | ' ; ?> <a class="uncheckall" href="#">Uncheck All</a></th>
			<th><div class="title-text"><?php __('Image');?></div></th>
			<th><div class="title-text"><?php __('Product Code');?></th>
                        <th><?php __('SKU');?></th>
			<th><div class="title-text"><?php __('Product name');?></th>
			<th><div class="title-text"><?php __('Available');?></th>
			<th><div class="title-text"><?php __('Price');?></th>
			<th   colspan='3'><div style="float:right"><div style="margin: 5px;"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','type'=>'submit')); ?></div><div class="btnClick" style="display:none;"><?php echo $this->Form->button('Export Data', array('value'=>'exports','name'=>'exports','type'=>'submit')); ?></div></div></th>
			
	</tr>

	<?php
	$i = 0;
	foreach ($projects as $project):
		$class = null;
		
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>

	
		<td class="checkbox"><?php	
		 $productid = $project['Project']['id'];
		echo $this->Form->input('Project.id',array('class'=>'chk1', 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?></td>
		<td class="checkbox"><?php  if(!empty($project['Project']['main_image_url'])){	echo "<img width='70px' src=http://images.vikkit.co.uk/Amazon-Images/".$project['Project']['main_image_url'].">";
		}else { echo '<img width=70px src=/img/images.png>';	}?></td>
                <td class="checkbox"><?php echo $project['Project']['product_code']; ?></td>
		<td class="checkbox"><?php echo $project['Project']['item_sku']; ?></td>		
		<td class="checkbox"><?php 
		 if(!empty($project['Project']['item_name']))
		{
		$row1 = $project['Project']['item_name'];			
		$item = strlen($row1); 
				 if($item >= '500'){
				 echo "<div style='color:red;'>Item Name must be no long 500 characters.</div>";
				 
				 }else {
				  $itemname = utf8_encode(substr($row1,0,200)); 
					echo ($itemname);				 
				 }
		
		}else{
		echo "<div style='color:red;'>Item Name is required</div>";
		}?></td>
		<td class="checkbox"><?php echo $project['Project']['quantity']; ?></td>	
		<td class="checkbox"><?php 
		$stanprice = $project['Project']['standard_price'];
		if(empty($stanprice))
		 {
		   echo "<span style='color:red;' title='Standard Price is Required.'>Standard Price is Required</span>";
	     }
		 else
		 {
			  $pric = $project['Project']['error'];
			   $pieces = explode(":", $pric);
			if((!empty($pieces[1])) && ($pieces[1] == 'Standard Price did not match.'))
			{
			  
			  // if($pieces[1] == 'Standard Price did not match.'){
				if(!empty($pieces[1]))
					{
				echo "<span style='color:red;' title='Standard Price did not match.'>$stanprice</span>";
					}
			}
			else
			{
				echo $stanprice;
			}
		}
	 ?></td>	
		<td class="actions">
		 <?php  
		  // echo $this->Form->input('', array('onchange'=>'myFunction()','label' => '','options' => array($project['Project']['id'] => 'Edit')));
			 // echo $this->Html->link(__('Edit', true), array('action' => 'edit', $project['Project']['id'])); ?>
			<?php // echo $this->Html->link(__('Delete', true), array('action' => 'delete', $project['Project']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $project['Project']['item_sku'])); ?>
		
			<?php 
			$size = array(''=>'Select','/projects/edit/'.$project['Project']['id']=>'Edit','/projects/delete/'.$project['Project']['id']=>'Delete');
			
			echo $this->Form->input('', array('id'=>'projectsid','type'=>'select','label' => '','options' =>$size));
		 ?>
		
		</td>

		
		


	</tr>
<?php endforeach; ?>
<?php echo $this->Form->end();?>
	</table>

<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<script type="text/javascript">
   $(document).ready( function() {
      // bind change event to select
      $('#projectsid').live('click', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>

<?php } ?>
