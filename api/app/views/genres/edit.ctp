<div class="genres form">
<?php echo $this->Form->create('Genre');?>
	<fieldset>
 		<legend><?php __('Edit Genre'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Genre.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Genre.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Genres', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Videos', true), array('controller' => 'videos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video', true), array('controller' => 'videos', 'action' => 'add')); ?> </li>
	</ul>
</div>