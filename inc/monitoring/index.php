<?php 

if(empty($_SESSION['akses'])){header('location: ../../');}

include('inc/monitoring/head.php');

?>
	
  <div class="templatemo-content-wrapper">
	<div class="templatemo-content">

	  <div class="row">
		<div class="col-md-12">
		  <div class="templatemo-alerts" align="center" id="loaded_contents_brought">
		  	<p>&nbsp;</p><p>&nbsp;</p>
			<img src="img/rm.png" border="0" id="btnpesan" />
			<input type="hidden" value="0" id="halaman" />
			<h1><?php echo $nama_cab.'  <br>===  '.$_SESSION['akses'] ?></h1>
		  </div>  
		            
		</div>
	  </div>   
	</div>
  </div>

  <div class="modal" id="respontersembunyi" aria-hidden="true">vcxvxvcxvxc
  </div>
  <!-- Modal Detail pesanan -->
  <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:800px">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		  <h4 class="modal-title" id="myModalLabelHapus">Detail Pemesanan</h4>
		  <div align="center">
		  	  <h4>Meja <span id="NomorMeja"></span></h4>
		  </div>
		  <div id="detailpemesanan">
		  </div>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-thumbs-up" style="color:#009900"></i> OK</button>
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


$("#btnmeja").click(function(){
	$("#halaman").val('1');
	$.ajax({
		type: "POST",
		url: "inc/monitoring/aksi_monitoring.php",
		data: 'aksi=meja',
		cache: false,
		beforeSend: function()
		{
			$("#loaded_contents_brought").html('<br clear="all"><div align="center"><font style="font-family:Arial,Tahoma;font-size:16px;"> Mengambil data </font> <img src="img/loadings.gif"/></div>');
		},
		success: function(response)
		{
			$("#loaded_contents_brought").hide().fadeIn(10).html(response);
			
		}
	});
});

$("#btnpemesanan").click(function(){
	$("#halaman").val('3');
	$("#notifpesanan").html('');
	$("#notifpesanan2").val('');
	$.ajax({
		type: "POST",
		url: "inc/monitoring/aksi_monitoring.php",
		data: 'aksi=pemesanan',
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
});

function btnpemesanannext(){
	//alert('om');
	lastlist = $("#lastlist").val();
	$.ajax({
		type: "POST",
		url: "inc/monitoring/aksi_monitoring.php",
		data: 'selanjutnya='+ lastlist +'&aksi=pemesanannestlist',
		cache: false,
		beforeSend: function()
		{
			$("#btnpemesanannext").html('<img src="img/loadings.gif"/>');
		},
		success: function(response)
		{
			$("#list"+lastlist).after(response);
			$("#btnpemesanannext").html('<i class="fa fa-long-arrow-down" style="color:#009900"></i> Lebih banyak ...');
			$("#lastlist").val(+lastlist+10);
		}
	});
}

function pilihmeja(xc){
	$("#halaman").val('2');
	$.ajax({
		type: "POST",
		url: "inc/monitoring/aksi_monitoring.php",
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
function detail(d,listit){
	$("#detailModal").modal("show");
	$.ajax({
		type: "POST",
		url: "inc/monitoring/aksi_monitoring.php",
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
			$("#listit").val(listit);
		}
	});
}

function tersaji(x){
	$.ajax({
		type: "POST",
		url: "inc/monitoring/aksi_monitoring.php",
		data: 'id='+x+'&aksi=tersaji',
		cache: false,
		beforeSend: function(){ },
		success: function(response)
		{	$("#tr_warna"+x).attr("class","");
			if(response=='tidak-ada'){
				listit = $("#listit").val();
				$("#"+listit).attr("class","list-group-item");
				$("#"+listit).attr("style","");
			}
			$("#td_ok"+x).html('<i class="fa fa-thumbs-up"></i> OK');
		}
	});
}
</script>