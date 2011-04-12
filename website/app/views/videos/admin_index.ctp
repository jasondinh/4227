<?php

echo '<div id="admin videos">';
$i = 1;
foreach ($videos as $video) {
  //debug($genre);
  echo $i. '. '.$video['Video']['name']. ' ('.$video['Genre']['name'].')';
  echo ' - ';
  echo $this->Html->link('Edit', array('action' => 'edit', $video['Video']['id'], 'admin' => true));
  echo ' | ';
  echo $this->Html->link(__('Delete', true), array('action' => 'delete', $video['Video']['id']), null, sprintf(__('Are you sure you want to delete #%s?', true), $video['Video']['id']));
  echo '<br />';
  $i++;
}
echo '<br />';
echo $this->Html->link('Add new video', array('action' => 'add'));
echo '</div>';

?>

