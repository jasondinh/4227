<div class="actors form">
<?php echo $this->Form->create('Actor');?>
	<fieldset>
 		<legend><?php __('Edit Actor'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('full_name');
		echo $this->Form->input('dob');
		echo $this->Form->input('Photo');
		echo $this->Form->input('Video');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Actor.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Actor.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Actors', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Photos', true), array('controller' => 'photos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Photo', true), array('controller' => 'photos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Videos', true), array('controller' => 'videos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Video', true), array('controller' => 'videos', 'action' => 'add')); ?> </li>
	</ul>
</div>