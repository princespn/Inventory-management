<?php 
if($session->read('Auth.User.group_id')=='4' && $session->read('Auth.User.group_id')=='3')
{
$this->requestAction('/users/logout/', array('return'));
}
?>
 <?php
 if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){

	$line= $german_listings[0]['GermanListing'];
	$mapping = array('','','Lagerhaltungsnummer','Produktname','Hersteller-Barcode','Barcode-Typ','Produkttyp','Marke','Hersteller','Artikelnummer','Produktbeschreibung','Update / Löschen','Anzahl','Preis','Währung','Zustandstyp des Angebots','Angebotsbedingung Anmerkung','Produkt-Site Startdatum','Vorlaufzeit für die Lieferung','Veröffentlichungsdatum','Termin zur Wiederauffüllung','Angebotspreis','Startdatum des Sonderangebots','Enddatum des Sonderangebots','Max. Menge Aggregatversand','Maximale Bestellmenge','Angebot kann als Geschenk versendet werden','Angebot kann als Geschenk eingepackt werden','Fehlender Hauptgrund','Wird vom Hersteller nicht mehr hergestellt','Packungseinheit','Steuerkennziffer des Produkts','SKU-Liste für Lieferung zum Wunschtermin','Verkäuferversandgruppe','Versandgewicht','Maßeinheit des auf der Webseite angegebenen Versandgewichts','Artikelgewicht','Maßeinheit des Artikelgewichts','Artikellänge','Maßeinheit der Artikellänge','Artikelbreite','Maßeinheit der Artikelweite','Artikelhöhe','Maßeinheit der Artikelhöhe','Artikeltiefe','Maßeinheit der Tiefe des Artikels','Artikeldurchmesser','Maßeinheit des Durchmessers des Artikels','Attribut1','Attribut2','Attribut3','Attribut4','Attribut5','Produktkategorisierung Suchpfad1','Produktkategorisierung Suchpfad2','Allgemeine Schlüsselwörter1','Allgemeine Schlüsselwörter2','Allgemeine Schlüsselwörter3','Allgemeine Schlüsselwörter4','Allgemeine Schlüsselwörter5','Katalognummer','Platinum Schlüsselwörter1','Platinum Schlüsselwörter2','Platinum Schlüsselwörter3','Platinum Schlüsselwörter4','Platinum Schlüsselwörter5','Zielgruppe','URL Hauptbild','URL Musterbild','URL Weiteres Produktbild1','URL Weiteres Produktbild2','URL Weiteres Produktbild3','URL Weiteres Produktbild4','URL Weiteres Produktbild5','URL Weiteres Produktbild6','URL Weiteres Produktbild7','URL Weiteres Produktbild8','Versandzentrum-ID','Paketbreite','Pakethöhe','Maßeinheit der Verpackungslänge','Paketgewicht','Maßeinheit des Verpackungsgewichts','Produktbeziehungs-Typ','Variantenbestandteil','SKU des übergeordneten Produkts','Varianten-Design','','','','','','','','','','','','','','','','','','','','','','','','','','','','Farbe (Herstellerbezeichnung)','Standardfarbe','Produktspezifische Größe','Gewindeanzahl','Material','','','');
	echo $csv->addRow($mapping);
	$csv->addRow(array_keys($line));
	foreach ($german_listings as $german_listing){		
	  $line = $german_listing['GermanListing'];
	  echo $csv->addRow($line);
	}
	$filename='german_listings';
	echo $csv->render($filename);
	}else{
	
	 ?>
<div class="german_listings index"><div class="grid_16">
<h2 id="page-heading"><?php __('Amazon Germany Listing');?></h2>
<table cellpadding="0" cellspacing="0">
<?php  echo $form->create('GermanListing',array('action'=>'index','id'=>'saveForm')); ?>
	<tr style="background:#666666;color:#ffffff;">
			
				
			<th style="width:90px;"><a class="checkall" href="#">Check All</a><?php echo ' | ' ; ?><a class="uncheckall" href="#">Uncheck All</a></th>
			<th><dev class="title-text"><?php __('Image');?></div></th>
			<th><?php	echo $this->Form->input('all_item',array('label'=>'','placeholder'=>'Search SKU,Title...','class'=>'export_box')); ?></th>
			<th></th>
			<th><dev class="title-text"><?php __('Available');?></th>
			<th><dev class="title-text"><?php __('Price');?></th>
			<th   colspan='3'><div style="float:right"><div style="margin: 5px;"><?php echo $this->Form->button('Search', array('value'=>'submit','name'=>'submit','id'=>'submit','type'=>'submit')); ?></div><div class="btnClick" style="display:none;"><?php echo $this->Form->button('Export Data', array('value'=>'exports','name'=>'exports','type'=>'submit')); ?></div></div></th>
			
	</tr>

	<?php
	$i = 0;
	foreach ($german_listings as $german_listing):
		$class = null;
		
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>

	
		<td class="checkbox"><?php	
		 $productid = $german_listing['GermanListing']['id'];
		echo $this->Form->input('GermanListing.id',array('class'=>'chk1', 'selected'=>'selected','label'=>'','multiple' => 'checkbox', 'value' =>$productid,'name'=>'checkid[]', 'type'=>'checkbox')); ?></td>
		<td class="checkbox"><?php  if(!empty($german_listing['GermanListing']['main_image_url'])){	echo "<img width='70px' src=http://images.vikkit.co.uk/Amazon-Images/".$german_listing['GermanListing']['main_image_url'].">";
		}else { echo '<img width=70px src=/img/images.png>';	}?></td>
		<td class="checkbox"><?php echo $german_listing['GermanListing']['item_sku']; ?></td>
		<td class="checkbox"><?php 
		 if(!empty($german_listing['GermanListing']['item_name']))
		{
		$row1 = $german_listing['GermanListing']['item_name'];			
		$item = strlen($row1); 
				 if($item >= '500'){
				 echo "<div style='color:red;'>Item Name must be no long 500 characters.</div>";
				 
				 }else {
				 $itemname = substr($row1,0,200); 
				 
				 $item_name = mb_convert_encoding($itemname, "UTF-8", mb_detect_encoding($itemname, "UTF-8, ISO-8859-1, ISO-8859-15", true));
				 echo ($item_name);
								 
				 }
		
		}else{
		echo "<div style='color:red;'>Item Name is required</div>";
		}?></td>
		<td class="checkbox"><?php echo $german_listing['GermanListing']['quantity']; ?></td>	
		<td class="checkbox"><?php if(!empty($german_listing['GermanListing']['standard_price']))
		{ echo $german_listing['GermanListing']['standard_price'];}else{
		echo "<div style='color:red;'>Price is required.</div>";
		} ?></td>	
		<td class="actions">
		<?php 
			$size = array(''=>'Select','/german_listings/edit/'.$german_listing['GermanListing']['id']=>'Edit','/german_listings/delete/'.$german_listing['GermanListing']['id']=>'Delete');
			
			echo $this->Form->input('', array('id'=>'german_listingsid','type'=>'select','label' => '','options' =>$size));
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
      $('#german_listingsid').live('click', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>

<?php } ?>
