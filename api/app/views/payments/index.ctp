<div class="payments index">
	<h2><?php __('Payments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('queue_id');?></th>
			<th><?php echo $this->Paginator->sort('timeStamp');?></th>
			<th><?php echo $this->Paginator->sort('transaction_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($payments as $payment):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $payment['Payment']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($payment['Queue']['id'], array('controller' => 'queues', 'action' => 'view', $payment['Queue']['id'])); ?>
		</td>
		<td><?php echo $payment['Payment']['timeStamp']; ?>&nbsp;</td>
		<td><?php echo $payment['Payment']['transaction_id']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $payment['Payment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $payment['Payment']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $payment['Payment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $payment['Payment']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Payment', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Queues', true), array('controller' => 'queues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Queue', true), array('controller' => 'queues', 'action' => 'add')); ?> </li>
	</ul>
</div>