<?php 
if($session->read('Auth.User.group_id')=='4' && $session->read('Auth.User.group_id')=='3')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
 <?php
 if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){

	$line= $listings[0]['Listing'];	
	$mapping = array('','','','SKU','','','AM-FR Title','','','','','AM-FR Description','','','AM-FR Standard Price','','','','','','AM-FR Sale Price','AM-FR Sale from date','AM-FR Sale end date','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-FR bullet_point 1','AM-FR bullet_point 2','AM-FR bullet_point 3','AM-FR bullet_point 4','AM-FR bullet_point 5','AM-FR Search Terms 1','AM-FR Search Terms 2','AM-FR Search Terms 3','AM-FR Search Terms 4','AM-FR Search Terms 5','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','AM-FR Colour Map1','AM-FR Colour Map2','AM-FR Size Map','','','','AM-FR Material','AM-FR Material1');
	echo $csv->addRow($mapping);
	$csv->addRow(array_keys($line));
	foreach ($listings as $listing){		
	  $line = $listing['Listing'];
	  echo $csv->addRow($line);
	}
	$filename='listings';
	echo $csv->render($filename);
	}else{
	
	 ?>
<div class="listings index"><div class="grid_16">
<h2 id="page-heading"><?php __('Amazon France Listing');?></h2>
<table cellpadding="0" cellspacing="0">
<?php  echo $form->create('Listing',array('action'=>'index','id'=>'saveForm')); ?>
<tr style="color:#ffffff;">
<th colspan="3"></th>
<th colspan="3"><?php	echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Product Code,SKU...','class'=>'export_box')); ?></th>
<th colspan="6"></th>
</tr>
	<tr style="background:#666666;color:#ffffff;">
			<th style="width:90px;"><a class="checkall" href="#">Check All</a><?php echo ' | ' ; ?><a class="uncheckall" href="#">Uncheck All</a></th>
			<th><?php __('Image');?></th>
			<th><?php __('Product Code');?></th>
                        <th><?php __('SKU');?></th>
                        <th style="width:30px;"><?php __('Category');?>
                       <select id="InventoryMasterCategory" name="data[InventoryMaster][category]">
                       <?php $option = $this->requestAction('/listings/categoriesPro'); //echo $this->Form->select('category',array($option)); 
                      foreach ($option as $key => $option){
                         echo '<option value='.$option.'>'.$option.'</option>';
                         }         ?> </select></th>  
                        <th><?php __('Browse nodes');?></th>
			<th><?php __('Product name');?></th>
			<th><?php __('Available');?></th>
			<th><?php __('Price');?></th>
			<th   colspan='3'><div style="float:right"><div style="margin: 5px;"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','type'=>'submit')); ?></div><div class="btnClick" style="display:none;"><?php echo $this->Form->button('Export Data', array('value'=>'exports','name'=>'exports','type'=>'submit')); ?></div></div></th>
			
	</tr>

	<?php
	$i = 0;
	foreach ($listings as $listing):
		$class = null;
		
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>

	
		<td class="checkbox"><?php	
		 $productid = $listing['Listing']['id'];
		echo $this->Form->input('Listing.id',array('class'=>'chk1', 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?></td>
		<td class="checkbox"><?php  if(!empty($listing['Listing']['main_image_url'])){	echo "<img width='70px' src=http://images.vikkit.co.uk/Amazon-Images/".$listing['Listing']['main_image_url'].">";
		}else { echo '<img width=70px src=/img/images.png>';	}?></td>
                <td><?php echo $listing['Listing']['product_code']; ?></td>
		<td><?php echo $listing['Listing']['item_sku']; ?></td>
                 <td><?php echo $listing['InventoryMaster']['category']; ?></td>
                <td><?php echo $listing['Listing']['recommended_browse_nodes1']; ?></td>
		<td><?php 
		 if(!empty($listing['Listing']['item_name']))
		{
		$row1 = $listing['Listing']['item_name'];			
		$keyword = $listing['Listing']['generic_keywords1'];
		$item = strlen($row1); 
				 if($item >= '500'){
				 echo "<div style='color:red;'>Item Name must be no long 500 characters.</div>";
				 
				 }else {
				$percentage = 0;
				$keyword = similar_text($row1,$keyword,$percentage);
				$itemname = substr($row1,0,50); 				 
					echo "</BR>";
					printf("<div style='color:red;'>The Title are %d percent Keyword.</div>", $percentage);
					echo ($itemname);
								 
				 }
		
		}else{
		echo "<div style='color:red;'>Item Name is required</div>";
		}?></td>
		<td><?php echo $listing['Listing']['quantity']; ?></td>	
		<td><?php 
		$stanprice = $listing['Listing']['standard_price'];
		if(empty($stanprice))
		 {
		   echo "<span style='color:red;' title='Standard Price is Required.'>Standard Price is Required</span>";
	     }
		 else
		 {
			  $pric = $listing['Listing']['error'];
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
		  // echo $this->Form->input('', array('onchange'=>'myFunction()','label' => '','options' => array($listing['Listing']['id'] => 'Edit')));
			 // echo $this->Html->link(__('Edit', true), array('action' => 'edit', $listing['Listing']['id'])); ?>
			<?php // echo $this->Html->link(__('Delete', true), array('action' => 'delete', $listing['Listing']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $listing['Listing']['item_sku'])); ?>
		
			<?php 
			$size = array(''=>'Select','/listings/edit/'.$listing['Listing']['id']=>'Edit','/listings/delete/'.$listing['Listing']['id']=>'Delete');
			
			echo $this->Form->input('', array('id'=>'listingsid','type'=>'select','label' => '','options' =>$size));
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
</div>
<script type="text/javascript">
   $(document).ready( function() {
      // bind change event to select
      $('#listingsid').live('click', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>
<script type="text/javascript">
document.getElementById("InventoryMasterCategory").onchange = function() {
     var selectedOption = $(this).val();
     window.location.href = "http://212.227.103.36:8888/listings/category/" + selectedOption;
}
</script>
<?php } 
