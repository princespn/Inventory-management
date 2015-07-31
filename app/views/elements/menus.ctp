<nav>
    <div class="wrapper">
      <ul id="menu" class="clearfix">
        <li><?php echo $this->Html->link(__('Home', true), array('controller' => 'projects', 'action' => 'index')); ?></li>
         <li><a href="#">Amazon Listing</a>
          <ul>
            <li class="green"><a href="#">Imports Listing</a>
              <ul>
                <li><?php echo $this->Html->link(__('UK Listing', true), array('controller' => 'projects', 'action' => 'import')); ?></li>
                <li><?php echo $this->Html->link(__('France Listing', true), array('controller' => 'listings', 'action' => 'import')); ?></li>
                
              </ul>
            </li>
            
           
            <li class="green"><a href="#">Exports Listing</a>
              <ul>
                <li><?php echo $this->Html->link(__('UK Listing', true), array('controller' => 'projects', 'action' => 'index')); ?></li>
                <li><?php echo $this->Html->link(__('France Listing', true), array('controller' => 'listings', 'action' => 'index')); ?></li>
              </ul>
            </li>
          </ul>
        </li>
         <li><?php echo $this->Html->link(__('My Account', true), array('controller' => 'users','action' => 'index'));?>
          <ul>
            <li class="green"><?php echo $this->Html->link(__('Users', true), array('controller' => 'users','action' => 'index'));?>
					<?php if($session->read('Auth.User.group_id')=='1') { ?>
				<ul>
                <li><?php echo $this->Html->link(__('Add User', true), array('controller' => 'users', 'action' => 'add')); ?></li>
              </ul>
			  <?php } ?>
			</li>
			<?php if($session->read('Auth.User.username')!='') { ?>
            <li><a href="<?php echo $this->Html->url('/users/logout', true); ?>">logout</a></li>
			 <?php } else {?>
			  <li><a href="<?php echo $this->Html->url('/users/login', true); ?>">Sign In</a></li>
            <?php } ?>
			</ul>
        </li>
      </ul>
    </div>
  </nav>