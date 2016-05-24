<?php 
if(empty($_SESSION['akses'])){header('location: '.$host.'stasiun.asp');}
	$k = explode('|',$_SESSION['akses']);  // $id_meja.'|'.$m.'|Meja|'.$c.'|'.$passout.'|namacabang';
	$nomor_meja = $k[1];
	$idcab = $k[3];
	$nama_cabang = $k[5];
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/style.css" rel="stylesheet" type="text/css">
<title><?php echo $nama_cabang ?></title>
</head>

<body>

<div id="body">
<div id="header">
  <table width="100%" border="0">
  <tr>
    <td>
		<img src="img/rm.png" border="0"  id="btnxx" />
	</td>
	<td width="150px" class="line_separator">
		<?php echo $_SESSION['IDorder'] ?>
	</td>
    <td width="150px" class="line_separator">
		MEJA <?php echo $nomor_meja ?> 
	</td>
	<td width="50px" class="line_separator">
		<a href="javascript:;" id="konfirmasi">
			&nbsp; &#9660; &nbsp;
		</a>
	</td>
  </tr>
</table>

</div>

<div id="samping">
	
	<div id="kotak_kotak" style="height:140px;">                                      
		<div id="kotak_kategori">
			<ul>
				<li id="cat_1" class="pilih" onclick="cate('catMakanan',1);">
					
						<img src="img/categorimakanan.png"/>
						<div>
							Foods
						</div>
						
				</li>
			</ul>
		</div>
		<div id="kotak_kategori">
			<ul>
				<li id="cat_2" onclick="cate('catMinuman',2);">
					
						<img src="img/categoriminuman.png"/>
						<div>
							Drinks
						</div>
					
				</li>
			</ul>
		</div>
		<div id="kotak_kategori">
			<ul>
				<li id="cat_3" onclick="cate('catJajanan',3);">
						
						<img src="img/categorisnacks.png"/>
						<div>
							Cake&amp;Snack
						</div>
					
				</li>
			</ul>
		</div>
	</div>
	
	<div id="kotak_kotak">                                      
    	<div class="kotak_judul">
        	<span>YANG ANDA PESAN</span>
		</div>
		
		<div align="center" id="loaded_contents_brought"><input id="totalygdipesan" type="hidden" value="0"></div>

		<div class="kotak_total">
        	<div style="float:right" id="totalygdipesan2">Rp. &nbsp; &nbsp; 0</div>
			<span>
				Total
			</span>
		</div>
	</div>
</div>


<form method="post" action="order-konfirm.php">
<div id="catMakanan" class="konten">
	<div id="gallery">
    	<ul>
		<?php 
			$n = 0;
			$sql = mysqli_query($jazz,"SELECT * FROM _menu WHERE jenis='1' ORDER BY urutan ASC"); // id_menu, jenis, nama, harga, gambar, urutan, id_cab
			while ($row = mysqli_fetch_array($sql))
			{ 	
				$pos = strpos($row[6],$idcab[0].'_');
				if($pos!==false){
					$n +=1;
		?>
		
        	<li id="item_<?php echo $n ?>" title="<?php echo $row['nama'] ?>" value="<?php echo $row['harga'] ?>" id_data="<?php echo $row['id_menu'] ?>">
            	<div class="beforecontainer2" id="titikordinaat<?php echo $n ?>">
					<div align="left">
						Pilih Banyaknya ?
						<a class="popup-close" onclick="popupclose(<?php echo $n ?>);" href="javascript:;">X</a>
					</div>
					<hr />
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'1');">1</a>
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'2');">2</a>
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'3');">3</a><br  /><br  />
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'4');">4</a>
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'5');">5</a>
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'6');">6</a><br  /><br  />
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'7');">7</a>
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'8');">8</a>
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'9');">9</a><br  /><br  />
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'');" style="padding:7px 12px 7px 13px;background-color:#FF9999;">Kosongkan</a>
					<hr />
				</div>
				
				<span><?php echo $row['nama'] ?></span><br />
				<img src="img/foods/<?php echo $row['gambar'] ?>" onclick="pilihmenu(<?php echo $n ?>);"  />
				
				<span>Rp. <?php echo number_format($row['harga'],0,',','.') ?> <span id="dikali<?php echo $n ?>"></span></span>
				<span style="float:right; margin-right:10px">
				<input id="jumlah_<?php echo $n ?>" type="hidden" onchange="pilih(<?php echo $n ?>);">
        		<!--<select id="jumlah_<?php echo $n ?>" style="width:100px" onchange="pilih(<?php echo $n ?>);">
        			<option value=""></option>
        			<?php
        				for($xx=1; $xx<=10; $xx++){
        					echo('<option value="'.$xx.'">'.$xx.'</option>');
        				}
      				?>
    			</select>-->
				</span>
            </li>
		<?php } } ?>
		</ul>
	</div>
</div>

