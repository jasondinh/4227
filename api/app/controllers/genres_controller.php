<?php
class GenresController extends AppController {

	var $name = 'Genres';
	var $uses = array("Employee", "User", 'Video', 'Genre');
	var $error;
	var $result;
	
	function beforeRender() {
	  if ($this->error) {
	    $this->set('error', $this->error);
	  }
	  
	  if ($this->result) {
	    $this->set('result', $this->result);
	  }
	}
	
	function add() {
	  $employee = $this->User->validate_employee();
		
		if ($employee) {
			$genre  = $this->params['form']['Genre'];
			debug($genre);
			$this->Genre->save($genre);
			$this->result = $genre;
		}
		else {
			$this->error = generate_error("Permission error");
		}
	}
	
	function show($id) {
	  $genre = $this->Genre->find('first', array(
	   'recursive' => -1,
	   'conditions' => array(
	     'Genre.id' => $id
	   )
	  ));
	  
	  $this->result = $genre;
	}
	
	function remove() {
	  $employee = $this->User->validate_employee();
		
		if ($employee) {
			$genre  = $this->params['form']['Genre'];
			debug($genre);
			$this->Genre->delete($genre['id']);
			$this->result = array('result' => TRUE);
		}
		else {
			$this->error = generate_error("Permission error");
		}
	}
	
	function update() {
	  $employee = $this->User->validate_employee();
		
		if ($employee) {
			$genre  = $this->params['form']['Genre'];
			$this->Genre->save($genre);
			$this->result = array('result' => TRUE);
		}
		else {
			$this->error = generate_error("Permission error");
		}
	}
	
	function show_all() {
	  $genres = $this->Genre->find('all', array(
	   'recursive' => -1
	  ));
	  
	  $this->result = $genres;
	}
	
	function show_video($genre_id) {
	  $genres = $this->Genre->find('first', array(
	   'conditions' => array(
	     'Genre.id' => $genre_id
	   )
	  ));
	  
	  if ($genres) {
	    if (isset($genres['Video'])) {
  	    $this->result = $genres['Video'];
  	  }
  	  else {
  	    $this->result = array();
  	  }
	  }
	  else {
	    $this->error = generate_error('No such genre');
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