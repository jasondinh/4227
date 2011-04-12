
<?php echo $this->Form->create('User');?>
	<fieldset>
 		<legend><?php __('Get help'); ?></legend>
	<?php
		echo $this->Form->input('question', array(
		  'type' => 'textarea'
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>