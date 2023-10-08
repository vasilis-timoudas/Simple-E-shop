<?php 
    include_once"dbconn.php"; 
    $table="USERS"; 
    $user = $_POST['user']; 
    $pass = $_POST['pass']; 
    $goto_url="";

    $cols = "U_EMAIL,U_PASSWD,U_FULLNAME";
    $sel="SELECT $cols FROM $table WHERE U_EMAIL='$user'"; 
    $tbl_q= mysqli_query($link, $sel); 
    $tbl_row= mysqli_fetch_array($tbl_q, MYSQLI_ASSOC);

    if($user == $tbl_row["U_EMAIL"] && ($pass== $tbl_row["U_PASSWD"]))  
    { 
        session_start(); 
        $_SESSION['valid'] = '1'; 
        $_SESSION['uname'] = $tbl_row['U_FULLNAME']; 
        $goto_url="menu.php"; 
        header('location: '.$goto_url); 
        die();
    }
    else
    {
        $goto_url="message.html"; 
        header('location: '.$goto_url); 
        die();
    }

    header('location: message.html'); 
?>