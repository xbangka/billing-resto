<?php 

if(empty($_SESSION['akses'])){header('location: ../../');}

include('inc/include/head.php');

function isiOptionSelect($jazz,$anu)
{	$n = 0;
	$sql = mysqli_query($jazz,"SELECT id_cab, namacab FROM _cabang");
	while ($cab = mysqli_fetch_array($sql))
	{	$n += 1;
		if($anu == 1){
		echo '<div class="checkbox">
				<label>
					<input name="inputcab[]" type="checkbox" value="'.$cab[0].'_" checked> ('.$cab[0].') '.$cab[1].'
				</label>
			  </div>' ;
		}else{
		echo '<div class="checkbox">
				<label>
					&nbsp; <input name="editcab[]" type="checkbox" id="editcab'.$n.'" value="'.$cab[0].'_"> ('.$cab[0].') '.$cab[1].' &nbsp;
				</label>
			  </div>' ;
		}
	}

}

?>

                    		
								
							
						
<input id="CurrentTab" type="hidden" value="1">
<input id="Tab1" type="hidden" value="1">
<input id="Tab2" type="hidden">
<input id="Tab3" type="hidden">

  <div class="templatemo-content-wrapper">
	<div class="templatemo-content">
	  <ol class="breadcrumb"><li>Daftar Menu Makanan Minuman</li></ol>
	  <div class="margin-bottom-30">
		<div class="row">
              <div class="col-md-12 col-sm-6">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist" id="templatemo-tabs">
                  <li>				 <a role="tab" href="javascript:;" data-toggle="modal" data-target="#BaruModal" id="newmenu">&nbsp; <i class="fa fa-plus"></i> &nbsp;</a></li>
                  <li class="active"><a role="tab" href="javascript:;" data-toggle="tab" data-target="#foods" onclick="pilihtab(1)">Makanan</a></li>
                  <li>				 <a role="tab" href="javascript:;" data-toggle="tab" data-target="#drinks" onclick="pilihtab(2)">Minuman</a></li>
                  <li>				 <a role="tab" href="javascript:;" data-toggle="tab" data-target="#cake" onclick="pilihtab(3)">Cake/Snacks</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                  
				  <div class="tab-pane active" id="foods">
                    <div class="row">
						<br />
						<div id="loaded_contents_brought1"></div>
					</div>
                  </div>
				  
				  
                  <div class="tab-pane fade" id="drinks">
                    <div class="row">
						<br />
						<div id="loaded_contents_brought2"></div>
					</div>
                  </div>
				  
				  
                  <div class="tab-pane fade" id="cake">
                    <div class="row">
						<br />
						<div id="loaded_contents_brought3"></div>
					</div>
                 </div> <!-- tab-content --> 
				 
              </div> 
			</div>
	  </div>
	</div>
  </div>


      <!-- Modal new -->
      <div class="modal fade" id="BaruModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:750px;top:0px">
          <div class="modal-content">
            <div class="modal-header">
              <form action="inc/include/aksi_menu.php" method="post" enctype="multipart/form-data" id="MyUploadForm">
			  <input name="aksi" type="hidden" value="new">
			  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Tambah Menu Baru</h4>
			  <hr style="border:solid 1px" />
			  
			  <div id="boxperingatan"></div>

				<div class="row">
					<div class="col-md-6 margin-bottom-15" align="center">
						<img src="" id="imgsrc" width="240" height="200" style="outline: 1px solid #ccc;" />
						<br  /><br  />
						Dimensi file harus 240x200 pixel<br  /><br  />
						<input name="image_file" id="imageInput" class="btn btn-success" type="file" style="font-size:14px;min-width: 100%;" />
					</div>
					
					<div class="col-md-6 margin-bottom-15">
						<label>Kategori</label>
						<select class="form-control" id="inputjenis" name="inputjenis">
							<option value="1">(1) Makanan</option>
							<option value="2">(2) Minuman</option>
							<option value="3">(3) Cake / Snacks</option>
						</select>
					</div>
					<div id="divvalidationinputnama">
						<div class="col-md-6 margin-bottom-15">
						  <label>Nama Menu</label>
						  <input id="inputnamamenu" name="inputnamamenu" type="text" class="form-control">
						  <span id="iconwarningnama" class=""></span>
						</div>
					</div>
					<div id="divvalidationinputharga">
						<div class="col-md-6 margin-bottom-15">
							<label>Harga</label>
							<input id="inputharga" name="inputharga" type="text" class="form-control" onkeypress="return isNumberKey(event)">
							<span id="iconwarningharga" class=""></span>
						</div>	
					</div>
					<div class="col-md-6 margin-bottom-15">
						<label>Tersedia di Cabang</label>
						<?php echo isiOptionSelect($jazz,1) ?>
					</div>
				</div>
			
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Simpan</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
			</form>
          </div>
        </div>
      </div>
	  
	  <!-- Modal edit -->
      <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:750px;top:0px">
          <div class="modal-content">
            <div class="modal-header">
              <form action="inc/include/aksi_menu.php" method="post" enctype="multipart/form-data" id="MyUploadForm2">
			  <input name="aksi" type="hidden" value="edit">
			  <input name="idmenu" id="idmenu" type="hidden">
			  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Edit Menu</h4>
			  <hr style="border:solid 1px" />
			  
			  <div id="boxperingatan2"> </div>
			  	
				<div class="row">
					<div class="col-md-6 margin-bottom-15" align="center">
						<img src="" id="imgsrc2" width="240" height="200" style="outline: 1px solid #ccc;" />
						<br  /><br  />
						Dimensi file harus 240x200 pixel<br  /><br  />
						<input name="image_file" id="imageedit" class="btn btn-success" type="file" style="font-size:14px;min-width: 100%;" />
						
					</div>
					
					<div>
						<div class="col-md-3 margin-bottom-15">
							<label>Kategori</label>
							<select class="form-control" id="editjenis" name="editjenis">
								<option value="1">(1) Makanan</option>
								<option value="2">(2) Minuman</option>
								<option value="3">(3) Cake / Snacks</option>
							</select>
						</div>
						<div class="col-md-3 margin-bottom-15">
							<label>Nomor Urut</label>
							<input name="nomerurutawal" id="nomerurutawal" type="hidden">
							<select class="form-control" id="nomerurut" name="nomerurut">
								
							</select>
						</div>
					</div>
					<div id="divvalidationeditnama">
						<div class="col-md-6 margin-bottom-15">
						  <label>Nama Menu</label>
						  <input id="editnamamenu" name="editnamamenu" type="text" class="form-control">
						  <span id="iconwarningnama2" class=""></span>
						</div>
					</div>
					<div id="divvalidationeditharga">
						<div class="col-md-6 margin-bottom-15">
							<label>Harga</label>
							<input id="editharga" name="editharga" type="text" class="form-control" onkeypress="return isNumberKey(event)">
							<span id="iconwarningharga2" class=""></span>
						</div>	
					</div>
					<div class="col-md-6 margin-bottom-15">
						<label>Tersedia di Cabang</label>
						<div id="mycheck">
							<?php echo isiOptionSelect($jazz,2) ?>
						</div>
					</div>
				</div>
            </div>
            <div class="modal-footer">
			  <button type="button" id="hapusID" class="btn btn-default" title="Hapus?" style="float:left"><i class="fa fa-trash-o" style="color:#CC0000;font-size:18px;"></i></button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
			</form>
          </div>
        </div>
      </div>
	  
	  
	  <!-- Modal Loading -->
	  <div class="modal fade" id="myrespon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:420px;top:170px">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="LabelModal"><font style="font-family:Arial,Tahoma;font-size:16px;">Silakan Tunggu !</font> <img src="img/loadings.gif"/></h4>
            </div>
          </div>
        </div>
      </div>
	  
	  <!-- Modal Hapus -->
      <div class="modal fade" id="HapusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:600px;top:170px">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabelHapus"></h4>
			  <input id="idakunhapus" type="hidden">
            </div>
            <div class="modal-footer">
              <button type="button" id="hapusMenu" class="btn btn-primary" data-dismiss="modal">&nbsp; <i class="fa fa-trash-o"></i> Ya &nbsp;</button>
              <button type="button" class="btn btn-default" data-dismiss="modal" id="btnbatal"><i class="fa fa-ban" style="color:#FF0000"></i> Tidak</button>
            </div>
          </div>
        </div>
      </div>
	  
