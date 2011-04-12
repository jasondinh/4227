<?php
class Payment extends AppModel {
	var $name = 'Payment';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Queue' => array(
			'className' => 'Queue',
			'foreignKey' => 'queue_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>