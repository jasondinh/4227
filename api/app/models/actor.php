<?php
class Actor extends AppModel {
	var $name = 'Actor';
	var $displayField = 'id';
	var $actsAs = 'ExtendAssociations'; 
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'Photo' => array(
			'className' => 'Photo',
			'joinTable' => 'actors_photos',
			'foreignKey' => 'actor_id',
			'associationForeignKey' => 'photo_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Video' => array(
			'className' => 'Video',
			'joinTable' => 'actors_videos',
			'foreignKey' => 'actor_id',
			'associationForeignKey' => 'video_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
	
	function find_actor_by_id($id) {
		$actor = $this->find('first', array(
			'conditions' => array(
				'Actor.id' => $id
			),
			'recursive' => -1
		));
		
		return $actor;
	}

}
?>