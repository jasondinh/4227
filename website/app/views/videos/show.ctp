<?php


foreach ($videos as $video) {
  //debug($video);
  echo '<div class="movie_info">';
  //debug($video);
  // echo $this->Html->image($video['Photo'][0]['url'], array('width'=>200, 'height' => 200)).'<br />';
  echo 'Name: '.$video['Video']['name'].'<br />';
  echo $this->Html->link('Genre: '.$video['Genre']['name'], array('controller' => 'genres', 'action' => 'show_video', $video['Genre']['id']));
  echo '<br />';
  echo 'Description: '.$video['Video']['description'].'<br />';
  echo 'Quantity: '.$video['Video']['quantity'].'<br />';
  echo 'Available quantity: '.$video['Video']['available'].'<br />';
  echo 'In this movie: ';
  
  for ($i = 0 ; $i < count($video['Actor']); ++$i) {
    $tmp = $video['Actor'][$i]['full_name'];
    if ($i != 0) {
      $tmp = ', '.$tmp;
    }
    echo $this->Html->link($tmp, array('controller' => 'actors', 'action' => 'show', $video['Actor'][$i]['id']));
  }
  
  if (isLoggedIn($this)) {
    echo '<br />';
    echo $this->Html->link('Add to queue', array('controller' => 'queues', 'action' => 'add_video_queue', $video["Video"]['id']));
    echo '<br />';
  }
echo '<iframe title="YouTube video player" width="640" height="390" src="http://www.youtube.com/embed/'.$video['Video']['youtube'].'" frameborder="0" allowfullscreen></iframe><br />';  
echo '</div>';

echo '<div id="commentDiv">Comment box';
$i = 0;
//debug($video);
foreach ($video['Comment'] as $comment) {
  if ($i % 2 == 0) {
    echo '<div class="even">';
  }
  else {
    echo '<div class="odd">';
  }
  echo $this->Html->link($comment['User']['username'], array('controller'=>'users', 'action'=>'view', $comment['User']['id']));
  echo ' commented: <br /><br />';
  echo $comment['Comment']['content']. '<br /><br />';
  echo '</div>';
  $i++;
}
echo '</div>';

if (isLoggedIn($this)) {
  echo 'Enter your comment:<br />';
  echo $this->Form->create('Comment', array(
    'action' => 'add'
    ));
  echo $this->Form->input('content', array(
    'type' => 'textarea',
    'value' => '',
    'label' => ''
  ));
  echo $this->Form->input('video_id', array(
    'type' => 'hidden',
    'value' => $video['Video']['id']
  ));
  
  echo $this->Form->end(__('Submit', true));
}
  
  
}
?>
