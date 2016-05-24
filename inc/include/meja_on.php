<?php 

if(empty($_SESSION['akses'])){header('location: ../../');}

include('inc/include/head.php');

function isiOptionSelect($jazz)
{	$n=0;
	$noma=0;
	$sql = mysqli_query($jazz,"SELECT id_cab, namacab FROM _cabang");
	while ($cab = mysqli_fetch_array($sql))
	{	$n+=1;
		echo '<button type="button" id="btncab'.$cab[0].'" class="btn btn-default" name="btncab[]" onclick="pilihcab('.$cab[0].')">
			  <i class="fa fa-share-alt"></i> 
			   Cab. '.$cab[1].'
			  </button> ';
		if($noma==0){ $noma=$cab[0]; }
	}
	
	if($n==0){
		echo '<input id="cabcurrent" type="hidden" value="1">';
	}elseif($n!=0){
		echo '<input id="cabcurrent" type="hidden" value="'.$noma.'">';
	}
}

?>
  <div class="templatemo-content-wrapper">
	<div class="templatemo-content">
	  <ol class="breadcrumb"><li>Akun Stasiun Meja</li></ol>
	  <div class="margin-bottom-30">
		<div class="row">
		  <div class="col-md-12">
			<div class="table-responsive">
				<?php echo isiOptionSelect($jazz) ?>
				<br />
				<br />
				
				<div id="loaded_contents_brought"></div>
				
              </div>
        	  
		  </div>
		</div>
	  </div>
	</div>
  </div>

  <!-- Modal Detail pesanan -->
  <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:800px">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		  <h4 class="modal-title" id="myModalLabel">Detail Pemesanan</h4>
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
<script src="inc/js/templatemo_script.js"></script>
<script type="text/javascript">
	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if( charCode > 31 && ( charCode < 48 || charCode > 57 ))
		return false;
		return true;
	}
	
	$(document).ready( function(){
		cab = $("#cabcurrent").val();
		$("#btncab"+ cab).removeClass();
		$("#btncab"+ cab).addClass("btn btn-success");
		var dataString = 'cab='+ cab +'&aksi=loadtable';
		$.ajax({
			type: "POST",
			url: "inc/include/aksi_meja_on.php",
			data: dataString,
			cache: false,
			beforeSend: function()
			{
				$("#loaded_contents_brought").html('<br clear="all"><div align="center"><font style="font-family:Arial,Tahoma;font-size:16px;">Mengambil Data</font> <img src="img/loadings.gif"/></div><br clear="all">');
			},
			success: function(response)
			{
				$("#loaded_contents_brought").hide().fadeIn(100).html(response);
			}
		});
	});
	
	function pilihcab(cab){
		$("#cabcurrent").val(cab);
		
			$('button[name="btncab[]"]').removeClass();
			$('button[name="btncab[]"]').addClass("btn btn-default");
		
		$("#btncab"+ cab).removeClass();
		$("#btncab"+ cab).addClass("btn btn-success");
		var dataString = 'cab='+ cab +'&aksi=loadtable';
		$.ajax({
			type: "POST",
			url: "inc/include/aksi_meja_on.php",
			data: dataString,
			cache: false,
			beforeSend: function()
			{
				$("#loaded_contents_brought").html('<br clear="all"><div align="center"><font style="font-family:Arial,Tahoma;font-size:16px;">Silakan Tunggu !</font> <img src="img/loadings.gif"/></div><br clear="all">');
			},
			success: function(response)
			{
				$("#loaded_contents_brought").hide().fadeIn(100).html(response);
			}
		});
	}
	
	
	
function btnpemesanannext(){
	
	cab = $("#cabcurrent").val();
	lastlist = $("#lastlist").val();
	$.ajax({
		type: "POST",
		url: "inc/include/aksi_meja_on.php",
		data: 'cab='+cab+'&selanjutnya='+ lastlist +'&aksi=pemesanannestlist',
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


function detail(d){
	$("#detailModal").modal("show");
	$("#myModalLabel").html("Detail Pemesanan "+ d);
	$.ajax({
		type: "POST",
		url: "inc/include/aksi_meja_on.php",
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
		}
	});
}
	
</script>