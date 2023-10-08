<?php
include_once "dbconn.php";
$table="USERS";
$user = $_POST['user'];
$pass = $_POST['pass'];
$goto_url="";

$cols = "U_EMAIL,U_PASSWD,U_FULLNAME";
$sel="SELECT $cols FROM $table WHERE U_EMAIL='$user'";
$tbl_q = mysqli_query($link, $sel);

    $tbl_row = mysqli_fetch_array($tbl_q, MYSQLI_ASSOC);
	//echo nl2br($tbl_row['U_ID']."".$tbl_row['U_FULLNAME']."\n");
    //$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    //printf ("%s (%s)\n", $tbl_row["U_EMAIL"], $tbl_row["U_FULLNAME"]);
    
	if($user == $tbl_row["U_EMAIL"] && ($pass== $tbl_row["U_PASSWD"]))  {
      	session_start();
      	$_SESSION['valid'] = '1';
      	$_SESSION['uname'] = $tbl_row['U_FULLNAME'];
      	$goto_url="menu.php";
      	header('location: '.$goto_url); die();
    }
    else   {
    	//echo nl2br($user." ".$pass."\n"); die();
    	$goto_url="message.html";
    	header('location: '.$goto_url); die();
    }
//}
header('location: message.html');

//mysql_close();
?>
