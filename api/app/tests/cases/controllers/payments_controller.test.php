<?php
/* Payments Test cases generated on: 2011-04-12 04:27:28 : 1302553648*/
App::import('Controller', 'Payments');

class TestPaymentsController extends PaymentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PaymentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.payment', 'app.queue', 'app.user', 'app.comment', 'app.video', 'app.genre', 'app.actor', 'app.photo', 'app.actors_photo', 'app.photos_video', 'app.actors_video');

	function startTest() {
		$this->Payments =& new TestPaymentsController();
		$this->Payments->constructClasses();
	}

	function endTest() {
		unset($this->Payments);
		ClassRegistry::flush();
	}

}
?>