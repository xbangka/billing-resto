<?php 

if(empty($_SESSION['akses'])){header('location: ../../');}

include('inc/include/head.php');
$tgl = date('Y-m-d H:i:s');

?>
  <div class="templatemo-content-wrapper">
	<div class="templatemo-content">
	  <ol class="breadcrumb">
		<li>Admin Panel</li>
	  </ol>
	  <div class="margin-bottom-30">
		<div class="row"><div class="col-md-6">
		<?php 
		$sql = mysqli_query($jazz,"SELECT * FROM _cabang ORDER BY id_cab ASC"); // id_cab, namacab, kota, alamat, pegawai
		$jmlcab = mysqli_num_rows($sql);
		if($jmlcab % 2 == 0){
			$jmlcab = $jmlcab / 2 ;
			$kiri = $jmlcab ;
		}else{
			$anu = $jmlcab / 2 ;
			$kiri = floor($anu) + 1 ;
		}
		$i = 0 ;
		while ($row = mysqli_fetch_array($sql))
		{ 	$n = 0 ;
			$online = 0;
			$sql2 = mysqli_query($jazz,"SELECT visitor_time FROM _meja WHERE id_cab='$row[0]'"); // id, id_cab, meja, pass, blok, ontime, jml_kursi, passout, visitor_time
			while ($row2 = mysqli_fetch_array($sql2)){
				$n += 1 ;
				if(strtotime($row2[0]) >= strtotime(date('Y-m-d H:i:s'))) {
					$online += 1;
				}
			}
			$i += 1 ;
			if($i==$kiri){
				echo '<span class="btn btn-primary" style="width:100%;text-align:left">
					<a href="">'.$row[0].'. '.$row[1].' <span class="badge">'.$online.' / '.$n.'</span></a>
					</span><br /><br />';
				echo '</div>';
				echo '<div class="col-md-6">';
			}else{ 
				echo '<span class="btn btn-primary" style="width:100%;text-align:left">
				<a href="">'.$row[0].'. '.$row[1].' <span class="badge">'.$online.' / '.$n.'</span></a>
				</span><br /><br />';
			}
		}
		?>
		</div></div>
	  </div>

	  <div class="row">
	  	<div class="col-md-6 col-sm-6 margin-bottom-30">
			<div class="panel panel-primary">
			  <div class="panel-heading">Data Visualization Visitor</div>
			  <canvas id="templatemo-line-chart" height="300" width="500"></canvas>
			</div> 
			<span class="btn btn-success"><a href="?l=grafic">Grafik Harian</a></span>
		  </div> 
		<div class="col-md-6">
		  <div class="templatemo-alerts">
			<div class="panel panel-primary">
			  <div class="panel-heading">User Table</div>
			  <div class="panel-body">
				<table class="table table-striped">
				  <thead>
					<tr>
					  <th>#</th>
					  <th>Nama</th>
					  <th>Cabang</th>
					  <th>Online</th>
					</tr>
				  </thead>
				  <tbody>
				  <?php 
				    $sql = mysqli_query($jazz,"SELECT *	FROM _akses	WHERE id_cab<>0 ORDER BY id_cab ASC");
					$n=0;
					while ($row = mysqli_fetch_array($sql))
					{   $n+=1;
						$jamOn = strtotime($row['ontime']);
						$jam = strtotime(date('Y-m-d H:i:s'));
						if($jamOn >= $jam){
							$OnOff = '<i class="fa fa-check-circle" style="color:#009900"></i>';
						}else{
							$OnOff = '<i class="fa fa-times-circle" style="color:#BBB"></i>';
						}
				  ?>
					<tr>
					  <td><?php echo $n; ?></td>
					  <td><?php echo $row['nama']; ?></td>
					  <td><?php echo $row['id_cab'].' ('.$row['jabatan'].')'; ?></td>
					  <td><span  id="OnOff<?php echo $n ?>"><?php echo $OnOff; ?></span></td>
					</tr>
				  <?php } ?>
				  </tbody> 
				</table>
				<input id="jml_n" type="hidden" value="<?php echo $n; ?>">
			  </div>
			</div>                     
		  </div>              
		</div>
	  </div>   
	</div>
  </div>

<?php 
/*
$m =  floattostr(date('m')) + 1;
$thn = date('Y');
for($i=0;$i<=6;$i++){
	$m = $m - 1;
	if($m==0){$m = 12; $thn = $thn - 1;}
	${'bln'.$i} = $m;
	$x=$thn.'-'.sprintf('%02d',$m);
	$sql = mysqli_query($jazz,
		"SELECT SUM(hits) FROM lllllllllllllllllllllllll_pengunjung_hits 
		WHERE LEFT(tgl,7)='$x'");
	$ada = mysqli_num_rows($sql);
	if($ada>=1){
		$row = mysqli_fetch_array($sql);
		${'hit'.$i} = $row[0] ;
	}else{ ${'hit'.$i} = 0; }
}
$X = $hit6 + $hit5 + $hit4 + $hit3 + $hit2 + $hit1 + $hit0 ;
$X = $X / 7;*/
?>  
<script src="inc/js/jquery.min.js"></script>
<script src="inc/js/bootstrap.min.js"></script>
<script src="inc/js/Chart.min.js"></script>
<script src="inc/js/templatemo_script.js"></script>
<script type="text/javascript">
$(document).ready( function(){
	
	nx = $("#jml_n").val();
	var ajax_call = function() {
		//your jQuery ajax code
		var dataString = 'aksi=loadfromindex';
		
		$.ajax({
			type: "POST",
			url: "inc/include/aksi_onoff.php",
			data: dataString,
			cache: false,
			beforeSend: function()
			{
			},
			success: function(response)
			{
				var arr = response.split('|');
				for(i=0; i<nx; i++){
					$("#OnOff"+(+i + 1)).html(arr[i]);
				}
				
			}
		});
	};
	
	var interval = 1000 * 20; // where X is your every X scon
	setInterval(ajax_call, interval);
});

// Line chart
var randomScalingFactor = function(){ return Math.round(Math.random()*100)};
var lineChartData = {
  labels : [<?php echo '"'.$namabulan[6].'","'.$namabulan[5].'","'.$namabulan[4].'","'.$namabulan[3].'","'.$namabulan[2].'","'.$namabulan[1].'","'.$namabulan[7].'"' ; ?>],
  datasets : [
  {
	label: "Data Peningkatan komentar",
	fillColor : "rgba(220,220,220,0.2)",
	strokeColor : "rgba(220,220,220,1)",
	pointColor : "rgba(220,220,220,1)",
	pointStrokeColor : "#fff",
	pointHighlightFill : "#fff",
	pointHighlightStroke : "rgba(220,220,220,1)",
	data : [<?php //echo $X.','.$X.','.$X.','.$X.','.$X.','.$X.','.$X ; ?>50,60,70,60,40,30,70]
  },
  {
	label: "Data Visitor",
	fillColor : "rgba(151,187,205,0.2)",
	strokeColor : "rgba(151,187,205,1)",
	pointColor : "rgba(151,187,205,1)",
	pointStrokeColor : "#fff",
	pointHighlightFill : "#fff",
	pointHighlightStroke : "rgba(151,187,205,1)",
	data : [<?php //echo $hit6.','.$hit5.','.$hit4.','.$hit3.','.$hit2.','.$hit1.','.$hit0 ; ?>30,60,42,50,60,40,80]
  }
  ]

}


  </script>