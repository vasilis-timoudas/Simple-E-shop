<?php
session_start(); 
if ( !isset($_SESSION['valid']) || ($_SESSION['valid'] != '1'))  
	{
    	header('location: index.php');  
    	exit(); 
 	}

$action= isset($_GET['action']) ? ($_GET['action']) : "";
$pid= isset($_GET['pid']) ? ($_GET['pid']) : "";
$spcf_pg= isset($_GET['pg']) ? intval($_GET['pg']) : 1;

if($action=='added'){
	echo '<script type="text/javascript">';
	echo "alert('Το προϊόν με κωδικό: ".$pid."\\nπροστέθηκε στο καλάθι σας.');";
	echo '</script>';
}
if($action=='exists'){
	echo '<script type="text/javascript">';
	echo "alert('Το προϊόν με κωδικό: ".$pid."\\nυπάρχει ήδη στο καλάθι σας.');";
	echo '</script>';
}

include_once "dbconn.php";
$table="PRODUCTS";
$cols = "*";
$sel="SELECT $cols FROM $table ORDER BY P_DESCR";
$tbl_q = mysqli_query($link, $sel);
$r2pg=3;


$all_recs=mysqli_num_rows($tbl_q);
$pg_num=(int) ($all_recs / $r2pg);
$lstpg=$all_recs-($pg_num*$r2pg);
if($pg_num*$r2pg<$all_recs){ $pg_num=$pg_num+1; }
$firsti=($spcf_pg*$r2pg)-$r2pg;
if($spcf_pg==$pg_num){ $lasti=$all_recs;}
else{$lasti=$spcf_pg*$r2pg;}

?>
<!DOCTYPE html>
<html> <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>AISMARKET: Κεντρική Σελίδα</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<table id="bara" align="center" border="0" width="80%">
	<tr><td width="55%">Όνομα Πελάτη: <b><?=$_SESSION['uname'];?></b></td>
	<td width="15%">Το καλάθι σας: <a href="basket.php"><img src="./images/basket.gif" style="width:20px; height:20px" /></a></td>
	<td width="10%">Αποσύνδεση: <a href="logout.php"><img src="./images/logout.png" style="width:20px; height:20px" /></a></td>
	</tr>
</table>
</br>
<table id="lista" align="center" border="1" width="80%">
	<tr>
		<td width="8%">ΚΩΔΙΚΟΣ</td>
		<td width="36%">ΠΕΡΙΓΡΑΦΗ</td>
		<td width="12%">ΚΑΤΗΓΟΡΙΑ</td>
		<td width="5%">ΦΩΤΟ</td>
		<td width="12%">ΑΞΙΑ</br><font size="1"> (περιλαμβάνει ΦΠΑ 23%)</font></td>
		<td width="7%">ΒΑΡΟΣ</td>
		<td width="6%">ΣΕ ΑΠΟΘΕΜΑ</td>
		<td width="6%">ΑΓΟΡΑ</td>
	</tr>
<?php
for($i=$firsti;$i<=($lasti-1);$i++) {
	if(mysqli_data_seek($tbl_q, $i)) { $tbl_row=mysqli_fetch_row($tbl_q); }
	if($tbl_row[7]>0){
		$tabela="NAI";
		$agora="<a href='bskt_add.php?pid=".$tbl_row[0]."&pg=".$spcf_pg."'><img src='./images/basket.gif' style='width:50px; height:50px' /></a>";
	}
	else{
		$tabela="OXI";
		$agora="<img src='./images/basket.gif' style='width:50px; height:50px;-webkit-filter:grayscale(100%);-moz-filter:grayscale(100%);filter:grayscale(100%);' />";
	}
?>
	<tr>
		<td><?=$tbl_row[0]?></td>
		<td><?=$tbl_row[1]?></td>
		<td><?=$tbl_row[2]?></td>
		<td><img src="<?=$tbl_row[3]?>" style="width:50px; height:50px"/></td>
		<td style="text-align:right"><?=number_format($tbl_row[4]+$tbl_row[5],2,',','')?> €</td>
		<td style="text-align:right"><?=number_format($tbl_row[6],3,',','')?> kgr</td>
		<td><? echo $tabela;?></td>
		<td><? echo $agora;?></td>
	</tr>
<?php
}
mysqli_free_result($tbl_q);
mysqli_close($link);
?>
</table>
<table align="center">
<tr>
<?php
for($i=0;$i<$pg_num;$i++){ ?>
	<td><a href="menu.php?pg=<?=($i+1)?>"><?=($i+1)?></a></td>
<?php
}
?>
</tr>
</table>
</body></html>
