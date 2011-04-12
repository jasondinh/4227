<?php
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'id';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Queue' => array(
			'className' => 'Queue',
			'foreignKey' => 'user_id',
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
			'foreignKey' => 'user_id',
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
	
	function validate_employee() {
	  $user = $this->validate_user();
	  if ($user['User']['roles'] == 1) {
	    return $user;
	  }
	  else {
	    return null;
	  }
	}
	
	function validate_user() {
	  $username = $_REQUEST['username'];
	  $password = $_REQUEST['password'];
	  
	  
	  $user = $this->find('first', array(
	   'conditions' => array(
	     'User.username' => $username,
	     'User.password' => $password,
	     'User.status' => 1 //do not return user who did not activate his/her account
	   ),
	   'recursive' => -1
	  ));
	  
	  return $user;
	}
	
	function find_user_by_id($user_id) {
		$user = $this->find('first', array(
			'conditions' => array(
				'User.id' => $user_id
			),
			'recursive' => -1
		));
		return $user;
	}
	
	function find_user_by_email($email) {
		$user = $this->find('first', array(
			'conditions' => array(
				'User.email' => $email
			),
			'recursive' => -1
		));
		return $user;
	}
	
	function find_user_by_username($username) {
		$user = $this->find('first', array(
			'conditions' => array(
				'User.username' => $username
			),
			'recursive' => -1
		));
		return $user;
	}
	
	function check_login($username, $password) {
	  $user = $this->find_user_by_username($username);
	  
	  if ($user) {
	    if ($user['User']['password'] == $password) {
	      return $user;
	    }
	  }
	  
	  return array('error' => 'You entered a wrong username/password combination. Please try again');
	}

}
?>