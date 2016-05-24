<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <link href="img/lamp.png" rel="icon" type="image/x-icon">      
  <link rel="stylesheet" href="inc/css/templatemo_main.css">

</head>
<body>
  <div class="navbar navbar-inverse" role="navigation">
      
	  <a href="javascript:;" data-toggle="modal" data-target="#confirmModal"
		  style="float:right;display:block;color:#FFFFFF; margin:3px 20px 0 0;">
		  <h4>Logout</h4>
	  </a>
	  <a href="javascript:;" id="btnmeja"
		  style="float:right;display:block;color:#FFFFFF; margin:3px 40px 0 0;">
		  <h4> &nbsp; Meja &nbsp; </h4>
	  </a>
	  <a href="javascript:;" id="btnpemesanan"
		  style="float:right;display:block;color:#FFFFFF; margin:3px 40px 0 0;">
		  <h4><span class="badge" id="notifpesanan"></span> Pemesanan</h4>
		  <input type="hidden" value="0" id="notifpesanan2" />
	  </a>
	  <div class="navbar-header">
        <div class="logo"><h1><?php echo $nama_cab ?></h1></div>
      </div>   
    </div>
	
	<audio id="chatAudio"><source src="notify.wav" type="audio/wav"><source src="notify.mp3" type="audio/mpeg"><source src="notify.ogg" type="audio/ogg"></audio>
	
    <div class="template-page-wrapper">
      <div class="navbar-collapse collapse templatemo-sidebar">
        <ul class="templatemo-sidebar-menu">
		<?php 
		$n = 0 ;
		$sql = mysqli_query($jazz,"SELECT id, meja, pass, passout FROM _meja WHERE id_cab='$id_cab'");//id, id_cab, meja, pass, blok, ontime, jml_kursi, passout, visitor_time
		while ($row = mysqli_fetch_array($sql))
		{ $n += 1 ;
		?>
          <li>
		  	<a href="javascript:;" title="<?php echo md101($row['pass']).' - '.$row['passout'] ?>" onClick="pilihmeja(<?php echo $row['meja'] ?>);">
				<i class="fa fa-laptop" id="meja<?php echo $n ?>" dataid="i<?php echo $row['id'] ?>i" style="color:#000"></i>
				Meja <?php echo $row['meja'] ?>
				<i class="fa fa-circle" style="float:right;color:#CCC" id="on<?php echo $n ?>" dataid="u<?php echo $row['id'] ?>u"></i>
			</a>
		  </li>
		 <?php } echo '<input id="totalmeja" type="hidden" value="'.$n.'">'; ?> <!--  style="color:#009900" -->
        </ul>
      </div>