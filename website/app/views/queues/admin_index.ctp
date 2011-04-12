<?php
echo '<div id="history">';
if ($processing) {
  echo 'Processing';
  echo '<table>';
  echo '<tr>';
  echo '<th>Title</th>';
  echo '<th>Username</th>';
  echo '<th>Address</th>';
  echo '<th>Action</th>';
  echo '</tr>';
  foreach ($processing as $queue) {
    //debug($queue);
    echo '<tr>';
    echo '<td>'.$queue['Video']['name'].'</td>';
    echo '<td>'.$queue['User']['username'].'</td>';
    echo '<td>'.$queue['User']['address'].'</td>';
    echo '<td>';
    echo $this->Html->link('Edit', array('action' => 'edit', $queue['Queue']['id'], 'admin' => true));
    echo ' | ';
    echo $this->Html->link(__('Delete', true), array('action' => 'delete', $queue['Queue']['id']), null, sprintf(__('Are you sure you want to delete this record?', true), $queue['Queue']['id']));
    echo '</td>';
    echo '</tr>';
  }
  echo '</table><br />';
}


if ($sent) {
  echo 'Sent via post';
  echo '<table>';
  echo '<tr>';
  echo '<th>Title</th>';
  echo '<th>Username</th>';
  echo '<th>Address</th>';
  echo '<th>Action</th>';
  echo '</tr>';
  foreach ($sent as $queue) {
    //debug($queue);
    echo '<tr>';
    echo '<td>'.$queue['Video']['name'].'</td>';
    echo '<td>'.$queue['User']['username'].'</td>';
    echo '<td>'.$queue['User']['address'].'</td>';
    echo '<td>';
    echo $this->Html->link('Edit', array('action' => 'edit', $queue['Queue']['id'], 'admin' => true));
    echo ' | ';
    echo $this->Html->link(__('Delete', true), array('action' => 'delete', $queue['Queue']['id']), null, sprintf(__('Are you sure you want to delete this record?', true), $queue['Queue']['id']));
    echo '</td>';
    echo '</tr>';
  }
  echo '</table><br />';
}

if ($returned) {
  echo 'Returned';
  echo '<table>';
  echo '<tr>';
  echo '<th>Title</th>';
  echo '<th>Username</th>';
  echo '<th>Address</th>';
  echo '<th>Action</th>';
  echo '</tr>';
  foreach ($returned as $queue) {
    //debug($queue);
    echo '<tr>';
    echo '<td>'.$queue['Video']['name'].'</td>';
    echo '<td>'.$queue['User']['username'].'</td>';
    echo '<td>'.$queue['User']['address'].'</td>';
    echo '<td>';
    echo $this->Html->link('Edit', array('action' => 'edit', $queue['Queue']['id'], 'admin' => true));
    echo ' | ';
    echo $this->Html->link(__('Delete', true), array('action' => 'delete', $queue['Queue']['id']), null, sprintf(__('Are you sure you want to delete this record?', true), $queue['Queue']['id']));
    echo '</td>';
    echo '</tr>';
  }
  echo '</table><br />';
}

if ($pending) {
  echo 'Pending';
  echo '<table>';
  echo '<tr>';
  echo '<th>Title</th>';
  echo '<th>Username</th>';
  echo '<th>Address</th>';
  echo '<th>Action</th>';
  echo '</tr>';
  foreach ($pending as $queue) {
    //debug($queue);
    echo '<tr>';
    echo '<td>'.$queue['Video']['name'].'</td>';
    echo '<td>'.$queue['User']['username'].'</td>';
    echo '<td>'.$queue['User']['address'].'</td>';
    echo '<td>';
    echo $this->Html->link('Edit', array('action' => 'edit', $queue['Queue']['id'], 'admin' => true));
    echo ' | ';
    echo $this->Html->link(__('Delete', true), array('action' => 'delete', $queue['Queue']['id']), null, sprintf(__('Are you sure you want to delete this record?', true), $queue['Queue']['id']));
    echo '</td>';
    echo '</tr>';
  }
echo '</table><br />';
}
echo '</div>';
?>