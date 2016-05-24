<?php
include('../../inc/db.php');

$_SESSION['akses'] = md101($_COOKIE['akses']);


if(isset($_POST['aksi']) && $_POST['aksi'] == 'meja')
{	$k = explode('|',$_SESSION['akses']); // $row['id'].'|'.$row['nama'].'|'.$row['jabatan'].'|'.$row['id_cab'].'_nama_cab|'.$row['user_name'];
	$l = explode('_',$k[3]);
	$xv = strlen($l[0]);
	$tgl = date('Y-m-d');
?>
<div align="left">
<h4 class="margin-bottom-15">Daftar Meja Makan <?php echo $l[1] ?></h4>

<?php 
$n = 0;
$sql = mysqli_query($jazz,"SELECT id, id_cab, meja, visitor_time FROM _meja WHERE id_cab='$l[0]'"); //id, id_cab, meja, pass, blok, ontime, jml_kursi, passout, visitor_time 2015-10-09 15:40:23
while ($row = mysqli_fetch_array($sql))
{	$n+=1;
	$jamOn = strtotime($row[3]);
	$jam = strtotime(date('Y-m-d H:i:s'));
	if($jamOn >= $jam){
		$OnOff = 'class="fa fa-circle" style="color:#009900"';
	}else{
		$OnOff = 'class="fa fa-circle" style="color:#CCC"';
	}

	$sql2 = mysqli_query($jazz,"SELECT id_order, jam_on, tgl FROM _order WHERE LEFT(id_order,".$xv.")='$l[0]' AND meja='$row[2]' AND tgl='$tgl' ORDER BY id_order DESC LIMIT 0,1"); // id_order, meja, tgl, jam_on, diupdate, selesai, total
	$ada = mysqli_num_rows($sql2);
	if($ada==1){
		$row2 = mysqli_fetch_array($sql2);
		$idorder = $row2[0];
		$wtk2 = strtotime($row2[2].' '.$row2[1]);
		$wtk = strtotime(date('Y-m-d H:i:s'));
		$jam_on = yang_lalu($wtk - $wtk2);
		if($jamOn < $jam){$jam_on = '-';}
	}else{
		$idorder = '';
		$jam_on = '-';
	}
	
	
?>
	<a href="javascript:;" class="list-group-item" onclick="pilihmeja(<?php echo $row[2] ?>);">
		<div class="row">
			<div class="col-md-6">
				<h4 class="list-group-item-heading">
				<i <?php echo $OnOff ?> id="oon<?php echo $n ?>" dataid="e<?php echo $row['id'] ?>e">
				</i> &nbsp; Meja <?php echo $row[2] ?> &nbsp; &nbsp; &nbsp; &nbsp; <span id="labelorder<?php echo $n ?>"><?php echo $idorder ?></span>
				</h4>
			</div>
			<div class="col-md-6">
				<h4 class="list-group-item-heading" id="yglalu<?php echo $n ?>"><?php echo $jam_on ?></h4>
			</div>
		</div>
	</a>
<?php } ?>

<input type="hidden" value="1" id="halaman" />
</div>














<?php
}
elseif(isset($_POST['aksi']) && $_POST['aksi'] == 'pilihmeja')
{
	$k = explode('|',$_SESSION['akses']); // $row['id'].'|'.$row['nama'].'|'.$row['jabatan'].'|'.$row['id_cab'].'_nama_cab|'.$row['user_name'];
	$l = explode('_',$k[3]);
	$xv = strlen($l[0]);
	$xc = addslashes($_POST['xc']);
	$tgl = date('Y-m-d');
?>
<div align="left">
<h4 class="margin-bottom-15">History Meja <?php echo $xc ?></h4>

<?php 
 //id_order, meja, tgl, jam_on, diupdate, selesai, total
$sql = mysqli_query($jazz,"SELECT * FROM _order WHERE LEFT(id_order,".$xv.")='$l[0]' AND meja='$xc' AND tgl='$tgl' ORDER BY id_order DESC LIMIT 0,10");
while ($row = mysqli_fetch_array($sql))
{	
	$idorder = $row[0];
	$wtk2 = strtotime($row[3]);
	$wtk = strtotime(date('H:i:s'));
	$jam_on = yang_lalu($wtk - $wtk2);
	$OnOff = 'On';
	$divaktif = 'class="list-group-item active" style="background:#009933;"';
	if($row[5] == 1){
		$jam_on = $row[3].' - '.$row[4];
		$OnOff = '';
		$divaktif = 'class="list-group-item"';
	}
	
?>
	<a href="javascript:;" <?php echo $divaktif ?> onclick="detail('<?php echo $row[0] ?>','');">
		<div class="row">
			<div class="col-md-6">
				<h4 class="list-group-item-heading">
				<?php echo $xc ?> &nbsp; &nbsp; &nbsp; <?php echo $idorder ?>  &nbsp; &nbsp; &nbsp; &nbsp;  <?php echo $OnOff ?>
				</h4>
			</div>
			<div class="col-md-6">
				<h4 class="list-group-item-heading"><?php echo $jam_on ?>   &nbsp; &nbsp; &nbsp; &nbsp; Rp. <?php echo number_format($row[6],0,',','.') ?></h4>
			</div>
		</div>
	</a>
<?php } ?>

<input type="hidden" value="2" id="halaman" />
</div>













<?php
}
elseif(isset($_POST['aksi']) && $_POST['aksi'] == 'pemesanan')
{
	$k = explode('|',$_SESSION['akses']); // $row['id'].'|'.$row['nama'].'|'.$row['jabatan'].'|'.$row['id_cab'].'_nama_cab|'.$row['user_name'];
	$l = explode('_',$k[3]);
	$xv = strlen($l[0]);
	$tgl = date('Y-m-d');
	$posisi = 0;
	$batas = 10;
	$selanjutnya = $posisi + $batas;
	
	mysqli_query(
			$jazz,
			"UPDATE 
				_notif  
			SET 
				diload='1'
			WHERE 
				cab='$l[0]'"
			);
?>

<h4 class="margin-bottom-15">Pemesanan</h4>
<div align="left">
<?php 
$n = 0 ;
$x = $n + 1 ;
 //id_order, meja, tgl, jam_on, diupdate, selesai, total   // id, id_order, id_menu, nama_menu, harga, qty, sub_total, itm_baru, jam
$sql = mysqli_query($jazz,"SELECT * FROM _order WHERE tgl='$tgl' AND LEFT(id_order,".$xv.")='$l[0]' AND diupdate > jam_on ORDER BY diupdate DESC LIMIT $posisi, $batas");
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
				<h4 class="list-group-item-heading"><?php echo $jam_on.' yang lalu' ?></h4>
			</div>
		</div>
	</a>
<?php } ?>
<p>&nbsp;</p>
<div align="center">
	<button type="button" class="btn btn-default" onclick="btnpemesanannext();"><i class="fa fa-long-arrow-down" style="color:#009900"></i> Lebih banyak ...</button>
