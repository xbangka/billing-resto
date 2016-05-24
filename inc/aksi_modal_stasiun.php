<?php
include('db.php');

if(isset($_POST['aksi']) && $_POST['aksi'] == 'out'){
	?>
<div id="popup">
	<div class="popup-container" style="width:178px">
		<div align="left">
			Kode Keluar 
			<a class="popup-close" id="popup-close" href="javascript:;">X</a>
		</div>
		<hr />
		<a class="buttonout" href="javascript:;" id="btn1">1</a>
		<a class="buttonout" href="javascript:;" id="btn2">2</a>
		<a class="buttonout" href="javascript:;" id="btn3">3</a><br  /><br  />
		<a class="buttonout" href="javascript:;" id="btn4">4</a>
		<a class="buttonout" href="javascript:;" id="btn5">5</a>
		<a class="buttonout" href="javascript:;" id="btn6">6</a><br /><br  />
		<a class="buttonout" href="javascript:;" id="btn7">7</a>
		<a class="buttonout" href="javascript:;" id="btn8">8</a>
		<a class="buttonout" href="javascript:;" id="btn9">9</a><br /><br  />
		<a class="buttonout" href="javascript:;" id="btn0" style="padding:7px 80px 7px 80px;">0</a><br  />
		<hr />
		<a class="buttonbatal" href="javascript:;">Batal</a>
		<a class="buttonOK" href="javascript:;" onclick="addkls();">Simpan</a>
	<p>&nbsp;</p>
	</div>
</div>
	<?php
}elseif(isset($_POST['aksi']) && $_POST['aksi'] == '2'){
	$a = date('Y-m-d H:i:s');
	$b = strtotime($a) + 6;
	$tgl = date('Y-m-d H:i:s',$b);
	$k = explode('|',$_SESSION['akses']);  // $id_meja.'|'.$m.'|Meja|'.$c;
	if(isset($_POST['costomer']) && $_POST['costomer'] == 'ada'){
		mysqli_query($jazz,"UPDATE _meja SET ontime='$tgl', visitor_time='$tgl' WHERE id='$k[0]'"); // id, id_cab, meja, pass, blok, ontime, jml_kursi, passout, visitor_time
		$_SESSION['IDorder'] = md101($_COOKIE['IDorder']);
	}else{
		mysqli_query($jazz,"UPDATE _meja SET ontime='$tgl' WHERE id='$k[0]'");
	}
	$_SESSION['akses'] = md101($_COOKIE['akses']);
	
}elseif(isset($_POST['aksi']) && $_POST['aksi'] == 'pesanbaru'){
	$k = explode('|',$_SESSION['akses']);  // $id_meja.'|'.$m.'|Meja|'.$c;
	$wkt = date('H:i:s');
	$jmlpilih = $_POST['jmlpilih'];
	$datastring = '';
	$arr  = array();
	$sql = mysqli_query($jazz,"SELECT id_menu, nama, harga FROM _menu"); // id_menu, jenis, nama, harga, gambar, urutan, id_cab
	while ($row = mysqli_fetch_array($sql))
	{
		$arr[$row[0]] = $row[1];
		$arr['"h'.$row[0].'"'] = $row[2];
	}
	
	$total = 0 ;
	
	for($i=1; $i<=$jmlpilih; $i++){
		$namamenu = $arr[$_POST['u'.$i]];
		$harga = $arr['"h'.$_POST['u'.$i].'"'];
		$subtotal = $harga * $_POST['jml'.$i];
		$datastring = $datastring."('', '".$_SESSION['IDorder']."', '".$_POST['u'.$i]."', '".$namamenu."', '".$harga."', '".$_POST['jml'.$i]."', '".$subtotal."', '1','".$wkt."'),";
		$total = $total + $subtotal;
	}
	$x = strlen($datastring);
	$datastring = substr($datastring,0,$x-1);
	mysqli_query(
		$jazz,
		"INSERT INTO 
			_order_detail 
		VALUES"
			.$datastring
		); // id, id_order, id_menu, nama_menu, harga, qty, sub_total, itm_baru
	$wkt = date('H:i:s');
	mysqli_query(
			$jazz,
			"UPDATE 
				_order  
			SET 
				diupdate='".$wkt."', 
				total='".$total."'
			WHERE 
				id_order='$_SESSION[IDorder]'"
			); // id_order, meja, tgl, jam_on, diupdate, selesai, total
	
		mysqli_query(
			$jazz,
			"INSERT INTO 
				_notif 
			VALUES 
				('',
				'$k[3]',
				'$k[1]',
				'0')
			");
	
	loadtable($jazz,$_SESSION['IDorder']);
	$_SESSION['akses'] = md101($_COOKIE['akses']);
	$_SESSION['IDorder'] = md101($_COOKIE['IDorder']);
	
}else{
	echo 'gagal';
}	


function loadtable($jazz,$idorder){

?>


	<table width="95%" border="0" style="font-family:Arial, Helvetica, sans-serif">
	  <?php 
	  	$p=0;
		${'k'.$p}='';
		$qty=0;
		$subtotal=0;
		$total=0;
		
		$sql = mysqli_query($jazz,"SELECT id_menu, nama_menu, qty, sub_total FROM _order_detail WHERE id_order='$idorder' ORDER BY nama_menu ASC"); 
		$jmlitem = mysqli_num_rows($sql);
		for($i=1;$i<=$jmlitem;$i++){
			$row = mysqli_fetch_array($sql);
			if(${'k'.$p} != $row['id_menu']){
				$p+=1;
				${'k'.$p} = $row['id_menu'];
				${'nama'.$p} = $row['nama_menu'];
				${'qty'.$p} = $row['qty'];
				${'subtotal'.$p} = $row['sub_total'];
			}else{
				${'qty'.$p} = ${'qty'.$p} + $row['qty'];
				${'subtotal'.$p} = ${'subtotal'.$p} + $row['sub_total'];
			}
		}
		for($i=1;$i<=$p;$i++){
			$nama=${'nama'.$i};
			$qty=${'qty'.$i};
			$subtotal=${'subtotal'.$i};
			$total=$total + $subtotal;
	  
	  ?>
	  <tr>
		<td><?php echo $i.'. '.$nama.' ('.$qty.')' ?></td>
		<td >Rp.</td>
		<td align="right" width="50px"><?php echo number_format($subtotal,0,',','.') ?></td>
	  </tr>
	  <?php } ?>
	</table>
	<input id="totalygdipesan" type="hidden" value="<?php echo number_format($total,0,',','.') ?>">

<?php 
}
?>

