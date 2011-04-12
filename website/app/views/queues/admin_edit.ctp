<div class="queues form">
<?php echo $this->Form->create('Queue');?>
	<fieldset>
 		<legend><?php __('Admin Edit Queue'); ?></legend>
	<?php
		echo $this->Form->input('id', array(
		  'type' => 'hidden',
		  'value' => $queue['Queue']['id']
		));
		echo $this->Form->input('video_id', array(
		  'type' => 'select',
		  'options' => $videos,
		  'value' => $queue['Queue']['video_id']
		));
		echo $this->Form->input('status', array(
		  'type' => 'select',
		  'options' => array(
		    '0' => 'Pending',
		    '1' => 'Processing',
		    '2' => 'Sent',
		    '3' => 'Returned'
		  ),
		  'value' => $queue['Queue']['status']
		));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>