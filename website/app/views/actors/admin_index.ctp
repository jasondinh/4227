<?php

echo '<div id="admin actor">';
$i = 1;
foreach ($actors as $actor) {
  //debug($genre);
  echo $i. '. '.$actor['Actor']['full_name'];
  echo ' - ';
  echo $this->Html->link('Edit', array('action' => 'edit', $actor['Actor']['id'], 'admin' => true));
  echo ' | ';
  echo $this->Html->link(__('Delete', true), array('action' => 'delete', $actor['Actor']['id']), null, sprintf(__('Are you sure you want to delete #%s?', true), $actor['Actor']['id']));
  echo '<br />';
  $i++;
}
echo '<br />';
echo $this->Html->link('Add new actor', array('action' => 'add'));
echo '</div>';

?>

