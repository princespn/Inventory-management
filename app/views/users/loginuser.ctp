<?php
/**
 *
 *
 * @copyright     Copyright 2005-2010, Blazecore, Inc.
 * @link          
 * @package       
 * @subpackage    cake.cake.libs.view.templates.pages
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/*if (Configure::read() == 0):
	$this->cakeError('error404');
endif;*/
?>
<div class="registration"><!--registration page!-->
<?php echo $this->Form->create(null, array('url' => array('controller' => 'user', 'action' => 'loginuser'))); ?> 
                          		<table width="488" border="0" cellspacing="0" cellpadding="0" align="center">
                          		    
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td  width="124">Username or email</td>
                                        <td class="sign_in_txtbg"><?php echo $this->Form->input('username',array('class'=>'sign_in_bx','label' => false)); ?></td>
                                  </tr>
                                      
                                       <tr>
                                        <td >Password</td>
                                        <td width="208"  class="sign_in_txtbg"><?php echo $this->Form->input('password',array('class'=>'sign_in_bx','label' => false)); ?></td>
                                       </tr>     
                                      <tr>
                                        <td>&nbsp;</td>
<td width="36" valign="middle"><?php echo $this->Form->submit('submit', array('type' => 'image','div'=>false, 'src' => $this->webroot . 'img/go.gif')); ?> &nbsp;<input type="checkbox" />Remember me</td>
                                      </tr>
                                       <tr>
                                        <td>&nbsp;</td>
                                      </tr>
                                      <tr>
                                        <td></td>  
                                        <td class="forgot"><a href="#" class="forgot" >Forgot password?</a> <a href="#" class="forgot" > Forgot username?</a></td>
                                      </tr>
                                       <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                      </tr>
                                      
                                    </table>
                                    <?php echo $this->Form->end(); ?>
                          </div>

