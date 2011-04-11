
<?php

if (isset($error)) {
  echo '<div class="error">'.$error.'</div>';
}

?>

<div class="users form">
  <?php 
  echo $this->Form->create('User', array(
    'action' => 'register'
    ));
?>
<fieldset>
  <legend><?php __('Register User'); ?></legend>
  <?php
  echo $this->Form->input('username');
  echo $this->Form->input('password', array(
    'type' => 'password',
    'value' => ''
  ));
  echo $this->Form->input('repeat_password', array(
    'type' => 'password',
    'value' => ''
  ));
  echo $this->Form->input('first_name');
  echo $this->Form->input('last_name');
  echo $this->Form->input('age');
  echo $this->Form->input('address');
  echo $this->Form->input('city');
  echo $this->Form->input('zip');
  echo $this->Form->input('country');
  echo $this->Form->input('telephone');
  echo $this->Form->input('email');
  ?>
</fieldset>
<?php echo $this->Form->end(__('Register', true));?>
</div>
</div>