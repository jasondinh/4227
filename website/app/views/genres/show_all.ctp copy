<div id="genre_list">
<ul>
<?php
$i = 0;
foreach ($genres as $genre) {
  $i++;
  echo "<li>";
  echo $this->Html->link("".$i.". ".$genre['Genre']['name'], array('controller' => 'genres', 'action' => 'show_video', $genre['Genre']['id']));
  echo "</li>";
}

?>
</ul>
</div>