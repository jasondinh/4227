<div class="videos form">
<?php echo $this->Form->create('Video');?>
	<fieldset>
 		<legend><?php __('Admin Add Video'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('imbd');
		echo $this->Form->input('quantity');
		echo $this->Form->input('available');
		echo $this->Form->input('genre_id');
		echo $this->Form->input('Actor');
		echo $this->Form->input('Photo');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Videos', true), array('action' => 'index'));?></li>
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