<?php 
$step = 1 ;
$pesan='';
if( isset($_POST['idmejax']) && $_POST['idmejax']!='' && $_POST['sandi']!=''){
	$c=addslashes($_POST['idcab']);
	$m=addslashes($_POST['idmejax']);
	$p=md100($_POST['sandi']);
	$sql=mysqli_query($jazz,"SELECT id, ontime, passout FROM _meja WHERE pass='$p' AND meja='$m' AND id_cab='$c' AND blok='0'");
	$ada=mysqli_num_rows($sql);
	if($ada==1){
		$tgl = date('Y-m-d H:i:s');
		$row = mysqli_fetch_array($sql);
		if( strtotime($row['ontime']) < strtotime($tgl) ){
			$id_meja = $row['id'];
			$passout = $row['passout'];
			$b = strtotime($tgl) + 6;
			$updatee = date('Y-m-d H:i:s',$b);
			$ip = ambil_ip();
			$tamu = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			$browser = $_SERVER['HTTP_USER_AGENT'];
			$_SESSION['akses'] = $id_meja.'|'.$m.'|Meja|'.$c.'|'.$passout;
			mysqli_query($jazz,"UPDATE _meja SET ontime='$updatee' WHERE id='$id_meja'");
			mysqli_query($jazz,"INSERT INTO _log_meja VALUES('','$c', '$m','$tgl','$ip','$tamu','$browser')") ;
			header('location: '.$host);
			exit;
		}else{
			$step = 1 ;
			$pesan='</p><p align="center" style="color:#FFF;background-color:#FF6699;padding:7px 0 7px 0;">Maaf, meja nomor '.$m.' sedang terpakai.</p><br /><p align="center">';
		}	
	}else{
		$step = 1 ;
		$pesan='</p><p align="center" style="color:#FFF;background-color:#FF6699;padding:7px 0 7px 0;">Maaf, Login Gagal.</p><br /><p align="center">';
	}
}elseif( isset($_POST['idmeja']) && $_POST['idmeja']!='' ){
	$idmeja = $_POST['idmeja'];
	$idcab = $_POST['idcab'];
	$step = 4 ;
	
}elseif( isset($_POST['kirim']) && isset($_POST['id']) && $_POST['id']!=''){
	$idcab = $_POST['id'];
	$step = 3 ;

}elseif(isset($_POST['kirim']) && empty($_REQUEST['captcha'])){
	$request_captcha = htmlspecialchars($_REQUEST['captcha']);
	unset($_SESSION['captcha']);
	header('location: '.$host);
	
}elseif(isset($_POST['kirim']) && !empty($_REQUEST['captcha'])){
	if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) {
		$pesan = '<b style="color:#FF0000">Invalid captcha</b><br />';
	}else{
		$step = 2 ;
	}
	$request_captcha = htmlspecialchars($_REQUEST['captcha']);
	unset($_SESSION['captcha']);
}

?>

<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Stasiun Meja</title>
  <link href="img/lamp.png" rel="icon" type="image/x-icon">        
  <link rel="stylesheet" href="css/style1.css">
</head>
<body>
<?php 
if($step == 1){
?>
  <section class="container">
    <div class="login">
      <h1>Login Stasiun Meja</h1>
      <form method="post" action="">
        <p align="center"><?php echo $pesan ?>
		<img src="js/captcha/" id="captcha" style="box-shadow: 5px 5px 5px #888888;" /><br />
		<a href="javascript:;" onClick="document.getElementById('captcha').src='js/captcha/?'+Math.random();">
				Not readable? Change text.
		</a></p>
		<p><input type="text" name="captcha" autocomplete="off" style="text-align:center" placeholder="enter captcha"/></p><br />
        <p class="submit"><input type="submit" name="kirim" value="Next"></p>
		
      </form>
    </div>
  </section>
<?php 
}elseif($step == 2){
	$sql = mysqli_query($jazz,"SELECT id_cab, namacab FROM _cabang");
	while ($cab = mysqli_fetch_array($sql)){
	echo '<form method="post" action=""><p><input type="hidden" name="id" value="'.$cab[0].'"><input type="submit" name="kirim" value="'.$cab[0].'. '.$cab[1].'"></p></form> ';}

}elseif($step == 3){
	echo '<p>&nbsp;</p><span style="color:#FF6600">Pilih Meja</span>';
	$sql = mysqli_query($jazz,"SELECT meja FROM _meja WHERE id_cab='$idcab' AND blok='0'"); // id, id_cab, meja, pass, blok, ontime, jml_kursi, passout, visitor_time
	while ($row = mysqli_fetch_array($sql)){
	echo '<form method="post" action=""><p><input type="hidden" name="idcab" value="'.$idcab.'"><input type="submit" name="idmeja" value="'.$row[0].'"></p></form> ';}

}elseif($step == 4){
?>
  <section class="container">
    <div class="login">
      <h1>Password</h1>
      <form method="post" action="">
        <p align="center"><?php echo $pesan ?>
		</p><input type="hidden" name="idcab" value="<?php echo $idcab  ?>">
		<p><input type="hidden" name="idmejax" value="<?php echo $idmeja ?>"></p>
		<p><input type="password" name="sandi"></p><br />
        <p class="submit"><input type="submit" name="kirim" value="Login"></p>
		
      </form>
    </div>
  </section>
<?php 
}
?>


<script type="text/javascript">
	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if( charCode > 31 && ( charCode < 48 || charCode > 57 ))
		return false;
		return true;
	}
</script>

</body>
</html>