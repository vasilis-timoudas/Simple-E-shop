<?php
session_start(); 
date_default_timezone_set('Europe/Athens');

if ( !isset($_SESSION['valid']) || ($_SESSION['valid'] != '1'))  
	{
    	header('location: index.php');  
    	exit(); 
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
	
	header('Content-Type: text/csv');
	header('Content-Disposition: attachment;filename="aismarket.txt"');
	header('Cache-Control: max-age=0');
	
	$grammi="========================================================================================\n";
	$out=fopen('php://output','w');
	$first = "\n===============================ΔΕΛΤΙΟ ΠΑΡΑΓΓΕΛΙΑΣ=======================================\n";
	$first .= $grammi;
	$first .= "ONOMA ΠΕΛΑΤΗ:\t\t".$_SESSION['uname']."\n";
	$first .= "ΗΜ/ΝΙΑ ΠΑΡΑΓΓΕΛΙΑΣ:\t".date('j.n.Y G:i:s e')."\n";
	fwrite($out, $first.$grammi."\n");
	$titles="ΚΩΔΙΚΟΣ\tΠΕΡΙΓΡΑΦΗ\t\t\t\tΑΞΙΑ\tΠΟΣΟΤΗΤΑ\tΤΕΛ.ΑΞΙΑ\n";
	fwrite($out, $grammi.$titles.$grammi);
	
	$synolo=0;
	while($tbl_row=mysqli_fetch_row($tbl_q)) {
		$posotita=$_SESSION['bskt_items'][$tbl_row[0]][1];
		$synolo=$synolo+($posotita*($tbl_row[4]+$tbl_row[5]));
		$upd="UPDATE $table SET P_QNT=".($tbl_row[7]-$posotita)." WHERE P_ID=".$tbl_row[0];
		$tbl_u=mysqli_query($link, $upd);
		if(strlen($tbl_row[1])>35){ $perigrafi=substr($tbl_row[1],0,35);}
		else{
			$perigrafi=$tbl_row[1];
			while(strlen($perigrafi)<35){$perigrafi=$perigrafi." ";}
		}
		$outr = $tbl_row[0]."\t";
		$outr .= $perigrafi."\t";
		$outr .= number_format($tbl_row[4]+$tbl_row[5],2,',','')."€\t";
		$outr .= $posotita."\t\t";
		$outr .= number_format($posotita*($tbl_row[4]+$tbl_row[5]),2,',','')."€";
		$outr .= "\n";
		//$outr .= $upd;
		fwrite($out, $outr);
	}
	
	fwrite($out, $grammi."\n".$grammi);
	$telos="ΣΥΝΟΛΙΚΗ ΑΞΙΑ ΑΓΟΡΩΝ:\t".number_format($synolo,2,',','')."€\n";
	fwrite($out, $telos.$grammi);
	fclose($out);
	unset($_SESSION['bskt_items']);
}

//mysqli_free_result($tbl_u);
//mysqli_free_result($tbl_q);
//mysqli_close($link);
?>
