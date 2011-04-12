<?php
class VideosController extends AppController {

	var $name = 'Videos';
	var $components = array('Api');
	function beforeFilter() {
    $top10 = $this->Api->get('videos/top10');
    $this->set('top10', $top10);
    $this->set('title', 'Video');
  }
	function show($id = null) {

    if ($id) {
      $videos = $this->Api->get('videos/get_video_details/'.$id);
      $this->set('videos', $videos);
    }
    else {
      $videos = $this->Api->get('videos/get_all');
      $this->set('videos', $videos);
    }
  }
  
  function admin_index() {
    if (isAdmin($this)) {
	    $result = $this->Api->get('videos/get_all'); 
	    $this->set('videos', $result);
	  }
  }
  
  function admin_edit($id = null) {
    if (isAdmin($this)) {
      if (!$this->data) {
        $result = $this->Api->get('videos/get_video_details/'.$id); 

  	    if (isset($result['Genre']['id'])) {
  	      $genre_selected = $result['Genre']['id'];
  	    }
  	    else {
  	      $genre_selected = 0;
  	    }
  	    $this->set('genre_selected', $genre_selected);
  	    $this->set('video', $result);

  	    $result = $this->Api->get('genres/show_all'); 
  	    $genres = array();
  	    foreach ($result as $genre) {
  	      $genres[$genre['Genre']['id']] = $genre['Genre']['name'];
  	    }
  	    $this->set('genres', $genres);

  	    $result = $this->Api->get('actors/show_all');
  	    $actors = array();
  	    foreach ($result as $actor) {
  	      $actors[$actor['Actor']['id']] = $actor['Actor']['full_name'];
  	    }
  	    $this->set('actors', $actors);
      }
      else {
        $data = $this->data;
	      $user = $this->Session->read('User.info');
        $data['username'] = $user['User']['username'];
        $data['password'] = $user['User']['password'];
        
        $this->Api->post('videos/update_video_details', $data);
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
	    if ($this->data) {
	      $data = $this->data;
	      $user = $this->Session->read('User.info');
        $data['username'] = $user['User']['username'];
        $data['password'] = $user['User']['password'];
        $this->Api->post('videos/add', $data);
        $this->redirect(array('action' => 'index'));
      }
      else {
  	    $result = $this->Api->get('genres/show_all'); 
  	    $genres = array();
  	    foreach ($result as $genre) {
  	      $genres[$genre['Genre']['id']] = $genre['Genre']['name'];
  	    }
  	    $this->set('genres', $genres);

  	    $result = $this->Api->get('actors/show_all');
  	    $actors = array();
  	    foreach ($result as $actor) {
  	      $actors[$actor['Actor']['id']] = $actor['Actor']['full_name'];
  	    }
  	    $this->set('actors', $actors);
      }
	  }
  }
  
  function search_title() {
    $data = $this->params['form'];
    $result = $this->Api->post('videos/search_title', $data);
    $this->set('videos', $result);
  }
	
	// 
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