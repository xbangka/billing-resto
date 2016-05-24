<?php 

if(empty($_SESSION['akses'])){header('location: ../../');}

include('inc/include/head.php');

function isiOptionSelect($jazz,$anu)
{	$n=0;
	$noma=0;
	$sql = mysqli_query($jazz,"SELECT id_cab, namacab FROM _cabang");
	while ($cab = mysqli_fetch_array($sql))
	{	$n+=1;
		if($anu==1){
			echo '<button type="button" id="btncab'.$cab[0].'" class="btn btn-default" onclick="pilihcab('.$cab[0].')">
				  <i class="fa fa-share-alt"></i> 
				   Cab. '.$cab[1].'
				  </button> ';
			if($noma==0){ $noma=$cab[0]; }
		}else{
			echo '<option value="'.$cab[0].'">('.$cab[0].') '.$cab[1].'</option>';
		}
	}
	
	if($n==0 && $anu==1){
		echo '<input id="cabcurrent" type="hidden" value="1">';
	}elseif($n!=0 && $anu==1){
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
				<button id="newakun" type="button" class="btn btn-primary" data-toggle="modal" data-target="#BaruModal"><i class="fa fa-laptop"></i> Meja Baru</button>
				&nbsp;
				<?php echo isiOptionSelect($jazz,1) ?>
				<br />
				<br />
				
				<div id="loaded_contents_brought"></div>
				
              </div>
        	  
		  </div>
		</div>
	  </div>
	</div>
  </div>


      <!-- Modal new -->
      <div class="modal fade" id="BaruModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:350px;top:0px">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Buat Akun Stasiun Meja Baru</h4>
			  <hr style="border:solid 1px" />
			  
			  <div id="boxperingatan"></div>

			  <form>
				<div class="row">
					<div class="col-md-12 margin-bottom-15">
						<label>Cabang</label>
						<select class="form-control" id="inputcabang">
							<?php
								echo isiOptionSelect($jazz,2);
							?>
						</select>
					</div>
					<div>
						<div id="divvalidationinput">
							<div class="col-md-6 margin-bottom-15">
							  <label>Nomor Meja</label>
							  <input id="inputmeja" type="text" class="form-control" maxlength="2" onkeypress="return isNumberKey(event)">
							  <span id="iconwarning" class=""></span>
							</div>
						</div>
						<div class="col-md-6 margin-bottom-15">
							<label>Blokir</label>
							<select class="form-control" id="inputblok">
								<option value="0">No</option>
								<option value="1">Yes</option>
							</select>
						</div>
					</div>
					<div id="divvalidationinputpass">
						<div class="col-md-12 margin-bottom-15">
							<label>Password</label>
							<input id="inputpassword" type="password" class="form-control">
							<span id="iconwarningpass" class=""></span>
						</div>	
					</div>
					<div>
						<div class="col-md-6 margin-bottom-15">
							<label>Jumlah Kursi</label>
							<input id="jml_kursi" type="text" class="form-control" maxlength="2" onkeypress="return isNumberKey(event)">
						</div>
						<div class="col-md-6 margin-bottom-15">
							<label>Kode Keluar</label>
							<input id="passout" type="text" class="form-control" maxlength="6" onkeypress="return isNumberKey(event)">
						</div>
					</div>
					
				</div>
			</form>
            </div>
            <div class="modal-footer">
              <button type="button" id="saveakun" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Simpan</button>
              <button type="button" class="btn btn-default" data-dismiss="modal" id="btnbatal"><i class="fa fa-times"></i> Batal</button>
            </div>
          </div>
        </div>
      </div>
	  
	  <!-- Modal edit -->
      <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:350px;top:0px">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Edit Akun Stasiun Meja</h4>
			  <hr style="border:solid 1px" />
			  <div id="boxperingatan2"> </div>
			  	<form>
				<div class="row">
					<div class="col-md-12 margin-bottom-15">
						<label>Cabang</label>
						<select class="form-control" id="editcabang">
							<?php
								echo isiOptionSelect($jazz,2);
							?>
						</select>
					</div>
					<div id="divvalidationedit">
						<div class="col-md-12 margin-bottom-15">
						  <label>Nomor Meja</label>
						  <input id="editmeja" type="text" class="form-control" onkeypress="return isNumberKey(event)">
						  <span id="iconwarning2" class=""></span>
						</div>
					</div>
					<div id="divvalidationeditpass2">
						<div class="col-md-12 margin-bottom-15">
							<label>Password</label>
							<input id="editpassword" type="password" class="form-control">
							<span id="iconwarningpass2" class=""></span>
						</div>	
					</div>
					<div class="col-md-12 margin-bottom-15">
						<label>Jumlah Kursi</label>
						<input id="jml_kursi2" type="text" class="form-control" onkeypress="return isNumberKey(event)">
					</div>
					<div class="col-md-12 margin-bottom-15">
						<label>Blokir</label>
						<select class="form-control" id="editblok">
							<option value="0">No</option>
							<option value="1">Yes</option>
						</select>
					</div><input id="editidmeja" type="hidden" disabled>
				</div>
				</form>
            </div>
            <div class="modal-footer">
              <button type="button" id="editakun" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update</button>
              <button type="button" class="btn btn-default" data-dismiss="modal" id="btnbatal"><i class="fa fa-times"></i> Batal</button>
            </div>
          </div>
        </div>
      </div>
	  
	  
	  <!-- Modal Lihat Pass -->
      <div class="modal fade" id="LihatPassModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:340px;top:170px">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="LabelLihatPass"></h4>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">&nbsp; <i class="fa fa-thumbs-o-up"></i> OK &nbsp;</button>
            </div>
          </div>
        </div>
      </div>
	  
	  <!-- Modal Hapus -->
      <div class="modal fade" id="HapusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:750px;top:170px">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabelHapus"></h4>
			  <input id="idakunhapus" type="hidden">
            </div>
            <div class="modal-footer">
              <button type="button" id="hapusakun" class="btn btn-primary" data-dismiss="modal">&nbsp; <i class="fa fa-trash-o"></i> Ya &nbsp;</button>
              <button type="button" class="btn btn-default" data-dismiss="modal" id="btnbatal"><i class="fa fa-ban" style="color:#FF0000"></i> Tidak</button>
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
	$("#newakun").click(function(){
		$("#divvalidationinput").removeClass();
		$("#iconwarning").removeClass();
		$("#divvalidationinputpass").removeClass();
		$("#iconwarningpass").removeClass();
		$("#boxperingatan").html('');
		cab = $("#cabcurrent").val();
		$("#inputcabang option[value='"+cab+"']").attr("selected","selected");
	});
	
	$("#inputmeja").keydown(function() {	
		$("#divvalidationinput").removeClass();
		$("#divvalidationinput").addClass("has-feedback");
		$("#iconwarning").removeClass();
	});
	$("#inputpassword").keydown(function() {	
		$("#divvalidationinputpass").removeClass();
		$("#divvalidationinputpass").addClass("has-feedback");
		$("#iconwarningpass").removeClass();
	});
	$("#editmeja").keydown(function() {
		$("#divvalidationedit").removeClass();
		$("#divvalidationedit").addClass("has-feedback");
		$("#iconwarning2").removeClass();
	});
	$("#editpassword").keydown(function() {	
		$("#divvalidationeditpass2").removeClass();
		$("#divvalidationeditpass2").addClass("has-feedback");
		$("#iconwarningpass2").removeClass();
		
	});
	
	$("#btnbatal").click(function(){
		kosongkan();
	});
	
	$(document).ready( function(){
		cab = $("#cabcurrent").val();
		$("#btncab"+ cab).removeClass();
		$("#btncab"+ cab).addClass("btn btn-success");
		var dataString = 'cab='+ cab +'&aksi=loadtable';
		$.ajax({
			type: "POST",
			url: "inc/include/aksi_akun3.php",
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
		$("#inputcabang option").each (function(){
			$("#btncab"+ $(this).val()).removeClass();
			$("#btncab"+ $(this).val()).addClass("btn btn-default");
		});
		$("#cabcurrent").val(cab);
		$("#btncab"+ cab).removeClass();
		$("#btncab"+ cab).addClass("btn btn-success");
		var dataString = 'cab='+ cab +'&aksi=loadtable';
		$.ajax({
			type: "POST",
			url: "inc/include/aksi_akun3.php",
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
	
	
	
	$("#saveakun").click(function(){
		
		meja = $("#inputmeja").val();
		sandi = $("#inputpassword").val();
		if(meja == "")
		{   $("#divvalidationinput").removeClass();
			$("#divvalidationinput").addClass("has-warning has-feedback");
			$("#iconwarning").removeClass();
			$("#iconwarning").addClass("fa fa-warning form-control-feedback");
			$("#boxperingatan").hide().fadeIn(500).html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Maaf, Nomor meja tidak boleh kosong.</div>');
		}
		else if(sandi == "")
		{   $("#divvalidationinputpass").removeClass();
			$("#divvalidationinputpass").addClass("has-warning has-feedback");
			$("#iconwarningpass").removeClass();
			$("#iconwarningpass").addClass("fa fa-warning form-control-feedback");
			$("#boxperingatan").hide().fadeIn(500).html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Maaf, Password tidak boleh kosong.</div>');
		}
		else
		{
			cabang = $("#inputcabang").val();
			inputpassword = $("#inputpassword").val();
			jml_kursi = $("#jml_kursi").val();
			inputblok = $("#inputblok").val();
			var dataString = 'meja='+ meja + '&cabang='+ cabang + '&password='+ inputpassword + '&jmlkursi='+ jml_kursi +'&blok='+ inputblok +'&aksi=new';
			$("#BaruModal").modal('hide');
			$.ajax({
				type: "POST",
				url: "inc/include/aksi_akun3.php",
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
			
			kosongkan();
		}
	});
	
	
	function editloadform(sandi, cab, meja, kursi, blok, id){
		$("#divvalidationedit").removeClass();
		$("#iconwarning2").removeClass()
		$("#boxperingatan2").html('');
		$("#editidmeja").val(id);
		$("#editmeja").val(meja);
		$("#editcabang option[value='"+cab+"']").attr("selected","selected");
		$("#editblok option[value='"+blok+"']").attr("selected","selected");
		$("#jml_kursi2").val(kursi);
		$("#editpassword").val(sandi);
	}
	
	
	$("#editakun").click(function(){
		meja = $("#editmeja").val();
		sandi = $("#editpassword").val();
		if(meja == "")
		{
			$("#divvalidationedit").removeClass();
			$("#divvalidationedit").addClass("has-warning has-feedback");
			$("#iconwarning2").removeClass();
			$("#iconwarning2").addClass("fa fa-warning form-control-feedback");
			$("#boxperingatan2").hide().fadeIn(500).html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Maaf, Nama Cabang tidak boleh kosong.</div>');
		}
		else if(sandi == "")
		{   $("#divvalidationeditpass2").removeClass();
			$("#divvalidationeditpass2").addClass("has-warning has-feedback");
			$("#iconwarningpass2").removeClass();
			$("#iconwarningpass2").addClass("fa fa-warning form-control-feedback");
			$("#boxperingatan2").hide().fadeIn(500).html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Maaf, Password tidak boleh kosong.</div>');
		}
		else
		{  	id = $("#editidmeja").val();
			cabang = $("#editcabang").val();
			blokir = $("#editblok").val();
			kursi = $("#jml_kursi2").val();
			var dataString = 'id='+ id + '&meja='+ meja + '&cabang='+ cabang + '&blokir='+ blokir +'&kursi='+ kursi +'&sandi='+ sandi +'&aksi=edit';
			$("#EditModal").modal('hide');
			$.ajax({
				type: "POST",
				url: "inc/include/aksi_akun3.php",
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
	});
	
	function lihatPass(x){
		var dataString = 'id='+ x +'&aksi=liatpass';
		$.ajax({
			type: "POST",
			url: "inc/include/aksi_akun3.php",
			data: dataString,
			cache: false,
			beforeSend: function()
			{
				$("#LabelLihatPass").html('<br clear="all"><div><font style="font-family:Arial,Tahoma;font-size:16px;">Silakan Tunggu !</font> <img src="img/loadings.gif"/></div><br clear="all">');
			},
			success: function(response)
			{
				$("#LabelLihatPass").hide().fadeIn(10).html(response);
			}
		});
	}
	function HapusID(idx,strcab,strmeja){
		cab = $("#editcabang option[value='"+strcab+"']").text();
		$("#myModalLabelHapus").html('Yakin ingin menghapus Meja "<span style="color:red;">'+ strmeja +'</span>" di cabang "<span style="color:red;">'+ cab +'</span>" ?');
		$("#idakunhapus").val(idx);
	}
	$("#hapusakun").click(function(){
		id = $("#idakunhapus").val();
		cab = $("#cabcurrent").val();
		var dataString = 'id='+ id +'&cab='+ cab +'&aksi=hapus';
		$.ajax({
			type: "POST",
			url: "inc/include/aksi_akun3.php",
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
	
	function kosongkan(){
		$("#inputmeja").val('');
		$("#inputpassword").val('');
		$("#jml_kursi").val('');
	}
	
</script>