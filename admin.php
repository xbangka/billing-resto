<?php 
$cekdb ='inc/db.php';
if (file_exists($cekdb)) {
	require($cekdb);
}else{
	exit();
}


if(empty($_SESSION['akses'])){header('location: '.$host.'login.asp');}

$akun = explode('|',$_SESSION['akses']);
if($akun[2]!='Admin'){header('location: '.$host);}
setcookie("akses", md100($_SESSION['akses']), time() + (3600*24));

$roll1='';
$acv1='';$acv2='';$acv3='';$acv4='';
$acv5='';$acv6='';$acv7='';$acv8='';

if (empty($_GET['l'])) {
	$acv1='active';
	include('inc/include/index.php');
	
}elseif($_GET['l']=='cabang'){
	$acv2='active';
	include('inc/include/cabang.php');

}elseif($_GET['l']=='akun2'){
	$acv3='active';
	$roll1=' open';
	include('inc/include/akun2.php');
	
}elseif($_GET['l']=='akun3'){
	$acv3='active';
	$roll1=' open';
	include('inc/include/akun3.php');
	
}elseif($_GET['l']=='log'){
	$acv3='active';
	$roll1=' open';
	include('inc/include/log.php');

}elseif($_GET['l']=='akun1'){
	$acv3='active';
	$roll1=' open';
	include('inc/include/akun1.php');

}elseif($_GET['l']=='menu'){
	$acv4='active';
	include('inc/include/menu.php');

}elseif($_GET['l']=='online'){
	$acv5='active';
	include('inc/include/online.php');

}elseif($_GET['l']=='kode'){
	$acv6='active';
	include('inc/include/meja_on.php');
	
}elseif($_GET['l']=='omset'){
	$acv7='active';
	include('inc/include/omset.php');
	
}else{
	include('inc/include/index.php');
}


?>
  <script type="text/javascript">

    window.onload = function(){
      var ctx_line = document.getElementById("templatemo-line-chart").getContext("2d");
      window.myLine = new Chart(ctx_line).Line(lineChartData, {
        responsive: true
      });
    };
  });
  

  </script>
      <!-- Modal -->
      <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:350px;top:170px">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Anda yakin ingin logout?</h4>
            </div>
            <div class="modal-footer">
              <a href="logout.php" class="btn btn-primary"> &nbsp; Ya &nbsp; </a>
              <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
            </div>
          </div>
        </div>
      </div>
      <footer class="templatemo-footer">
        <div class="templatemo-copyright">
          <p>Copyright &copy; 2015 AnyFoods Resto v.1.0 <!-- Credit: www.templatemo.com --></p>
        </div>
      </footer>
    </div>
</body>
</html>