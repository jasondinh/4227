<?php
class GenresController extends AppController {

	var $name = 'Genres';
	var $components = array('Api');
	function beforeFilter() {
    $top10 = $this->Api->get('videos/top10');
    $this->set('top10', $top10);
    $this->set('title', 'Video');
  }
	function show_all() {
	  $result = $this->Api->get('genres/show_all'); 
	  $this->set('genres', $result);
	}
	
	function show_video($genre_id) {
	  if ($genre_id) {
	    $result = $this->Api->get('genres/show_video/'.$genre_id);
	    $this->set('videos', $result);
	  }
	}
	
	function admin_index() {
	  if (isAdmin($this)) {
	    $result = $this->Api->get('genres/show_all'); 
	    $this->set('genres', $result);
	  }	  
	  //debug($result);
	}
	
	function admin_add() {
	  if (isAdmin($this)) {
	    if ($this->data) {
	      $data = $this->data;
	      $user = $this->Session->read('User.info');
        $data['username'] = $user['User']['username'];
        $data['password'] = $user['User']['password'];
        $this->Api->post('genres/add', $data);
        $this->redirect(array('action' => 'index'));
      }
	  }
	  
	}
	
	function admin_edit($id = null) {
	  if (isAdmin($this)) {
	    if (!$this->data) {
	      $result = $this->Api->get('genres/show/'.$id);
  	    $this->set('genre', $result);
	    }
	    else {
	      $data = $this->data;
	      $user = $this->Session->read('User.info');
        $data['username'] = $user['User']['username'];
        $data['password'] = $user['User']['password'];
        
        $this->Api->post('genres/update', $data);
        $this->redirect(array('action' => 'index'));
	    }
	  }
	}
	
	function admin_delete($id) {
	  if (isAdmin($this)) {
	    $user = $this->Session->read('User.info');
	    $data['username'] = $user['User']['username'];
      $data['password'] = $user['User']['password'];
      $data['Genre']['id'] = $id;
      $this->Api->post('genres/remove', $data, true);
      //$this->redirect(array('action' => 'index'));
	  }
	}
	
	
	
	// function show() {
	//     $genres = $this->Genre->find('all', array(
	//      'recursive' => -1
	//     ));
	//     
	//     $this->set('genres', $genres);
	//   }
	//   
	//   function show_api() {
	//     $this->layout = 'api';
	//     $genres = $this->Genre->find('all', array(
	//      'recursive' => -1
	//     ));
	//     echo  json_encode($genres);
	//   }
	//   function index() {
	//     $this->Genre->recursive = 0;
	//     $this->set('genres', $this->paginate());
	//   }
	// 
	//   function view($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid genre', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     $this->set('genre', $this->Genre->read(null, $id));
	//   }
	// 
	//   function add() {
	//     if (!empty($this->data)) {
	//       $this->Genre->create();
	//       if ($this->Genre->save($this->data)) {
	//         $this->Session->setFlash(__('The genre has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The genre could not be saved. Please, try again.', true));
	//       }
	//     }
	//   }
	// 
	//   function edit($id = null) {
	//     if (!$id && empty($this->data)) {
	//       $this->Session->setFlash(__('Invalid genre', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     if (!empty($this->data)) {
	//       if ($this->Genre->save($this->data)) {
	//         $this->Session->setFlash(__('The genre has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The genre could not be saved. Please, try again.', true));
	//       }
	//     }
	//     if (empty($this->data)) {
	//       $this->data = $this->Genre->read(null, $id);
	//     }
	//   }
	// 
	//   function delete($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid id for genre', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     if ($this->Genre->delete($id)) {
	//       $this->Session->setFlash(__('Genre deleted', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     $this->Session->setFlash(__('Genre was not deleted', true));
	//     $this->redirect(array('action' => 'index'));
	//   }
	//   function admin_index() {
	//     $this->Genre->recursive = 0;
	//     $this->set('genres', $this->paginate());
	//   }
	// 
	//   function admin_view($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid genre', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     $this->set('genre', $this->Genre->read(null, $id));
	//   }
	// 
	//   function admin_add() {
	//     if (!empty($this->data)) {
	//       $this->Genre->create();
	//       if ($this->Genre->save($this->data)) {
	//         $this->Session->setFlash(__('The genre has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The genre could not be saved. Please, try again.', true));
	//       }
	//     }
	//   }
	// 
	//   function admin_edit($id = null) {
	//     if (!$id && empty($this->data)) {
	//       $this->Session->setFlash(__('Invalid genre', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     if (!empty($this->data)) {
	//       if ($this->Genre->save($this->data)) {
	//         $this->Session->setFlash(__('The genre has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The genre could not be saved. Please, try again.', true));
	//       }
	//     }
	//     if (empty($this->data)) {
	//       $this->data = $this->Genre->read(null, $id);
	//     }
	//   }
	// 
	//   function admin_delete($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid id for genre', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     if ($this->Genre->delete($id)) {
	//       $this->Session->setFlash(__('Genre deleted', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     $this->Session->setFlash(__('Genre was not deleted', true));
	//     $this->redirect(array('action' => 'index'));
	//   }
}
?>