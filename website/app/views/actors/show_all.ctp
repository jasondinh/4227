<?php
$i = 0;
foreach ($actors as $actor) {
  $i++;
  echo $this->Html->link($i.'. '.$actor['Actor']['full_name'], array('controller' => 'actors', 'action' => 'show', $actor['Actor']['id'])).'<br />';
}

?>