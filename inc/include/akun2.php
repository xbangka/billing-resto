<?php 

if(empty($_SESSION['akses'])){header('location: ../../');}

include('inc/include/head.php');

function isiOptionSelect($jazz)
{
	$sql = mysqli_query($jazz,"SELECT id_cab, namacab FROM _cabang");
	while ($cab = mysqli_fetch_array($sql))
	{
		echo '<option value="'.$cab[0].'">('.$cab[0].') '.$cab[1].'</option>';
	}   
}

?>
  <div class="templatemo-content-wrapper">
	<div class="templatemo-content">
	  <ol class="breadcrumb">
		<li>Akun Stasiun Monitoring Pemesanan dan Kasir</li>
	  </ol>
	  <div class="margin-bottom-30">
		<div class="row">
		  <div class="col-md-12">
			<div class="table-responsive">
				<button id="newakun" type="button" class="btn btn-primary" data-toggle="modal" data-target="#BaruModal"><i class="fa fa-desktop"></i> Akun Baru</button>
				<br />
				<br />
				<input id="currentPage" type="hidden">
				<div id="loaded_contents_brought"></div>
				
              </div>
        	  
		  </div>
		</div>
	  </div>
	</div>
  </div>


      <!-- Modal new -->
      <div class="modal fade" id="BaruModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:650px;top:70px">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Buat Akun Baru</h4>
			  <hr style="border:solid 1px" />
			  
			  <div id="boxperingatan"></div>

			  <form>
				<div class="row">
					<div id="divvalidationinput">
						<div class="col-md-6 margin-bottom-15">
						  <label>Nama</label>
						  <input id="inputnama" type="text" class="form-control">
						  <span id="iconwarning" class=""></span>
						</div>
					</div>
					<div class="col-md-6 margin-bottom-15">
					  <label>Jabatan</label>
					  <select class="form-control" id="inputjabatan">
							<option value="Kasir">Kasir</option>
							<option value="Monitoring">Monitoring</option>
					  </select>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6 margin-bottom-15">
						<label>Cabang</label>
						<select class="form-control" id="inputcabang">
							<?php
								echo isiOptionSelect($jazz);
							?>
						</select>
					</div>
					<div class="col-md-6 margin-bottom-15">
						<label>Blokir</label>
						<select class="form-control" id="inputblok">
							<option value="0">No</option>
							<option value="1">Yes</option>
						</select>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6 margin-bottom-15">
						<label>Username</label>
						<input id="inputusername" type="text" class="form-control">
					</div>
					<div class="col-md-6 margin-bottom-15">
						<label>Password</label>
						<input id="inputpassword" type="password" class="form-control">
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
        <div class="modal-dialog" style="width:650px;top:70px">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Edit Akun</h4>
			  <hr style="border:solid 1px" />
			  <div id="boxperingatan2"> </div>
			  	<form>
				<div class="row">
					<div id="divvalidationedit">
						<div class="col-md-6 margin-bottom-15">
						  <label>Nama</label>
						  <input id="editnama" type="text" class="form-control">
						  <span id="iconwarning2" class=""></span>
						</div>
					</div>
					<div class="col-md-6 margin-bottom-15">
					  <label>Jabatan</label>
					  <select class="form-control" id="editjabatan">
							<option value="Kasir">Kasir</option>
							<option value="Monitoring">Monitoring</option>
					  </select>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6 margin-bottom-15">
						<label>Cabang</label>
						<select class="form-control" id="editcabang">
							<?php
								echo isiOptionSelect($jazz);
							?>
						</select>
					</div>
					<div class="col-md-6 margin-bottom-15">
						<label>Blokir</label>
						<select class="form-control" id="editblok">
							<option value="0">No</option>
							<option value="1">Yes</option>
						</select>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6 margin-bottom-15">
						<label>Username</label>
						<input id="editusername" type="text" class="form-control">
					</div>
					<div class="col-md-6 margin-bottom-15">
						<label>Password</label>
						<input id="editpassword" type="password" class="form-control">
					</div>
				</div><input id="editidakun" type="hidden" disabled>
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
              <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-thumbs-o-up"></i> OK &nbsp;</button>
            </div>
          </div>
        </div>
      </div>
	  
	  <!-- Modal Hapus -->
      <div class="modal fade" id="HapusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:500px;top:170px">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabelHapus"></h4>
			  <input id="idakunhapus" type="hidden">
            </div>
            <div class="modal-footer">
              <button type="button" id="hapusakun" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-trash-o"></i> Ya &nbsp; &nbsp;</button>
              <button type="button" class="btn btn-default" data-dismiss="modal" id="btnbatal"><i class="fa fa-ban" style="color:#FF0000"></i> Tidak</button>
            </div>
          </div>
        </div>
      </div>
	  
