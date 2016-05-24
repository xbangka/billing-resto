<?php 

$pesan='';
if(isset($_POST['kirim']) && empty($_REQUEST['captcha'])){
	header('location: '.$host);
}elseif(isset($_POST['kirim']) && !empty($_REQUEST['captcha'])){
	if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) {
		$pesan = '<b style="color:#FF0000">Invalid captcha</b><br />';
	} else {
		$u=addslashes($_POST['nama']);
		$p=md100($_POST['sandi']);
		$sql=mysqli_query($jazz,"SELECT * FROM _akses WHERE password='$p' AND user_name='$u' AND blok='0'");
		$ada=mysqli_num_rows($sql);
		if($ada==1){
			$tgl = date('Y-m-d H:i:s');
			$ip = ambil_ip();
			$tamu = gethostbyaddr($_SERVER['REMOTE_ADDR']);
			$browser = $_SERVER['HTTP_USER_AGENT'];
			$row = mysqli_fetch_array($sql);
			$_SESSION['akses'] = $row['id'].'|'.$row['nama'].'|'.$row['jabatan'].'|'.$row['id_cab'].'|'.$row['user_name'];
			unset($_SESSION['captcha']);
			mysqli_query($jazz,"UPDATE _akses SET ontime='$tgl' WHERE id='$row[id]'");
			mysqli_query($jazz,"INSERT INTO _log VALUES('','$row[id]','$tgl','$ip','$tamu','$browser')") ;
			header('location: '.$host);
			exit;
		}else{
			$pesan='<b style="color:#FF0000">Maaf, username atau password salah</b><br />';
		}
	}
	$request_captcha = htmlspecialchars($_REQUEST['captcha']);
	unset($_SESSION['captcha']);
}
?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>::</title>
<link rel="stylesheet" href="css/style1.css">
</head>
<body>
	<section class="container">
    <div class="login">
      <h1>Login User</h1>
			<form action="" method="post">
				
				<?php 
				echo $pesan.'';
				?>
				<p>
				<input name="nama" type="text" maxlength="25" 
				onKeyUp="this.value=this.value.replace(/[^0-9a-zA-Z_.,!@#$%^&*()-]/g,' ')" 
				autocomplete="off" placeholder="Username" style="text-align:center"/>
				</p>
				<p><input name="sandi" type="password" maxlength="50" placeholder="Password" style="text-align:center" /></p>
				<p align="center">
				<img src="js/captcha/" id="captcha" style="box-shadow: 5px 5px 5px #888888;" /><br />
				<a href="javascript:;" onClick="document.getElementById('captcha').src='js/captcha/?'+Math.random();">
					Not readable? Change text.
				</a></p>
				
				<p><input type="text" name="captcha" autocomplete="off" style="text-align:center" placeholder="enter captcha"/></p><br />
				
				<p class="submit"><input name="kirim" type="submit" value=" &nbsp; login &nbsp; "/></p>
			</form>
    </div>
  </section>
</body>
</html>
