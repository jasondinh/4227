<?php
if (isset($videos)) {
  $i = 1;
  foreach ($videos as $video) {
    
    echo $this->Html->link($i.'. '. $video['name'], array('controller' => 'videos', 'action' => 'show', $video['id']));
    echo '<br />';
    $i++;
  }
}
?>