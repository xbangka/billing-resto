<?php
include('../../inc/db.php');
$_SESSION['akses'] = md101($_COOKIE['akses']);

if(isset($_POST['aksi']) && $_POST['aksi'] == 'loadtable')
{	
	loadtable($jazz,$_POST['page']);
	
}
elseif(isset($_POST['aksi']) && $_POST['aksi'] == 'new')
{	
	mysqli_query(
		$jazz,
		"INSERT INTO 
			_akses 
		VALUES(
			'', 
			'".addslashes($_POST['nama'])."', 
			'".addslashes($_POST['jabatan'])."',
			'".addslashes($_POST['cabang'])."',
			'".addslashes($_POST['username'])."',
			'".md100($_POST['sandi'])."',
			'0000-00-00 00:00:00',
			'".addslashes($_POST['blokir'])."'
			)"
		);
		loadtable($jazz,$_POST['page']);
	
}
elseif(isset($_POST['aksi']) && $_POST['aksi'] == 'edit')
{
	$id = $_POST['id'];
	mysqli_query(
		$jazz,
		"UPDATE 
			_akses  
		SET 
			nama='".addslashes($_POST['nama'])."', 
			jabatan='".addslashes($_POST['jabatan'])."', 
			id_cab='".$_POST['cabang']."',
			user_name='".addslashes($_POST['username'])."',
			password='".md100($_POST['sandi'])."',
			blok='".$_POST['blokir']."'
		WHERE 
			id='$id'"
		);
		loadtable($jazz,$_POST['page']);
}
elseif(isset($_POST['aksi']) && $_POST['aksi'] == 'hapus')
{
	$id = $_POST['id'];
	mysqli_query(
		$jazz,
		"DELETE FROM
			_akses  
		WHERE 
			id='$id'"
		);
		loadtable($jazz,$_POST['page']);
}
else
{
	echo 'gagal';
}	


function loadtable($jazz,$page){

?>


<table class="table table-striped table-hover table-bordered">
  <thead>
	<tr>
	  <th>#</th>
	  <th>ID</th>
	  <th>Nama</th>
	  <th>Posisi</th>
	  <th>Cabang</th>
	  <th>Username</th>
	  <th>Blok</th>
	  <th>Action</th>
	</tr>
  </thead>
  <tbody>
	<?php 
		include('pajinasi.php');
		$p = new Paging();
		$batas = 10;
		$posisi = $p->cariPosisi($batas);
		$n = $posisi;
		$sql = mysqli_query($jazz,
							
							"SELECT 
								_akses.* , 
								_cabang.namacab 
							FROM 
								_akses 
							INNER JOIN 
								_cabang 
							ON 
								_akses.id_cab=_cabang.id_cab
							ORDER BY 
								_akses.id_cab, 
								_akses.jabatan 
							ASC LIMIT 
								$posisi,
								$batas
							");
			
		$jmlrecord = mysqli_num_rows(mysqli_query($jazz,"SELECT id FROM _akses WHERE jabatan<>'Admin'"));
		$jmlhalaman = $p->jumlahHalaman($jmlrecord,$batas);
		
		while ($row = mysqli_fetch_array($sql))
		{	$n+=1;
			if($row[7]==0){
				$row7 = 'No';
				$danger = '';
			}else{
				$row7 = 'Yes';
				$danger = 'danger';
			}
			$jamOn = strtotime($row[6]);
			$jam = strtotime(date('Y-m-d H:i:s'));
			if($jamOn >= $jam){
				$OnOff = '<i class="fa fa-check-circle" style="color:#009900"></i>';
			}else{
				$OnOff = '<i class="fa fa-times-circle" style="color:#DDD"></i>';
			}
			
	?>
	<tr class="<?php echo $danger ?>">
	  <td><?php echo $n ?></td>
	  <td><?php echo $row[0] ?></td>
	  <td><?php echo $row[1] ?></td>
	  <td><?php echo $OnOff.' '.$row[2] ?></td>
	  <td><?php echo '('.$row[3].') '.$row[8] ?></td>
	  <td><?php echo $row[4] ?></td>                    
	  <td><?php echo $row7 ?></td>
	  <td><!-- Split button -->
		<div class="btn-group">
		  <button type="button" class="btn btn-info"><i class="fa fa-question-circle"></i></button>
		  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
			<span class="caret"></span>
			<span class="sr-only">Toggle Dropdown</span>
		  </button>
		  <ul class="dropdown-menu" role="menu">
			<li>
				<a href="javascript:;" data-toggle="modal" data-target="#EditModal" 
				onclick="editloadform(<?php echo '\''.md101($row[5]).'\',\''.$row[1].'\',\''.$row[2].'\',\''.$row[3].'\',\''.$row[7].'\',\''.$row[4].'\',\''.$row[0].'\'' ?>);">
				<i class="fa fa-edit" style="color:#006600"></i> Ubah</a>
			</li>
			<li>
				<a href="javascript:;" data-toggle="modal" data-target="#LihatPassModal"
				 onclick="lihatPass(<?php echo md101($row[5]) ?>);">
				 <i class="fa fa-eye" style="color:blue"></i> Lihat Password</a>
			</li>
			<li>
				<a href="javascript:;" data-toggle="modal" data-target="#HapusModal"
				 onclick="HapusID(<?php echo ''.$row[0].',\''.trim($row[1]).'\'' ?>);">
				 <i class="fa fa-trash-o" style="color:#CC0000"></i> Hapus</a>
			</li>
		  </ul>
		</div></td>
	</tr>
	<?php 
	}
	?>
  </tbody>
</table>
<ul class="pagination pull-right">
<?php
	$linkHalaman = $p->navHalaman($page,$jmlhalaman,'','');
	echo $linkHalaman;
?>
</ul>


<?php 
}
?>

