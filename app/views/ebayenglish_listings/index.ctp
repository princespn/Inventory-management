<?php 
if($session->read('Auth.User.group_id')=='4' && $session->read('Auth.User.group_id')=='3')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
 <?php
 if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){

	$line= $ebayenglishlistings[0]['EbayenglishListing'];
	$mapping = array('','','','SKU','EB-UK-Title','EB-UK-Price','EB-UK-Descripton','EB-UK-Size','EB-UK-Brand','EB-UK-Color','EB-UK-Color1','EB-UK-Material','EB-UK-Room','EB-UK-Type','EB-UK-SubType','EB-UK-Plant Required','EBAY_IMAGE1','EBAY_IMAGE2');
	echo $csv->addRow($mapping);
	$csv->addRow(array_keys($line));
	
	foreach ($ebayenglishlistings as $ebayenglishlisting){		
	  $line = $ebayenglishlisting['EbayenglishListing'];
	  echo $csv->addRow($line);
	}
	$filename='ebayenglish_listings';
	echo $csv->render($filename);
	}else{
	
	 ?>
<div class="projects index"><div class="grid_16">
<h2 id="page-heading"><?php __('Ebay Uk Listing');?></h2>
<table cellpadding="0" cellspacing="0">
<?php  echo $form->create('EbayenglishListing',array('action'=>'index','id'=>'saveForm')); ?>
	<tr style="color:#ffffff;">
	<th colspan="3"></th>
	<th><?php	echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search Product Code,SKU...','class'=>'export_box')); ?></th>
	<th colspan="5"></th>
	</tr>
	<tr style="background:#666666;color:#ffffff;">				
			<th style="width:90px;"><a class="checkall" href="#">Check All</a><?php echo ' | ' ; ?><a class="uncheckall" href="#">Uncheck All</a></th>
			<th><div class="title-text"><?php __('Image');?></div></th>
                        <th><div class="title-text"><?php __('Product Code');?></th>
			<th><?php __('SKU');?></th>			
			<th><div class="title-text"><?php __('Title');?></div></th>
			<th><div class="title-text"><?php __('Price');?></div></th>
			<th><div class="title-text"><?php __('Size');?></div></th>
			<th   colspan='3'><div style="float:right"><div style="margin: 5px;"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','type'=>'submit')); ?></div><div class="btnClick" style="display:none;"><?php echo $this->Form->button('Export Data', array('value'=>'exports','name'=>'exports','type'=>'submit')); ?></div></div></th>
			
	</tr>

	<?php
	$i = 0;
	foreach ($ebayenglishlistings as $ebayenglishlisting):
		$class = null;
		
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>

	
		<td class="checkbox"><?php	
		 $productid = $ebayenglishlisting['EbayenglishListing']['id'];
		echo $this->Form->input('EbayenglishListing.id',array('class'=>'chk1', 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?></td>
		<td class="checkbox"><?php  if(!empty($ebayenglishlisting['EbayenglishListing']['image1'])){	echo "<img width='70px' src=http://images.vikkit.co.uk/Amazon-Images/".$ebayenglishlisting['EbayenglishListing']['image1'].">";
		}else { echo '<img width=70px src=/img/images.png>';	}?></td>
		<td class="checkbox"><?php echo $ebayenglishlisting['EbayenglishListing']['sku']; ?></td>
		<td class="checkbox"><?php echo $ebayenglishlisting['EbayenglishListing']['product_code']; ?></td>
		<td class="checkbox"><?php 
		 if(!empty($ebayenglishlisting['EbayenglishListing']['title']))
		{
		$row1 = $ebayenglishlisting['EbayenglishListing']['title'];			
		$item = strlen($row1); 
				 if($item >= '500'){
				 echo "<div style='color:red;'>Title must be no long 500 characters.</div>";
				 
				 }else {
				 $itemname = substr($row1,0,200); 
				 
				 $item_name = mb_convert_encoding($itemname, "UTF-8", mb_detect_encoding($itemname, "UTF-8, ISO-8859-1, ISO-8859-15", true));
				 echo ($item_name);
								 
				 }
		
		}else{
		echo "<div style='color:red;'>Title is required</div>";
		}?></td>
                <td class="checkbox"><?php 
		$stanprice = $ebayenglishlisting['EbayenglishListing']['price'];
		if(empty($stanprice))
		 {
		   echo "<span style='color:red;' title='Price is Required.'>Price is Required</span>";
	     }
		 else
		 {
			  $pric = $ebayenglishlisting['EbayenglishListing']['error'];
			   $pieces = explode(":", $pric);
			   if((!empty($pieces[1])) && ($pieces[1] == 'Price did not match.'))
			   {
				// if($pieces[1] == 'Standard Price did not match.'){
					if(!empty($pieces[1]))
					{
				   echo "<span style='color:red;' title='Price did not match.'>$stanprice</span>";
					}
				}
				else
				{
					echo $stanprice;
				}
		}
	 ?></td>	
		<td class="checkbox"><?php if(!empty($ebayenglishlisting['EbayenglishListing']['size']))
		{ echo $ebayenglishlisting['EbayenglishListing']['size'];}else{
		echo "<div style='color:red;'>Size is required.</div>";
		} ?></td>	
		<td class="actions">
		<?php 
			$size = array(''=>'Select','/ebayenglish_listings/edit/'.$ebayenglishlisting['EbayenglishListing']['id']=>'Edit','/ebayenglish_listings/delete/'.$ebayenglishlisting['EbayenglishListing']['id']=>'Delete');
			
			echo $this->Form->input('', array('id'=>'ebayenglishlistingsid','type'=>'select','label' => '','options' =>$size));
		 ?>		
		</td>
	</tr>
<?php endforeach; ?>
<?php echo $this->Form->end();?>
	</table><p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?></p>
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
      $('#ebayenglishlistingsid').live('click', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>

<?php } ?>
