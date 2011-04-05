<?php

if ($this->Session->read('User.loggedin')) {
  
  if (isset($error)) {
    echo '<div class="error">'.$error.'</div>';
  }
  
  ?>
  
  <div class="users form">
  <?php echo $this->Form->create('User', array(
    'action' => 'edit_profile'
  ));?>
  	<fieldset>
   		<legend><?php __('Edit profile'); ?></legend>
  	<?php
  	
  	$user = $this->Session->read('User.info');
  		echo $this->Form->input('first_name', array(
  		  'value' => $user['User']['first_name']
  		));
  		echo $this->Form->input('last_name', array(
  		  'value' => $user['User']['last_name']
  		));
  		echo $this->Form->input('age', array(
  		  'value' => $user['User']['age']
  		));
  		echo $this->Form->input('address', array(
  		  'value' => $user['User']['address']
  		));
  		echo $this->Form->input('city', array(
  		  'value' => $user['User']['city']
  		));
  		echo $this->Form->input('country', array(
  		  'value' => $user['User']['country']
  		));
  		echo $this->Form->input('telephone', array(
  		  'value' => $user['User']['telephone']
  		));
  		echo $this->Form->input('email', array(
  		  'value' => $user['User']['email']
  		));
  		echo $this->Form->input('zip', array(
  		  'value' => $user['User']['zip']
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



