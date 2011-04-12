<?php
class CommentsController extends AppController {

	var $name = 'Comments';
	var $uses = array("Employee", "User", 'Comment');
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
	  $user = $this->User->validate_user();
		if ($user) {
		  if (isset($this->params['form']['Comment'])) {
		    $comment = $this->params['form']['Comment'];
		    $comment['timeStamp'] = time();
		    $this->Comment->create();
		    $this->Comment->save($comment);
		    $this->result = array('result' => TRUE);
		  }
		}
		else {
			$this->error = generate_error('Permission error');
		}
	}
	
	function remove() {
	  $employee = $this->User->validate_employee();
		if ($employee) {
		  if (isset($this->params['form']['Comment'])) {
		    $comment = $this->params['form']['Comment'];
		    $this->Comment->delete($comment['id']);
		    $this->result = array('result' => TRUE);
		  }
		}
		else {
			$this->error = generate_error("Permission error");
		}
	}
	
	function show_all() {
	  $comments = $this->Comment->find('all', array(
	    'order' => 'Comment.timeStamp ASC'
	  ));
	  $this->result = $comments;
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