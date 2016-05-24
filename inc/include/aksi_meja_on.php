<?php
include('../../inc/db.php');
$_SESSION['akses'] = md101($_COOKIE['akses']);

if(isset($_POST['aksi']) && $_POST['aksi'] == 'loadtable')
{	
	loadtable($jazz,$_POST['cab']);
	
}

elseif(isset($_POST['selanjutnya']) && $_POST['aksi'] == 'pemesanannestlist' && $_POST['selanjutnya']!= '')
{
	$cab = $_POST['cab'];
	$xv = strlen($cab);
	$posisi = 0;
	$batas = 10;
	$selanjutnya = $posisi + $batas;
	if(isset($_POST['selanjutnya'])){ $posisi = floor($_POST['selanjutnya']); }

$n = $posisi ;
$x = $posisi + 1 ;
 //id_order, meja, tgl, jam_on, diupdate, selesai, total   // id, id_order, id_menu, nama_menu, harga, qty, sub_total, itm_baru, jam
$sql = mysqli_query($jazz,"SELECT * FROM _order WHERE LEFT(id_order,".$xv.")='$cab' AND diupdate > jam_on ORDER BY tgl DESC, diupdate DESC LIMIT $posisi, $batas");
while ($row = mysqli_fetch_array($sql))
{	$n += 1;
	$wtk2 = strtotime($row[2].' '.$row[4]);
	$wtk = strtotime(date('Y-m-d H:i:s'));
	$jam_on = yang_lalu($wtk - $wtk2);
	$sql2 = mysqli_query($jazz,"SELECT nama_menu, qty, itm_baru FROM _order_detail WHERE id_order='$row[0]' AND jam='$row[4]' AND itm_baru='1' ORDER BY harga DESC LIMIT 0,1"); // id, id_order, id_menu, nama_menu, harga, qty, sub_total, itm_baru, jam
	$row2 = mysqli_fetch_array($sql2);
	$divaktif = 'class="list-group-item"';
	if($row2[2] == 1){
		$divaktif = 'class="list-group-item active" style="background:#009933;"';
	}
	
?>
	<a href="javascript:;" <?php echo $divaktif ?> onclick="detail('<?php echo $row[0] ?>','list<?php echo $n ?>');" id="list<?php echo $n ?>">
		<div class="row">
			<div class="col-md-6">
				<h4 class="list-group-item-heading">
				Meja <?php echo $row[1] ?> &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $row2[0].' <span class="badge">'.$row2[1].'</span> ...' ?>
				</h4>
			</div>
			<div class="col-md-6">
				<h4 class="list-group-item-heading"><?php echo $row[0].' &nbsp; &nbsp; '.$jam_on.' yang lalu' ?></h4>
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
	  <th width="140px">Waktu</th>
	  <th width="120px">Subtotal</th>
	</tr>
  </thead>
  <tbody>
<?php 
$n = 0;
$sql = mysqli_query($jazz,"SELECT tgl FROM _order WHERE id_order='$d'");
$row = mysqli_fetch_array($sql);
$tgl = $row[0];
$sql = mysqli_query($jazz,"SELECT * FROM _order_detail WHERE id_order='$d' ORDER BY itm_baru, qty DESC"); //id, id_order, id_menu, nama_menu, harga, qty, sub_total, itm_baru, jam
$total = 0 ;
while ($row = mysqli_fetch_array($sql))
{	$n += 1;
	$wtk2 = strtotime($tgl.' '.$row[8]);
	$wtk = strtotime(date('Y-m-d H:i:s'));
	$jam_on = yang_lalu($wtk - $wtk2);
	$total = $total + $row[6] ;
	?>
		<tr>
		  <td><?php echo $n ?></td>
		  <td><?php echo $row[3].' <span class="badge">'.$row[5].'</span>' ?></td>
		  <td><?php echo $jam_on.' yang lalu' ?></td>
		  <td align="right"><span style="float:left">Rp. </span><?php echo number_format($row[6],0,',','.') ?></td>
		</tr>
	  
	<?php
} ?>
		<tr align="right">
		  <td colspan="3">Total</td>
		  <td style="background:#66FF99"><span style="float:left">Rp. </span><?php echo number_format($total,0,',','.') ?></td>
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




function loadtable($jazz,$cab){
	$xv = strlen($cab);
	$posisi = 0;
	$batas = 10;
	$selanjutnya = $posisi + $batas;
	
?>

<div align="left">
<?php 
$n = 0 ;
$x = $n + 1 ;
 //id_order, meja, tgl, jam_on, diupdate, selesai, total   // id, id_order, id_menu, nama_menu, harga, qty, sub_total, itm_baru, jam
$sql = mysqli_query($jazz,"SELECT * FROM _order WHERE LEFT(id_order,".$xv.")='$cab' AND diupdate > jam_on ORDER BY tgl DESC, diupdate DESC LIMIT $posisi, $batas");
while ($row = mysqli_fetch_array($sql))
{	$n += 1;
	$wtk2 = strtotime($row[2].' '.$row[4]);
	$wtk = strtotime(date('Y-m-d H:i:s'));
	$jam_on = yang_lalu($wtk - $wtk2);
	$sql2 = mysqli_query($jazz,"SELECT nama_menu, qty, itm_baru FROM _order_detail WHERE id_order='$row[0]' AND jam='$row[4]' AND itm_baru='1' ORDER BY harga DESC LIMIT 0,1"); // id, id_order, id_menu, nama_menu, harga, qty, sub_total, itm_baru, jam
	$row2 = mysqli_fetch_array($sql2);
	$divaktif = 'class="list-group-item"';
	if($row2[2] == 1){
		$divaktif = 'class="list-group-item active" style="background:#009933;"';
	}
	
?>
	<a href="javascript:;" <?php echo $divaktif ?> onclick="detail('<?php echo $row[0] ?>');" id="list<?php echo $n ?>">
		<div class="row">
			<div class="col-md-6">
				<h4 class="list-group-item-heading">
				Meja <?php echo $row[1] ?> &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $row2[0].' <span class="badge">'.$row2[1].'</span> ...' ?>
				</h4>
			</div>
			<div class="col-md-6">
				<h4 class="list-group-item-heading"><?php echo $row[0].' &nbsp; &nbsp; '.$jam_on.' yang lalu' ?></h4>
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

