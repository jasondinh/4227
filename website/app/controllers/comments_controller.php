<?php
class CommentsController extends AppController {

	var $name = 'Comments';
	var $components = array('Api');
	function beforeFilter() {
    $top10 = $this->Api->get('videos/top10');
    $this->set('top10', $top10);
    $this->set('title', 'Comment');
  }
	function add() {
	  if (isset($this->data)) {
      $this->refresh_session();
      $user = $this->Session->read('User.info');
      $this->data['Comment']['user_id'] = $user['User']['id'];
      $data = $this->data;
      $data['username'] = $user['User']['username'];
      $data['password'] = $user['User']['password'];
      $result = $this->Api->post('comments/add', $data);
      
      $this->redirect(array('controller' => 'videos', 'action' => 'show', $this->data['Comment']['video_id']));
	  }
	}
	
	function admin_index() {
	  if (isAdmin($this)) {
	    $result = $this->Api->get('comments/show_all');
	    $this->set('comments', $result);
	  }
	}
	
	function admin_delete($id) {
	  if (isAdmin($this)) {
	    $user = $this->Session->read('User.info');
	    $data['username'] = $user['User']['username'];
      $data['password'] = $user['User']['password'];
      $data['Comment']['id'] = $id;
      $this->Api->post('comments/remove', $data);
      $this->redirect(array('action' => 'index'));
	  }
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

	// function admin_index() {
	//     $this->Comment->recursive = 0;
	//     $this->set('comments', $this->paginate());
	//   }
	// 
	//   function admin_view($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid comment', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     $this->set('comment', $this->Comment->read(null, $id));
	//   }
	// 
	//   function admin_add() {
	//     if (!empty($this->data)) {
	//       $this->Comment->create();
	//       if ($this->Comment->save($this->data)) {
	//         $this->Session->setFlash(__('The comment has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The comment could not be saved. Please, try again.', true));
	//       }
	//     }
	//     $users = $this->Comment->User->find('list');
	//     $videos = $this->Comment->Video->find('list');
	//     $this->set(compact('users', 'videos'));
	//   }
	// 
	//   function admin_edit($id = null) {
	//     if (!$id && empty($this->data)) {
	//       $this->Session->setFlash(__('Invalid comment', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     if (!empty($this->data)) {
	//       if ($this->Comment->save($this->data)) {
	//         $this->Session->setFlash(__('The comment has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The comment could not be saved. Please, try again.', true));
	//       }
	//     }
	//     if (empty($this->data)) {
	//       $this->data = $this->Comment->read(null, $id);
	//     }
	//     $users = $this->Comment->User->find('list');
	//     $videos = $this->Comment->Video->find('list');
	//     $this->set(compact('users', 'videos'));
	//   }
	// 
	//   function admin_delete($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid id for comment', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     if ($this->Comment->delete($id)) {
	//       $this->Session->setFlash(__('Comment deleted', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     $this->Session->setFlash(__('Comment was not deleted', true));
	//     $this->redirect(array('action' => 'index'));
	//   }
}
?>