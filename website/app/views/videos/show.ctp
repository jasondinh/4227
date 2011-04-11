<?php


foreach ($videos as $video) {
  echo '<div class="movie_info">';
  echo 'Name: '.$video['Video']['name'].'<br />';
  echo 'Genre: '.$video['Genre']['name'].'<br />';
  echo 'Description: '.$video['Video']['description'].'<br />';
  echo 'Quantity: '.$video['Video']['quantity'].'<br />';
  echo 'Available quantity: '.$video['Video']['available'].'<br />';
  echo '</div>';
  echo "+++++++++++++++++";
}
?>