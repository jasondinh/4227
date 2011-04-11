<div class="employees index">
	<h2><?php __('Employees');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('username');?></th>
			<th><?php echo $this->Paginator->sort('password');?></th>
			<th><?php echo $this->Paginator->sort('first_name');?></th>
			<th><?php echo $this->Paginator->sort('last_name');?></th>
			<th><?php echo $this->Paginator->sort('age');?></th>
			<th><?php echo $this->Paginator->sort('address');?></th>
			<th><?php echo $this->Paginator->sort('city');?></th>
			<th><?php echo $this->Paginator->sort('country');?></th>
			<th><?php echo $this->Paginator->sort('telephone');?></th>
			<th><?php echo $this->Paginator->sort('point');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('zip');?></th>
			<th><?php echo $this->Paginator->sort('access');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($employees as $employee):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $employee['Employee']['id']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['username']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['password']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['first_name']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['last_name']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['age']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['address']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['city']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['country']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['telephone']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['point']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['email']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['zip']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['access']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['created']; ?>&nbsp;</td>
		<td><?php echo $employee['Employee']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $employee['Employee']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $employee['Employee']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $employee['Employee']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $employee['Employee']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Employee', true), array('action' => 'add')); ?></li>
	</ul>
</div>