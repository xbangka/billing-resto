<?php

if (!isset($_SESSION['IDorder'])) {

	$k = explode('|',$_SESSION['akses']);  // $id_meja.'|'.$m.'|Meja|'.$c.'|'.$passout;
	$sql = mysqli_query($jazz,"SELECT namacab FROM _cabang WHERE id_cab='$k[3]'"); //id_cab, namacab, kota, alamat, pegawai
	$row = mysqli_fetch_array($sql);
	$_SESSION['akses'] = $_SESSION['akses'].'|'.$row[0];
	setcookie("akses", md100($_SESSION['akses']), time() + (3600*24));
	$nama_cabang = $row[0];
?>


<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title><?php echo $nama_cabang ?></title>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width">        
  <link rel="stylesheet" href="inc/css/templatemo_main.css">
</head>
<body>
  <div id="main-wrapper">
    <div class="navbar navbar-inverse" role="navigation">
      <a href="javascript:;" id="btnxx"
		  style="float:right;display:block;color:#FFFFFF; margin:3px 20px 0 0;">
		  <h4><i class="fa fa-lock"></i></h4>
	  </a>
	  <div class="navbar-header">
        <div class="logo"><h1><img src="img/rm.png" border="0" /></h1></div>
      </div>   
    </div>
    <div class="template-page-wrapper">
        <div class="form-group">
          <div class="col-md-12">
            <label class="col-sm-12 control-label">Cabang <?php echo $nama_cabang ?></label>
            <div class="col-sm-12" align="center">
              
			  <br />
			  <a href="inc/buatkode.php" class="list-group-item active" style="width:600px">
                    <h4>Nomor Meja</h4>
					<span style="font-size:250px"><?php echo $k[1] ?></span>
              </a>

            </div>
          </div>              
        </div>
    </div>
  </div>
  
  <!-- Modal Out -->
      <div class="modal fade" id="myrespon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:228px;top:50px">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabelHapus">Number Of Out</h4><br />
				  <button type="button" class="btn btn-default" id="btn1"><span  style="font-size:32px">&nbsp;1&nbsp;</span></button> 
				  <button type="button" class="btn btn-default" id="btn2"><span  style="font-size:32px">&nbsp;2&nbsp;</span></button> 
				  <button type="button" class="btn btn-default" id="btn3"><span  style="font-size:32px">&nbsp;3&nbsp;</span></button><br />
				  <button type="button" class="btn btn-default" id="btn4" style="margin:4px 0 4px 0"><span  style="font-size:32px">&nbsp;4&nbsp;</span></button> 
				  <button type="button" class="btn btn-default" id="btn5" style="margin:4px 0 4px 0"><span  style="font-size:32px">&nbsp;5&nbsp;</span></button> 
				  <button type="button" class="btn btn-default" id="btn6" style="margin:4px 0 4px 0"><span  style="font-size:32px">&nbsp;6&nbsp;</span></button><br />
				  <button type="button" class="btn btn-default" id="btn7"><span  style="font-size:32px">&nbsp;7&nbsp;</span></button> 
				  <button type="button" class="btn btn-default" id="btn8"><span  style="font-size:32px">&nbsp;8&nbsp;</span></button> 
				  <button type="button" class="btn btn-default" id="btn9"><span  style="font-size:32px">&nbsp;9&nbsp;</span></button>
				  <button type="button" class="btn btn-default" id="btn0" style="margin:4px 0px 0px 0px;width:193px"><span  style="font-size:32px">&nbsp;0&nbsp;</span></button>
				<input id="myhit" type="hidden">
				<input id="myhit2" type="hidden" value="<?php echo $k[4] ?>">
            </div>
            <div class="modal-footer">
              <button type="button" id="idout" class="btn btn-primary" data-dismiss="modal">&nbsp;&nbsp; <i class="fa fa-check"></i> OK &nbsp; &nbsp;</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">&nbsp;<i class="fa fa-times" style="color:#FF0000"></i> Cancel&nbsp;</button>
            </div>
          </div>
        </div>
      </div>
	  
<script src="inc/js/jquery.min.js"></script>
<script src="inc/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$.ajax({
		type: "POST",
		url: "inc/aksi_stasiun.php",
		data: "&aksi=2",
		cache: false,
		beforeSend: function(){},
		success: function(response){}
	});
	var ajax_call = function() {
		$.ajax({
			type: "POST",
			url: "inc/aksi_stasiun.php",
			data: 'aksi=2',
			cache: false,
			beforeSend: function(){},
			success: function(){}
		});
	};
	
	var interval = 6000; // 1000 = 1 detik
	setInterval(ajax_call, interval);
	
});	

myhit = "";

$("#btnxx").click(function(){
	myhit = "";
	$("#myhit").val(myhit);
	$("#myrespon").modal('show');
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
		window.location="logout.php";
	}
});


</script>
</body>
</html>

<?php 
}
?>