</div>
<input type="hidden" value="3" id="halaman" />
<input type="hidden" value="<?php echo $x ?>" id="firstlist" />
<input type="hidden" value="<?php echo $n ?>" id="lastlist" />
</div>








<?php

}
elseif(isset($_POST['selanjutnya']) && $_POST['aksi'] == 'pemesanannestlist' && $_POST['selanjutnya']!= '')
{
	$k = explode('|',$_SESSION['akses']); // $row['id'].'|'.$row['nama'].'|'.$row['jabatan'].'|'.$row['id_cab'].'_nama_cab|'.$row['user_name'];
	$l = explode('_',$k[3]);
	$xv = strlen($l[0]);
	$tgl = date('Y-m-d');
	$posisi = 0;
	$batas = 10;
	$selanjutnya = $posisi + $batas;
	if(isset($_POST['selanjutnya'])){ $posisi = floor($_POST['selanjutnya']); }

$n = $posisi ;
$x = $posisi + 1 ;
 //id_order, meja, tgl, jam_on, diupdate, selesai, total   // id, id_order, id_menu, nama_menu, harga, qty, sub_total, itm_baru, jam
$sql = mysqli_query($jazz,"SELECT * FROM _order WHERE tgl='$tgl' AND LEFT(id_order,".$xv.")='$l[0]' AND diupdate > jam_on ORDER BY diupdate DESC LIMIT $posisi, $batas");
while ($row = mysqli_fetch_array($sql))
{	$n += 1;
	$wtk2 = strtotime($row[4]);
	$wtk = strtotime(date('H:i:s'));
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
				<h4 class="list-group-item-heading"><?php echo $jam_on.' yang lalu' ?></h4>
			</div>
		</div>
	</a>
<?php } 











}
elseif(isset($_POST['aksi']) && $_POST['aksi'] == 'detail')
{
	$k = explode('|',$_SESSION['akses']); // $row['id'].'|'.$row['nama'].'|'.$row['jabatan'].'|'.$row['id_cab'].'_nama_cab|'.$row['user_name'];
	$l = explode('_',$k[3]);
	$xv = strlen($l[0]);
	$tgl = date('Y-m-d');
	$d = $_POST['d'];
?>

<table class="table table-striped table-hover table-bordered">
  <thead>
	<tr>
	  <th width="20px">#</th>
	  <th>Item</th>
	  <th width="140px">Waktu</th>
	  <th width="100px">Tersaji</th>
	</tr>
  </thead>
  <tbody>
<?php 
$n = 0; //id, id_order, id_menu, nama_menu, harga, qty, sub_total, itm_baru, jam
$sql = mysqli_query($jazz,"SELECT * FROM _order_detail WHERE id_order='$d' ORDER BY itm_baru, qty DESC");
while ($row = mysqli_fetch_array($sql))
{	$n += 1;
	$wtk2 = strtotime($row[8]);
	$wtk = strtotime(date('H:i:s'));
	$jam_on = yang_lalu($wtk - $wtk2);
	$divaktif = '';
	if($row[7] == 1){
		$divaktif = 'class="success"';
		$btn = '<button type="button" class="btn btn-primary" onclick="tersaji('.$row[0].')"><i class="fa fa-send"></i> sajikan</button>';
	}else{
		$btn = '<i class="fa fa-thumbs-up"></i> OK';
	}
	?>
		<tr id="tr_warna<?php echo $row[0] ?>" <?php echo $divaktif ?>>
		  <td><?php echo $n ?></td>
		  <td><?php echo $row[3].' <span class="badge">'.$row[5].'</span>' ?></td>
		  <td><?php echo $jam_on.' yang lalu' ?></td>
		  <td id="td_ok<?php echo $row[0] ?>">

			<?php echo $btn ?>

		  </td>
		</tr>
	  
	<?php
} ?>

	</tbody>
</table>
	<input type="hidden" id="listit" />
<?php













}
elseif(isset($_POST['aksi']) && $_POST['aksi'] == 'tersaji')
{
	$id = $_POST['id'];
	
	$sql = mysqli_query($jazz,"SELECT id_order FROM _order_detail WHERE id='$id'"); // id, id_order, id_menu, nama_menu, harga, qty, sub_total, itm_baru, jam
	$row = mysqli_fetch_array($sql);
	$idorder = $row[0];
	
	mysqli_query(
			$jazz,
			"UPDATE 
				_order_detail  
			SET 
				itm_baru='0'
			WHERE 
				id='$id'"
			); //id, id_order, id_menu, nama_menu, harga, qty, sub_total, itm_baru, jam
	
	$sql = mysqli_query($jazz,"SELECT id FROM _order_detail WHERE id_order='$idorder' AND itm_baru='1'");
	$ada = mysqli_num_rows($sql);
	
	if($ada == 0){
		echo 'tidak-ada';
	}


}
else
{
	echo 'gagal';
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