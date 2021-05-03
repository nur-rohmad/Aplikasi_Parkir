<?php
include'koneksi.php';
$noked=$_GET['anoked'];
$tglawal=$_GET['atgawal'];
if(! empty($noked) AND ! empty($tglawal)){
	$hapus=mysqli_query($konek,"DELETE FROM parkirku where NoKendaraan='$noked' AND TglAwal='$tglawal'")
		or die ("Gagal Menjalankan Update".mysql_error());

$row=mysqli_fetch_array($hapus);
header('location:index.php');
} 
 ?>