<?php
include('../../inc/db.php');

$_SESSION['akses'] = md101($_COOKIE['akses']);

if(empty($_SESSION['akses'])){
	$id = $_COOKIE['id'];
	$sql = mysqli_query($jazz,"SELECT sesilogin FROM _akses WHERE id='$id'"); //id, nama, jabatan, id_cab, user_name, password, ontime, blok, sesilogin
	$row = mysqli_fetch_array($sql);
	$_SESSION['akses'] = md101($row[0]);
}


if(isset($_POST['aksi']) && $_POST['aksi'] == 'loadfromindex')
{
	$sql = mysqli_query($jazz,"SELECT ontime,nama FROM _akses WHERE id_cab<>0 ORDER BY id_cab ASC");
	$OnOff = '';
	while ($row = mysqli_fetch_array($sql))
	{
		$jamOn = strtotime($row[0]);
		$jam = strtotime(date('Y-m-d H:i:s'));
		if($jamOn >= $jam){
			$OnOff = $OnOff.'<i class="fa fa-check-circle" style="color:#009900"></i>|';
		}else{
			$OnOff = $OnOff.'<i class="fa fa-times-circle" style="color:#BBB"></i>|';
		}
	}
	echo $OnOff;
}
elseif(isset($_POST['aksi']) && $_POST['aksi'] == 'loadfromonline')
{
	$sql = mysqli_query($jazz,"SELECT id, ontime FROM _akses WHERE jabatan <> 'Admin'");
	$OnOff = '';
	while ($row = mysqli_fetch_array($sql))
	{
		$jamOn = strtotime($row[1]);
		$jam = strtotime(date('Y-m-d H:i:s'));
		if($jamOn >= $jam){
			$OnOff = $OnOff.'k'.$row[0].'k,';
		}
	}
	$sql = mysqli_query($jazz,"SELECT id, ontime, visitor_time FROM _meja"); //id, id_cab, meja, pass, blok, ontime, jml_kursi, passout, visitor_time
	while ($row = mysqli_fetch_array($sql))
	{
		$jamOn = strtotime($row[2]);
		$jam = strtotime(date('Y-m-d H:i:s'));
		if($jamOn >= $jam){
			$OnOff = $OnOff.'s'.$row[0].'s,';
		}
	}
	echo $OnOff;
	
}elseif(isset($_POST['aksi']) && $_POST['aksi'] == 'loadfrommonitoring'){
	$hal = $_POST['hal'];
	$a = date('Y-m-d H:i:s');
	$b = strtotime($a) + 6;
	$tgl = date('Y-m-d H:i:s',$b);
	$k = explode('|',$_SESSION['akses']); // $row['id'].'|'.$row['nama'].'|'.$row['jabatan'].'|'.$row['id_cab'].'_nama_cab|'.$row['user_name'];
	mysqli_query($jazz,"UPDATE _akses SET ontime='$tgl' WHERE id='$k[0]'"); 
	
	$idcab = $_POST['idcab'];
	$xv = strlen($idcab);
	$sql = mysqli_query($jazz,"SELECT id, ontime, visitor_time, meja FROM _meja WHERE id_cab=$idcab"); //id, id_cab, meja, pass, blok, ontime, jml_kursi, passout, 
	$OnOff = '';
	$OnLogin = '';
	$kode = '';
	$n=0;
	$jam = strtotime(date('Y-m-d H:i:s'));
	while ($row = mysqli_fetch_array($sql))
	{	$n+=1;
		$jamOn = strtotime(date($row[1]));
		if($jamOn >= $jam){
			$OnOff = $OnOff.'i'.$row[0].'i,';
		}
		$jamOn = strtotime(date($row[2]));
		if($jamOn >= $jam){
			$OnLogin = $OnLogin.'u'.$row[0].'u,';
			if($hal==1){
				$OnLogin = $OnLogin.'e'.$row[0].'e,';
			}
		}

		$sql2 = mysqli_query($jazz,"SELECT id_order, jam_on, tgl FROM _order WHERE LEFT(id_order,".$xv.")='$idcab' AND meja='$row[3]' ORDER BY id_order DESC LIMIT 0,1"); // id_order, meja, tgl, jam_on, diupdate, selesai, total
		$ada = mysqli_num_rows($sql2);
		if($ada==1){
			$row2 = mysqli_fetch_array($sql2);
			$idorder = $row2[0];
			$wtk2 = strtotime($row2[2].' '.$row2[1]);
			$wtk = strtotime(date('Y-m-d H:i:s'));
			$jam_on = yang_lalu($wtk - $wtk2);
			if($jamOn < $jam){$jam_on = '-';}
		}else{
			$idorder = '';
			$jam_on = '-';
		}
		$kode = $kode.'<span id="labelorderserver'.$n.'" mydata="'.$idorder.'"></span><span id="yglaluserver'.$n.'" mydata="'.$jam_on.'"></span>';
	}
	$idcab = $k[3];
	$k = explode('_',$idcab);
	$idcab = $k[0];
	$sql2 = mysqli_query($jazz,"SELECT diload FROM _notif WHERE diload='0' AND cab='$idcab'"); // id, cab, meja, diload
	$ada = mysqli_num_rows($sql2);
	if($ada!=0){
		$kode = $kode.'||PESANBARU_'.$ada;
	}
	
	echo $OnOff.$OnLogin.$kode ;
	
	
}else{
	echo 'gagal';
}	


function yang_lalu($a){
	if($a<=59){
		$jam_on = $a.' detik';
	}elseif($a>=60 && $a<=3599){
		$jam_on = floor($a/60).' menit';
	}elseif($a>=3600){
		$jam_on = floor($a/3600).' jam';
	}else{
		$jam_on = '-';
	}
	return $jam_on ;
	
}

?>