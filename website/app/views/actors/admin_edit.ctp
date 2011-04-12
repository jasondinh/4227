<div class="actors form">
<?php echo $this->Form->create('Actor');?>
	<fieldset>
 		<legend><?php __('Edit Actor'); ?></legend>
	<?php
		echo $this->Form->input('id', array(
		  'type' => 'hidden', 
		  'value' => $actor['Actor']['id']
		));
		echo $this->Form->input('full_name', array(
		  'value' => $actor['Actor']['full_name']
		));
		echo $this->Form->input('dob', array(
		  'value' => $actor['Actor']['dob'],
		  'label' => 'Day or birth(DD/MM/YYYY)'
		));
		//echo $this->Form->input('Photo');
		echo $this->Form->input('Video');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>