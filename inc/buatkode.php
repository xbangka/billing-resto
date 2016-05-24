<?php 

$cekdb ='db.php';

if (file_exists($cekdb)) {
	require($cekdb);
}else{
	exit();
}
if (isset($_SESSION['IDorder']) || !isset($_SESSION['akses'])) {
	header('Location: '.$host);
	exit;
}else{
	$k = explode('|',$_SESSION['akses']);  // $id_meja.'|'.$m.'|Meja|'.$c.'|'.$passout;
	$tgl=date("Y-m-d");
	$waktu=date("H:i:s");
	$kodeorder=$k[3].'.'.$k[1].'.'; //1.1.001
	$jmlkode=strlen($kodeorder);
	
	$sql = mysqli_query($jazz,"SELECT id_order FROM _order WHERE LEFT(id_order,".$jmlkode.")='$kodeorder' ORDER BY id_order DESC LIMIT 0,1");
	//id_order, id_meja, tgl, jam_on, diupdate, selesai, total
	$ada=mysqli_num_rows($sql);
	if($ada==0){
		$kodeorder=$kodeorder.sprintf('%03d',1);
	}else{
		$row = mysqli_fetch_array($sql);
		$urutan = floattostr(substr($row[0],-3,3)); //001 ==> 1
		$kodeorder = $kodeorder.sprintf('%03d',($urutan+1));
	}
	
	mysqli_query($jazz,"INSERT INTO _order VALUES('$kodeorder', '$k[1]', '$tgl', '$waktu', '$waktu', '0', '0')");
	
	$_SESSION['IDorder']=$kodeorder;
	setcookie("IDorder", md100($_SESSION['IDorder']), time() + (3600*6));
	header('Location: '.$host);
	}
?>