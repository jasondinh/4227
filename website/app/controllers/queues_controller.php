<?php
class QueuesController extends AppController {

	var $name = 'Queues';
	var $components = array('Api');
	function beforeFilter() {
    $top10 = $this->Api->get('videos/top10');
    $this->set('top10', $top10);
    $this->set('title', 'Queue');
  }
	function add_video_queue($video_id) {
	  $user = $this->Session->read('User.info');
	  
    $data['username'] = $user['User']['username'];
    $data['password'] = $user['User']['password'];
    $data['video']['id'] = $video_id;
    $data['user']['id'] = $user['User']['id'];
    
    $result = $this->Api->post('queues/add_video_queue', $data);
    
    if (isset($result['error'])) {
      $this->set('error', $result['error']);
    }
    
    $this->redirect(array('controller' => 'users', 'action' => 'my_movies'));
	}
	
	function remove_video_queue($video_id) {
		$user = $this->Session->read('User.info');
	  
    $data['username'] = $user['User']['username'];
    $data['password'] = $user['User']['password'];
    $data['video']['id'] = $video_id;
    $data['user']['id'] = $user['User']['id'];
    
    $result = $this->Api->post('queues/remove_video_queue', $data);
    
    if (isset($result['error'])) {
      $this->set('error', $result['error']);
    }
    $this->redirect(array('controller' => 'users', 'action' => 'my_movies'));
	}
	
	function admin_index() {
    if (isAdmin($this)) {
	    $result = $this->Api->get('queues/show_all'); 
	    $processing = array();
	    $sent = array();
	    $returned = array();
	    $pending = array();
	    
	    foreach ($result as $queue) {
	      if ($queue['Queue']['status'] == 0) {
	        $pending[] = $queue;
	      }
	      else if ($queue['Queue']['status'] == 1) {
	        $processing[] = $queue;
	      }
	      else if ($queue['Queue']['status'] == 2) {
	        $sent[] = $queue;
	      }
	      else if ($queue['Queue']['status'] == 3) {
	        $returned[] = $queue;
	      }
	    }
	    $this->set('processing', $processing);
	    $this->set('sent', $sent);
	    $this->set('pending', $pending);
	    $this->set('returned', $returned);
	  }
  }
  
  function admin_edit($id = null) {
    if (isAdmin($this)) {
      if (!$this->data) {
	      $user = $this->Session->read('User.info');
	      $data = array();
        $data['username'] = $user['User']['username'];
        $data['password'] = $user['User']['password'];
        $result = $this->Api->post('queues/show/'.$id, $data); 
        //debug($result);
  	    $this->set('queue', $result);
  	    $result = $this->Api->get('videos/get_all');
  	    $videos = array();
  	    foreach ($result as $video) {
  	      $videos[$video['Video']['id']] = $video['Video']['name'];
  	    }
  	    $this->set('videos', $videos);
      }
      else {
        $data = $this->data;
	      $user = $this->Session->read('User.info');
        $data['username'] = $user['User']['username'];
        $data['password'] = $user['User']['password'];
        $this->Api->post('queues/edit', $data);
        $this->redirect(array('action'=>'index'));
      }
	  }
  }
  
  function admin_delete($id) {
    if (isAdmin($this)) {
	    $user = $this->Session->read('User.info');
	    $data['username'] = $user['User']['username'];
      $data['password'] = $user['User']['password'];
      $data['Queue']['id'] = $id;
      $this->Api->post('queues/remove', $data);
      $this->redirect(array('action' => 'index'));
	  }
  }
  

	// function index() {
	//     $this->Queue->recursive = 0;
	//     $this->set('queues', $this->paginate());
	//   }
	// 
	//   function view($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid queue', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     $this->set('queue', $this->Queue->read(null, $id));
	//   }
	// 
	//   function add() {
	//     if (!empty($this->data)) {
	//       $this->Queue->create();
	//       if ($this->Queue->save($this->data)) {
	//         $this->Session->setFlash(__('The queue has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The queue could not be saved. Please, try again.', true));
	//       }
	//     }
	//     $users = $this->Queue->User->find('list');
	//     $videos = $this->Queue->Video->find('list');
	//     $this->set(compact('users', 'videos'));
	//   }
	// 
	//   function edit($id = null) {
	//     if (!$id && empty($this->data)) {
	//       $this->Session->setFlash(__('Invalid queue', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     if (!empty($this->data)) {
	//       if ($this->Queue->save($this->data)) {
	//         $this->Session->setFlash(__('The queue has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The queue could not be saved. Please, try again.', true));
	//       }
	//     }
	//     if (empty($this->data)) {
	//       $this->data = $this->Queue->read(null, $id);
	//     }
	//     $users = $this->Queue->User->find('list');
	//     $videos = $this->Queue->Video->find('list');
	//     $this->set(compact('users', 'videos'));
	//   }
	// 
	//   function delete($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid id for queue', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     if ($this->Queue->delete($id)) {
	//       $this->Session->setFlash(__('Queue deleted', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     $this->Session->setFlash(__('Queue was not deleted', true));
	//     $this->redirect(array('action' => 'index'));
	//   }
	//   function admin_index() {
	//     $this->Queue->recursive = 0;
	//     $this->set('queues', $this->paginate());
	//   }
	// 
	//   function admin_view($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid queue', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     $this->set('queue', $this->Queue->read(null, $id));
	//   }
	// 
	//   function admin_add() {
	//     if (!empty($this->data)) {
	//       $this->Queue->create();
	//       if ($this->Queue->save($this->data)) {
	//         $this->Session->setFlash(__('The queue has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The queue could not be saved. Please, try again.', true));
	//       }
	//     }
	//     $users = $this->Queue->User->find('list');
	//     $videos = $this->Queue->Video->find('list');
	//     $this->set(compact('users', 'videos'));
	//   }
	// 
	//   function admin_edit($id = null) {
	//     if (!$id && empty($this->data)) {
	//       $this->Session->setFlash(__('Invalid queue', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     if (!empty($this->data)) {
	//       if ($this->Queue->save($this->data)) {
	//         $this->Session->setFlash(__('The queue has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The queue could not be saved. Please, try again.', true));
	//       }
	//     }
	//     if (empty($this->data)) {
	//       $this->data = $this->Queue->read(null, $id);
	//     }
	//     $users = $this->Queue->User->find('list');
	//     $videos = $this->Queue->Video->find('list');
	//     $this->set(compact('users', 'videos'));
	//   }
	// 
	//   function admin_delete($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid id for queue', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     if ($this->Queue->delete($id)) {
	//       $this->Session->setFlash(__('Queue deleted', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     $this->Session->setFlash(__('Queue was not deleted', true));
	//     $this->redirect(array('action' => 'index'));
	//   }
}
?>