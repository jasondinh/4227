<?php

if (isset($error)) {
  echo json_encode($error);
}

else if (isset($result)) {
  echo json_encode($result);
}

?>