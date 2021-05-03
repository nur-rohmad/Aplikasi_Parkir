<?php
include 'koneksi.php';
// membuat page 
$tampil = 10;
$page = isset($_GET["halaman"]) ? (int) $_GET["halaman"] : 1;
$mulai = ($page > 1) ? ($page * $tampil) - $tampil : 0;
$result = mysqli_query($konek, "SELECT*FROM parkirku");
$total = mysqli_num_rows($result);
$pages = ceil($total / $tampil);
// akir membuat page

if (isset($_POST['cari'])) {
	$nopol = $_POST['cari'];
	$tampil = mysqli_query($konek, "SELECT*,hour(timediff(TglAkhir,TglAwal)) AS 'Lama' from parkirku where NoKendaraan like '%" . $nopol . "%'");
} else {
	$tampil = mysqli_query($konek, "SELECT*,hour(timediff(TglAkhir,TglAwal)) AS 'Lama' from parkirku ORDER BY TglAwal DESC LIMIT $mulai, $tampil");
}

// $cari=
?>
<!DOCTYPE html>
<html>

<head>
	<title>Aplikasi Parkir</title>
	<link rel="stylesheet" type="text/css" href="asset/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">


<body>

	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<div class="container">
		<h1>Aplikasi Parkir Nur Rohmad</h1>
		<h2 align="center">Daftar Parkir</h2>
		<h3 align="center">kendaraan Roda 2: 2 jam pertama Rp. 2000 jam berikutnya + Rp. 500 per jam
			<nav>kendaraan Roda 4: 2 jam pertama Rp. 5000 jam berikutnya + Rp. 1000 per jam</nav>
		</h3>


		<button class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"> Tambah
		</button>

		<button class="btn btn-primary"><a href="cetakLaporan.php" target="_BLANK">Cetak</a></button>


		<div class="collapse" id="collapseExample">
			<form action="tambah.php" method="POST">
				<div class="form-group">
					<label for="exampleInputEmail1">Nomor Kendaraan</label>
					<input type="text" class="form-control" name="nopol">

				</div>
				<div class="from-group">
					<label for="exampleInputEmail1">Nomor Kendaraan</label>
				</div>
				<div class="form-group">
					<input class="form-check-input " type="radio" name="kendaraan" id="gridRadios1" value="R2" checked>
					<label class="form-check-label " for="gridRadios1">
						Roda 2
					</label>
				</div>
				<div class="from-group">
					<input class="form-check-input " type="radio" name="kendaraan" id="gridRadios2" value="R4" checked>
					<label class="form-check-label " for="gridRadios2">Roda 4
					</label>
				</div>
				<br>
				<button type="submit" class="btn btn-primary">Parkir</button>
			</form>
		</div>
		<table border="1" class="table table-hover">
			<tr>
				<th>NO</th>
				<th>NO KENDR</th>
				<th>TGL AWAL</th>
				<th>TGL AKHIR</th>
				<th>JNS KENDR</th>
				<th>LAMA (JAM)</th>
				<th>TARIF PARKIR</th>
				<th>AKSI</th>
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
					<td>
						<?php if ($row['TglAkhir'] == '') : ?>
							<a href="bayar.php?anoked=<?php echo $row['NoKendaraan'] ?>&atgawal=<?php echo $row['TglAwal'] ?>">Bayar</a>
						<?php endif ?>
						<a href="hapus.php?anoked=<?php echo $row['NoKendaraan'] ?>&atgawal=<?php echo $row['TglAwal'] ?>">Hapus</a>
					</td>

				</tr>
				<?php $i++; ?>
			<?php endwhile; ?>

		</table>
	</div>
	<div align="center">
		Halaman
		<?php for ($i = 1; $i <= $pages; $i++) : ?>
			<a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
		<?php endfor; ?>
	</div>
</body>

</html>