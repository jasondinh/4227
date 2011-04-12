<?php
class Video extends AppModel {
	var $name = 'Video';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Genre' => array(
			'className' => 'Genre',
			'foreignKey' => 'genre_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Queue' => array(
			'className' => 'Queue',
			'foreignKey' => 'video_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'video_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


	var $hasAndBelongsToMany = array(
		'Actor' => array(
			'className' => 'Actor',
			'joinTable' => 'actors_videos',
			'foreignKey' => 'video_id',
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
		'Photo' => array(
			'className' => 'Photo',
			'joinTable' => 'photos_videos',
			'foreignKey' => 'video_id',
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
		)
	);
	
	function find_video_by_id($id) {
		$video = $this->find('first', array(
			'conditions' => array(
				'Video.id' => $id
			),
			'recursive' => -1
		));
		
		return $video;
	}
}
?>