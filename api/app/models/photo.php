<?php
class Photo extends AppModel {
	var $name = 'Photo';
	var $displayField = 'id';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasAndBelongsToMany = array(
		'Actor' => array(
			'className' => 'Actor',
			'joinTable' => 'actors_photos',
			'foreignKey' => 'photo_id',
			'associationForeignKey' => 'actor_id',
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
			'joinTable' => 'photos_videos',
			'foreignKey' => 'photo_id',
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

}
?>