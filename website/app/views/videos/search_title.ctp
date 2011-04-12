<?php

echo '<div id="search videos">';

if ($videos) {
  $i = 0;
  foreach ($videos as $video) {
    $i++;
    echo $this->Html->link($i.'. '.$video['Video']['name'], array('controller' => 'videos', 'action' => 'show', $video['Video']['id']));
    echo '<br />';
  }
  
}
else {
  echo 'No movies with such title found';
}

echo '</div>';


?>