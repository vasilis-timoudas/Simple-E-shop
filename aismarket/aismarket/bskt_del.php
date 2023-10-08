<?php
session_start(); 
if ( !isset($_SESSION['valid']) || ($_SESSION['valid'] != '1'))  
	{
    	header('location: index.php');  
    	exit(); 
 	}
 $pid=isset($_GET['pid']) ? $_GET['pid'] : "";
 
 echo $pid;
	
 if($pid=='all'){
 	unset($_SESSION['bskt_items']);
 	header('Location: basket.php?action=removed&pid=all');
 }
 unset($_SESSION['bskt_items'][$pid]);
 	header('Location: basket.php?action=removed&pid='.$pid);

 ?>