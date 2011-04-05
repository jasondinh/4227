<div class="queues index">
	<h2><?php __('Queues');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('user_id');?></th>
			<th><?php echo $this->Paginator->sort('video_id');?></th>
			<th><?php echo $this->Paginator->sort('timeStamp');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($queues as $queue):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $queue['Queue']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($queue['User']['id'], array('controller' => 'users', 'action' => 'view', $queue['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($queue['Video']['name'], array('controller' => 'videos', 'action' => 'view', $queue['Video']['id'])); ?>
		</td>
		<td><?php echo $queue['Queue']['timeStamp']; ?>&nbsp;</td>
		<td><?php echo $queue['Queue']['status']; ?>&nbsp;</td>
		<td><?php echo $queue['Queue']['created']; ?>&nbsp;</td>
		<td><?php echo $queue['Queue']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $queue['Queue']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $queue['Queue']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $queue['Queue']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $queue['Queue']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Queue', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Videos', true), array('controller' => 'videos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video', true), array('controller' => 'videos', 'action' => 'add')); ?> </li>
	</ul>
</div>