<?php 

if(empty($_SESSION['akses'])){header('location: ../../');}

include('inc/include/head.php');

?>
  <div class="templatemo-content-wrapper">
	<div class="templatemo-content">
	  <ol class="breadcrumb">
		<li>Cabang</li>
	  </ol>
	  <div class="margin-bottom-30">
		<div class="row">
		  <div class="col-md-12">
			<div class="table-responsive">
				<button id="newcab" type="button" class="btn btn-primary" data-toggle="modal" data-target="#BaruModal"><i class="fa fa-share-alt"></i> Cabang Baru</button>
				<br />
				<br />
				<div id="loaded_contents_brought">
                <table class="table table-striped table-hover table-bordered">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>ID</th>
                      <th>Cabang</th>
                      <th>Alamat, Kota</th>
                      <th>Jumlah Pegawai</th>
                      <th>Jumlah Meja</th>
                      <th>Jumlah Kursi</th>
					  <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
				  	<?php 
						$n=0;
					 	$sql = mysqli_query($jazz,"SELECT * FROM _cabang");
						while ($row = mysqli_fetch_array($sql))
						{
			  				$n+=1;
							$jmlkursi=0;
							$sql2 = mysqli_query($jazz,"SELECT jml_kursi FROM _meja WHERE id_cab='$row[id_cab]'");
							$jmlmeja = mysqli_num_rows($sql2);
							while ($row2 = mysqli_fetch_array($sql2))
							{
								$jmlkursi+=$row2[0];
							}
					?>
                    <tr>
                      <td><?php echo $n ?></td>
                      <td><?php echo $row['id_cab'] ?></td>
                      <td><?php echo $row['namacab'] ?></td>
                      <td><?php echo $row['alamat'].', '.$row['kota'] ?></td>
                      <td><?php echo $row['pegawai'] ?></td>
                      <td><?php echo $jmlmeja ?></td>                    
                      <td><?php echo $jmlkursi ?></td>
                      <td><!-- Split button -->
                        <div class="btn-group">
                          <button type="button" class="btn btn-info"><i class="fa fa-question-circle"></i></button>
                          <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li>
								<a href="javascript:;" data-toggle="modal" data-target="#EditModal" 
								onclick="editloadform(<?php echo '\''.$row['id_cab'].'\',\''.$row['namacab'].'\',\''.$row['kota'].'\',\''.$row['alamat'].'\',\''.$row['pegawai'].'\'' ?>);">
								<i class="fa fa-edit" style="color:#006600"></i> Ubah</a>
							</li>
                            <li>
								<a href="javascript:;" data-toggle="modal" data-target="#HapusModal"
								 onclick="HapusID(<?php echo $row['id_cab'] ?>);">
								 <i class="fa fa-trash-o" style="color:#CC0000"></i> Hapus</a>
							</li>
                          </ul>
                        </div></td>
                    </tr>
					<?php 
					}
					?>
                  </tbody>
                </table>
				</div>
              </div>
        
		  </div>
		</div>
	  </div>
	</div>
  </div>


      <!-- Modal new -->
      <div class="modal fade" id="BaruModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:350px">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Buat Cabang Baru</h4>
			  <hr style="border:solid 1px" />
			  
			  <div id="boxperingatan"> </div>

			  <form>
				<div id="divvalidationinput" class="row">
					<div class="col-md-12 margin-bottom-15">
					  <label>Nama Cabang</label>
					  <input id="inputnamacab" type="text" class="form-control">
					  <span id="iconwarning" class=""></span>
					 </div>
				</div>
				<label>Kota</label>
				<input id="inputkota" type="text" class="form-control"><br />
				<label>Alamat</label>
				<input id="inputalamat" type="text" class="form-control"><br />
				<label>Jumlah Pegawai</label>
				<input id="inputpegawai" type="text" class="form-control" onkeypress="return isNumberKey(event)">
			</form>
            </div>
            <div class="modal-footer">
              <button type="button" id="savecab" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Simpan</button>
              <button type="button" class="btn btn-default" data-dismiss="modal" id="btnbatal"><i class="fa fa-times"></i> Batal</button>
            </div>
          </div>
        </div>
      </div>
	  
	  <!-- Modal edit -->
      <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:350px">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Edit Cabang</h4>
			  <hr style="border:solid 1px" />
			  <div id="boxperingatan2"> </div>
			  	<form>
					<div id="divvalidationedit" class="row">
						<div class="col-md-12 margin-bottom-15">
						  <label>Nama Cabang</label>
						  <input id="editnamacab" type="text" class="form-control">
						  <span id="iconwarning2" class=""></span>
						 </div>
					</div>
					<label>Kota</label>
					<input id="editkota" type="text" class="form-control"><br />
					<label>Alamat</label>
					<input id="editalamat" type="text" class="form-control"><br />
					<label>Jumlah Pegawai</label>
					<input id="editpegawai" type="text" class="form-control" onkeypress="return isNumberKey(event)">
					<input id="editidcab" type="hidden" disabled><br />
				</form>
            </div>
            <div class="modal-footer">
              <button type="button" id="editcab" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update</button>
              <button type="button" class="btn btn-default" data-dismiss="modal" id="btnbatal"><i class="fa fa-times"></i> Batal</button>
            </div>
          </div>
        </div>
      </div>
	  
	  <!-- Modal Hapus -->
      <div class="modal fade" id="HapusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:340px;top:170px">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabelHapus"></h4>
			  <input id="idcabhapus" type="hidden">
            </div>
            <div class="modal-footer">
              <button type="button" id="hapuscab" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-trash-o"></i> Ya &nbsp; &nbsp;</button>
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
	$("#newcab").click(function(){
		$("#divvalidationinput").removeClass();
		$("#divvalidationinput").addClass("row");
		$("#iconwarning").removeClass();
		$("#boxperingatan").html('');
	});
	
	$("#inputnamacab").keydown(function() {	
		$("#divvalidationinput").removeClass();
		$("#divvalidationinput").addClass("row has-feedback");
		$("#iconwarning").removeClass();

	});
	$("#editnamacab").keydown(function() {
		$("#divvalidationedit").removeClass();
		$("#divvalidationedit").addClass("row has-feedback");
		$("#iconwarning2").removeClass();
	});
	
	$("#btnbatal").click(function(){
		kosongkan();
	});
	
	
	
	$("#savecab").click(function(){
		
		namacab = $("#inputnamacab").val();
		if(namacab == "")
		{   $("#divvalidationinput").removeClass();
			$("#divvalidationinput").addClass("row has-warning has-feedback");
			$("#iconwarning").removeClass();
			$("#iconwarning").addClass("fa fa-warning form-control-feedback");
			$("#boxperingatan").hide().fadeIn(500).html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Maaf, Nama cabang tidak boleh kosong.</div>');
		}
		else
		{ 
			kota = $("#inputkota").val();
			alamat = $("#inputalamat").val();
			pegawai = $("#inputpegawai").val();
			var dataString = 'namacab='+ namacab + '&kota='+ kota + '&alamat='+ alamat + '&pegawai='+ pegawai + '&aksi=new';
			$("#BaruModal").modal('hide');
			$.ajax({
				type: "POST",
				url: "inc/include/aksi_cabang.php",
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
	
	
	function editloadform(id, namacab, kota, alamat, pegawai){
		$("#divvalidationedit").removeClass();
		$("#divvalidationedit").addClass("row");
		$("#iconwarning2").removeClass()
		$("#boxperingatan2").html('');
		$("#editidcab").val(id);
		$("#editnamacab").val(namacab);
		$("#editkota").val(kota);
		$("#editalamat").val(alamat);
		$("#editpegawai").val(pegawai);
	}
	
	
	$("#editcab").click(function(){
		namacab = $("#editnamacab").val();
		if(namacab == "")
		{
			$("#divvalidationedit").removeClass();
			$("#divvalidationedit").addClass("row has-warning has-feedback");
			$("#iconwarning2").removeClass();
			$("#iconwarning2").addClass("fa fa-warning form-control-feedback");
			$("#boxperingatan2").hide().fadeIn(500).html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>Maaf, Nama Cabang tidak boleh kosong.</div>');
		}
		else
		{   $("#EditModal").modal('hide');
			kota = $("#editkota").val();
			alamat = $("#editalamat").val();
			pegawai = $("#editpegawai").val();
			id = $("#editidcab").val();
			var dataString = 'id='+ id + '&namacab='+ namacab + '&kota='+ kota + '&alamat='+ alamat + '&pegawai='+ pegawai + '&aksi=edit';
			$.ajax({
				type: "POST",
				url: "inc/include/aksi_cabang.php",
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
	
	
	function HapusID(idx){
		$("#myModalLabelHapus").html('Hapus Cabang ID = "<span style="color:red;">'+idx+'</span>"');
		$("#idcabhapus").val(idx);
	}
	$("#hapuscab").click(function(){
		id = $("#idcabhapus").val();
		var dataString = 'id='+ id + '&aksi=hapus';
		$.ajax({
			type: "POST",
			url: "inc/include/aksi_cabang.php",
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
		$("#inputnamacab").val('');
		$("#inputkota").val('');
		$("#inputalamat").val('');;
		$("#inputpegawai").val('');
	}
	
</script>