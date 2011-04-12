<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id', array(
		  'type' => 'hidden',		));
		echo $this->Form->input('username', array(
		));
		echo $this->Form->input('password', array(
		));
		echo $this->Form->input('repeat_password', array(
		  'type'=> 'password'
		));
		echo $this->Form->input('first_name', array(
		));
		echo $this->Form->input('last_name', array(
		));
		echo $this->Form->input('age', array(
		));
		echo $this->Form->input('address', array(
		));
		echo $this->Form->input('city', array(
		));
		echo $this->Form->input('country', array(
		));
		echo $this->Form->input('telephone', array(
		));
		echo $this->Form->input('point', array(
		));
		echo $this->Form->input('email', array(
		));
		echo $this->Form->input('zip', array(
		));
		echo $this->Form->input('roles', array(
		  'label' => 'Role',
		  'type' => 'select',
		  'options' => array('User', 'Admin')
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>