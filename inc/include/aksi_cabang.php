<?php
include('../../inc/db.php');
$_SESSION['akses'] = md101($_COOKIE['akses']);

if(isset($_POST['aksi']) && $_POST['aksi'] == 'new')
{	
	mysqli_query(
		$jazz,
		"INSERT INTO 
			_cabang 
		VALUES(
			'', 
			'".addslashes($_POST['namacab'])."', 
			'".addslashes($_POST['kota'])."',
			'".addslashes($_POST['alamat'])."',
			'".addslashes($_POST['pegawai'])."'
			)"
		);
		loadtable($jazz);
	
}
elseif(isset($_POST['aksi']) && $_POST['aksi'] == 'edit')
{
	$id = $_POST['id'];
	mysqli_query(
		$jazz,
		"UPDATE 
			_cabang  
		SET 
			namacab='".addslashes($_POST['namacab'])."', 
			kota='".addslashes($_POST['kota'])."', 
			alamat='".addslashes($_POST['alamat'])."',
			pegawai='".addslashes($_POST['pegawai'])."'
		WHERE 
			id_cab='$id'"
		);
		loadtable($jazz);
}
elseif(isset($_POST['aksi']) && $_POST['aksi'] == 'hapus')
{
	$id = $_POST['id'];
	mysqli_query(
		$jazz,
		"DELETE FROM
			_cabang  
		WHERE 
			id_cab='$id'"
		);
		loadtable($jazz);
}
else
{
	echo 'gagal';
}	


function loadtable($jazz){

?>


<table class="table table-striped table-hover table-bordered">
  <thead>
	<tr>
	  <th>#</th>
	  <th>ID</th>
	  <th>Cabang</th>
	  <th>Alamat, Kota</th>
	  <th>Jumlah Pegawai</th>
	  <th>Jumlah Meja</th>
	  <th>Jumlah Kursi</th>
	  <th>Action</th>
	</tr>
  </thead>
  <tbody>
<?php 
	$n=0;
	$sql = mysqli_query($jazz,"SELECT * FROM _cabang");
	while ($row = mysqli_fetch_array($sql))
	{
		$n+=1;
		$jmlkursi=0;
		$sql2 = mysqli_query($jazz,"SELECT jml_kursi FROM _meja WHERE id_cab='$row[id_cab]'");
		$jmlmeja = mysqli_num_rows($sql2);
		while ($row2 = mysqli_fetch_array($sql2))
		{
			$jmlkursi+=$row2[0];
		}
?>
<tr>
  <td><?php echo $n ?></td>
  <td><?php echo $row['id_cab'] ?></td>
  <td><?php echo $row['namacab'] ?></td>
  <td><?php echo $row['alamat'].', '.$row['kota'] ?></td>
  <td><?php echo $row['pegawai'] ?></td>
  <td><?php echo $jmlmeja ?></td>                    
  <td><?php echo $jmlkursi ?></td>
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
			onclick="editloadform(<?php echo '\''.$row['id_cab'].'\',\''.$row['namacab'].'\',\''.$row['kota'].'\',\''.$row['alamat'].'\',\''.$row['pegawai'].'\'' ?>);">
			<i class="fa fa-edit" style="color:#006600"></i> Ubah</a>
		</li>
		<li>
			<a href="javascript:;" data-toggle="modal" data-target="#HapusModal"
			 onclick="HapusID(<?php echo $row['id_cab'] ?>);">
			 <i class="fa fa-trash-o" style="color:#CC0000"></i> Hapus</a>
		</li>
	  </ul>
	</div></td>
</tr>
<?php 
	} 
echo '</tbody></table>';
}
?>

