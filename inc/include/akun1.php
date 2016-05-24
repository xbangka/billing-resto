<?php 

if(empty($_SESSION['akses'])){header('location: ../../');}

include('inc/include/head.php');
$pesan ='';

if(isset($_POST['password'])){
	$x=$_POST['id'];
	$a=md104($_POST['user']);
	$b=md104($_POST['nama']);
	$k = explode('@',$_POST['surel']);
	$c = md104($k[0]).'@'.$k[1];
	$d=$_POST['notif'];
	$z=md5(md105($_POST['password']));
	if($_SESSION['sandi']==$z){
		if(!filter_var($_POST['surel'], FILTER_VALIDATE_EMAIL)){
			$pesan= '<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				Maaf, format surat elektronik Anda salah.
			  </div>';
			
		}elseif(!empty($_POST['password_1']) && $_POST['password_1']!=$_POST['password_2']){
			$pesan= '<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				Maaf, Anda mengulangi kata sandi baru yang tidak sama.
			  </div>';
			  
		}elseif($_POST['password_1']!='' && $_POST['password_1']==$_POST['password_2']){
			$z=md5(md105($_POST['password_1']));
			mysqli_query($jazz,"UPDATE lllllllllllllllllllllllll_user 
			SET user='$a', sandi='$z', nama='$b', surel='$c', notip='$d'
			WHERE n='$x'");
			$pesan = '<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<strong>Berhasil!</strong> perubahan data user telah Anda lakukan dan Anda menggunakan sandi baru.
			</div>';
			$_SESSION['id'] = $a;
			$_SESSION['sandi'] = $z;
			
		}else{
			mysqli_query($jazz,"UPDATE lllllllllllllllllllllllll_user 
			SET user='$a', sandi='$z', nama='$b', surel='$c', notip='$d'
			WHERE n='$x'");
			$pesan = '<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				<strong>Berhasil!</strong> perubahan data user telah Anda lakukan.
			</div>';
			$_SESSION['id'] = $a;
			$_SESSION['sandi'] = $z;
			
		}
		
	}else{
		$pesan= '<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert">
					<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
				</button>
				Maaf, kata sandi Anda untuk validasi salah.
			  </div>';
	}
}


$sql = mysqli_query($jazz,"SELECT id, nama, user_name FROM _akses WHERE jabatan='Admin'");
$row = mysqli_fetch_array($sql);
$id = $row[0];
$nama = $row[1];
$user = $row[2];
?>
  <div class="templatemo-content-wrapper">
	<div class="templatemo-content">
	  <ol class="breadcrumb">
		<li>Edit User</li>
	  </ol>	
	  <div class="row col-md-6 margin-bottom-15">
	  <div class="templatemo-alerts">
			<input id="idx" type="hidden" value="<?php echo $id ?>">
			<div id="divvalidation1">
				  <label>Nama</label>
				  <input id="nama" type="text" class="form-control" value="<?php echo $nama; ?>"> 
				  <span id="iconwarning1" class=""></span>
			</div><br />
			
			<div id="divvalidation2">
				  <label>User</label>
				  <input id="user" type="text" class="form-control" value="<?php echo $user; ?>"> 
				  <span id="iconwarning2" class=""></span>
			</div><br />

			<div id="divvalidation3">
				  <label>Validasikan dengan Sandi lama</label>
				  <input type="password" class="form-control" id="password"> 
				  <span id="iconwarning3" class=""></span>
			</div><hr />
			
			<div id="divvalidation4">
				  
				  <label>Sandi Baru</label>
				  <input type="password" class="form-control" id="password_1">
				  <span id="iconwarning4" class=""></span>
			</div><br />
			
			<div id="divvalidation5">
				  <label>Ulangi Sandi Baru</label>
				  <input type="password" class="form-control" id="password_2">
				  <span id="iconwarning5" class=""></span>
			</div>
				
			<br />
			<button id="btnUpdate" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update</button> *) Kosongkan Sandi Baru jika ingin login dengan sandi lama   
		</div>
	</div>
  </div>
</div>

      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:420px;top:170px">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="LabelModal"></h4>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-thumbs-o-up"></i> OK &nbsp;</button>
            </div>
          </div>
        </div>
      </div>
	  <div class="modal fade" id="myrespon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:420px;top:170px">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="LabelModal"><font style="font-family:Arial,Tahoma;font-size:16px;">Silakan Tunggu !</font> <img src="img/loadings.gif"/></h4>
            </div>
          </div>
        </div>
      </div>
	  
<script src="inc/js/jquery.min.js"></script>
<script src="inc/js/bootstrap.min.js"></script>
<script src="inc/js/templatemo_script.js"></script>
<script type="text/javascript">
	$("#btnUpdate").click(function(){
		
		nama = $("#nama").val();
		user = $("#user").val();
		pass = $("#password").val();
		password_1 = $("#password_1").val();
		password_2 = $("#password_2").val();
		if(nama == "")
		{   $("#divvalidation1").removeClass();
			$("#divvalidation1").addClass("has-warning has-feedback");
			$("#iconwarning1").removeClass();
			$("#iconwarning1").addClass("fa fa-warning form-control-feedback");
			$("#myModal").modal('show');
			$("#LabelModal").html('Maaf, Nama tidak boleh kosong !.');
		}
		else if(user == "")
		{   $("#divvalidation2").removeClass();
			$("#divvalidation2").addClass("has-warning has-feedback");
			$("#iconwarning2").removeClass();
			$("#iconwarning2").addClass("fa fa-warning form-control-feedback");
			$("#myModal").modal('show');
			$("#LabelModal").html('Maaf, User tidak boleh kosong !.');
		}
		else if(pass == "")
		{   $("#divvalidation3").removeClass();
			$("#divvalidation3").addClass("has-warning has-feedback");
			$("#iconwarning3").removeClass();
			$("#iconwarning3").addClass("fa fa-warning form-control-feedback");
			$("#myModal").modal('show');
			$("#LabelModal").html('Maaf, Password validasi tidak boleh kosong !.');
		}
		else if(password_1 != "" && password_2 == "")
		{   $("#divvalidation5").removeClass();
			$("#divvalidation5").addClass("has-warning has-feedback");
			$("#iconwarning5").removeClass();
			$("#iconwarning5").addClass("fa fa-warning form-control-feedback");
			$("#myModal").modal('show');
			$("#LabelModal").html('Maaf, Ulangi Password Baru Anda !.');
		}
		else if(password_2 != "" && password_1 == "")
		{   $("#divvalidation4").removeClass();
			$("#divvalidation4").addClass("has-warning has-feedback");
			$("#iconwarning4").removeClass();
			$("#iconwarning4").addClass("fa fa-warning form-control-feedback");
			$("#myModal").modal('show');
			$("#LabelModal").html('Maaf, Apa Password Baru Anda ?.');
		}
		else if(password_1 != "" && password_1 != password_2)
		{   $("#divvalidation5").removeClass();
			$("#divvalidation5").addClass("has-warning has-feedback");
			$("#iconwarning5").removeClass();
			$("#iconwarning5").addClass("fa fa-warning form-control-feedback");
			$("#myModal").modal('show');
			$("#LabelModal").html('Maaf, Password Baru Tidak Sama !.');
		}
		else
		{
			idx = $("#idx").val();
			var dataString = 'nama='+ nama + '&user='+ user + '&pass='+ pass + '&password_1='+ password_1 +'&idx='+ idx +'&aksi=edit';
			$.ajax({
				type: "POST",
				url: "inc/include/aksi_akun1.php",
				data: dataString,
				cache: false,
				beforeSend: function()
				{
					$("#myrespon").modal('show');
				},
				success: function(response)
				{
					$("#myrespon").modal('hide');
					$("#myModal").modal('show');
					$("#LabelModal").html(response);
					$("#password").val("");
					if(response=='Berhasil.'){
						$("#password_1").val("");
						$("#password_2").val("");
					}
				}
			});
		}
	});
	
	$("#nama").keydown(function() {	
		$("#divvalidation1").removeClass();
		$("#divvalidation1").addClass("has-feedback");
		$("#iconwarning1").removeClass();
		
	});
	$("#user").keydown(function() {	
		$("#divvalidation2").removeClass();
		$("#divvalidation2").addClass("has-feedback");
		$("#iconwarning2").removeClass();
		
	});
	$("#password").keydown(function() {	
		$("#divvalidation3").removeClass();
		$("#divvalidation3").addClass("has-feedback");
		$("#iconwarning3").removeClass();
		
	});
	$("#password_1").keydown(function() {	
		$("#divvalidation4").removeClass();
		$("#divvalidation4").addClass("has-feedback");
		$("#iconwarning4").removeClass();
		
	});
	$("#password_2").keydown(function() {	
		$("#divvalidation5").removeClass();
		$("#divvalidation5").addClass("has-feedback");
		$("#iconwarning5").removeClass();
		
	});
</script>