<?php
$i = 0;

if (sizeof($queues) == 0) {
  echo 'You don\'t have any movie in your queue, how about '.$this->Html->link('browsing', array('controller' => 'genres', 'action' => 'show_all')).' for one?';
}
else {
  foreach ($queues as $queue) {
    $i++;
    echo $this->Html->link("$i. ". $queue['Video']['name']." - ", array('controller' => 'videos', 'action' => 'show', $queue['Video']['id']));
    echo $this->Html->link('Remove this move from queue', array('controller' => 'queues', 'action' => 'remove_video_queue', $queue['Video']['id']));
    echo '<br />';

  }
  
  echo $this->Html->link('Check out this', array('controller' => 'users', 'action' => 'checkout'));
}

?>