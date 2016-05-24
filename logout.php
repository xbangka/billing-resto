<?php 
$cekdb ='inc/db.php';
if (file_exists($cekdb)) {
	require($cekdb);
}else{
	exit();
}

$k = explode('|',$_SESSION['akses']);  // $id_meja.'|'.$m.'|Meja|'.$c;
$tgl = strtotime(date('Y-m-d H:i:s')) ;
	

if($k[2]=='Admin' || $k[2]=='Kasir' || $k[2]=='Monitoring'){
	$host = 'http://'.$_SERVER['HTTP_HOST'].'/login.asp';
	
}elseif($k[2]=='Meja'){
	$host = 'http://'.$_SERVER['HTTP_HOST'].'/stasiun.asp';
	mysqli_query($jazz,"UPDATE _meja SET ontime='$tgl' WHERE id='$k[0]'");
	
}else{
	header('location: http://'.$_SERVER['HTTP_REFERER']);
	exit();
}
$_SESSION=array();
session_destroy();
setcookie("akses", "", time() - (3600*24));
header('location: '.$host);
?>