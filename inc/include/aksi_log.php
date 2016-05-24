<?php
include('../../inc/db.php');
$_SESSION['akses'] = md101($_COOKIE['akses']);

if(isset($_POST['aksi']) && $_POST['aksi'] == 'loadtable')
{	
	loadtable($jazz,$namabulan,$_POST['tab']);
	
}
elseif(isset($_POST['aksi']) && $_POST['aksi'] == 'hapus')
{
	if($_POST['tab']==1){
		mysqli_query($jazz,"DELETE _log.* FROM _log INNER JOIN _akses ON _log.id_user=_akses.id WHERE _akses.jabatan<>'Admin'");
	}elseif($_POST['tab']==2){
		mysqli_query($jazz,"DELETE FROM _log_meja");
	}else{
		mysqli_query($jazz,"DELETE _log.* FROM _log INNER JOIN _akses ON _log.id_user=_akses.id WHERE _akses.jabatan='Admin'");
	}
	
	loadtable($jazz,$namabulan,$_POST['tab']);
}
elseif(isset($_POST['aksi']) && $_POST['aksi'] == 'liatpass')
{
	echo 'gagal';
}	




function loadtable($jazz,$namabulan,$tab){

?>


<table class="table table-striped table-hover table-bordered">
  <thead>
	<tr>
	  <th>#</th>
	  <th>User</th>
	  <th>Tanggal, Waktu</th>
	  <th>IP</th>
	  <th>PC</th>
	  <th width="360px">Browser</th>
	</tr>
  </thead>
  <tbody>
	<?php 
		$n=0;
		
		if($tab==1){
			$sql = mysqli_query($jazz,
							
					"SELECT 
						_log.* , 
						_akses.nama,
						_akses.jabatan,
						_akses.id_cab
					FROM 
						_log 
					INNER JOIN 
						_akses 
					ON 
						_log.id_user=_akses.id 
					AND
						_akses.jabatan<>'Admin'
					ORDER BY 
						_log.tgl
					DESC");
		}elseif($tab==2){
			$sql = mysqli_query($jazz,
					"SELECT 
						_log_meja.* , 
						_cabang.namacab
					FROM 
						_log_meja 
					INNER JOIN 
						_cabang 
					ON 
						_log_meja.id_cab=_cabang.id_cab 
					ORDER BY 
						_log_meja.tgl
					DESC");
		}else{
			$sql = mysqli_query($jazz,
					"SELECT 
						_log.* , 
						_akses.nama
					FROM 
						_log 
					INNER JOIN 
						_akses 
					ON 
						_log.id_user=_akses.id 
					AND
						_akses.jabatan='Admin'
					ORDER BY 
						_log.tgl
					DESC");
		}
		
		while ($row = mysqli_fetch_array($sql))
		{	$n+=1;
			if($tab==1){
				$user = $row[6].'<br />('.$row[7].','.$row[8].')';
				$tgl = substr($row[2],0,10);
				$k = explode("-",$tgl);
				$tgl = $k[2].'-'.$namabulan[floattostr($k[1])].'-'.$k[0].'<br />'.substr($row[2],11,8);
				$ip = $row[3];
				$pc = $row[4];
				$browser = $row[5];
			}elseif($tab==2){ 
				$user = 'Meja Nomor '.$row[2].'<br />('.$row[1].','.$row[7].')';
				$tgl = substr($row[3],0,10);
				$k = explode("-",$tgl);
				$tgl = $k[2].'-'.$namabulan[floattostr($k[1])].'-'.$k[0].'<br />'.substr($row[3],11,8);
				$ip = $row[4];
				$pc = $row[5];
				$browser = $row[6];
			}else{
				$user = $row[6];
				$tgl = substr($row[2],0,10);
				$k = explode("-",$tgl);
				$tgl = $k[2].'-'.$namabulan[floattostr($k[1])].'-'.$k[0].'<br />'.substr($row[2],11,8);
				$ip = $row[3];
				$pc = $row[4];
				$browser = $row[5];
			}
	?>
	<tr>
	  <td><?php echo $n ?></td>
	  <td><?php echo $user ?></td>
	  <td><?php echo $tgl ?></td>
	  <td><?php echo $ip ?></td>
	  <td><?php echo $pc ?></td>                    
	  <td><?php echo $browser ?></td>
	</tr>
	<?php 
	}
	?>
  </tbody>
</table><p>&nbsp;</p><p>&nbsp;</p>
<?php 
}
?>

