<?php
class UsersController extends AppController {

  var $name = 'Users';
  var $components = array('Api');
  
  function beforeFilter() {
    $top10 = $this->Api->get('videos/top10');
    $this->set('top10', $top10);
    $this->set('title', 'User');
  }

  function register() {
    if (!empty($this->data)) {
      if ($this->data['User']['password'] == $this->data['User']['repeat_password']) {
        $this->Api->post('users/add_member', $this->data);
        $this->redirect(array('action' => 'index'));
      }
      else {
        $this->set('error', 'Your password didn\'t match. Try again!');
      }
    }
  }
  
  function help() {
    if (isLoggedIn($this)) {
      $this->refresh_session();
      if ($this->data) {
        $user = $this->Session->read('User.info');
        $data = $this->data;

        $data['username'] = $user['User']['username'];
        $data['password'] = $user['User']['password'];
        debug($data);
        $result = $this->Api->post('users/help', $data, true  );
      }
    }
    else {
      $this->redirect(array('controller' => 'users', 'action' => 'my_movies'));
    }
  }
  function show($id) {

  }

  function login() {
    if (!empty($this->data)) {

      $result = $this->_login($this->data['User']['username'], $this->data['User']['password']);

      if (isset($result['error'])) {
        $this->set('error', $result['error']);
      }
      else {
        $this->Session->write('User.loggedin', '1');
        $this->Session->write('User.info', $result);
        $this->redirect(array('action' => 'my_movies'));
        return $result;
      }
    }
  }

  function logout() {
    $this->Session->write('User.loggedin', '0');
    $this->Session->write('User.info', null);
    $this->redirect(array('action' => 'my_movies'));
  }

  function refresh_session() {
    $user = $this->Session->read('User.info');
    $result = $this->_login($user['User']['username'], $user['User']['password']);
    $this->Session->write('User.info', $result);
  }

  function _login($username, $password) {
    $data = array(
      'username' => $username,
      'password' => $password,
      );

    $result = $this->Api->post('users/get_profile', $data);
    return $result;
  }

  function edit_profile() {
    $this->refresh_session();
    if (!empty($this->data)) {

      $user = $this->Session->read('User.info');

      $data = $this->data;

      $data['username'] = $user['User']['username'];
      $data['password'] = $user['User']['password'];

      $result = $this->Api->post('users/update_profile', $data);
      //debug($result);
      if (isset($result['error'])) {
        $this->set('error', $result->error);
      }
      $this->refresh_session();
    }
  }

  function history() {
    $user = $this->Session->read('User.info');
    $data = array(
      'username' => $user['User']['username'],
      'password' => $user['User']['password']
      );

    $result = $this->Api->post('users/history', $data);
    //debug($result);
    $this->set('queues', $result);
  }

  function change_password() {
    if (isLoggedIn($this)) {
      if (!empty($this->data)) {
        $this->refresh_session();
        $user = $this->Session->read('User.info');
        $data = $this->data['User'];
        $data['username'] = $user['User']['username'];
        $data['id'] = $user['User']['id'];
        if ($data['password'] != $user['User']['password'])  { 
          $this->set('error', 'Your password is incorrect');
        }
        else if ($data['new_password'] != $data['new_password_repeat']) {
          $this->set('error', 'Your new password does not match');
        }
        else if ($data['new_password'] == '' || $data['new_password'] == null) {
          $this->set('error', 'Your new password is blank');
        }
        else if ($data['password'] == $user['User']['password'])  {
          $data = array('User' => $data);
          $data['username'] = $user['User']['username'];
          $data['password'] = $data['User']['password'];
          $result = $this->Api->post('users/change_password', $data);
          if (isset($result['error'])) {
            $this->set('error', $result['error']);
          }
          else {
            $user['User']['password'] = $data['User']['new_password'];
            $this->Session->write('User.info', $user);
          }
          $this->refresh_session();
        }
      }
    }
    else {
      $this->redirect(array('controller' => 'users', 'action' => 'my_movies'));
    }
  }

  function checkout() {
    if (isLoggedIn($this)) {
      if (!$this->data) {
      }
      else {
        $user = $this->Session->read('User.info');
        $data = $this->data;

        $data['username'] = $user['User']['username'];
        $data['password'] = $user['User']['password'];
        $result = $this->Api->post('users/checkout', $data);
        if (isset($result["ACK"])) {
          if("SUCCESS" == strtoupper($result["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($result["ACK"])) {
            $this->redirect(array('controller' => 'users', 'action' => 'checkout_success'));
          }
        }
        else {
          $this->set('error', 'Please try again');
        }
      }
    }
    else {
      $this->redirect(array('controller' => 'users', 'action' => 'my_movies'));
    } 
  }
  
  function checkout_success() {
    
  }

  //current queue

  function my_movies() {
    $user = $this->Session->read('User.info');
    $data = array(
      'username' => $user['User']['username'],
      'password' => $user['User']['password']
      );

    $result = $this->Api->post('users/my_movies', $data);
    //debug($result);
    $this->set('queues', $result);
  }             
                                                                
  function admin_index() {
    if (isAdmin($this)) {
	    $result = $this->Api->get('users/show_all'); 
	    $this->set('users', $result);
	  }
  }
  
  function admin_edit($id = null) {
    if (isAdmin($this)) {
      if (!$this->data) {
	      $user = $this->Session->read('User.info');
	      $data = array();
        $data['username'] = $user['User']['username'];
        $data['password'] = $user['User']['password'];
        $result = $this->Api->post('users/show/'.$id, $data); 
  	    $this->set('user', $result);
      }
      else {
        $data = $this->data;
	      $user = $this->Session->read('User.info');
        $data['username'] = $user['User']['username'];
        $data['password'] = $user['User']['password'];
        $this->Api->post('users/update_profile', $data);
         $this->redirect(array('action'=>'index'));
      }
	  }
  }
  
  function admin_delete($id) {
    if (isAdmin($this)) {
	    $user = $this->Session->read('User.info');
	    $data['username'] = $user['User']['username'];
      $data['password'] = $user['User']['password'];
      $data['User']['id'] = $id;
      //debug($data);
      $this->Api->post('users/remove', $data);
      $this->redirect(array('action' => 'my_movies'));
	  }
  }
  
  function admin_add() {
    if (isAdmin($this)) {
	    if ($this->data) {
	      $data = $this->data;
	      $user = $this->Session->read('User.info');
        $data['username'] = $user['User']['username'];
        $data['password'] = $user['User']['password'];
        $this->Api->post('users/add_member', $data);
        $this->redirect(array('action' => 'index'));
      }
	  }
  }
}
?>
