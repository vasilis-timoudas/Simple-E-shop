<?php
  session_start();
  session_destroy();
  mysqli_close($link);
  header('location: index.php'); 
?>

