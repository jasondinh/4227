<?php

echo '<div id="history">';
echo '<table>';

echo '<tr>';
echo '<th>Username</th>';
echo '<th>Movie</th>';
echo '<th>Comment</th>';
echo '<th>Date & Time</th>';
echo '<th>Action</th>';
echo '</tr>';

foreach ($comments as $comment) {
  //debug($comment);
  echo '<tr>';
  echo '<td>'.$comment['User']['username'].'</td>';
  echo '<td>'.$comment['Video']['name'].'</td>';
  echo '<td>'.$comment['Comment']['content'].'</td>';
  $date = date('l jS F Y h:i:s A', $comment['Comment']['timeStamp']);
  echo '<td>'.$date.'</td>';
  echo '<td>';
  echo $this->Html->link(__('Delete', true), array('action' => 'delete', $comment['Comment']['id']), null, sprintf(__('Are you sure you want to delete #%s?', true), $comment['Comment']['id']));
  echo'</td>';
  echo '</tr>';
}

echo '</table>';
echo '</div>';
?>