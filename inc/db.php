<?php
session_start();
//error_reporting(0);
function judul_seo($string){
	$c = array (' '); 
	$d = array ('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+'); 
	$string = str_replace($d, '', $string); 
	$string = strtolower(str_replace($c, '-', $string)); 
	return $string;
	}
 //-------------------------------------------------------------
function ambil_ip(){foreach (array('HTTP_CLIENT_IP','HTTP_X_REAL_IP','REMOTE_ADDR','HTTP_FORWARDED_FOR','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED','HTTP_X_CLUSTER_CLIENT_IP','HTTP_FORWARDED') as $key){if (array_key_exists($key,$_SERVER) === true){foreach (explode(',',$_SERVER[$key]) as $ip){if (filter_var($ip,FILTER_VALIDATE_IP) !== false){return $ip; }	} }	} }
///============================================================
function floattostr($val){ preg_match( "#^([\+\-]|)([0-9]*)(\.([0-9]*?)|)(0*)$#", trim($val), $o ); return $o[1].sprintf('%d',$o[2]).($o[3]!='.'?$o[3]:''); }
///============================================================
function md100($kata){ $len = strlen($kata)-1; $temp2 = ''; for($i=0;$i<=$len;$i++){$temp = substr($kata, $i, 1); $ansi = ord($temp); if($ansi % 2 == 0){$temp2 = $temp2.''.chr($ansi - 2);	}else{ $temp2 = $temp2.''.chr($ansi + 2);}} return $temp2;}
function md101($kata){$len = strlen($kata)-1; $temp2 = ''; for($i=0;$i<=$len;$i++){ $temp = substr($kata, $i, 1); $ansi = ord($temp); if($ansi % 2 == 0){ $temp2 = $temp2.''.chr($ansi + 2); }else{ $temp2 = $temp2.''.chr($ansi - 2);	} }	return $temp2;}

function nbull($kata){
	$len = strlen($kata)-1; 
	$temp2 = ''; 
	for($i=0;$i<=$len;$i++){ 
		$temp = substr($kata, $i, 1); 
		$temp = str_replace($temp, '&bull;', $temp); 
		$temp2 = $temp2.$temp;
	}
	return $temp2;
}

$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
$svrname = $_SERVER['SERVER_NAME'];
$hostdb = 'localhost';
$user = 'root';
$pass = '';
$dbase = '.resto.';
$jazz = mysqli_connect($hostdb,$user,$pass,$dbase) or die(header('location: '.$host.'404.php?error-mysqli-connect'));
$timezone = "Asia/Jakarta";
if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
$namabulan = array('','Januari','Pebruari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','Nopember','Desember');

?>