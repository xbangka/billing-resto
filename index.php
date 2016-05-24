<?php 
$cekdb ='inc/db.php';
if (file_exists($cekdb)) {
	require($cekdb);
}else{
	exit();
}

if(!isset($_SESSION['akses']) && empty($_REQUEST['laman'])){
	include('inc/404.php');
	exit();
}elseif(!isset($_SESSION['akses']) && $_REQUEST['laman']=='intro'){
	include('inc/intro.php');
	exit();
}elseif(!isset($_SESSION['akses']) && $_REQUEST['laman']=='lojin'){
	include('inc/lojin.php');
	exit();
}elseif(!isset($_SESSION['akses']) && $_REQUEST['laman']=='stasiunmeja'){
	include('inc/stasiun.php');
	exit();
}else{
	
	$akun = explode('|',$_SESSION['akses']);
	switch($akun[2]){
		case 'Admin' :
			header('location: admin.php');
			break;
		case 'Monitoring' :
			header('location: monitoring.php');
			break;
		case 'Kasir' :
			header('location: kasir.php');
			break;
		case 'Meja' :
			if (isset($_SESSION['IDorder'])) {
				include('stasiun.php');
			}else{
				include('inc/face.php');
			}
			break;
	}
}

?>