<?php

if ($this->Session->read('User.loggedin')) {
  
  if (isset($error)) {
    echo '<div class="error">'.$error.'</div>';
  }
  
  ?>
  
  <div class="users form">
  <?php echo $this->Form->create('User', array(
    'action' => 'change_password'
  ));?>
  	<fieldset>
   		<legend><?php __('Change password'); ?></legend>
  	<?php
  		echo $this->Form->input('password', array(
  		  'label' => 'Current password',
  		  'type' => 'password',
  		  'value' => ''
  		));
  		echo $this->Form->input('new_password', array(
  		  'label' => 'New password',
  		  'type' => 'password',
  		  'value' => ''
  		));
  		echo $this->Form->input('new_password_repeat', array(
  		  'label' => 'Repeat new password',
  		  'type' => 'password',
  		  'value' => ''
  		));
  	?>
  	</fieldset>
  <?php echo $this->Form->end('Submit');?>
  </div>  
  <?php
}
else {
  ?>
  <div class="error">
    You need to login to access this page
  </div>  
  <?php
}

?>