<script src="inc/js/jquery.min.js"></script>
<script src="inc/js/jquery.form.min.js"></script>
<script src="inc/js/bootstrap.min.js"></script>
<script src="inc/js/templatemo_script.js"></script>
<script src="inc/js/formuploadimg.js"></script>
<script type="text/javascript">
	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if( charCode > 31 && ( charCode < 48 || charCode > 57 ))
		return false;
		return true;
	}
	
	$("#newmenu").click(function(){
		tab = $("#CurrentTab").val();
		$("#inputjenis option[value='"+tab+"']").attr("selected","selected");
		$("#divvalidationinputnama").removeClass();
		$("#iconwarningnama").removeClass();
		$("#divvalidationinputnama").removeClass();
		$("#iconwarningnama").removeClass();
		$("#boxperingatan").html('');
		$("#imageInput").val('');
		$("#imgsrc").attr('src', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==');
		
	});
	$("#inputnamamenu").keydown(function() {	
		$("#divvalidationinputnama").removeClass();
		$("#divvalidationinputnama").addClass("has-feedback");
		$("#iconwarningnama").removeClass();
	});
	$("#inputharga").keydown(function() {	
		$("#divvalidationinputharga").removeClass();
		$("#divvalidationinputharga").addClass("has-feedback");
		$("#iconwarningharga").removeClass();
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

	$(document).ready( function(){
		tab = $("#CurrentTab").val();
		var dataString = 'jenis='+ tab +'&aksi=loadtable';
		$.ajax({
			type: "POST",
			url: "inc/include/aksi_menu.php",
			data: dataString,
			cache: false,
			beforeSend: function()
			{
				$("#loaded_contents_brought1").html('<br clear="all"><div align="center"><font style="font-family:Arial,Tahoma;font-size:16px;">Mengambil Data</font> <img src="img/loadings.gif"/></div><br clear="all">');
			},
			success: function(response)
			{
				$("#loaded_contents_brought1").hide().fadeIn(100).html(response);
			}
		});
		

		 $('#MyUploadForm').submit(function() { 
				tab2 = $('#inputjenis').val();
				currentab = $('#CurrentTab').val();
				if(tab2==currentab){
					var idtarget = '#loaded_contents_brought'+tab2;
				}else{ var idtarget = ''; }
				
				$(this).ajaxSubmit({ 
					target: idtarget,   // target element(s) to be updated with server response 
					beforeSubmit: beforeSubmit,  // pre-submit callback 
					success: afterSuccess,  // post-submit callback 
					resetForm: true        // reset the form after successful submit 
				});  			
				return false; 
		}); 
		$('#MyUploadForm2').submit(function() { 
				tab3 = $('#editjenis').val();
				currentab2 = $('#CurrentTab').val();
				
				if(tab3==currentab2){
					var idtarget = '#loaded_contents_brought'+tab3;
					
				}else{ var idtarget = ''; }
				
				$(this).ajaxSubmit({ 
					
					target: idtarget,   // target element(s) to be updated with server response 
					beforeSubmit: beforeSubmit2,  // pre-submit callback 
					success: afterSuccess,  // post-submit callback 
					resetForm: true        // reset the form after successful submit 
				}); 
				//alert(idtarget); 			
				return false; 
		}); 
	});
	
	function pilihtab(tab){
		if( $("#Tab"+ tab).val()=='' ){
			var dataString = 'jenis='+ tab +'&aksi=loadtable';
			$.ajax({
				type: "POST",
				url: "inc/include/aksi_menu.php",
				data: dataString,
				cache: false,
				beforeSend: function()
				{
					$("#loaded_contents_brought"+ tab).html('<br clear="all"><div align="center"><font style="font-family:Arial,Tahoma;font-size:16px;">Silakan Tunggu !</font> <img src="img/loadings.gif"/></div><br clear="all">');
				},
				success: function(response)
				{
					$("#loaded_contents_brought"+ tab).hide().fadeIn(100).html(response);
				}
			});
		}
		$("#Tab"+ tab).val(tab);
		$("#CurrentTab").val(tab);
	}
	
	function edit(id){
		
		idx = $("#id"+id).val();
		$("#idmenu").val(idx);
		
		img = $("#gambar"+id).attr('src');
		$("#imgsrc2").attr('src', img);
		$("#imageedit").val('');
		
		jenis = $("#jenis"+id).val();
		$("#editjenis option[value='"+jenis+"']").attr("selected","selected");
		
		nama = $("#nama"+id).val();
		$("#editnamamenu").val(nama);
		
		harga = $("#harga"+id).val();
		$("#editharga").val(harga);
		
		jmlrow = $("#jml_row_"+jenis).val();
		$('#nomerurut')
			.find('option')
			.remove()
			.end()
		;
		
		for(u=1; u<=jmlrow; u++){
			urutdb = $("#jenis"+jenis+"_diurut"+u).val();
			$('<option>').val(urutdb).text(u).appendTo('#nomerurut');
		}
		
		urut = $("#urutan"+id).val();
		$("#nomerurut option[value='"+urut+"']").attr("selected","selected");
		$("#nomerurutawal").val(urut);
		
		var mycheck = document.getElementById('mycheck');
		var inputTags = mycheck.getElementsByTagName('input');
		var checkboxCount = 0;
		for (i=0, length = inputTags.length; i<length; i++) {
			 if (inputTags[i].type == 'checkbox') {
				 checkboxCount++;
			 }
		}
		
		for(u=1; u<=checkboxCount; u++){

			if($('#id'+id+'_cab'+u).val() == $('#editcab'+u).val()){
				$('#editcab'+u).prop('checked', true);
			}else{
				$('#editcab'+u).prop('checked', false);
			}
		}
		
		$("#divvalidationeditnama").removeClass();
		$("#iconwarningnama2").removeClass()
		$("#divvalidationeditharga").removeClass();
		$("#iconwarningharga2").removeClass()
		$("#boxperingatan2").html('');
		
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


	$("#hapusID").click(function(){
		namamenu = $("#editnamamenu").val();
		$("#EditModal").modal('hide');
		$("#HapusModal").modal('show');
		$("#myModalLabelHapus").html('Yakin ingin menghapus menu "<span style="color:red;">'+ namamenu +'</span>" ?');
	});
	
	$("#btnbatal").click(function(){
		$("#HapusModal").modal('hide');
		$("#EditModal").modal('show');
	});

	$("#hapusMenu").click(function(){
		id = $("#idmenu").val();
		var dataString = 'id='+ id +'&aksi=hapus';
		$.ajax({
			type: "POST",
			url: "inc/include/aksi_menu.php",
			data: dataString,
			cache: false,
			beforeSend: function()
			{
				$("#HapusModal").modal('hide');
				$("#myrespon").modal('show');
				$("#loaded_contents_brought").html('<br clear="all"><div align="center"><font style="font-family:Arial,Tahoma;font-size:16px;">Silakan Tunggu !</font> <img src="img/loadings.gif"/></div><br clear="all">');
			},
			success: function(response)
			{
				tab2 = $('#editjenis').val();
				currentab = $('#CurrentTab').val();
				if(tab2==currentab){
					$("#loaded_contents_brought"+tab2).hide().fadeIn(10).html(response);
				}
				$("#myrespon").modal('hide');
			}
		});
	});
	
	
document.getElementById('imageInput').onchange = function (evt) {
	var tgt = evt.target || window.event.srcElement,
		files = tgt.files;

	// FileReader support
	if (FileReader && files && files.length) {
		var fr = new FileReader();
		fr.onload = function () {
			document.getElementById('imgsrc').src = fr.result;
		}
		fr.readAsDataURL(files[0]);
		$("#boxperingatan").html('');
	}

	// Not supported
	else {
		$("#imgsrc").attr('src', 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==');
	}
}
document.getElementById('imageedit').onchange = function (evt) {
	var tgt = evt.target || window.event.srcElement,
		files = tgt.files;

	// FileReader support
	if (FileReader && files && files.length) {
		var fr = new FileReader();
		fr.onload = function () {
			document.getElementById('imgsrc2').src = fr.result;
		}
		fr.readAsDataURL(files[0]);
		$("#boxperingatan2").html('');	
	}

	// Not supported
	else {
		id = $("#idmenu").val();
		img = $("#gambar"+id).attr('src');
		$("#imgsrc2").attr('src', img);
	}
}
</script>