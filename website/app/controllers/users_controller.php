<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $components = array('Api');

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
  
  function login() {
    if (!empty($this->data)) {
      
      $result = $this->_login($this->data['User']['username'], $this->data['User']['password']);
      
      if (isset($result['error'])) {
        $this->set('error', $result['error']);
      }
      else {
        $this->Session->write('User.loggedin', '1');
        $this->Session->write('User.info', $result);
        $this->redirect(array('action' => 'index'));
        return $result;
      }
    }
  }

function logout() {
       $this->Session->write('User.loggedin', '0');
       $this->Session->write('User.info', null);
       $this->redirect(array('action' => 'index'));
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
  // debug($result); 
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
  
  function change_password() {
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
  
  
  //check out all movies in queues
  
  function checkout() {
    $user = $this->Session->read('User.info');
    
    $data = array(
     'username' => $user['User']['username'],
     'password' => $user['User']['password']
    );
    
    $result = $this->Api->post('users/checkout', $data);
    
    if (isset($result['error'])) {
      $this->set('error', $result['error']);
    }
  }
  
  //current queue
  
  function my_movies() {
	    // $this->refresh_session();
	    //     $user = $this->Session->read('User.info');
	    //     $queue = $this->User->Queue->find('all', array(
	    //       'conditions' => array(
	    //        'Queue.user_id' => $user['User']['id'],
	    //        'Queue.status' => 1
	    //       )
	    //     ));
	    $user = $this->Session->read('User.info');
	    $data = array(
	     'username' => $user['User']['username'],
	     'password' => $user['User']['password']
	    );
	    
	    $result = $this->Api->post('users/my_movies', $data);
	    //debug($result);
	  $this->set('queues', $result);
	}
  
  
  
  //   
  //   function register_api($username, $password, $first_name, $last_name, $age, $address, $city, $zip, $country, $tel, $email) {
  //     //TODO: validation for username, password
  //     $user = $this->User->find_user_by_username($username);
  //     if ($user) {
  //       return array('error' => 'Username already existed. Please try another username.');
  //     }
  //     else {
  //       $user = array(
  //         'username' => $username,
  //         'password' => $password,
  //         'first_name' => $first_name,
  //         'last_name' => $last_name,
  //         'age' => $age,
  //         'address' => $address,
  //         'city' => $city,
  //         'zip' => $zip,
  //         'country' => $country,
  //         'telephone' => $tel,
  //         'email' => $email
  //       );
  //       
  //       $this->User->create();
  //       $this->User->save($user);
  //     }
  //   }
  //   
  
  //   
  //   function login_api($username, $password) {
  //     $user = $this->User->find_user_by_username($username);    
  //     if ($user) {
  //       if ($user['User']['password'] == $password) {
  //         return $user;
  //       }
  //     }
  //     
  //     return array('error' => 'You entered a wrong username/password combination. Please try again');
  //   }
  //   
  //   function logout() {
  //     $this->Session->write('User.loggedin', '0');
  //     $this->Session->write('User.info', null);
  //     $this->redirect(array('action' => 'index'));
  //   }
  // 
  
  //  
  //  function edit_profile_api($username, $password, $first_name, $last_name, $age, $address, $city, $zip, $country, $tel, $email) {
  //    $user = $this->User->check_login($username, $password);
  //    
  //    if (isset($result['error'])) {
  //      return $result;
  //     }
  //     else {
  //       $new_user = array(
  //         'id' => $user['User']['id'],
  //         'username' => $username,
  //         'password' => $password,
  //         'first_name' => $first_name,
  //         'last_name' => $last_name,
  //         'age' => $age,
  //         'address' => $address,
  //         'city' => $city,
  //         'zip' => $zip,
  //         'country' => $country,
  //         'telephone' => $tel,
  //         'email' => $email
  //       );
  //       
  //       $this->User->save($new_user);
  //       
  //       return $new_user;
  //     }
  //  }
  //  
  //  function get_info_api($username = null, $password = null) {
  //    $this->layout = 'api';
  //    $user = $this->User->check_login($username, $password);
  //    echo json_encode($user);
  //  }
  //  
  //  function change_password() {
  //    if (!empty($this->data)) {
  //      $this->refresh_session();
  //       $user = $this->Session->read('User.info');
  //       $data = $this->data['User'];
  //       if ($data['password'] != $user['User']['password'])  { 
  //         $this->set('error', 'Your password is incorrect');
  //       }
  //       else if ($data['new_password'] != $data['new_password_repeat']) {
  //         $this->set('error', 'Your new password does not match');
  //       }
  //       else if ($data['new_password'] == '' || $data['new_password'] == null) {
  //         $this->set('error', 'Your new password is blank');
  //       }
  //       else if ($data['password'] == $user['User']['password'])  {
  //         $result = $this->change_password_api($user['User']['username'], $user['User']['password'], $data['new_password']);
  //         if (isset($result['error'])) {
  //           $this->set('error', $result['error']);
  //         }
  //         $this->refresh_session();
  //       }
  //     }
  //  }
  //  
  //  function change_password_api($username, $password, $newpassword) {
  //    $user = $this->User->check_login($username, $password);
  //    
  //    if (isset($result['error'])) {
  //      return $result;
  //     }
  //     else {
  //       $new_user = array(
  //         'id' => $user['User']['id'],
  //         'username' => $username,
  //         'password' => $newpassword,
  //       );
  //       
  //       $this->User->save($new_user);
  //       
  //       return $new_user;
  //     }
  //  }
  //  
  //  function view_history() {
  //    
  //  }
  //  
  //  function search_member() {
  //    
  //  }
  //  
  //  function index() {
  //    //$this->User->recursive = 0;
  //    //$this->set('users', $this->paginate());
  //  }
  // 
  //  function view($id = null) {
  //    if (!$id) {
  //      $this->Session->setFlash(__('Invalid user', true));
  //      $this->redirect(array('action' => 'index'));
  //    }
  //    $this->set('user', $this->User->read(null, $id));
  //  }
  // 
  //  function add() {
  //    if (!empty($this->data)) {
  //      $this->User->create();
  //      if ($this->User->save($this->data)) {
  //        $this->Session->setFlash(__('The user has been saved', true));
  //        $this->redirect(array('action' => 'index'));
  //      } else {
  //        $this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
  //      }
  //    }
  //  }
  // 
  //  function edit($id = null) {
  //    if (!$id && empty($this->data)) {
  //      $this->Session->setFlash(__('Invalid user', true));
  //      $this->redirect(array('action' => 'index'));
  //    }
  //    if (!empty($this->data)) {
  //      if ($this->User->save($this->data)) {
  //        $this->Session->setFlash(__('The user has been saved', true));
  //        $this->redirect(array('action' => 'index'));
  //      } else {
  //        $this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
  //      }
  //    }
  //    if (empty($this->data)) {
  //      $this->data = $this->User->read(null, $id);
  //    }
  //  }
  // 
  //  function delete($id = null) {
  //    if (!$id) {
  //      $this->Session->setFlash(__('Invalid id for user', true));
  //      $this->redirect(array('action'=>'index'));
  //    }
  //    if ($this->User->delete($id)) {
  //      $this->Session->setFlash(__('User deleted', true));
  //      $this->redirect(array('action'=>'index'));
  //    }
  //    $this->Session->setFlash(__('User was not deleted', true));
  //    $this->redirect(array('action' => 'index'));
  //  }
  //  function admin_index() {
  //    $this->User->recursive = 0;
  //    $this->set('users', $this->paginate());
  //  }
  // 
  //  function admin_view($id = null) {
  //    if (!$id) {
  //      $this->Session->setFlash(__('Invalid user', true));
  //      $this->redirect(array('action' => 'index'));
  //    }
  //    $this->set('user', $this->User->read(null, $id));
  //  }
  // 
  //  function admin_add() {
  //    if (!empty($this->data)) {
  //      $this->User->create();
  //      if ($this->User->save($this->data)) {
  //        $this->Session->setFlash(__('The user has been saved', true));
  //        $this->redirect(array('action' => 'index'));
  //      } else {
  //        $this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
  //      }
  //    }
  //  }
  // 
  //  function admin_edit($id = null) {
  //    if (!$id && empty($this->data)) {
  //      $this->Session->setFlash(__('Invalid user', true));
  //      $this->redirect(array('action' => 'index'));
  //    }
  //    if (!empty($this->data)) {
  //      if ($this->User->save($this->data)) {
  //        $this->Session->setFlash(__('The user has been saved', true));
  //        $this->redirect(array('action' => 'index'));
  //      } else {
  //        $this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
  //      }
  //    }
  //    if (empty($this->data)) {
  //      $this->data = $this->User->read(null, $id);
  //    }
  //  }
  // 
  //  function admin_delete($id = null) {
  //    if (!$id) {
  //      $this->Session->setFlash(__('Invalid id for user', true));
  //      $this->redirect(array('action'=>'index'));
  //    }
  //    if ($this->User->delete($id)) {
  //      $this->Session->setFlash(__('User deleted', true));
  //      $this->redirect(array('action'=>'index'));
  //    }
  //    $this->Session->setFlash(__('User was not deleted', true));
  //    $this->redirect(array('action' => 'index'));
  //  }
  //  
  //  function refresh_session() {
  //    if ($this->Session->read('User.loggedin')) {
  //      $current = $this->Session->read('User.info');
  //      $user = $this->User->find_user_by_id($current['User']['id']);
  //      $this->Session->write('User.info', $user);
  //    }
  //    
  //  }
}
?>
