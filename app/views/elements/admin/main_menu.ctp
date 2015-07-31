<ul class="nav main">
	<li>
	<a href="#">Imports Listing</a>
		<ul>
			 <li><?php echo $this->Html->link(__('UK Listing', true), array('controller' => 'projects', 'action' => 'import')); ?></li>
             <li><?php echo $this->Html->link(__('France Listing', true), array('controller' => 'listings', 'action' => 'import')); ?></li>
			 <li><?php echo $this->Html->link(__('Germany Listing', true), array('controller' => 'german_listings', 'action' => 'import')); ?></li>
              
		</ul>	
	</li>
	<li>
		<li><a href="#">Exports Listing</a>
		<ul>
          <li><?php echo $this->Html->link(__('UK Listing', true), array('controller' => 'projects', 'action' => 'index')); ?></li>
          <li><?php echo $this->Html->link(__('France Listing', true), array('controller' => 'listings', 'action' => 'index')); ?></li>
		  <li><?php echo $this->Html->link(__('Germany Listing', true), array('controller' => 'german_listings', 'action' => 'index')); ?></li>
        </ul>
	</li>
	<li>
		<?php echo $this->Html->link(__('My Account', true), array('controller' => 'users','action' => 'index'));?>	
	          <ul>
            <li class="green"><?php echo $this->Html->link(__('Users', true), array('controller' => 'users','action' => 'index'));?></li>
			<?php if($session->read('Auth.User.group_id')=='1') { ?>
			<li><?php echo $this->Html->link(__('Add New User', true), array('controller' => 'users', 'action' => 'add')); ?></li>
            <?php } ?>
            <li><a href="<?php echo $this->Html->url('/users/logout', true); ?>">logout</a></li>            
			</ul>
	</li>
	<li style="float:right;"><a href="#"><b>Welcome</b> <?php echo $session->read('Auth.User.username'); ?></a></li>
</ul>
