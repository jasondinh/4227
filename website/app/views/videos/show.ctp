<?php


foreach ($videos as $video) {
  echo '<div class="movie_info">';
  echo 'Name: '.$video['Video']['name'].'<br />';
  echo 'Genre: '.$video['Genre']['name'].'<br />';
  echo 'Description: '.$video['Video']['description'].'<br />';
  echo 'Quantity: '.$video['Video']['quantity'].'<br />';
  echo 'Available quantity: '.$video['Video']['available'].'<br />';
  echo '</div>';
  
  echo $this->Html->link('Add to queue', array('controller' => 'queues', 'action' => 'add_video_queue', $video["Video"]['id']));
  echo '<br />';
  echo 'Enter your comment:<br />';
  echo $this->Form->create('Comment', array(
    'action' => 'add'
    ));
  echo $this->Form->input('comment', array(
    'type' => 'textarea',
    'value' => '',
    'label' => ''
  ));
  echo $this->Form->input('video_id', array(
    'type' => 'hidden',
    'value' => $video['Video']['id']
  ));
  
  echo $this->Form->end(__('Submit', true));
  echo "+++++++++++++++++";
  
}
?>