<script src="inc/js/jquery.min.js"></script>
<script src="inc/js/bootstrap.min.js"></script>
<script src="inc/js/templatemo_script.js"></script>
<script type="text/javascript">
	$("#newakun").click(function(){
		$("#divvalidationinput").removeClass();
		$("#iconwarning").removeClass();
		$("#boxperingatan").html('');
	});
	
	$("#inputnama").keydown(function() {	
		$("#divvalidationinput").removeClass();
		$("#divvalidationinput").addClass("has-feedback");
		$("#iconwarning").removeClass();
		
	});
	$("#editnama").keydown(function() {
		$("#divvalidationedit").removeClass();
		$("#divvalidationedit").addClass("has-feedback");
		$("#iconwarning2").removeClass();
	});
	
	$("#btnbatal").click(function(){
		kosongkan();
	});
	
	$(document).ready( function(){
		var dataString = 'page=1&aksi=loadtable';
		$.ajax({
			type: "POST",
			url: "inc/include/aksi_akun2.php",
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
	function toPage(page){
		var dataString = 'page='+ page +'&aksi=loadtable';
		$("#currentPage").val(page);
		$.ajax({
			type: "POST",
			url: "inc/include/aksi_akun2.php",
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
		
		nama = $("#inputnama").val();
		if(nama == "")
		{   $("#divvalidationinput").removeClass();
			$("#divvalidationinput").addClass("has-warning has-feedback");
			$("#iconwarning").removeClass();
			$("#iconwarning").addClass("fa fa-warning form-control-feedback");
			$("#boxperingatan").hide().fadeIn(500).html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Maaf, Nama tidak boleh kosong.</div>');
		}
		else
		{
			jabatan = $("#inputjabatan").val();
			cabang = $("#inputcabang").val();
			blokir = $("#inputblok").val();
			username = $("#inputusername").val();
			sandi = $("#inputpassword").val();
			page = $("#currentPage").val();
			var dataString = 'nama='+ nama + '&jabatan='+ jabatan + '&cabang='+ cabang + '&blokir='+ blokir +'&username='+ username +'&sandi='+ sandi +'&page='+ page +'&aksi=new';
			$("#BaruModal").modal('hide');
			$.ajax({
				type: "POST",
				url: "inc/include/aksi_akun2.php",
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
	
	
	function editloadform(sandi, nama, jabatan, cabang, blok, username, id){
		$("#divvalidationedit").removeClass();
		$("#iconwarning2").removeClass()
		$("#boxperingatan2").html('');
		$("#editidakun").val(id);
		$("#editnama").val(nama);
		$("#editjabatan option[value='"+jabatan+"']").attr("selected","selected");
		$("#editcabang option[value='"+cabang+"']").attr("selected","selected");
		$("#editblok option[value='"+blok+"']").attr("selected","selected");
		$("#editusername").val(username);
		$("#editpassword").val(sandi);
	}
	
	
	$("#editakun").click(function(){
		nama = $("#editnama").val();
		if(nama == "")
		{
			$("#divvalidationedit").removeClass();
			$("#divvalidationedit").addClass("has-warning has-feedback");
			$("#iconwarning2").removeClass();
			$("#iconwarning2").addClass("fa fa-warning form-control-feedback");
			$("#boxperingatan2").hide().fadeIn(500).html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Maaf, Nama tidak boleh kosong.</div>');
		}
		else
		{  	id = $("#editidakun").val();
			jabatan = $("#editjabatan").val();
			cabang = $("#editcabang").val();
			blokir = $("#editblok").val();
			username = $("#editusername").val();
			sandi = $("#editpassword").val();
			page = $("#currentPage").val();
			var dataString = 'id='+ id + '&nama='+ nama + '&jabatan='+ jabatan + '&cabang='+ cabang + '&blokir='+ blokir +'&username='+ username +'&sandi='+ sandi +'&page='+ page +'&aksi=edit';
			$("#EditModal").modal('hide');
			$.ajax({
				type: "POST",
				url: "inc/include/aksi_akun2.php",
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
		$("#LabelLihatPass").html('Password: '+x);
	}
	function HapusID(idx,strakun){
		$("#myModalLabelHapus").html('Yakin ingin menghapus "<span style="color:red;">'+ strakun +'</span>" ?');
		$("#idakunhapus").val(idx);
	}
	$("#hapusakun").click(function(){
		id = $("#idakunhapus").val();
		page = $("#currentPage").val();
		var dataString = 'id='+ id + '&page='+ page +'&aksi=hapus';
		$.ajax({
			type: "POST",
			url: "inc/include/aksi_akun2.php",
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
		$("#inputnama").val('');
		$("#inputusername").val('');
		$("#inputpassword").val('');
	}
	
</script>