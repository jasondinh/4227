<?php
class Employee extends AppModel {
	var $name = 'Employee';
	var $displayField = 'id';
	
	function validate_employee() {
	  $username = $_REQUEST['eUsername'];
	  $password = $_REQUEST['ePassword'];
	  
	  $employee = $this->find('first', array(
	   'conditions' => array(
	     'Employee.username' => $username,
	     'Employee.password' => $password
	   ),
	   'recursive' => -1
	  ));
	  
	  return $employee;
	}
	
	function find_employee_by_username($username) {
	  $employee = $this->find('first', array(
	   'conditions' => array(
	     'Employee.username' => $username
	   ),
	   'recursive' => -1
	  ));
	  
	  return $employee;
	}
	
	function find_employee_by_id($id) {
	  $employee = $this->find('first', array(
	   'conditions' => array(
	     'Employee.id' => $id
	   ),
	   'recursive' => -1
	  ));
	  
	  return $employee;
	}
}
?>