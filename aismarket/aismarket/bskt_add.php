<?php
session_start(); 
if ( !isset($_SESSION['valid']) || ($_SESSION['valid'] != '1'))  
	{
    	header('location: index.php');  
    	exit(); 
 	}
 $pid=isset($_GET['pid']) ? $_GET['pid'] : "";
 $spcf_pg=isset($_GET['pg']) ? $_GET['pg'] : "1";
 
 if(!isset($_SESSION['bskt_items'])){
 	$_SESSION['bskt_items']=array(array());
 }
 if(array_key_exists($pid,$_SESSION['bskt_items'])){
 	$_SESSION['bskt_items'][$pid][1]="1";
 	header('Location: menu.php?action=exists&pid='.$pid.'&pg='.$spcf_pg);
 }
 else{
 	$_SESSION['bskt_items'][$pid][0]=$pid;
 	$_SESSION['bskt_items'][$pid][1]="1";
 	header('Location: menu.php?action=added&pid='.$pid.'&pg='.$spcf_pg);
 }
 ?>