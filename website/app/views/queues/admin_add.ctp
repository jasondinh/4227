<div class="queues form">
<?php echo $this->Form->create('Queue');?>
	<fieldset>
 		<legend><?php __('Admin Add Queue'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('video_id');
		echo $this->Form->input('timeStamp');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Queues', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Videos', true), array('controller' => 'videos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video', true), array('controller' => 'videos', 'action' => 'add')); ?> </li>
	</ul>
</div>