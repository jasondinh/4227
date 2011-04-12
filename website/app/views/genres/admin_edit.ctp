<div class="genres form">
<?php echo $this->Form->create('Genre');?>
	<fieldset>
 		<legend><?php __('Admin Edit Genre'); ?></legend>
	<?php
		echo $this->Form->input('id', array(
		  'type' => 'hidden',
		  'value' => $genre['Genre']['id']
		));
		echo $this->Form->input('name', array(
		  'value' => $genre['Genre']['name']
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
