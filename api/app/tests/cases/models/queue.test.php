<?php
/* Queue Test cases generated on: 2011-04-12 04:25:44 : 1302553544*/
App::import('Model', 'Queue');

class QueueTestCase extends CakeTestCase {
	var $fixtures = array('app.queue', 'app.user', 'app.comment', 'app.video', 'app.genre', 'app.actor', 'app.photo', 'app.actors_photo', 'app.photos_video', 'app.actors_video', 'app.payment');

	function startTest() {
		$this->Queue =& ClassRegistry::init('Queue');
	}

	function endTest() {
		unset($this->Queue);
		ClassRegistry::flush();
	}

}
?>