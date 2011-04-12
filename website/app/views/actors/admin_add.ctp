<div class="actors form">
<?php echo $this->Form->create('Actor');?>
	<fieldset>
 		<legend><?php __('New Actor'); ?></legend>
	<?php
		echo $this->Form->input('full_name', array(
		));
		echo $this->Form->input('dob', array(
		  'label' => 'Day or birth(DD/MM/YYYY)'
		));
		echo $this->Form->input('Video');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>