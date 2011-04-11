<?php
class QueuesController extends AppController {

	var $name = 'Queues';
	
	var $uses = array("Employee", "User", 'Video', 'Queue');
	var $error;
	var $result;	

	function beforeRender() {
		if ($this->error) {
			$this->set('error', $this->error);
			debug($this->error);
		}

		if ($this->result) {
			$this->set('result', $this->result);
			debug($this->result);
		}
	}
	
	function add_video_queue() {
		$user = $this->User->validate_user();
		
		if ($user) {
			$video = $this->params['form']['video'];
			$tmp_user = $this->params['form']['user'];
			
			$queue = $this->Queue->find_queue_by_user_id_and_movie_id($tmp_user['id'], $video['id']);
			
			if ($queue) {
				$this->error = generate_error('Duplicate queue');
			}
			else {
				
				$video = $this->Video->find_video_by_id($video['id']);
				
				if ($video['Video']['available'] <= 0) {
					$this->error = generate_error('No more stock');
				}
				else {
					$queue = array(
						'user_id' => $tmp_user['id'],
						'video_id' => $video['Video']['id']
					);
					$this->Queue->create();
					$this->Queue->save($queue);
					$video['Video']['available']--;
					$this->Video->save($video);
					$this->result = array('result'=>TRUE);
				}
			}
		}
		else {
			$this->error = generate_error('Permission error');
		}
	}
	
	function remove_video_queue() {
		$user = $this->User->validate_user();
		
		if ($user) {
			$video = $this->params['form']['video'];
			$tmp_user = $this->params['form']['user'];
			
			$queue = $this->Queue->find_queue_by_user_id_and_movie_id($tmp_user['id'], $video['id']);
			
			if ($queue) {
				
				$this->Queue->delete($queue['Queue']['id']);
				
				$video = $this->Video->find_video_by_id($video['id']);
				
				$video['Video']['available']++;
				$this->Video->save($video);
				$this->result = array('result'=>TRUE);
			}
			else {
				$this->error = generate_error('No such queue');
				
			}
		}
		else {
			$this->error = generate_error('Permission error');
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