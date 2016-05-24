<?php 

if(empty($_SESSION['akses'])){header('location: ../../');}

include('inc/include/head.php');

?>
  <div class="templatemo-content-wrapper">
	<div class="templatemo-content">
	  <ol class="breadcrumb"><li>Log Activity</li></ol>
	  <div class="margin-bottom-30">
		<div class="row">
		  <div class="col-md-12">
			<div class="table-responsive">
				
				<button type="button" id="btnTab1" class="btn btn-default" onclick="pilihTab(1)"><i class="fa fa-desktop"></i> Monitoring/Kasir</button> 
				<button type="button" id="btnTab2" class="btn btn-default" onclick="pilihTab(2)"><i class="fa fa-laptop"></i> Meja</button> 
				<button type="button" id="btnTab3" class="btn btn-default" onclick="pilihTab(3)"><i class="fa fa-desktop"></i> My Self</button>
				<br />
				<div align="right">
				<button type="button" id="btnHapusLog" class="btn btn-primary" data-toggle="modal" data-target="#HapusModal"><i class="fa fa-trash-o"></i> Hapus Log</button>
				</div>
				<br />
				<div id="loaded_contents_brought"></div>
				<input id="CurrentTab" type="hidden" value="1">
              </div>
        	  
		  </div>
		</div>
	  </div>
	</div>
  </div>
	  
	  <!-- Modal Hapus -->
      <div class="modal fade" id="HapusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:400px;top:170px">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabelHapus"></h4>
            </div>
            <div class="modal-footer">
              <button type="button" id="hapuslog" class="btn btn-primary" data-dismiss="modal">&nbsp; <i class="fa fa-trash-o"></i> Ya &nbsp;</button>
              <button type="button" class="btn btn-default" data-dismiss="modal" id="btnbatal"><i class="fa fa-ban" style="color:#FF0000"></i> Tidak</button>
            </div>
          </div>
        </div>
      </div>
	  
<script src="inc/js/jquery.min.js"></script>
<script src="inc/js/bootstrap.min.js"></script>
<script src="inc/js/templatemo_script.js"></script>
<script type="text/javascript">
	
	$(document).ready( function(){
		currenttab = $("#CurrentTab").val();
		$("#btnTab"+ currenttab).removeClass();
		$("#btnTab"+ currenttab).addClass("btn btn-success");
		var dataString = 'tab='+ currenttab +'&aksi=loadtable';
		$.ajax({
			type: "POST",
			url: "inc/include/aksi_log.php",
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
	function pilihTab(x){
		$("#btnTab1").removeClass();
		$("#btnTab1").addClass("btn btn-default");
		$("#btnTab2").removeClass();
		$("#btnTab2").addClass("btn btn-default");
		$("#btnTab3").removeClass();
		$("#btnTab3").addClass("btn btn-default");
		$("#CurrentTab").val(x);
		$("#btnTab"+ x).removeClass();
		$("#btnTab"+ x).addClass("btn btn-success");
		var dataString = 'tab='+ x +'&aksi=loadtable';
		$.ajax({
			type: "POST",
			url: "inc/include/aksi_log.php",
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
	

	$("#btnHapusLog").click(function(){
		$("#myModalLabelHapus").html('Yakin ingin menghapus log aktifitas ini ?');
	});
	
	
	$("#hapuslog").click(function(){
		tab = $("#CurrentTab").val();
		var dataString = 'tab='+ tab +'&aksi=hapus';
		$.ajax({
			type: "POST",
			url: "inc/include/aksi_log.php",
			data: dataString,
			cache: false,
			beforeSend: function()
			{
				$("#loaded_contents_brought").html('<br clear="all"><div align="center"><font style="font-family:Arial,Tahoma;font-size:16px;">Silakan Tunggu !</font> <img src="img/loadings.gif"/></div><br clear="all">');
			},
			success: function(response)
			{
				$("#loaded_contents_brought").hide().fadeIn(10).html(response);
			}
		});
	});
	
</script>