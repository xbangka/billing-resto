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
	  
	  <div class="navbar-header">
        <div class="logo"><h1>Administrator</h1></div>
      </div>   
    </div>
    <div class="template-page-wrapper">
      <div class="navbar-collapse collapse templatemo-sidebar">
        <ul class="templatemo-sidebar-menu">
          <li class="<?php echo $acv1; ?>"><a href="admin.php"><i class="fa fa-home"></i>Dashboard</a></li>
		  <li class="<?php echo $acv2; ?>"><a href="?l=cabang"><i class="fa fa-share-alt"></i> Cabang</a></li>
          <li class="sub<?php echo $roll1; ?> <?php echo $acv3; ?>">
            <a href="javascript:;">
              <i class="fa fa-desktop"></i> Akun<div class="pull-right"><span class="caret"></span></div>
            </a>
            <ul class="templatemo-submenu">
              <li><a href="?l=akun2"> &nbsp; &nbsp; &nbsp;|----- Monitoring / Kasir</a></li>
              <li><a href="?l=akun3"> &nbsp; &nbsp; &nbsp;|----- Meja</a></li>
              <li><a href="?l=log"> &nbsp; &nbsp; &nbsp;|----- Log</a></li>             
              <li><a href="?l=akun1"> &nbsp; &nbsp; &nbsp;|----- Setting</a></li>
            </ul>
          </li>
		  <li class="<?php echo $acv4; ?>"><a href="?l=menu"><i class="fa fa-qrcode"></i>Menu</a></li> 
          <li class="<?php echo $acv5; ?>"><a href="?l=online"><i class="fa fa-check"></i>Online</a></li>
		  <li class="<?php echo $acv6; ?>"><a href="?l=kode"><i class="fa fa-hacker-news"></i>Kode Order Meja</a></li>
		  <li class="<?php echo $acv7; ?>"><a href="?l=omset"><i class="fa fa-money"></i>Pendapatan</a></li>
          <li><a href="javascript:;" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-sign-out"></i>Logout</a></li>
        </ul>
      </div><!--/.navbar-collapse -->