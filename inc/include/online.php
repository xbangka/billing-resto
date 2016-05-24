<?php 

if(empty($_SESSION['akses'])){header('location: ../../');}

include('inc/include/head.php');

?>
<div class="templatemo-content-wrapper">
	<div class="templatemo-content">
		<div class="margin-bottom-30">
			<div class="templatemo-panels">
            <div class="row"> 
              <div class="col-md-12 col-sm-12 margin-bottom-30">
                <div class="panel panel-success">
                  <div class="panel-heading" id="myrespon">Meja</div>
                  <div class="panel-body">
                    <table class="table table-striped">
                      <thead>
					  	<tr>
					  <?php 
						$sql = mysqli_query($jazz,"SELECT id_cab, namacab FROM _cabang ORDER BY id_cab ASC");
						$n=0;
						while ($row = mysqli_fetch_array($sql))
						{   $n+=1;
							${'cab'.$n} = $row[0];
                        
                            echo '<th width="10px">'.$row[1].'</th>';
						} 
						$jmlcab = $n;
						echo '<input id="jmlcab" type="hidden" value="'.$jmlcab.'">';
					  ?>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
						  <?php 
							$sql = mysqli_query($jazz,"SELECT id_cab, id FROM _akses WHERE jabatan = 'Kasir' ORDER BY id_cab, blok ASC");
							$cabang_temp = '';
							$cabangx = '';
							$n = 0;
							while ($row = mysqli_fetch_array($sql))
							{   
								if($cabang_temp != $row[0]){
									$n += 1;
									$cabangx = $cabangx.','.$row[0];
									${'id'.$n} = $row[1];
								}
							} 
							
							for($i=1; $i<=$jmlcab; $i++){
								$x = ${'cab'.$i};
								if(strpos($cabangx,$x)){
									echo '<td><i class="fa fa-desktop"></i> K &nbsp; <i class="fa fa-circle" id="k'.$i.'" title="k'.${'id'.$i}.'k" style="color:#DDD"></i></td>';
								}else{
									echo '<td></td>';
								}
							}
						  ?>
                          
                        </tr>
                          <?php 
							$sql = mysqli_query($jazz,"SELECT id_cab, id FROM _akses WHERE jabatan = 'Monitoring' ORDER BY id_cab, blok ASC");
							$cabang_temp = '';
							$cabangx = '';
							$n = 0;
							while ($row = mysqli_fetch_array($sql))
							{   
								if($cabang_temp != $row[0]){
									$n += 1;
									$cabangx = $cabangx.','.$row[0];
									${'id'.$n} = $row[1];
								}
							} 
							
							for($i=1; $i<=$jmlcab; $i++){
								$x = ${'cab'.$i};
								if(strpos($cabangx,$x)){
									echo '<td><i class="fa fa-desktop"></i> M &nbsp; <i class="fa fa-circle" id="m'.$i.'" title="k'.${'id'.$i}.'k" style="color:#DDD"></i></td>';
								}else{
									echo '<td></td>';
								}
							}
						  ?>
                          
                        <tr> 
                           <?php 
							$n = 0;
							for($i=1; $i<=$jmlcab; $i++){
								$x = ${'cab'.$i};
								echo '<td style="padding: 0px 0px 0px 0px"> <table class="table table-striped">';
								$sql = mysqli_query($jazz,"SELECT meja,id FROM _meja WHERE id_cab='$x' ORDER BY meja ASC");
								while ($row = mysqli_fetch_array($sql))
								{   $n += 1;
									echo '<tr><td>Meja '.$row[0].' &nbsp; <i class="fa fa-circle" id="meja'.$n.'" title="s'.$row[1].'s" style="color:#DDD"></i></td></tr>';
								} 
								echo '</table> </td>';
							}
							echo '<input id="totalmeja" type="hidden" value="'.$n.'">';
						  ?>
                        
                        </tr> <!-- <i class="fa fa-circle" style="color:#009900"></i> -->
						
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>       
            </div>
		</div>
	</div>
</div>

	  
<script src="inc/js/jquery.min.js"></script>
<script src="inc/js/bootstrap.min.js"></script>
<script src="inc/js/templatemo_script.js"></script>
<script type="text/javascript">

$(document).ready( function(){
		id = $("#idmenu").val();
		var dataString = 'aksi=loadfromonline';
		$.ajax({
			type: "POST",
			url: "inc/include/aksi_onoff.php",
			data: dataString,
			cache: false,
			beforeSend: function()
			{
				$("#myrespon").html('Meja <img src="img/loadings.gif"/>');
			},
			success: function(response)
			{
				$("#myrespon").html('Meja');
				jmlcab = $("#jmlcab").val();
				totalmeja = $("#totalmeja").val();
				
				for(i=1; i<=jmlcab; i++){
					x = $("#k"+i).attr("title");
					if(response.indexOf(x)>-1){
						$("#k"+i).attr("style","color:#009900");
					}else{
						$("#k"+i).attr("style","color:#DDD");
					}
				}
				for(i=1; i<=jmlcab; i++){
					x = $("#m"+i).attr("title");
					if(response.indexOf(x)>-1){
						$("#m"+i).attr("style","color:#009900");
					}else{
						$("#m"+i).attr("style","color:#DDD");
					}
				}
				for(i=1; i<=totalmeja; i++){
					x = $("#meja"+i).attr("title");
					if(response.indexOf(x)>-1){
						$("#meja"+i).attr("style","color:#009900");
					}else{
						$("#meja"+i).attr("style","color:#DDD");
					}
				}
			}
		});
	
	var ajax_call = function() {
		//your jQuery ajax code
		var dataString = 'aksi=loadfromonline';
		
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
				jmlcab = $("#jmlcab").val();
				totalmeja = $("#totalmeja").val();
				
				for(i=1; i<=jmlcab; i++){
					x = $("#k"+i).attr("title");
					if(response.indexOf(x)>-1){
						$("#k"+i).attr("style","color:#009900");
					}else{
						$("#k"+i).attr("style","color:#DDD");
					}
				}
				for(i=1; i<=jmlcab; i++){
					x = $("#m"+i).attr("title");
					if(response.indexOf(x)>-1){
						$("#m"+i).attr("style","color:#009900");
					}else{
						$("#m"+i).attr("style","color:#DDD");
					}
				}
				for(i=1; i<=totalmeja; i++){
					x = $("#meja"+i).attr("title");
					if(response.indexOf(x)>-1){
						$("#meja"+i).attr("style","color:#009900");
					}else{
						$("#meja"+i).attr("style","color:#DDD");
					}
				}
				
			}
		});
	};
	
	
	interval = 1000 * 10; // where X is your every X scon
	setInterval(ajax_call, interval);
	
});

</script>