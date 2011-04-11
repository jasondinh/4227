<div class="employees form">
<?php echo $this->Form->create('Employee');?>
	<fieldset>
 		<legend><?php __('Admin Edit Employee'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('age');
		echo $this->Form->input('address');
		echo $this->Form->input('city');
		echo $this->Form->input('country');
		echo $this->Form->input('telephone');
		echo $this->Form->input('point');
		echo $this->Form->input('email');
		echo $this->Form->input('zip');
		echo $this->Form->input('access');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Employee.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Employee.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Employees', true), array('action' => 'index'));?></li>
	</ul>
</div>