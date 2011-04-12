<div id="history">
<?php
if ($queues && count($queues) > 0) {
  echo '<table>';
  echo '<tr>';
  echo '<th>Movie</th>';
  echo '<th>Date rented</th>';
  echo '<th>Status</th>';
  echo '<th>Transaction code</th>';
  echo '</tr>';
  $i = 0;
  foreach ($queues as $queue) {
    //debug($queue);
    if ($i % 2 == 0) {
      echo '<tr class="even">';
    }
    else {
      echo '<tr class="odd">';
    }
    $i++;
    
    echo '<td>'.$this->Html->link($queue['Video']['name'], array('controller'=> 'videos', 'action' => 'show', $queue['Video']['id'])).'</td>';
    $date = date('l jS F Y h:i:s A', $queue['Payment']['timeStamp']);
    echo '<td>'.$date.'</td>';
    $status = $queue['Queue']['status'];
    switch ($status) {
      case 1:
      $status = 'Processing';
      break;
      case 2: 
      $status = 'Sent via post';
      break;
      case 3: 
      $status = 'Returned';
      break;
    }
    echo '<td>'.$status.'</td>';
    echo '<td>'.$queue['Payment']['transaction_id'].'</td>';
    echo '</tr>';
  }
  echo '</table>';
}
else {
  echo 'You don\'t have any history with us yet';
}
?>
</div>