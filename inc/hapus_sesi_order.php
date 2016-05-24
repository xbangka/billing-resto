<?php
include("db.php");
$idorder=$_SESSION['IDorder'];
mysqli_query($jazz,"UPDATE _order SET selesai='1' WHERE id_order='$idorder'");

$sql = mysqli_query($jazz,"SELECT id FROM _order_detail WHERE id_order='$idorder'"); //id, id_order, id_menu, nama_menu, harga, qty, sub_total, itm_baru
$ada = mysqli_num_rows($sql);
if($ada==0){
	mysqli_query($jazz,"DELETE FROM _order WHERE id_order='$idorder'");
}

unset($_SESSION['IDorder']);
setcookie("IDorder", "", time() - (3600*6));
header('Location: '.$host);
exit;
?>