<?php 
$cekdb ='inc/db.php';
if (file_exists($cekdb)) {
	require($cekdb);
}else{
	exit();
}


if(empty($_SESSION['akses'])){header('location: '.$host.'login.asp');}

$akun = explode('|',$_SESSION['akses']); // $row['id'].'|'.$row['nama'].'|'.$row['jabatan'].'|'.$row['id_cab'].'|'.$row['user_name'];

if($akun[2]!='Kasir'){header('location: '.$host);}

$pos = strpos($akun[3],'_');
if($pos===false){
	$sql = mysqli_query($jazz,"SELECT namacab FROM _cabang WHERE id_cab='$akun[3]'"); //id_cab, namacab, kota, alamat, pegawai
	$row = mysqli_fetch_array($sql);
	$id_cab = $akun[3];
	$nama_cab = $row[0];
	$_SESSION['akses'] = $akun[0].'|'.$akun[1].'|'.$akun[2].'|'.$id_cab.'_'.$nama_cab.'|'.$akun[4]; // $row['id'].'|'.$row['nama'].'|'.$row['jabatan'].'|'.$row['id_cab'].'_nama_cab|'.$row['user_name'];
	setcookie("akses", md100($_SESSION['akses']), time() + (3600*24));
}else{
	$k = explode('_',$akun[3]);
	$id_cab = $k[0];
	$nama_cab = $k[1];
}


if (empty($_GET['l'])) {
	include('inc/kasir/index.php');
	
}elseif($_GET['l']!=''){
	include('inc/kasir/index.php');
				
}else{
	include('inc/kasir/index.php');
}


?>

      <!-- Modal -->
      <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:350px;top:170px">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Anda yakin ingin logout?</h4>
            </div>
            <div class="modal-footer">
              <a href="logout.php" class="btn btn-primary"> &nbsp; Ya &nbsp; </a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>