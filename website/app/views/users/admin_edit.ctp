<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php __('Edit User'); ?></legend>
	<?php
		echo $this->Form->input('id', array(
		  'type' => 'hidden',
		  'value' => $user['User']['id']
		));
		echo $this->Form->input('username', array(
		  'value' => $user['User']['username']
		));
		echo $this->Form->input('password', array(
		  'value' => $user['User']['password']
		));
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
		echo $this->Form->input('point', array(
		  'value' => $user['User']['point']
		));
		echo $this->Form->input('email', array(
		  'value' => $user['User']['email']
		));
		echo $this->Form->input('zip', array(
		  'value' => $user['User']['zip']
		));
		echo $this->Form->input('roles', array(
		  'value' => $user['User']['roles'],
		  'label' => 'Role',
		  'type' => 'select',
		  'options' => array('User', 'Admin')
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>