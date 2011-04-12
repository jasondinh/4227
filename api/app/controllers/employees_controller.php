<?php
class EmployeesController extends AppController {

	var $name = 'Employees';
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
	
	function get_profile() {
	  $tmp_employee = $this->User->validate_employee();
	  if ($tmp_employee) {
			$this->result = $tmp_employee;
		}
		else {
			$this->error = generate_error('Permission error');
		}
	}
	
	function add_employee() {
		$tmp_employee = $this->User->validate_employee();
		
		if ($tmp_employee) {
			$employee = $this->params['form']['employee'];
			
			$tmp_employee_2 = $this->Employee->find_employee_by_username($employee['username']);
			
			if ($tmp_employee_2) {
				$this->error = generate_error('Duplicate username');
			}
			else {
				$this->Employee->create();
				$this->Employee->save($employee);
				$this->result = $employee;
			}
		}
		else {
			$this->error = generate_error('Permission error');
		}
	}
	
	function get_employee_details() {
	  	//TODO: validaion
		$employee = $this->User->validate_employee();
		if ($employee) {
			$employee = $this->params['form']['employee'];


			$employee = $this->Employee->find_employee_by_id($employee['id']);

			if ($employee) {
				$this->result = $employee;
			}

			else {
				$this->error = generate_error('No such employee');
			}
		}
		else {
			$this->error = generate_error("Permission error");
		}
	}
	
	function update_employee_details() {
		//TODO: remove password field
		$employee = $this->User->validate_employee();
		if ($employee) {
			$employee  = $this->params['form']['employee'];
			$this->Employee->save($employee);
			$this->result = $employee;
		}
		else {
			$this->error = generate_error("Permission error");
		}
	  
	}
	
	function delete_employee() {
	  	$employee = $this->User->validate_employee();
		if ($employee) {
			$employee  = $this->params['form']['employee'];
			$this->Employee->delete($employee['id']);
			$this->result = array('result' => TRUE);
		}
		else {
			$this->error = generate_error("Permission error");
		}
	}
	
	function get_employee_role($employee_id, $passowrd) {
	  
	}
	
	function getAccessRights($employee_id, $passowrd) {
	  
	}
	
	function change_password() {
		$employee = $this->User->validate_employee();
		if ($employee) {
			//$employee  = $this->params['form']['employee'];
			$employee['Employee']['password'] = $this->params['form']['employee']['new_password'];
			$this->Employee->save($employee);
			$this->result = $employee;
		}
		else {
			$this->error = generate_error("Permission error");
		}
	}

	// function index() {
	//     $this->Employee->recursive = 0;
	//     $this->set('employees', $this->paginate());
	//   }
	// 
	//   function view($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid employee', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     $this->set('employee', $this->Employee->read(null, $id));
	//   }
	// 
	//   function add() {
	//     if (!empty($this->data)) {
	//       $this->Employee->create();
	//       if ($this->Employee->save($this->data)) {
	//         $this->Session->setFlash(__('The employee has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The employee could not be saved. Please, try again.', true));
	//       }
	//     }
	//   }
	// 
	//   function edit($id = null) {
	//     if (!$id && empty($this->data)) {
	//       $this->Session->setFlash(__('Invalid employee', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     if (!empty($this->data)) {
	//       if ($this->Employee->save($this->data)) {
	//         $this->Session->setFlash(__('The employee has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The employee could not be saved. Please, try again.', true));
	//       }
	//     }
	//     if (empty($this->data)) {
	//       $this->data = $this->Employee->read(null, $id);
	//     }
	//   }
	// 
	//   function delete($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid id for employee', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     if ($this->Employee->delete($id)) {
	//       $this->Session->setFlash(__('Employee deleted', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     $this->Session->setFlash(__('Employee was not deleted', true));
	//     $this->redirect(array('action' => 'index'));
	//   }
	//   function admin_index() {
	//     $this->Employee->recursive = 0;
	//     $this->set('employees', $this->paginate());
	//   }
	// 
	//   function admin_view($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid employee', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     $this->set('employee', $this->Employee->read(null, $id));
	//   }
	// 
	//   function admin_add() {
	//     if (!empty($this->data)) {
	//       $this->Employee->create();
	//       if ($this->Employee->save($this->data)) {
	//         $this->Session->setFlash(__('The employee has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The employee could not be saved. Please, try again.', true));
	//       }
	//     }
	//   }
	// 
	//   function admin_edit($id = null) {
	//     if (!$id && empty($this->data)) {
	//       $this->Session->setFlash(__('Invalid employee', true));
	//       $this->redirect(array('action' => 'index'));
	//     }
	//     if (!empty($this->data)) {
	//       if ($this->Employee->save($this->data)) {
	//         $this->Session->setFlash(__('The employee has been saved', true));
	//         $this->redirect(array('action' => 'index'));
	//       } else {
	//         $this->Session->setFlash(__('The employee could not be saved. Please, try again.', true));
	//       }
	//     }
	//     if (empty($this->data)) {
	//       $this->data = $this->Employee->read(null, $id);
	//     }
	//   }
	// 
	//   function admin_delete($id = null) {
	//     if (!$id) {
	//       $this->Session->setFlash(__('Invalid id for employee', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     if ($this->Employee->delete($id)) {
	//       $this->Session->setFlash(__('Employee deleted', true));
	//       $this->redirect(array('action'=>'index'));
	//     }
	//     $this->Session->setFlash(__('Employee was not deleted', true));
	//     $this->redirect(array('action' => 'index'));
	//   }
}
?>