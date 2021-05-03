<?php
include 'koneksi.php';
$nopol = strtoupper($_POST['cari']);
if (!empty($nopol)) {
  $tambah = mysqli_query($konek, "SELECT*,hour(timediff(TglAkhir,TglAwal)) AS 'Lama' from parkirku where nopol like '%$nopol%'");
}
header('location:index.php');
