<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
</head>

<body>
	<div>
		<h4 style="border-bottom: 2px solid black;">Data Transaksi</h4>
		<p><strong><span style="color: green;">Pemasukan hari ini: </span></strong>Rp. <?php if ($pemasukanHariIni->nominal == null || $pemasukanHariIni->nominal === ''){ echo 'Rp. 0,00.';}else{ echo number_format($pemasukanHariIni->nominal).",00.";} ?></p>
		<p><strong><span style="color: green;">Pemasukan Bulan ini: </span></strong>Rp. <?php if ($pemasukanBulanIni->nominal == null || $pemasukanBulanIni->nominal === ''){ echo 'Rp. 0,00.';}else{ echo number_format($pemasukanBulanIni->nominal).",00.";} ?></p>
		<p><strong><span style="color: red;">Pengeluaran hari ini: </span></strong>Rp. <?php if ($pengeluaranHariIni->nominal == null || $pengeluaranHariIni->nominal === ''){ echo 'Rp. 0,00.';}else{ echo number_format($pengeluaranHariIni->nominal).",00.";} ?></p>
		<p><strong><span style="color: red;">Pengeluaran Bulan ini: </span></strong>Rp. <?php if ($pengeluaranBulanIni->nominal == null || $pengeluaranBulanIni->nominal === ''){ echo 'Rp. 0,00.';}else{ echo number_format($pengeluaranBulanIni->nominal).",00.";} ?></p><hr>
		<h4>Pilih Tipe Laporan: </h4>
		<form action="<?= base_url('user/laporanPDF'); ?>" method="post">
			<label for="tanggal">Tipe Laporan</label><br>
			<select name="tipeLaporan" id="">
				<option value="kosong" selected disabled>Pilih Tipe Laporan: </option>
				<option value="Pemasukan">Semua data Pemasukan</option>
				<option value="Pengeluaran">Semua data Pengeluaran</option>
				<option value="semua">Semua data Pemasukan & Pengeluaran</option>
			</select><br>
			<strong><span>Atau, Rentang Tanggal: </span><br></strong>
			<label for="tanggalAwal">Tanggal Awal: </label><br>
			<input type="date" name="tanggalAwal" id=""><br>
			<label for="tanggalAkhir">Tanggal Akhir: </label><br>
			<input type="date" name="tanggalAkhir" id=""><br><br>
			<button type="submit">Cetak Laporan PDF</button>
		</form>
	</div>
	<hr>
	<div>
		<h4>Tambah Data User+</h4>
		<form action="<?= base_url('user/tambah') ?>" method="post">
			<label for="username">Username: </label><br>
			<input type="text" name="username" id="" placeholder="Username"><br>
			<label for="nama">Nama: </label><br>
			<input type="text" name="nama" id="" placeholder="Nama"><br>
			<label for="password">Password: </label><br>
			<input type="password" name="password" id="" placeholder="Password"><br>
			<label for="username">Tipe User: </label><br>
			<select name="tipe_user" id="">
				<option value="Admin">Admin</option>
				<option value="User">User</option>
			</select><br><br>
			<button type="submit">Tambah</button>
		</form>
		<hr>
		<p style="color: red;">
			<?= $this->session->flashdata('error'); ?>
		</p>
		<p style="color: green;">
			<?= $this->session->flashdata('success'); ?>
		</p>
	</div>

	<div>
		<h4>Tabel Pengguna</h4>
		<p>Jumlah data: <?php echo count($dataUser) ?></p>
		<table border="1">
			<tr>
				<th>No</th>
				<th>Username</th>
				<th>Nama</th>
				<th>Tipe User</th>
				<th>Aksi</th>
			</tr>
			<?php $no = 1;
			foreach ($dataUser as $data) {
			?>
				<tr>
					<td style="padding: 5px; margin: 15px; padding-right: 25px;"><?= $no++ ?></td>
					<td style="padding: 5px; margin: 15px; padding-right: 25px;"><?= $data['username']; ?></td>
					<td style="padding: 5px; margin: 15px; padding-right: 25px;"><?= $data['nama']; ?></td>
					<td style="padding: 5px; margin: 15px; padding-right: 25px;"><?= $data['level']; ?></td>
					<td>
						<button class="hapus"><a style="text-decoration: none; color: black;" href="<?= base_url('user/hapusData/' . $data['id_user']) ?>">Hapus</a></button><strong>/</strong><button><a style="text-decoration: none; color: black;" href="<?= base_url('user/halaman_edit/' . $data['id_user']) ?>">Edit</a></button>
					</td>
				</tr>
			<?php
			}
			?>
		</table>
	</div>
	<hr>
	<h4>Tambah Data <span style="color: green;">Pemasukan+</span></h4>
	<form action="<?= base_url('user/pemasukan') ?>" method="post">
		<label for="username">Keterangan Pemasukan: </label><br>
		<input type="text" name="keterangan" id="" placeholder="Keterangan Pemasukan...."><br>
		<label for="username">Nominal Pemasukan: </label><br>
		<input type="text" name="nominal" id="" placeholder="Nominal Pemasukan....."><br><br>
		<button type="submit">Tambah data Pemasukan</button>
	</form><hr>

	<div>
		<h4>Tabel Data Pemasukan</h4>
		<p>Jumlah data: <?php echo count($pemasukan) ?></p>
		<table border="1">
			<tr>
				<th>No</th>
				<th>Username</th>
				<th>Keterangan Pemasukan</th>
				<th>Nominal Pemasukan</th>
				<th>Tanggal</th>
				<th>Aksi</th>
			</tr>
			<?php $no = 1;
			foreach ($pemasukan as $data) {
			?>
				<tr>
					<td style="padding: 5px; margin: 15px; padding-right: 25px;"><?= $no++ ?></td>
					<td style="padding: 5px; margin: 15px; padding-right: 25px;"><?= $data['username']; ?></td>
					<td style="padding: 5px; margin: 15px; padding-right: 25px;"><?= $data['keterangan']; ?></td>
					<td style="padding: 5px; margin: 15px; padding-right: 25px;"><?= $data['nominal']; ?></td>
					<td style="padding: 5px; margin: 15px; padding-right: 25px;"><?= $data['tanggal']; ?></td>
					<td>
						<button class="hapus"><a style="text-decoration: none; color: black;" href="<?= base_url('user/hapusPemasukan/' . $data['id_transaksi']) ?>">Hapus</a></button>
					</td>
				</tr>
			<?php
			}
			?>
		</table>
	</div><hr>

	<h4>Tambah Data <span style="color: red;">Pengeluaran+</span></h4>
	<form action="<?= base_url('user/pengeluaran') ?>" method="post">
		<label for="username">Keterangan Pemasukan: </label><br>
		<input type="text" name="keterangan" id="" placeholder="Keterangan Pemasukan...."><br>
		<label for="username">Nominal Pemasukan: </label><br>
		<input type="text" name="nominal" id="" placeholder="Nominal Pemasukan....."><br><br>
		<button type="submit">Tambah data Pengeluaran</button>
	</form><hr>

	<div>
		<h4>Tabel Data Pengeluaran</h4>
		<p>Jumlah data: <?php echo count($pengeluaran) ?></p>
		<table border="1">
			<tr>
				<th>No</th>
				<th>Username</th>
				<th>Keterangan Pengeluaran</th>
				<th>Nominal Pengeluaran</th>
				<th>Tanggal</th>
				<th>Aksi</th>
			</tr>
			<?php $no = 1;
			foreach ($pengeluaran as $data) {
			?>
				<tr>
					<td style="padding: 5px; margin: 15px; padding-right: 25px;"><?= $no++ ?></td>
					<td style="padding: 5px; margin: 15px; padding-right: 25px;"><?= $data['username']; ?></td>
					<td style="padding: 5px; margin: 15px; padding-right: 25px;"><?= $data['keterangan']; ?></td>
					<td style="padding: 5px; margin: 15px; padding-right: 25px;"><?= $data['nominal']; ?></td>
					<td style="padding: 5px; margin: 15px; padding-right: 25px;"><?= $data['tanggal']; ?></td>
					<td>
						<button class="hapus"><a style="text-decoration: none; color: black;" href="<?= base_url('user/hapusPemasukan/' . $data['id_transaksi']) ?>">Hapus</a></button>
					</td>
				</tr>
			<?php
			}
			?>
		</table>
	</div><hr>
	<script type="text/javascript">
        var buttonHapus = document.querySelector('hapus');
		buttonHapus.addEventListener("click", function() {
			const konfirmasi = confirm("Apakah anda ingin menghapus data ini?");
			var id = document.getElementsByName('idUser').values();
			if (konfirmasi == true){
				window.location.href = "<?php echo base_url('user/hapusData/') ?>" + id;
			} else {
				alert("Baiklah data batal untuk dihapus");
			}
		});
    </script>
</body>

</html>