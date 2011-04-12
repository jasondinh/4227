<?php

echo '<div id="admin index">';
$i = 1;
foreach ($users as $user) {
  //debug($genre);
  echo $i. '. '.$user['User']['username'];
  echo ' - ';
  echo $this->Html->link('Edit', array('action' => 'edit', $user['User']['id'], 'admin' => true));
  echo ' | ';
  echo $this->Html->link(__('Delete', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete #%s?', true), $user['User']['id']));
  echo '<br />';
  $i++;
}
echo '<br />';
echo $this->Html->link('Add new user', array('action' => 'add'));
echo '</div>';

?>

