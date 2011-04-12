<?php
/* Queue Fixture generated on: 2011-04-12 04:25:44 : 1302553544 */
class QueueFixture extends CakeTestFixture {
	var $name = 'Queue';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'video_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'timeStamp' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'status' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'video_id' => 1,
			'timeStamp' => 1,
			'status' => 1,
			'created' => '2011-04-12 04:25:44',
			'modified' => '2011-04-12 04:25:44'
		),
	);
}
?>