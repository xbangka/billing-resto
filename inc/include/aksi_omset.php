<?php
include('../../inc/db.php');

$_SESSION['akses'] = md101($_COOKIE['akses']);

if(isset($_POST['aksi']) && $_POST['aksi'] == 'loadtable')
{	
	$tgl1 = $_POST['tgl1'];
	$tgl2 = $_POST['tgl2'];
	$k = explode('/',$tgl1);
	$tgl1 = $k[2].'-'.$k[1].'-'.$k[0];
	$k = explode('/',$tgl2);
	$tgl2 = $k[2].'-'.$k[1].'-'.$k[0];
	
	loadtable($jazz,$_POST['cab'],$tgl1,$tgl2);
	
}

elseif(isset($_POST['selanjutnya']) && $_POST['aksi'] == 'pemesanannestlist' && $_POST['selanjutnya']!= '')
{
	$cab = $_POST['cab'];
	$tgl1 = $_POST['tgl1'];
	$tgl2 = $_POST['tgl2'];
	$k = explode('/',$tgl1);
	$tgl1 = $k[2].'-'.$k[1].'-'.$k[0];
	$k = explode('/',$tgl2);
	$tgl2 = $k[2].'-'.$k[1].'-'.$k[0];
	$xv = strlen($cab);
	$posisi = 0;
	$batas = 10;
	$selanjutnya = $posisi + $batas;
	if(isset($_POST['selanjutnya'])){ $posisi = floor($_POST['selanjutnya']); }
	if($tgl1==''){
		$tgl1 = date('Y-m-d');
	}
	if($tgl2==''){
		$tgl2 = date('Y-m-d');
	}
	$n = $posisi ;
	$x = $posisi + 1 ;
 // id_penjualan, nofaktur, no_jual, tanggal, total, byar, kembali
$sql = mysqli_query($jazz,"SELECT * FROM _penjualan WHERE LEFT(no_jual,".$xv.")='$cab' AND LEFT(tanggal,10) BETWEEN '$tgl1' AND '$tgl2' LIMIT $posisi, $batas");
while ($row = mysqli_fetch_array($sql))
{	$n += 1;
	
?>
	<a href="javascript:;" class="list-group-item" onclick="detail('<?php echo $row['nofaktur'] ?>');" id="list<?php echo $n ?>">
		<div class="row">
			<div class="col-md-6">
				<h4 class="list-group-item-heading">
				Fak <?php echo $row[1] ?> &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $row[2] ?>
				</h4>
			</div>
			<div class="col-md-6">
				<h4 class="list-group-item-heading">Rp. &nbsp; <?php echo number_format($row[4],0,',','.') ?></h4>
			</div>
		</div>
	</a>
<?php } 






}
elseif(isset($_POST['aksi']) && $_POST['aksi'] == 'detail')
{	$d = $_POST['d'];
?>

<table class="table table-striped table-hover table-bordered">
  <thead>
	<tr>
	  <th width="20px">#</th>
	  <th>Item</th>
	  <th width="140px">Harga</th>
	  <th width="120px">Subtotal</th>
	</tr>
  </thead>
  <tbody>
<?php 
$n = 0;
$sql = mysqli_query($jazz,"SELECT * FROM _penjualan_detail WHERE nofaktur='$d' ORDER BY jumlah DESC"); //id, nofaktur, id_menu, namamenu, harga, jumlah, subtotal
while ($row = mysqli_fetch_array($sql))
{	$n += 1;
	?>
		<tr>
		  <td><?php echo $n ?></td>
		  <td><?php echo $row[3].' <span class="badge">'.$row[5].'</span>' ?></td>
		  <td align="right"><span style="float:left">Rp. </span><?php echo number_format($row[4],0,',','.') ?></td>
		  <td align="right"><span style="float:left">Rp. </span><?php echo number_format($row[6],0,',','.') ?></td>
		</tr>
	  
	<?php
}

$sql = mysqli_query($jazz,"SELECT total, byar, kembali FROM _penjualan WHERE nofaktur='$d'"); // id_penjualan, nofaktur, no_jual, tanggal, total, byar, kembali
$row = mysqli_fetch_array($sql);

?>
		<tr align="right">
		  <td colspan="3">Total</td>
		  <td style="background:#66FF99"><span style="float:left">Rp. </span><?php echo number_format($row[0],0,',','.') ?></td>
		</tr>
		<tr align="right">
		  <td colspan="3">Bayar</td>
		  <td style="background:#66FF99"><span style="float:left">Rp. </span><?php echo number_format($row[1],0,',','.') ?></td>
		</tr>
		<tr align="right">
		  <td colspan="3">Kembali</td>
		  <td style="background:#66FF99"><span style="float:left">Rp. </span><?php echo number_format($row[2],0,',','.') ?></td>
		</tr>
	</tbody>
</table>
	<input type="hidden" id="listit" />
<?php








}
else
{
	echo 'gagal';
}	




function loadtable($jazz,$cab,$tgl1,$tgl2){
	$xv = strlen($cab);
	$posisi = 0;
	$batas = 10;
	if($tgl1==''){
		$tgl1 = date('Y-m-d');
	}
	if($tgl2==''){
		$tgl2 = date('Y-m-d');
	}
	$selanjutnya = $posisi + $batas;
	$omset = 0 ;
	$sql = mysqli_query($jazz,"SELECT total FROM _penjualan WHERE LEFT(no_jual,".$xv.")='$cab' AND LEFT(tanggal,10) BETWEEN '$tgl1' AND '$tgl2'");
	while ($row = mysqli_fetch_array($sql))
	{	$omset = $omset +  $row[0];
	}
	
?>
<div align="left">
<h1 align="right" style="color:#990000">Pendapatan Rp. <?php echo number_format($omset,0,',','.') ?></h1>
<?php 
$n = 0 ;
$x = $n + 1 ;
 // id_penjualan, nofaktur, no_jual, tanggal, total, byar, kembali
$sql = mysqli_query($jazz,"SELECT * FROM _penjualan WHERE LEFT(no_jual,".$xv.")='$cab' AND LEFT(tanggal,10) BETWEEN '$tgl1' AND '$tgl2' LIMIT $posisi, $batas");
while ($row = mysqli_fetch_array($sql))
{	$n += 1;
	
?>
	<a href="javascript:;" class="list-group-item" onclick="detail('<?php echo $row['nofaktur'] ?>');" id="list<?php echo $n ?>">
		<div class="row">
			<div class="col-md-6">
				<h4 class="list-group-item-heading">
				Fak <?php echo $row[1] ?> &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $row[2] ?>
				</h4>
			</div>
			<div class="col-md-6">
				<h4 class="list-group-item-heading">Rp. &nbsp; <?php echo number_format($row[4],0,',','.') ?></h4>
			</div>
		</div>
	</a>
<?php } ?>
<p>&nbsp;</p>
<div align="center">
	<button type="button" class="btn btn-default" onclick="btnpemesanannext();"><i class="fa fa-long-arrow-down" style="color:#009900"></i> Lebih banyak ...</button>
</div>
<input type="hidden" value="<?php echo $x ?>" id="firstlist" />
<input type="hidden" value="<?php echo $n ?>" id="lastlist" />
</div>


<?php
}

function yang_lalu($a){
	if($a<=59){
		$jam_on = $a.' detik';
	}elseif($a>=60 && $a<=3599){
		$jam_on = floor($a/60).' menit';
	}elseif($a>=3600){
		$jam_on = floor($a/3600).' jam';
	}else{
		$jam_on = '-';
	}
	return $jam_on ;
	
}

?>