<div id="catMinuman" class="konten">
	<div id="gallery">
    	<ul>
        <?php 
			$sql = mysqli_query($jazz,"SELECT * FROM _menu WHERE jenis='2' ORDER BY urutan ASC"); // id_menu, jenis, nama, harga, gambar, urutan, id_cab
			while ($row = mysqli_fetch_array($sql))
			{ 	
				$pos = strpos($row[6],$idcab[0].'_');
				if($pos!==false){
					$n +=1;
		?>
		
        	<li id="item_<?php echo $n ?>" title="<?php echo htmlspecialchars($row['nama']) ?>" value="<?php echo $row['harga'] ?>" id_data="<?php echo $row['id_menu'] ?>">
            	<div class="beforecontainer2" id="titikordinaat<?php echo $n ?>">
					<div align="left">
						Pilih Banyaknya ?
						<a class="popup-close" onclick="popupclose(<?php echo $n ?>);" href="javascript:;">X</a>
					</div>
					<hr />
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'1');">1</a>
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'2');">2</a>
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'3');">3</a><br  /><br  />
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'4');">4</a>
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'5');">5</a>
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'6');">6</a><br  /><br  />
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'7');">7</a>
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'8');">8</a>
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'9');">9</a><br  /><br  />
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'');" style="padding:7px 12px 7px 13px;background-color:#FF9999;">Kosongkan</a>
					<hr />
				</div>
				<span><?php echo htmlspecialchars($row['nama']) ?></span><br />
				<img src="img/foods/<?php echo $row['gambar'] ?>" onclick="pilihmenu(<?php echo $n ?>);" />
				<span>Rp. <?php echo number_format($row['harga'],0,',','.') ?> <span id="dikali<?php echo $n ?>"></span></span>
				<span style="float:right; margin-right:10px">
				<input id="jumlah_<?php echo $n ?>" type="hidden" onchange="pilih(<?php echo $n ?>);">
        		<!--<select id="jumlah_<?php echo $n ?>" style="width:100px" onchange="pilih(<?php echo $n ?>);">
        			<option value=""></option>
        			<?php
        				for($xx=1; $xx<=10; $xx++){
        					echo('<option value="'.$xx.'">'.$xx.'</option>');
        				}
      				?>
    			</select>-->
				</span>
            </li>
		<?php } } ?>
		</ul>
	</div>
</div>

<div id="catJajanan" class="konten">
	<div id="gallery">
    	<ul>
        <?php 
			$sql = mysqli_query($jazz,"SELECT * FROM _menu WHERE jenis='3' ORDER BY urutan ASC"); // id_menu, jenis, nama, harga, gambar, urutan, id_cab
			while ($row = mysqli_fetch_array($sql))
			{ 	
				$pos = strpos($row[6],$idcab[0].'_');
				if($pos!==false){
					$n +=1;
		?>
		
        	<li id="item_<?php echo $n ?>" title="<?php echo htmlspecialchars($row['nama']) ?>" value="<?php echo $row['harga'] ?>" id_data="<?php echo $row['id_menu'] ?>">
            	<div class="beforecontainer2" id="titikordinaat<?php echo $n ?>">
					<div align="left">
						Pilih Banyaknya ?
						<a class="popup-close" onclick="popupclose(<?php echo $n ?>);" href="javascript:;">X</a>
					</div>
					<hr />
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'1');">1</a>
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'2');">2</a>
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'3');">3</a><br  /><br  />
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'4');">4</a>
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'5');">5</a>
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'6');">6</a><br  /><br  />
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'7');">7</a>
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'8');">8</a>
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'9');">9</a><br  /><br  />
					<a class="buttonout" href="javascript:;" onclick="angka(<?php echo $n ?>,'');" style="padding:7px 12px 7px 13px;background-color:#FF9999;">Kosongkan</a>
					<hr />
				</div>
				<span><?php echo htmlspecialchars($row['nama']) ?></span><br />
				<img src="img/foods/<?php echo $row['gambar'] ?>" onclick="pilihmenu(<?php echo $n ?>);" />
				<span>Rp. <?php echo number_format($row['harga'],0,',','.') ?> <span id="dikali<?php echo $n ?>"></span></span>
				<span style="float:right; margin-right:10px">
				<input id="jumlah_<?php echo $n ?>" type="hidden" onchange="pilih(<?php echo $n ?>);">
        		<!--<select id="jumlah_<?php echo $n ?>" style="width:100px" onchange="pilih(<?php echo $n ?>);">
        			<option value=""></option>
        			<?php
        				for($xx=1; $xx<=10; $xx++){
        					echo('<option value="'.$xx.'">'.$xx.'</option>');
        				}
      				?>
    			</select>-->
				</span>
            </li>
		<?php } } ?>
		</ul>
	</div>
</div>
<input id="jmlmenu" type="hidden" value="<?php echo $n ?>">

