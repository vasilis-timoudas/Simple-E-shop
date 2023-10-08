<?php
session_start(); 
if ( !isset($_SESSION['valid']) || ($_SESSION['valid'] != '1'))  
	{
    	header('location: index.php');  
    	exit(); 
 	}
 $pid=isset($_GET['pid']) ? $_GET['pid'] : "";
 $ps=isset($_GET['ps']) ? $_GET['ps'] : 1;
 
 	$_SESSION['bskt_items'][$pid][1]=$ps;
 	header('Location: basket.php?action=change_ps&pid='.$pid.'&ps='.$ps);
 
 ?>