<?php
class Queue extends AppModel {
	var $name = 'Queue';
	var $displayField = 'id';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Video' => array(
			'className' => 'Video',
			'foreignKey' => 'video_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function find_queue_by_user_id_and_movie_id($user_id, $movie_id) {
		$queue = $this->find('first', array(
			'conditions' => array(
				'Queue.user_id' => $user_id,
				'Queue.video_id' => $movie_id
			),
		));
		
		return $queue;
	}
	
	function find_pending_queue_by_user_id($user_id) {
	  $count = $this->find('count', array(
	   'conditions' => array(
				'Queue.user_id' => $user_id,
				'Queue.status' => 0
			),
	  ));
	  return $count;
	}
}
?>