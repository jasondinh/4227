<div class="photos view">
<h2><?php  __('Photo');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $photo['Photo']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Url'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $photo['Photo']['url']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $photo['Photo']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $photo['Photo']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Photo', true), array('action' => 'edit', $photo['Photo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Photo', true), array('action' => 'delete', $photo['Photo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $photo['Photo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Photos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photo', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Actors', true), array('controller' => 'actors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Actor', true), array('controller' => 'actors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Videos', true), array('controller' => 'videos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video', true), array('controller' => 'videos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Actors');?></h3>
	<?php if (!empty($photo['Actor'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Full Name'); ?></th>
		<th><?php __('Dob'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($photo['Actor'] as $actor):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $actor['id'];?></td>
			<td><?php echo $actor['full_name'];?></td>
			<td><?php echo $actor['dob'];?></td>
			<td><?php echo $actor['created'];?></td>
			<td><?php echo $actor['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'actors', 'action' => 'view', $actor['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'actors', 'action' => 'edit', $actor['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'actors', 'action' => 'delete', $actor['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $actor['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Actor', true), array('controller' => 'actors', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Videos');?></h3>
	<?php if (!empty($photo['Video'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Imbd'); ?></th>
		<th><?php __('Quantity'); ?></th>
		<th><?php __('Available'); ?></th>
		<th><?php __('Genre Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($photo['Video'] as $video):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $video['id'];?></td>
			<td><?php echo $video['name'];?></td>
			<td><?php echo $video['description'];?></td>
			<td><?php echo $video['imbd'];?></td>
			<td><?php echo $video['quantity'];?></td>
			<td><?php echo $video['available'];?></td>
			<td><?php echo $video['genre_id'];?></td>
			<td><?php echo $video['created'];?></td>
			<td><?php echo $video['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'videos', 'action' => 'view', $video['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'videos', 'action' => 'edit', $video['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'videos', 'action' => 'delete', $video['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $video['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Video', true), array('controller' => 'videos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
