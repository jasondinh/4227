<div class="payments form">
<?php echo $this->Form->create('Payment');?>
	<fieldset>
		<legend><?php __('Edit Payment'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Payment.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Payment.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Payments', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Queues', true), array('controller' => 'queues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Queue', true), array('controller' => 'queues', 'action' => 'add')); ?> </li>
	</ul>
</div>