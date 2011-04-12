<?php
class ActorsController extends AppController {

	var $name = 'Actors';
	var $components = array('Api');
	function beforeFilter() {
    $top10 = $this->Api->get('videos/top10');
    $this->set('top10', $top10);
    $this->set('title', 'Actor');
  }
	
	function show($id) {
	  
	  $result =  $this->Api->get('actors/show/'.$id);
	  $this->set('actor', $result);
	}
	
	function show_all() {
	  $result = $this->Api->get('actors/show_all');
	  $this->set('actors', $result);
	}
	
	function admin_index() {
    if (isAdmin($this)) {
	    $result = $this->Api->get('actors/show_all'); 
	    $this->set('actors', $result);
	  }
  }
  
  function admin_edit($id = null) {
    if (isAdmin($this)) {
      if (!$this->data) {
        $result = $this->Api->get('actors/get_actor_details/'.$id); 

  	    $this->set('actor', $result);
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
        $this->Api->post('actors/update_actor_details', $data);
        $this->redirect(array('action'=>'index'));
      }
	  }
  }
  
  function admin_delete($id) {
    if (isAdmin($this)) {
	    $user = $this->Session->read('User.info');
	    $data['username'] = $user['User']['username'];
      $data['password'] = $user['User']['password'];
      $data['Video']['id'] = $id;
      $this->Api->post('videos/remove', $data);
      $this->redirect(array('action' => 'index'));
	  }
  }
  
  function admin_add() {
    if (isAdmin($this)) {
	    if (!$this->data) {
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
        $this->Api->post('actors/add', $data);
        $this->redirect(array('action'=>'index'));
      }
	  }
  }

	// function index() {
	//     $this->Actor->recursive = 0;
	//     $this->set('actors', $this->paginate());
	//   }
	// 
	//   function view($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid actor', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     $this->set('actor', $this->Actor->read(null, $id));
	//   }
	// 
	//   function add() {
	//     if (!empty($this->data)) {
	//       $this->Actor->create();
	//       if ($this->Actor->save($this->data)) {
	//         $this->Session->setFlash(__('The actor has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The actor could not be saved. Please, try again.', true));
	//       }
	//     }
	//     $photos = $this->Actor->Photo->find('list');
	//     $videos = $this->Actor->Video->find('list');
	//     $this->set(compact('photos', 'videos'));
	//   }
	// 
	//   function edit($id = null) {
	//     if (!$id && empty($this->data)) {
	//       $this->Session->setFlash(__('Invalid actor', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     if (!empty($this->data)) {
	//       if ($this->Actor->save($this->data)) {
	//         $this->Session->setFlash(__('The actor has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The actor could not be saved. Please, try again.', true));
	//       }
	//     }
	//     if (empty($this->data)) {
	//       $this->data = $this->Actor->read(null, $id);
	//     }
	//     $photos = $this->Actor->Photo->find('list');
	//     $videos = $this->Actor->Video->find('list');
	//     $this->set(compact('photos', 'videos'));
	//   }
	// 
	//   function delete($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid id for actor', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     if ($this->Actor->delete($id)) {
	//       $this->Session->setFlash(__('Actor deleted', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     $this->Session->setFlash(__('Actor was not deleted', true));
	//     $this->redirect(array('action' => 'index'));
	//   }
	//   function admin_index() {
	//     $this->Actor->recursive = 0;
	//     $this->set('actors', $this->paginate());
	//   }
	// 
	//   function admin_view($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid actor', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     $this->set('actor', $this->Actor->read(null, $id));
	//   }
	// 
	//   function admin_add() {
	//     if (!empty($this->data)) {
	//       $this->Actor->create();
	//       if ($this->Actor->save($this->data)) {
	//         $this->Session->setFlash(__('The actor has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The actor could not be saved. Please, try again.', true));
	//       }
	//     }
	//     $photos = $this->Actor->Photo->find('list');
	//     $videos = $this->Actor->Video->find('list');
	//     $this->set(compact('photos', 'videos'));
	//   }
	// 
	//   function admin_edit($id = null) {
	//     if (!$id && empty($this->data)) {
	//       $this->Session->setFlash(__('Invalid actor', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     if (!empty($this->data)) {
	//       if ($this->Actor->save($this->data)) {
	//         $this->Session->setFlash(__('The actor has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The actor could not be saved. Please, try again.', true));
	//       }
	//     }
	//     if (empty($this->data)) {
	//       $this->data = $this->Actor->read(null, $id);
	//     }
	//     $photos = $this->Actor->Photo->find('list');
	//     $videos = $this->Actor->Video->find('list');
	//     $this->set(compact('photos', 'videos'));
	//   }
	// 
	//   function admin_delete($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid id for actor', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     if ($this->Actor->delete($id)) {
	//       $this->Session->setFlash(__('Actor deleted', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     $this->Session->setFlash(__('Actor was not deleted', true));
	//     $this->redirect(array('action' => 'index'));
	//   }
}
?>