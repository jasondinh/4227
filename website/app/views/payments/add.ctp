<div class="payments form">
<?php echo $this->Form->create('Payment');?>
	<fieldset>
		<legend><?php __('Add Payment'); ?></legend>
	<?php
		echo $this->Form->input('queue_id');
		echo $this->Form->input('timeStamp');
		echo $this->Form->input('transaction_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Payments', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Queues', true), array('controller' => 'queues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Queue', true), array('controller' => 'queues', 'action' => 'add')); ?> </li>
	</ul>
</div>