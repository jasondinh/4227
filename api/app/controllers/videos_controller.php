<?php
class VideosController extends AppController {

	var $name = 'Videos';
	var $uses = array("Employee", "User", 'Video', 'Queue');
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
	
	function search_title() {
	  $keyword = $this->params['form']['keyword'];
	  $videos = $this->Video->find('all', array(
	   'conditions' => array(
	     'Video.name LIKE' => "%$keyword%"
	   )
	  ));
	  $this->result = $videos;
	}
	
	function top10() {
	  $queues = $this->Queue->find('all');
	  $tmp = array();
	  foreach ($queues as $queue) {
	    if (isset($tmp[$queue['Video']['id']])) {
	      $tmp[$queue['Video']['id']]++;
	    }
	    else {
	      $tmp[$queue['Video']['id']] = 1;
	    }
	  }
	  
	  arsort($tmp);
	  $videos = array();
	  $i = 0;
	  foreach ($tmp as $key => $value) {
	    $i++;
	    $video = $this->Video->find('first', array(
	     'conditions' => array(
	       'Video.id' => $key
	     ),
	     'recursive' => -1
	    ));
	    $videos[] = $video;
	    if ($i > 9) {
	      break;
	    }
	  }
	  $this->result = $videos;
	}
	
	function add() {
		
		//TODO: check video duplication
		
		$employee = $this->User->validate_employee();
		
		if ($employee) {
			$video  = $this->params['form'];
			$this->Video->save($video);
			$this->result = $video;
		}
		else {
			$this->error = generate_error("Permission error");
		}
	}
	
	function get_all() {
	  $video = $this->Video->find('all');
	  $this->result = $video;
	}
	
	function get_video_details($id) {
		
		//TODO: validaion
		
		$videos = $this->Video->find('all', array(
		  'conditions' => array(
		    'Video.id' => $id,
		  )
		));
		//debug($videos);
		
		
		
		if ($videos) {
		  foreach ($videos as &$video) {
		    foreach ($video['Comment'] as &$comment) {
		      $comment2 = $this->Video->Comment->find('first', array(
		        'conditions' => array(
		          'Comment.id' => $comment['id']
		        )
		      ));
		      $comment = $comment2;
		    }
		  }
		  //debug($videos);
			$this->result = $videos;
		}
		
		else {
			$this->error = generate_error('No such video');
		}
	  
	}
	
	function update_video_details() {
		$employee = $this->User->validate_employee();
		if ($employee) {
			$video  = $this->params['form'];
			$this->Video->save($video);
			$this->result = $video;
		}
		else {
			$this->error = generate_error("Permission error");
		}
	}
	
	function remove() {
	 	$employee = $this->User->validate_employee();
		if ($employee) {
			$video  = $this->params['form']['Video'];
			$this->Video->delete($video['id']);
			$this->result = array('result' => TRUE);
		}
		else {
			$this->error = generate_error("Permission error");
		}
	}
	
	// function show($id = null) {
	//     
	//     if ($id) {
	//       $videos = $this->Video->find('all', array(
	//        'conditions' => array(
	//          'Video.id' => $id
	//        )
	//       ));
	//       $this->set('videos', $videos);
	//     }
	//     else {
	//       $videos = $this->Video->find('all', array(
	//       ));
	//       
	//       $this->set('videos', $videos);
	//     }
	//   }
	// 
	//   function index() {
	//     $this->Video->recursive = 0;
	//     $this->set('videos', $this->paginate());
	//   }
	// 
	//   function view($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid video', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     $this->set('video', $this->Video->read(null, $id));
	//   }
	// 
	//   function add() {
	//     if (!empty($this->data)) {
	//       $this->Video->create();
	//       if ($this->Video->save($this->data)) {
	//         $this->Session->setFlash(__('The video has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The video could not be saved. Please, try again.', true));
	//       }
	//     }
	//     $genres = $this->Video->Genre->find('list');
	//     $actors = $this->Video->Actor->find('list');
	//     $photos = $this->Video->Photo->find('list');
	//     $this->set(compact('genres', 'actors', 'photos'));
	//   }
	// 
	//   function edit($id = null) {
	//     if (!$id && empty($this->data)) {
	//       $this->Session->setFlash(__('Invalid video', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     if (!empty($this->data)) {
	//       if ($this->Video->save($this->data)) {
	//         $this->Session->setFlash(__('The video has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The video could not be saved. Please, try again.', true));
	//       }
	//     }
	//     if (empty($this->data)) {
	//       $this->data = $this->Video->read(null, $id);
	//     }
	//     $genres = $this->Video->Genre->find('list');
	//     $actors = $this->Video->Actor->find('list');
	//     $photos = $this->Video->Photo->find('list');
	//     $this->set(compact('genres', 'actors', 'photos'));
	//   }
	// 
	//   function delete($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid id for video', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     if ($this->Video->delete($id)) {
	//       $this->Session->setFlash(__('Video deleted', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     $this->Session->setFlash(__('Video was not deleted', true));
	//     $this->redirect(array('action' => 'index'));
	//   }
	//   function admin_index() {
	//     $this->Video->recursive = 0;
	//     $this->set('videos', $this->paginate());
	//   }
	// 
	//   function admin_view($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid video', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     $this->set('video', $this->Video->read(null, $id));
	//   }
	// 
	//   function admin_add() {
	//     if (!empty($this->data)) {
	//       $this->Video->create();
	//       if ($this->Video->save($this->data)) {
	//         $this->Session->setFlash(__('The video has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The video could not be saved. Please, try again.', true));
	//       }
	//     }
	//     $genres = $this->Video->Genre->find('list');
	//     $actors = $this->Video->Actor->find('list');
	//     $photos = $this->Video->Photo->find('list');
	//     $this->set(compact('genres', 'actors', 'photos'));
	//   }
	// 
	//   function admin_edit($id = null) {
	//     if (!$id && empty($this->data)) {
	//       $this->Session->setFlash(__('Invalid video', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     if (!empty($this->data)) {
	//       if ($this->Video->save($this->data)) {
	//         $this->Session->setFlash(__('The video has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The video could not be saved. Please, try again.', true));
	//       }
	//     }
	//     if (empty($this->data)) {
	//       $this->data = $this->Video->read(null, $id);
	//     }
	//     $genres = $this->Video->Genre->find('list');
	//     $actors = $this->Video->Actor->find('list');
	//     $photos = $this->Video->Photo->find('list');
	//     $this->set(compact('genres', 'actors', 'photos'));
	//   }
	// 
	//   function admin_delete($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid id for video', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     if ($this->Video->delete($id)) {
	//       $this->Session->setFlash(__('Video deleted', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     $this->Session->setFlash(__('Video was not deleted', true));
	//     $this->redirect(array('action' => 'index'));
	//   }
}
?>