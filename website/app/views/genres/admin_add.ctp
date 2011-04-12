<div class="genres form">
<?php echo $this->Form->create('Genre');?>
	<fieldset>
 		<legend><?php __('Add New Genre'); ?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>