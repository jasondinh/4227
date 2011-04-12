<?php
class ActorsController extends AppController {

	var $name = 'Actors';
	var $uses = array("Employee", "User", 'Actor', 'Video');
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
	
	function show_all() {
	  $actors = $this->Actor->find('all');
	  $this->result = $actors;
	}
	
	function show($id) {
	  $actor = $this->Actor->find('first', array(
	   'conditions' => array(
	     'Actor.id' => $id
	   )
	  ));
	  
	  if ($actor) {
	    $this->result = $actor;
	  }
	  else {
	    $this->error = generate_error('No such actor');
	  }
	}
	
	function add() {
		
		$employee = $this->User->validate_employee();
		
		if ($employee) {
			$actor  = $this->params['form'];
			$this->Actor->save($actor);
			$this->result = $actor;
		}
		else {
			$this->error = generate_error("Permission error");
		}
	  
	}
	
	function get_actor_details($id) {
		
	  	//TODO: validaion
		//$actor = $this->params['form']['actor'];
		
		$actor = $this->Actor->find_actor_by_id($id);
		
		if ($actor) {
			$this->result = $actor;
		}
		
		else {
			$this->error = generate_error('No such actor');
		}
	}
	
	function update_actor_details() {
	  
	  	$employee = $this->User->validate_employee();
		if ($employee) {
			$actor  = $this->params['form'];
			$this->Actor->save($actor);
			$this->result = $actor;
		}
		else {
			$this->error = generate_error("Permission error");
		}
	}
	
	function delete_actor() {
		$employee = $this->User->validate_employee();
		if ($employee) {
			$actor  = $this->params['form']['actor'];
			$this->Actor->delete($actor['id']);
			$this->result = array('result' => TRUE);
		}
		else {
			$this->error = generate_error("Permission error");
		}
	}
	
	function add_actor_movie() {
		
		//TODO: validate actor and movie existence
		$employee = $this->User->validate_employee();
		if ($employee) {
			$actor  = $this->params['form']['actor'];
			$video  = $this->params['form']['video'];
			
			$this->Actor->habtmAdd('Video', $actor['id'], $video['id']);
			
			$this->result = array('result' => TRUE);
		}
		else {
			$this->error = generate_error("Permission error");
		}
	}
	
	function remove_actor_movie() {
	  	$employee = $this->User->validate_employee();
		if ($employee) {
			$actor  = $this->params['form']['actor'];
			$video  = $this->params['form']['video'];
			
			$this->Actor->habtmDelete('Video', $actor['id'], $video['id']);
			
			$this->result = array('result' => TRUE);
		}
		else {
			$this->error = generate_error("Permission error");
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