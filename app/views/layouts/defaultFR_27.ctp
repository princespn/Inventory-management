<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
<!--<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf8_unicode_ci" />-->

<?php  echo $this->Html->charset(); ?>
<?php echo $this->Html->meta('keywords','enter any meta keyword here');?>
<?php echo $this->Html->meta('description','enter any meta description here');?>
	<title>
		<?php __('Inventory Management'); ?> - 
		<?php echo $title_for_layout; ?>
	</title>
		<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('cake.generic');
		echo $this->Html->css(array('reset', 'text', 'grid', 'layout', 'nav'));
		echo '<!--[if IE 6]>'.$this->Html->css('ie6').'<![endif]-->';
		echo '<!--[if IE 7]>'.$this->Html->css('ie').'<![endif]-->';
		echo $this->Html->script(array('jquery-1.3.2.min.js', 'jquery-ui.js', 'jquery-fluid16.js'));
		echo $scripts_for_layout;		
	?>
	<script type="text/javascript"> 
    tinyMCE.init({ 
        theme : "simple", 
        mode : "textareas", 
        convert_urls : false 
    });
</script>
<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<?php echo $this->Html->meta('favicon.ico','/img/favicon.ico',array('type' => 'icon'));?> 
<?php echo $this->Html->script('scripts'); echo $this->Html->script('jquery-1.11.1.min');?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	$('#GermanListingFile').change(function(){
	$('#submit').removeAttr('disabled');
	
	});
	$('#submit').click(function(){
		$('#progress').show(1000);	
	
	});
    
});
</script>
<script>
$(document).ready(function(){
	$('#ProjectFile').change(function(){
	$('#submit').removeAttr('disabled');
	
	});
	$('#submit').click(function(){
		$('#progress').show(1000);	
	
	});
    
});
</script>
<script>
$(document).ready(function(){
	$('#ListingFile').change(function(){
	$('#submit').removeAttr('disabled');
	
	});
	$('#submit').click(function(){
		$('#progress').show(1000);	
	
	});
    
});
</script>
<script>
$(document).ready( function() {
$('.checkall').click(function () {	
$(":checkbox").attr("checked", true);
 $('div.btnClick').show();

    });
$('.uncheckall').click(function () {	
$(":checkbox").attr("checked", false);
$(":checkbox").removeAttr('selected');
$('div.btnClick').hide();
    });
});
</script>
<script type="text/javascript">
$.noConflict();
   $(document).ready( function() {
            $('.chk1').change(function () {
                if ($(this).is(":checked")) {
                    $('div.btnClick').show();
                }
                else {
                    var isChecked = false;
                    $('.chk1').each(function () {
                        if ($(this).is(":checked")) {
                             $('div.btnClick').show();
                            isChecked = true;
                        }
                    });
                    if (!isChecked) {
                        $('div.btnClick').hide();
                    }
                }
 
 
            })
        });
</script>
<script type="text/javascript">

   $(document).ready( function() {
  $('a[href="#"]').live('click', function(e){
    e.preventDefault();
  });
  
  $('#menu > li').live('mouseover', function(e){
    $(this).find("ul:first").show();
    $(this).find('> a').addClass('active');
  }).live('mouseout', function(e){
    $(this).find("ul:first").hide();
    $(this).find('> a').removeClass('active');
  });
  
  $('#menu li li').live('mouseover',function(e){
    if($(this).has('ul').length) {
      $(this).parent().addClass('expanded');
    }
    $('ul:first',this).parent().find('> a').addClass('active');
    $('ul:first',this).show();
  }).live('mouseout',function(e){
    $(this).parent().removeClass('expanded');
    $('ul:first',this).parent().find('> a').removeClass('active');
    $('ul:first', this).hide();
  });
});
</script>	
	
</head>
<body>
	<div class="container_16">			
		<div class="grid_16">
			<h1 id="branding">
			<?php echo $this->Html->link(__('Inventory Management', true), array('controller' => 'projects', 'action' => 'index')); ?>
				
			</h1>
		</div>
		<div class="grid_16">
			 <?php echo $this->element('admin/main_menu'); ?>
		</div>
		
		<div class="clear" style="height: 10px; width: 100%;"></div>
		<h2 id="page-heading"><?php echo $this->Session->flash(); ?></h2>
			

			<?php echo $content_for_layout; ?>
		
		
	</div>
	<?php  // echo $this->element('sql_dump'); ?>
</body>
</html>
