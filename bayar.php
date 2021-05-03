<?php
include 'koneksi.php';
$noked = $_GET['anoked'];
$tglawal = $_GET['atgawal'];


if (!empty($noked) and !empty($tglawal)) {
	$upd = mysqli_query($konek, "UPDATE parkirku SET TglAkhir=now() WHERE NoKendaraan='$noked' AND TglAwal='$tglawal'")
		or die("Gagal Menjalankan Update" . mysql_error());
	$upd = mysqli_query($konek, "SELECT jnsKendaraan,hour(timediff(TglAkhir,TglAwal)) AS 'Lama',
		CASE 
			WHEN jnsKendaraan='R2' THEN if(hour(timediff(TglAkhir,TglAwal))>2, (hour(timediff(TglAkhir,TglAwal))-2)*500+2000,2000)
			WHEN jnsKendaraan='R4' THEN if(hour(timediff(TglAkhir,TglAwal))>2, (hour(timediff(TglAkhir,TglAwal))-2)*1000+5000,5000)
			ELSE 0
			END AS 'tarif'
			FROM parkirku WHERE Nokendaraan='$noked'AND TglAwal='$tglawal'");
	$row = mysqli_fetch_array($upd);
	$upd = mysqli_query($konek, "UPDATE parkirku SET tarifParkir='$row[tarif]' WHERE Nokendaraan='$noked' AND TglAwal='$tglawal'")
		or die("Gagal Menjalankan Update" . mysql_error());
	header('location:index.php');
}
