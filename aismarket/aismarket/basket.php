<?php
session_start(); 
if ( !isset($_SESSION['valid']) || ($_SESSION['valid'] != '1'))  
	{
    	header('location: index.php');  
    	exit(); 
 	}
$action= isset($_GET['action']) ? ($_GET['action']) : "";
$posotita = isset($_GET['ps']) ? ($_GET['ps']) : 1;
$pid = isset($_GET['pid']) ? ($_GET['pid']) : "";

if($action=='change_ps'){
	echo '<script type="text/javascript">';
	echo "alert('Η ποσότητα παραγγελίας για το προϊόν με κωδικό: ".$pid."\\nενημερώθηκε.');";
	echo '</script>';
}
if($action=='removed'){
	echo '<script type="text/javascript">';
	if($pid=='all'){
		echo "alert('Το καλάθι σας άδειασε.');";
	}
	else{
		echo "alert('Το προϊόν με κωδικό: ".$pid."\\nδιαγράφηκε από το καλάθι σας.');";	
	}
	echo '</script>';
}

if(isset($_SESSION['bskt_items']) && count($_SESSION['bskt_items'])>0){
	$pids="";
	foreach($_SESSION['bskt_items'] as $pid=>$grammi){
		$pids=$pids.$pid.",";
	}
	$pids=rtrim($pids,',');
	include_once "dbconn.php";
	$table="PRODUCTS";
	$cols = "*";
	$sel="SELECT $cols FROM $table WHERE P_ID IN ({$pids}) ORDER BY P_ID";
	$tbl_q = mysqli_query($link, $sel);
	$apotelesma="1";
}
else{
	$pids="ΚΕΝΟ ΚΑΛΑΘΙ";
	$apotelesma="0";
}

?>
<!DOCTYPE html>
<html> <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>AISMARKET: Διαχείριση Καλαθιού</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

<table id="bara" align="center" border="0" width="80%">
	<tr><td width="55%">Όνομα Πελάτη: <b><?=$_SESSION['uname'];?></b></td>
	<td width="15%">Συνέχεια αγορών: <a href="menu.php"><img src="./images/menu.png" style="width:20px; height:20px" /></a></td>
	<td width="10%">Αποσύνδεση: <a href="logout.php"><img src="./images/logout.png" style="width:20px; height:20px" /></a></td>
	</tr>
</table>
</br>
<table id="lista2" align="center" border="1" width="80%">
	<tr>
		<td width="5%">ΦΩΤΟ</td>
		<td width="8%">ΚΩΔΙΚΟΣ</td>
		<td width="36%">ΠΕΡΙΓΡΑΦΗ</td>
		<td width="12%">ΑΞΙΑ</br><font size="1"> (περιλαμβάνει ΦΠΑ 23%)</font></td>
		<td width="10%">ΠΟΣΟΤΗΤΑ</td>
		<td width="7%">ΤΕΛ.ΑΞΙΑ</>
		<td width="6%">ΔΙΑΓΡΑΦΗ</td>
		
	</tr>
<?php
$synolo=0;
if($apotelesma>0){
	while($tbl_row=mysqli_fetch_row($tbl_q)) {
	$posotita=$_SESSION['bskt_items'][$tbl_row[0]][1];
	if($tbl_row[7]<5){$maxp=$tbl_row[7];}
	else{$maxp='5';}
?>
	<tr>
		<td><img src="<?=$tbl_row[3]?>" style="width:50px; height:50px"/></td>
		<td><?=$tbl_row[0]?></td>
		<td><?=$tbl_row[1]?></td>
		<td style="text-align:right"><?=number_format($tbl_row[4]+$tbl_row[5],2,',','');?> €</td>
		<td><input type="number" name="posotita" value="<?=$posotita;?>" maxlength="1" max="<?=$maxp;?>" min="1" onchange="val(this.value)">
			<button type="button" onclick="updt(<?=$tbl_row[0]?>);">Αλλαγή</button></td>
		<td><?=number_format($posotita*($tbl_row[4]+$tbl_row[5]),2,',','')?> €</td>
		<td><a href="bskt_del.php?pid=<?=$tbl_row[0];?>"><img src="./images/recycle_bin.png" style="width:13px; height:13px" /></td>
	</tr>
<?php
	$synolo=$synolo+($posotita*($tbl_row[4]+$tbl_row[5]));
	}
mysqli_free_result($tbl_q);
mysqli_close($link);
}
else{ ?>
	<tr>
		<td colspan="7"><? echo $pids; ?></td>
	</tr>
<?
}
?>
<tr><td colspan="5"><b>Σύνολο:</b></td><td colspan="2"><b><?=number_format($synolo,2,',','');?> €</b></td></tr>
</table>
<table align="center">
<tr>
</tr>
</table>
<?
if($synolo>0){
	echo nl2br("<table cellpadding='10' align='center'>\n");
	echo nl2br("<tr align='center'><td><a href='bskt_del.php?pid=all' title='ΑΔΕΙΑΣΜΑ ΚΑΛΑΘΙΟΥ'><img src='./images/recycle_bin.png' style='width:50px; height:50px'/></a></td>\n");
	echo nl2br("<td><a href='tameio.php' title='ΟΛΟΚΛΗΡΩΣΗ ΑΓΟΡΩΝ'><img src='./images/tameio.gif' style='width:50px; height:50px'/></a></td></tr>\n");
	echo nl2br("</table>\n");
}?>
<script>
	var posotita;
	function val(timi){
		posotita=timi;
	}
	function updt(vl){
			var pid=vl;
			window.location.href="bskt_chg.php?pid="+pid+"&ps="+posotita;

	}
</script>
</body></html>
