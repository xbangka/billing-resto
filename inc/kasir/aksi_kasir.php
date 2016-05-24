<?php
include('../../inc/db.php');

$_SESSION['akses'] = md101($_COOKIE['akses']);


if(isset($_POST['aksi']) && $_POST['aksi'] == 'pilihmeja')
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
	<a href="javascript:;" <?php echo $divaktif ?> onclick="detail('<?php echo $row[0] ?>');">
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
	  <th width="140px">Harga</th>
	</tr>
  </thead>
  <tbody>
<?php 
$faktur = date('Ymd').'.'.$d;
$sqlqw = mysqli_query($jazz,"SELECT * FROM _penjualan WHERE nofaktur='$faktur'");
$ada = mysqli_num_rows($sqlqw);
if($ada==0){
	
	$total = 0;
	$n = 0; //id, id_order, id_menu, nama_menu, harga, qty, sub_total, itm_baru, jam
	$sql = mysqli_query($jazz,"SELECT * FROM _order_detail WHERE id_order='$d' ORDER BY itm_baru, qty DESC");
	while ($row = mysqli_fetch_array($sql))
	{	$n += 1;
		$total = $total + $row[6];
		?>
			<tr>
			  <td><?php echo $n ?></td>
			  <td><?php echo $row[3].' <span class="badge">'.$row[5].'</span>' ?></td>
			  <td><span style="float:left">Rp. </span><span style="float:right"><?php echo number_format($row[6],0,',','.') ?></span></td>
			</tr>
		  
		<?php
	} ?>
			<tr>
			  <td colspan="2" align="right">Total</td>
			  <td style="background:#66FF99"><span style="float:left">Rp. </span><span style="float:right"><?php echo number_format($total,0,',','.') ?></span></td>
			</tr>
			<tr>
			  <td colspan="2" align="right">Dibayar</td>
			  <td style="padding:0px 0px 0px 0px"><input type="text" id="bayar" style="font-size:20px;text-align:right;font-weight:bold;width:140px" onkeypress="return isNumberKey(event)" onkeyup="hitung()" /></td>
			</tr>
			<tr>
			  <td colspan="2" align="right">Kembali</td>
			  <td><span style="float:left">Rp. </span><span style="float:right" id="kembali">0</span></td>
			</tr>
		</tbody>
	</table>
		<input type="hidden" id="total" value="<?php echo $total ?>" />
		<input type="hidden" id="kembali2" value="" />
	<?php
	
	
}else{

	
	$n = 0; //id, nofaktur, id_menu, namamenu, harga, jumlah, subtotal
	$sql = mysqli_query($jazz,"SELECT * FROM _penjualan_detail WHERE nofaktur='$faktur' ORDER BY id ASC");
	while ($row = mysqli_fetch_array($sql))
	{	$n += 1;
		?>
			<tr>
			  <td><?php echo $n ?></td>
			  <td><?php echo $row[3].' <span class="badge">'.$row[5].'</span>' ?></td>
			  <td><span style="float:left">Rp. </span><span style="float:right"><?php echo number_format($row[6],0,',','.') ?></span></td>
			</tr>
		  
		<?php
	}
	$row = mysqli_fetch_array($sqlqw)
	  ?>
			<tr>
			  <td colspan="2" align="right">Total</td>
			  <td style="background:#66FF99"><span style="float:left">Rp. </span><span style="float:right"><?php echo number_format($row[4],0,',','.') ?></span></td>
			</tr>
			<tr>
			  <td colspan="2" align="right">Dibayar</td>
			  <td style="background:#66FF99"><span style="float:left">Rp. </span><span style="float:right"><?php echo number_format($row[5],0,',','.') ?></span></td>
			</tr>
			<tr>
			  <td colspan="2" align="right">Kembali</td>
			  <td style="background:#66FF99"><span style="float:left">Rp. </span><span style="float:right"><?php echo number_format($row[6],0,',','.') ?></span></td>
			</tr>
		</tbody>
	</table>
	<?php
}








}
elseif(isset($_POST['aksi']) && $_POST['aksi'] == 'simpan')
{
	$k = explode('|',$_SESSION['akses']); // $row['id'].'|'.$row['nama'].'|'.$row['jabatan'].'|'.$row['id_cab'].'_nama_cab|'.$row['user_name'];
	$l = explode('_',$k[3]);
	$xv = strlen($l[0]);
	$tgl = date('Y-m-d H:i:s');
	$tgl2 = date('Ymd');
	$id = $_POST['id'];
	$bayar = $_POST['b'];
	$kembali = $_POST['k'];
	
	$sql = mysqli_query($jazz,"SELECT * FROM _order WHERE id_order='$id'"); // id_order, meja, tgl, jam_on, diupdate, selesai, total
	$row = mysqli_fetch_array($sql);
	
	mysqli_query(
		$jazz,
		"INSERT INTO 
			_penjualan 
		VALUES(
			'', 
			'".$tgl2.".".$row['id_order']."', 
			'".$row['id_order']."',
			'".$tgl."',
			'".$row['total']."',
			'".$bayar."',
			'".$kembali."'
			)"
		); //id_penjualan, nofaktur, no_jual, tanggal, total, byar, kembali
	
	$sql = mysqli_query($jazz,"SELECT * FROM _order_detail WHERE id_order='$id'"); // id, id_order, id_menu, nama_menu, harga, qty, sub_total, itm_baru, jam
	while ($row = mysqli_fetch_array($sql))
	{	mysqli_query(
		$jazz,
		"INSERT INTO 
			_penjualan_detail 
		VALUES(
			'', 
			'".$tgl2.".".$row['id_order']."', 
			'".$row['id_menu']."',
			'".$row['nama_menu']."',
			'".$row['harga']."',
			'".$row['qty']."',
			'".$row['sub_total']."'
			)"
		); //id, nofaktur, id_menu, namamenu, harga, jumlah, subtotal
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