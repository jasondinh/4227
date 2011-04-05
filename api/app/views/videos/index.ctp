<div class="videos index">
	<h2><?php __('Videos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('imbd');?></th>
			<th><?php echo $this->Paginator->sort('quantity');?></th>
			<th><?php echo $this->Paginator->sort('available');?></th>
			<th><?php echo $this->Paginator->sort('genre_id');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($videos as $video):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $video['Video']['id']; ?>&nbsp;</td>
		<td><?php echo $video['Video']['name']; ?>&nbsp;</td>
		<td><?php echo $video['Video']['description']; ?>&nbsp;</td>
		<td><?php echo $video['Video']['imbd']; ?>&nbsp;</td>
		<td><?php echo $video['Video']['quantity']; ?>&nbsp;</td>
		<td><?php echo $video['Video']['available']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($video['Genre']['name'], array('controller' => 'genres', 'action' => 'view', $video['Genre']['id'])); ?>
		</td>
		<td><?php echo $video['Video']['created']; ?>&nbsp;</td>
		<td><?php echo $video['Video']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $video['Video']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $video['Video']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $video['Video']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $video['Video']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Video', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Genres', true), array('controller' => 'genres', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Genre', true), array('controller' => 'genres', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Queues', true), array('controller' => 'queues', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Queue', true), array('controller' => 'queues', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Actors', true), array('controller' => 'actors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Actor', true), array('controller' => 'actors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Photos', true), array('controller' => 'photos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photo', true), array('controller' => 'photos', 'action' => 'add')); ?> </li>
	</ul>
</div>