<div id="catlist" class="konten">
	<div class="konfirmasi" align="center">
		<h2>Konfirmasi Pemesanan</h2>

		<table class="CSSTableGenerator" >
		  <tr class="tr">
			<td width="5px" class="td">#</td>
			<td class="td">Item</td>
			<td width="5px" class="td">n</td>
			<td width="100px" class="td">Harga</td>
			<td width="90px" class="td">Opsi</td>
		  </tr>
		  <tr class="tr">
			<td colspan="5" class="tdd">
				
				<!-- Khusus Item Konfirmasi -->
				<table width="100%" id="myTable"></table>
				<!-- Khusus Item Konfirmasi -->
				
			</td>
		  </tr>
		  <tr align="right" class="tr">
			<td colspan="5" class="td-terakhir"><div id="total">Total &nbsp; &nbsp; Rp. 0</div></td>
			<input id="jmlpilih" type="hidden">
		  </tr>
		</table>

		<div class="frmtombol">
			<div class="txtKonfirm">Apakah yakin dengan daftar menu diatas ?</div>
			<a href="javascript:;" class="tombolpesan" id="btnpesan">Ya</a>
			<a href="javascript:;" class="tombolbatal" id="btnbatal" onclick="batal();">Batal</a>
		</div>
		<p>&nbsp;</p>
	</div>
</div>



</form>


<div id="frmBtn" class="frmBtng">
	Jika selesai klik disini<p></p>
	<a href="javascript:;" class="tombolpesan" id="cat_4" onclick="cate('catlist',4);">Selesai</a>
</div>


<div id="popup_1" class="beforepopup">
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
		<a class="buttonOK" href="javascript:;" id="idout">&nbsp;OK&nbsp;</a>
		<input id="myhit" type="hidden" >
		<input id="myhit2" type="hidden" value="<?php echo $k[4] ?>">
	<p>&nbsp;</p>
	</div>
</div>
	  
<script type="text/javascript" src="js/jquery_1.5.2.js"></script>
<script type="text/javascript" src="js/action.js"></script>
<script type="text/javascript">
$(document).ready( function(){
	$("#frmBtn").attr("class","frmBtn");
	$("#popup_1").hide();
	$("#popup_1").attr("class","popup");
	$("#popup_2").hide();
	$("#popup_2").attr("class","popup");
	x = $("#jmlmenu").val();
	for (i = 1; i <= x; i++) {
		$("#titikordinaat"+i).hide();
		$("#titikordinaat"+i).attr("class","popup-container2");
	}
});


$("#konfirmasi").click(function(){
	$("#popup_1").show();
	myhit = "";
	$("#myhit").val("");
});

$("#popup-close").click(function(){
	$("#popup_1").hide();
	myhit = "";
	$("#myhit").val("");
});

$(".buttonbatal").click(function(){
	$("#popup_1").hide();
	myhit = "";
	$("#myhit").val("");
});

myhit = "";

$("#frmBtn").click(function(){
	myhit = "";
	$("#myhit").val(myhit);
});


$("#btn1").click(function(){
	myhit = myhit+'1'
	$("#myhit").val(myhit);
});
$("#btn2").click(function(){
	myhit = myhit+'2'
	$("#myhit").val(myhit);
});
$("#btn3").click(function(){
	myhit = myhit+'3'
	$("#myhit").val(myhit);
});
$("#btn4").click(function(){
	myhit = myhit+'4'
	$("#myhit").val(myhit);
});
$("#btn5").click(function(){
	myhit = myhit+'5'
	$("#myhit").val(myhit);
});
$("#btn6").click(function(){
	myhit = myhit+'6'
	$("#myhit").val(myhit);
});
$("#btn7").click(function(){
	myhit = myhit+'7'
	$("#myhit").val(myhit);
});
$("#btn8").click(function(){
	myhit = myhit+'8'
	$("#myhit").val(myhit);
});
$("#btn9").click(function(){
	myhit = myhit+'9'
	$("#myhit").val(myhit);
});
$("#btn0").click(function(){
	myhit = myhit+'0'
	$("#myhit").val(myhit);
});
$("#idout").click(function(){
	pass=$("#myhit").val();
	pass2=$("#myhit2").val();
	if(pass==pass2){
		window.location="inc/hapus_sesi_order.php";
	}
	$("#popup_1").hide();
	myhit = "";
	$("#myhit").val("");
});

function pilihmenu(x){
	zx = $("#jmlmenu").val();
	for (i = 1; i <= zx; i++) {
		$("#titikordinaat"+i).hide();
	}
	$("#jmlnya").val(x);
	$("#titikordinaat"+x).show();
}
function popupclose(x){
	$("#titikordinaat"+x).hide();
}

$(window).scroll(function(){
	x = $("#jmlmenu").val();
	for (i = 1; i <= x; i++) {
		$("#titikordinaat"+i).hide();
	}
});


function angka(x,c){
	$("#jumlah_"+x).val(c);
	$("#dikali"+x).html('x '+c);
	if(c==''){ $("#dikali"+x).html(''); }
	pilih(x);
	$("#titikordinaat"+x).hide();
}

</script>
</body>
</html>