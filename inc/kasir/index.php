<?php 

if(empty($_SESSION['akses'])){header('location: ../../');}

include('inc/kasir/head.php');

?>
	
  <div class="templatemo-content-wrapper">
	<div class="templatemo-content">

	  <div class="row">
		<div class="col-md-12">
		  <div class="templatemo-alerts" align="center" id="loaded_contents_brought">
		  	<p>&nbsp;</p><p>&nbsp;</p>
			<img src="img/rm.png" border="0" id="btnpesan" />
			<input type="hidden" value="0" id="halaman" />
			
		  </div>  
		            
		</div>
	  </div>   
	</div>
  </div>

  <div class="modal" id="respontersembunyi" aria-hidden="true">
  </div>
  <!-- Modal Detail pesanan -->
  <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:700px">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		  <h4 class="modal-title" id="myModalLabel"></h4><input type="hidden" id="idorder" value="" />
		  <div align="center">
		  	  <h4>Meja <span id="NomorMeja"></span></h4>
		  </div>
		  <div id="detailpemesanan">
		  </div>
		</div>
		<div class="modal-footer" id="modal-footer2">
		  
		</div>
	  </div>
	</div>
  </div>

<script src="inc/js/jquery.min.js"></script>
<script src="inc/js/bootstrap.min.js"></script>
<script src="inc/js/templatemo_script.jss"></script>
<script type="text/javascript">
$(document).ready( function(){

	var ajax_call = function() {
		hal = $("#halaman").val();
		$.ajax({
			type: "POST",
			url: "inc/include/aksi_onoff.php",
			data: 'idcab=<?php echo $id_cab ?>&hal='+hal+'&aksi=loadfrommonitoring',
			cache: false,
			beforeSend: function()
			{
			},
			success: function(response)
			{	totalmeja = $("#totalmeja").val();
				for(i=1; i<=totalmeja; i++){
					x = $("#meja"+i).attr("dataid");
					if(response.indexOf(x)>-1){
						$("#meja"+i).attr("style","color:#009900");
					}else{
						$("#meja"+i).attr("style","color:#CCC");
					}
					x = $("#on"+i).attr("dataid");
					if(response.indexOf(x)>-1){
						$("#on"+i).attr("style","float:right;color:#009900");
					}else{
						$("#on"+i).attr("style","float:right;color:#CCC");
					}
					if(hal==1){
						x = $("#oon"+i).attr("dataid");
						if(response.indexOf(x)>-1){
							$("#oon"+i).attr("style","color:#009900");
						}else{
							$("#oon"+i).attr("style","color:#CCC");
						}
						$("#respontersembunyi").html(response);
						$("#labelorder"+i).html( $("#labelorderserver"+i).attr("mydata") );
						$("#yglalu"+i).html( $("#yglaluserver"+i).attr("mydata") );
					}
					if(response.indexOf('PESANBARU')>-1){
						k = response.split("||");
						l = k[1].split("_");
						$("#notifpesanan").html(l[1]);
						h = $("#notifpesanan").html();
						hh = $("#notifpesanan2").val();
						if(h != hh ){
							$('#chatAudio')[0].play();
						}
						$("#notifpesanan2").val(l[1]);
					}else{ $("#notifpesanan").html(''); }
					
					//alert(response);
				}
				
			}
		});
		
		
	};
	
	var interval = 4000; // where X is your every X scon
	setInterval(ajax_call, interval);
});




	function saveorder(){
		kembali = $("#kembali2").val();
		if(kembali == "" || parseInt(kembali) < 0)
		{
			alert('Inputan Tidak benar');
		}
		else
		{   
			idorder = $("#idorder").val();
			bayar = $("#bayar").val();
			
			$.ajax({
				type: "POST",
				url: "inc/kasir/aksi_kasir.php",
				data: 'id='+ idorder + '&b='+ bayar + '&k='+ kembali + '&aksi=simpan',
				cache: false,
				beforeSend: function()
				{
					$("#modal-footer2").html('<button type="button" id="saveorder" class="btn btn-default"><img src="img/spinner.gif" /> Simpan </button><button type="button" class="btn btn-default"><i class="fa fa-times"></i> Batal</button>');
					
				},
				success: function(response)
				{
					$("#modal-footer2").html('<button type="button" class="btn btn-default" data-dismiss="modal">&nbsp; Tutup &nbsp;</button>');
					detail(idorder);
					alert('Berhasil');
				}
			});
		}
	}
	
	
	
function pilihmeja(xc){
	$("#halaman").val('2');
	$.ajax({
		type: "POST",
		url: "inc/kasir/aksi_kasir.php",
		data: 'xc='+xc+'&aksi=pilihmeja',
		cache: false,
		beforeSend: function()
		{
			$("#loaded_contents_brought").html('<br clear="all"><div align="center"><font style="font-family:Arial,Tahoma;font-size:16px;">Mengambil data </font> <img src="img/loadings.gif"/></div>');
		},
		success: function(response)
		{
			$("#loaded_contents_brought").hide().fadeIn(10).html(response);
		}
	});
}
function detail(d){
	$("#detailModal").modal("show");
	$("#myModalLabel").html("Detail Pemesanan : " + d);
	$("#idorder").val(d);
	$.ajax({
		type: "POST",
		url: "inc/kasir/aksi_kasir.php",
		data: 'd='+d+'&aksi=detail',
		cache: false,
		beforeSend: function()
		{
			$("#detailpemesanan").html('<br clear="all"><div align="center"><font style="font-family:Arial,Tahoma;font-size:16px;">Mengambil data </font> <img src="img/loadings.gif"/></div>');
			k = d.split('.');
			$("#NomorMeja").html(k[1]);
		},
		success: function(response)
		{
			$("#detailpemesanan").hide().fadeIn(10).html(response);
			$("#modal-footer2").html('<button type="button" id="saveorder" onclick="saveorder();" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Simpan </button><button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>');
		}
	});
}
function isNumberKey(evt){
	var charCode = (evt.which) ? evt.which : event.keyCode;
	if( charCode > 31 && ( charCode < 48 || charCode > 57 ))
	return false;
	return true;
}

function hitung(){
	bayar = parseInt($("#bayar").val());
	if( bayar > 31 && ( bayar < 48 || bayar > 57 )){
		total = parseInt($("#total").val());
		kembali = bayar - total; 
		$("#kembali2").val(kembali);
		$("#kembali").html(numberformat(kembali));
	}
}
function numberformat(x){
	return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g,".");
}

</script>