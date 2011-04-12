<div class="payments view">
<h2><?php  __('Payment');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $payment['Payment']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Queue'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($payment['Queue']['id'], array('controller' => 'queues', 'action' => 'view', $payment['Queue']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('TimeStamp'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $payment['Payment']['timeStamp']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Transaction Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $payment['Payment']['transaction_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Payment', true), array('action' => 'edit', $payment['Payment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Payment', true), array('action' => 'delete', $payment['Payment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $payment['Payment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Payments', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Queues', true), array('controller' => 'queues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Queue', true), array('controller' => 'queues', 'action' => 'add')); ?> </li>
	</ul>
</div>
