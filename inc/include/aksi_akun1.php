<?php
include('../../inc/db.php');
$_SESSION['akses'] = md101($_COOKIE['akses']);

if(isset($_POST['aksi']) && $_POST['aksi'] == 'edit')
{
	$id = $_POST['idx'];
	
	$sql = mysqli_query($jazz,"SELECT password FROM _akses WHERE id='$id'");
	$row = mysqli_fetch_array($sql);
	if(md101($row[0])==$_POST['pass']){
		if($_POST['password_1']!=''){
			mysqli_query(
			$jazz,
			"UPDATE 
				_akses  
			SET 
				nama='".addslashes($_POST['nama'])."', 
				user_name='".addslashes($_POST['user'])."',
				password='".md100($_POST['password_1'])."'
			WHERE 
				id='$id'"
			);
		}else{
			mysqli_query(
			$jazz,
			"UPDATE 
				_akses  
			SET 
				nama='".addslashes($_POST['nama'])."', 
				user_name='".addslashes($_POST['user'])."'
			WHERE 
				id='$id'"
			);
		}
		echo 'Berhasil.';
	}else{
		echo 'Gagal, Password sebelumnya salah !.';
	}
		
}
else
{
	echo 'gagal';
}	

?>