<div class="videos form">
<?php echo $this->Form->create('Video');?>
	<fieldset>
 		<legend><?php __('Admin Edit Video'); ?></legend>
	<?php
	//debug($video);
		echo $this->Form->input('id', array(
		  'value' => $video[0]['Video']['id'],
		  'type' => 'hidden'
		));
		echo $this->Form->input('name', array(
		  'value' => $video[0]['Video']['name'],
		));
		echo $this->Form->input('description', array(
		  'value' => $video[0]['Video']['description'],
		));
		echo $this->Form->input('imbd', array(
		  'value' => $video[0]['Video']['imbd'],
		));
		echo $this->Form->input('quantity', array(
		  'value' => $video[0]['Video']['quantity'],
		));
		echo $this->Form->input('available', array(
		  'value' => $video[0]['Video']['available'],
		));
		echo $this->Form->input('youtube', array(
		  'value' => $video[0]['Video']['youtube'],
		));
		echo $this->Form->input('genre_id', array(
		  'options' => $genres,
		));
		echo $this->Form->input('Actor', array(
		  'options' => $actors,
		));
		//echo $this->Form->input('Photo');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>