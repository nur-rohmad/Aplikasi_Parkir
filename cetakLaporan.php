<?php
include 'koneksi.php';
$tampil = mysqli_query($konek, "SELECT*,hour(timediff(TglAkhir,TglAwal)) AS 'Lama' from parkirku where month(TglAwal)=10 ORDER BY TglAwal ");
$totalPendapatan = mysqli_query($konek, "SELECT sum(tarifParkir) as 'total', count(NoKendaraan) as 'jumlah_kendaraan' from parkirku where month(TglAwal)=10");
$total = mysqli_fetch_array($totalPendapatan);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>cetak laporan</title>
  <style>
    div {
      width: 100%;
      height: 100%;
    }

    h1 {
      text-align: center;
    }

    h4 {
      margin-top: 0px;
      margin-bottom: 0px;
      text-align: center;
    }

    table {
      justify-content: center;
      /* margin-left: 25%; */

    }
  </style>
</head>

<body>
  <div>
    <h1>Laporan Parkir Bukan Desember</h1>
    <table border="1" class="table table-hover">
      <tr>
        <th>NO</th>
        <th>NO KENDR</th>
        <th>TGL AWAL</th>
        <th>TGL AKHIR</th>
        <th>JNS KENDR</th>
        <th>LAMA (JAM)</th>
        <th>TARIF PARKIR</th>
      </tr>
      <?php $i = 1; ?>
      <?php while ($row = mysqli_fetch_array($tampil)) : ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $row['NoKendaraan']; ?></td>
          <td><?php echo $row['TglAwal']; ?></td>
          <td><?php echo $row['TglAkhir']; ?></td>
          <td><?php echo $row['jnsKendaraan']; ?></td>
          <td><?php echo $row['Lama']; ?></td>
          <td><?php echo $row['tarifParkir']; ?></td>

        </tr>
        <?php $i++; ?>
      <?php endwhile; ?>
    </table>

    <table>
      <tr>
        <td>jumlah kendaraan </td>
        <td><?php echo $total['jumlah_kendaraan'] ?></td>
      </tr>
      <tr>
        <td>Jumlah Pendapatan</td>
        <td><?php echo $total['total'] ?></td>
      </tr>
    </table>
  </div>
</body>

<script>
  // window.print();
</script>

</html>