<?php

echo '<div id="admin genres">';
$i = 1;
foreach ($genres as $genre) {
  //debug($genre);
  echo $i. '. '.$genre['Genre']['name'];
  echo ' - ';
  echo $this->Html->link('Edit', array('controller' => 'genres', 'action' => 'edit', $genre['Genre']['id'], 'admin' => true));
  echo ' | ';
  echo $this->Html->link(__('Delete', true), array('action' => 'delete', $genre['Genre']['id']), null, sprintf(__('Are you sure you want to delete #%s?', true), $genre['Genre']['id']));
  echo '<br />';
  $i++;
}
echo '<br />';
echo $this->Html->link('Add new genres', array('action' => 'add'));
echo '</div>';

?>

