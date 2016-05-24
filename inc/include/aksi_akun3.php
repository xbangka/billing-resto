<?php
include('../../inc/db.php');
$_SESSION['akses'] = md101($_COOKIE['akses']);

if(isset($_POST['aksi']) && $_POST['aksi'] == 'loadtable')
{	
	loadtable($jazz,$_POST['cab']);
	
}
elseif(isset($_POST['aksi']) && $_POST['aksi'] == 'new')
{
	mysqli_query(
		$jazz,
		"INSERT INTO 
			_meja
		VALUES(
			'', 
			'".addslashes($_POST['cabang'])."', 
			'".addslashes($_POST['meja'])."',
			'".md100($_POST['password'])."',
			'".addslashes($_POST['blok'])."',
			'0000-00-00 00:00:00',
			'".addslashes($_POST['jmlkursi'])."'
			)"
		);
		loadtable($jazz,$_POST['cabang']);
	
}
elseif(isset($_POST['aksi']) && $_POST['aksi'] == 'edit')
{
	$id = $_POST['id'];
	$uu = mysqli_query(
		$jazz,
		"UPDATE 
			_meja  
		SET 
			id_cab='".addslashes($_POST['cabang'])."', 
			meja='".addslashes($_POST['meja'])."', 
			pass='".md100($_POST['sandi'])."',
			blok='".addslashes($_POST['blokir'])."',
			jml_kursi='".addslashes($_POST['kursi'])."'
		WHERE 
			id='$id'"
		);
		loadtable($jazz,$_POST['cabang']);
}
elseif(isset($_POST['aksi']) && $_POST['aksi'] == 'hapus')
{
	$id = $_POST['id'];
	mysqli_query(
		$jazz,
		"DELETE FROM
			_meja  
		WHERE 
			id='$id'"
		);
		loadtable($jazz,$_POST['cab']);
}
elseif(isset($_POST['aksi']) && $_POST['aksi'] == 'liatpass')
{
	$id = $_POST['id'];
	$sql = mysqli_query(
		$jazz,
		"SELECT pass FROM
			_meja  
		WHERE 
			id='$id'"
		);
	$data = mysqli_fetch_array($sql);
	echo md101($data[0]);
}
else
{
	echo 'gagal';
}	




function loadtable($jazz,$cab){

?>


<table class="table table-striped table-hover table-bordered">
  <thead>
	<tr>
	  <th>#</th>
	  <th>ID</th>
	  <th>Nomor Meja</th>
	  <th>Password</th>
	  <th>Jumlah Kursi</th>
	  <th>Blokir</th>
	  <th>Action</th>
	</tr>
  </thead>
  <tbody>
	<?php 
		$n=0;
		$sql = mysqli_query($jazz,
							
							"SELECT 
								_meja.* , 
								_cabang.namacab 
							FROM 
								_meja 
							INNER JOIN 
								_cabang 
							ON 
								_meja.id_cab=_cabang.id_cab AND
								_meja.id_cab='$cab'
							ORDER BY 
								_meja.meja
							ASC");
		
		while ($row = mysqli_fetch_array($sql))
		{	$n+=1;
			if($row[4]==0){
				$row7 = 'No';
				$danger = '';
			}else{
				$row7 = 'Yes';
				$danger = 'danger';
			}
			$jamOn = strtotime($row[5]);
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
	  <td><?php echo $row[2].' &nbsp; '.$OnOff ?></td>
	  <td><?php echo nbull($row[3]) ?></td>
	  <td><?php echo $row[6] ?></td>                    
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
				onclick="editloadform(<?php echo '\''.md101($row[3]).'\',\''.$row[1].'\',\''.$row[2].'\',\''.$row[6].'\',\''.$row[4].'\',\''.$row[0].'\'' ?>);">
				<i class="fa fa-edit" style="color:#006600"></i> Ubah</a>
			</li>
			<li>
				<a href="javascript:;" data-toggle="modal" data-target="#LihatPassModal"
				 onclick="lihatPass(<?php echo $row[0] ?>);">
				 <i class="fa fa-eye" style="color:blue"></i> Lihat Password</a>
			</li>
			<li>
				<a href="javascript:;" data-toggle="modal" data-target="#HapusModal"
				 onclick="HapusID(<?php echo $row[0].','.$row[1].','.$row[2] ?>);">
				 <i class="fa fa-trash-o" style="color:#CC0000"></i> Hapus</a>
			</li>
		  </ul>
		</div></td>
	</tr>
	<?php 
	}
	?>
  </tbody>
</table><p>&nbsp;</p><p>&nbsp;</p>
<?php 
}
?>

