<div class="videos form">
<?php echo $this->Form->create('Video');?>
	<fieldset>
 		<legend><?php __('Add New Video'); ?></legend>
	<?php
	//debug($video);
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('imbd');
		echo $this->Form->input('quantity');
		echo $this->Form->input('available');
		echo $this->Form->input('youtube');
		echo $this->Form->input('genre_id', array(
		  'options' => $genres,
		));
		echo $this->Form->input('Actor', array(
		  'options' => $actors,
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>