<?php
include'koneksi.php';
	$nopol=strtoupper($_POST['nopol']);
	$jenis=strtoupper($_POST['kendaraan']);
if(! empty($nopol) AND !empty($jenis)){
$tambah=mysqli_query($konek,"INSERT INTO parkirku(NoKendaraan,jnsKendaraan,TglAwal) values ('$nopol','$jenis',now())");
}
header('location:index.php');
 ?>
