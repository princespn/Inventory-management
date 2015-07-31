<!DOCTYPE html>
<head>
<?php echo $this->Html->charset('ISO-8859-1'); ?>
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
		echo $scripts_for_layout;
	?>
<?php echo $this->Html->meta('favicon.ico','/img/favicon.ico',array('type' => 'icon'));?> 
</head>
<body>
	<div class="container_16">			
		<div class="grid_16">
			<h1 id="branding">
			<?php echo $this->Html->link(__('Inventory Management', true), array('controller' => 'projects', 'action' => 'index')); ?>
				
			</h1>
		</div>
		<div class="clear"></div>				
		<div class="clear" style="height: 10px; width: 100%;"></div>
		
			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>
		
		<div class="clear"></div>
	</div>
	<?php // echo $this->element('sql_dump'); ?>
</body>
</html>
