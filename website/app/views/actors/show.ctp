<?php

echo '<div id="actor">';
// if (isset($actor['Photo'][0])) {
//   echo $this->Html->image($actor['Photo'][0]['url'], array('width' => 200, 'height' => 200)).'<br />';
// }

echo 'Name: '.$actor['Actor']['full_name'].'<br />';
echo 'Birthday: '.$actor['Actor']['dob'].'<br />';
echo 'Starred in movies: ';
foreach ($actor['Video'] as $video) {
  echo $this->Html->link($video['name'], array('controller' => 'videos', 'action' => 'show', $video['id']));
}
echo '<br />';
echo '</div>';

?>