<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $uses = array('Employee', 'User', 'Payment');
	var $components = array('Api', 'Paypal');
	var $error;
	var $result;	
	
	function help() {
	  $user = $this->User->validate_user();
	  
	  if ($user) {  
	    $subject = 'Query from WowRental';
	    
	    $body = 'Hi management team,'."\n".'
	    '."\n".'
'.$user['User']['username'].' ('.$user['User']['email'].') from WowRental asks this question:'."\n".'
	    '."\n".'
'.$this->params['form']['User']['question'].''."\n".'
';

    $to = 'wowrental2@gmail.com';
    $from = $user['User']['email'];
	    $this->Api->send_email($subject, $body, $to, $from);
	  }
	  else {
	    $this->error = generate_error('Permission error');
	  }
	}
	
	function beforeRender() {
	  if ($this->error) {
	    $this->set('error', $this->error);
	  }
	  
	  if ($this->result) {
	    $this->set('result', $this->result);
	  }
	}
	
	function show_all() {
	  $user = $this->User->find('all');
	  $this->result = $user;
	}
	
	function history() {
	  $user = $this->User->validate_user();
	  
	  if ($user) {  
	    $queue = $this->User->Queue->find('all', array(
  	    'conditions' => array(
	      'Queue.user_id' => $user['User']['id'],
  	    'Queue.status' => '1'
  	    )
  	  ));
  	  $this->result = $queue;
	  }
	  else {
	    $this->error = generate_error('Wrong username/password!');
	  }
	}
	
	//input: post form of member array
	//TODO: email user
	function add_member() {
	  //debug($this->params['form']);
	  if (isset($this->params['form']['User'])) {
	    $member = $this->params['form']['User'];

  	  $user = $this->User->find_user_by_username($member['username']);

  	  if ($user) {
  	    $this->error = generate_error('This user already existed. Please pick another username');
  	  }
  	  else {
  	    $user = $this->User->find_user_by_email($member['email']);
  	    if ($user) {
  	      $this->error = generate_error('Duplicate email!');
  	    }
  	    else {

  	      //TODO: check password complexity, check for missing field
  	      if ($member['password'] == $member['repeat_password']) {
  	        $member['status'] = 0;
  	        $member['validation'] = md5($this->Api->genRandomString());
  	        $this->User->create();
  	        $this->User->save($member);
  	        $this->result = $member;
  	        $body = "Hi,\n
  	        \n
Welcome to WowRental. To activate your account, please click on the following link:\n
  	        \n
  	        "."http://localhost/4227/api/users/activate/".$this->User->getInsertID()."/".$member['validation']."\n
  	        \n
Regards,
WowRental Team";
  	        $this->Api->send_email('Welcome to WowRental', $body, $member['email']);
  	      }
  	      else {
  	        $this->error = generate_error('Wrong password');
  	      }
  	    }
  	  }
	  }
	}
	
	function activate($id, $validation) {
	  $user = $this->User->find('first', array(
	   'conditions' => array(
	     'User.id' => $id,
	     'User.validation' => $validation,
	     'User.status' => 0
	   )
	  ));
	  if ($user) {
	    $user['User']['status'] = 1;
	    $this->User->save($user);
	    $this->redirect('http://localhost/4227/website/');
	  }
	  else {
	    $this->error = generate_error("No such user/validation code combination or this user has been activated.");
	  }
	}
	
	function show($id) {
	  $user = $this->User->validate_employee();
	  if ($user) {
	    $user = $this->User->find('first', array(
	     'conditions' => array('User.id' => $id)
	    ));
	    $this->result = $user;
	  }
	  else {
	    $this->error = generate_error('Wrong username/password!');
	  }
	}
	
	function get_profile() {
	  $user = $this->User->validate_user();
	  
	  if ($user) {
	    $this->result = $user;
	  }
	  else {
	    $this->error = generate_error('Wrong username/password!');
	  }
	}
	
	function update_profile() {
	  
	  
	  $user = $this->User->validate_user();
	  
	  if ($user || $this->User->validate_employee()) {
	    if (isset($this->params['form']['User'])) {
	      
  	    $member = $this->params['form']['User'];
  	    if ($user) {
  	      $member['id'] = $user['User']['id'];
  	    }
  	    
  	    $this->User->save($member);
  	    
  	    $this->result = $member;
  	  }
	  }
	  else {
	    $this->error = generate_error('Wrong username/password!');
	  }
	}
	
	function remove() {
		if ($this->User->validate_employee())	{
			$member = $this->params['form']['User'];
			$this->User->delete($member['id']);
			$this->result = array('result'=> TRUE);
		}
		else {
			$this->error = generate_error('Permission error');
		}
	}
	
	function my_movies() {
	  $user = $this->User->validate_user();
	  
	  if ($user) {
	    
	    $queue = $this->User->Queue->find('all', array(
  	    'conditions' => array(
  	     'Queue.user_id' => $user['User']['id'],
  	     'Queue.status' => 0
  	    )
  	  ));
  	  
  	  
  	  $this->result = $queue;
  	  
  	  
	    // if (isset($this->params['form']['User'])) {
	    //         //TODO: do not allow user change anything else here except password
	    //         $member = $this->params['form']['User'];
	    //         $member['id'] = $user['User']['id'];
	    //         
	    //         if ($member['new_password'] == $member['new_password_repeat']) {
	    //           $member['password'] = $member['new_password'];
	    //           $this->User->save($member);
	    //           $this->result = $member;
	    //         }
	    //         else {
	    //           $this->error = generate_error('retype password');
	    //         }
	    //       }
	  }
	  else {
	    $this->error = generate_error('Wrong username/password!');
	  }
	}
	
	function change_password() {
	  
	  $user = $this->User->validate_user();
	  
	  if ($user) {
	    if (isset($this->params['form']['User'])) {
	      //TODO: do not allow user change anything else here except password
  	    $member = $this->params['form']['User'];
  	    $member['id'] = $user['User']['id'];
  	    
  	    if ($member['new_password'] == $member['new_password_repeat']) {
  	      $member['password'] = $member['new_password'];
	        $this->User->save($member);
    	    $this->result = $member;
	      }
	      else {
	        $this->error = generate_error('retype password');
	      }
  	  }
	  }
	  else {
	    $this->error = generate_error('Wrong username/password!');
	  }
	  
	}
	
  function checkout() {
    $user = $this->User->validate_user();
    if ($user) {
      $count  = $this->User->Queue->find_pending_queue_by_user_id($user['User']['id']);
      if ($count > 0)  {
        
        if ($user['User']['point'] / 10 >= $count) {
          $amount = 0;
          $user['User']['point'] -= 10*$count;
        }
        else {
          $redemp = floor($user['User']['point'] / 10);
          $amount = ($count - $redemp) * 3;
          $user['User']['point'] -= 10 * $redemp;
        }
        
        $user['User']['point'] += $count;
        $this->User->save($user);
        if (isset($this->params['form'], $this->params['form']['User'])) {
          $details = array(
            'first_name' => $user['User']['first_name'],
            'last_name' => $user['User']['last_name'],
            'type' => $this->params['form']['User']['type'],
            'number' => $this->params['form']['User']['number'],
            'expire_month' => $this->params['form']['User']['expire_month'],
            'expire_year' => $this->params['form']['User']['expire_year'],
            'cvv' => $this->params['form']['User']['cvv'],
            'address1' => $user['User']['address'],
            'address2' => '',
            'city' => $user['User']['city'],
            'state' => 'SG',
            'zip' => $user['User']['zip'],
            'country' => 'SG',
            'amount' => $amount + 1,
            );
          $this->Paypal->do_payment($details);

          $result = $this->Paypal->do_payment($details);
          if("SUCCESS" == strtoupper($result["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($result["ACK"])) {
            $queues = $this->User->Queue->find('all', array(
            'conditions' => array(
              'Queue.user_id' => $user['User']['id'],
              'Queue.status' => 0
              )
              ));

            foreach ($queues as $queue) {
              $queue['Queue']['status'] = 1;
              $this->User->Queue->save($queue);
              $payment = array(
                'queue_id' => $queue['Queue']['id'],
                'timeStamp' => time(),
                'transaction_id' => $result['TRANSACTIONID'],
                'amount' => $this->params['form']['User']['amount']
              );
              $this->Payment->save($payment);
            }
            
            $body = "Hi ". $user['User']['username'].",\n
            \n
Thank you for your payment of ".$amount." SGD to WowRental. Your order is being processed right now and we will get back to you as soon as possible.\n
\n
Regards,\n
WowRental team";
            $this->Api->send_email('Confirmation of your payment', $body, $user['User']['email']);

          }
          $this->result = $result;
        }
      }  
      else {
        $this->error = generate_error('No movie in queue');
      }    
    }
    else {
      $this->error = generate_error('Wrong username/password!');
    }
  }
	
	function view_history() {
	  
	}
	
	function view_rewardsPoints() {
	  
	}

  // function register() {
  //     if (!empty($this->data)) {
  //       if ($this->data['User']['password'] == $this->data['User']['repeat_password']) {
  //         $data = $this->data['User'];
  //         $result = $this->register_api($data['username'], $data['password'], $data['first_name'],
  //         $data['last_name'], $data['age'], $data['address'], $data['city'], $data['zip'], $data['country'],
  //         $data['telephone'], $data['email']);
  //         if (isset($result['error'])) {
  //           $this->set('error', $result['error']);
  //         }
  //       }
  //       else {
  //         $this->set('error', 'Your password didn\'t match. Try again!');
  //       }
  //     }
  //   }
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
  //   function login() {
  //     if (!empty($this->data)) {
  //       $user = $this->data['User']['username'];
  //       $pass = $this->data['User']['password'];
  //       
  //       $result = $this->login_api($user, $pass);
  //       
  //       if (isset($result['error'])) {
  //         $this->set('error', $result['error']);
  //       }
  //       else {
  //         $this->Session->write('User.loggedin', '1');
  //         $this->Session->write('User.info', $result);
  //         $this->redirect(array('action' => 'index'));
  //       }      
  //     }
  //   }
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
  //  function edit_profile() {
  //     if (!empty($this->data)) {
  //       $this->refresh_session();
  //       $user = $this->Session->read('User.info');
  //       
  //       $data = $this->data['User'];
  //       
  //       $result = $this->edit_profile_api($user['User']['username'], $user['User']['password'], $data['first_name'],$data['last_name'], $data['age'], $data['address'], $data['city'], $data['zip'], $data['country'], $data['telephone'], $data['email']);
  //       if (isset($result['error'])) {
  //         $this->set('error', $result['error']);
  //       }
  //       
  //       $this->refresh_session();
  //     }
  //  }
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