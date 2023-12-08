<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<?php if ($this->session->flashdata('error')) : ?>
    <div class="col-12 mb-4">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><span class="fe fe-alert-octagon fe-16"></span> Gagal!</strong> <?php if ($this->session->flashdata('error')) { echo $this->session->flashdata('error') . ' '; } ?> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        </div>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('success')) : ?>
    <div class="col-12 mb-4">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><span class="fe fe-help-circle fe-16"></span> Behasil!</strong> <?php if ($this->session->flashdata('success')) { echo ucfirst($this->session->flashdata('success')) . ' '; } ?>  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        </div>
    </div>
<?php endif; ?>
<?php if ($this->session->flashdata('warning')) : ?>
    <div class="col-12 mb-4">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong><span class="fe fe-alert-triangle fe-16"></span> Maaf!</strong> <?php if ($this->session->flashdata('warning')) { echo $this->session->flashdata('warning') . ' '; } ?> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        </div>
    </div>
<?php endif; ?>

<div class="row my-4">
	<div class="col-6 col-lg-3">
		<div class="card shadow mb-4">
			<div class="card-body">
				<i class="fe  fe-dollar-sign fe-32 text-primary"></i>
				<h3 class="h5 mt-4 mb-1">Pemasukan hari ini</h3>
				<p class="text-muted"><strong>Sebesar:</strong> <?php if ($pemasukanHariIni->nominal === NULL || $pemasukanHariIni->nominal === ''){ echo 'Rp. 0,00.';}else{ echo number_format($pemasukanHariIni->nominal).",00.";} ?></p>
			</div> <!-- .card-body -->
		</div> <!-- .card -->
	</div> <!-- .col-md-->
	<div class="col-6 col-lg-3">
		<div class="card shadow mb-4">
			<div class="card-body">
				<i class="fe fe-dollar-sign fe-32 text-success"></i>
				<h3 class="h5 mt-4 mb-1">Pemasukan bulan ini</h3>
				<p class="text-muted"><strong>Sebesar:</strong> <?php if ($pemasukanBulanIni->nominal === NULL || $pemasukanBulanIni->nominal === ''){ echo 'Rp. 0,00.';}else{ echo number_format($pemasukanBulanIni->nominal).",00.";} ?></p>
			</div> <!-- .card-body -->
		</div> <!-- .card -->
	</div> <!-- .col-md-->
	<div class="col-6 col-lg-3">
		<div class="card shadow mb-4">
			<div class="card-body">
				<i class="fe fe-dollar-sign fe-32 text-warning"></i>
				<h3 class="h5 mt-4 mb-1">Pengeluaran hari ini</h3>
				<p class="text-muted"><strong>Sebesar:</strong> <?php if ($pengeluaranHariIni->nominal === NULL || $pengeluaranHariIni->nominal === ''){ echo 'Rp. 0,00.';}else{ echo number_format($pengeluaranHariIni->nominal).",00.";} ?></p>
			</div> <!-- .card-body -->
		</div> <!-- .card -->
	</div> <!-- .col-md-->
	<div class="col-6 col-lg-3">
		<div class="card shadow">
			<div class="card-body">
				<i class="fe fe-dollar-sign fe-32 text-danger"></i>
				<h3 class="h5 mt-4 mb-1">Pengeluaran bulan ini</h3>
				<p class="text-muted"><strong>Sebesar:</strong> <?php if ($pengeluaranBulanIni->nominal === NULL || $pengeluaranBulanIni->nominal === ''){ echo 'Rp. 0,00.';}else{ echo number_format($pengeluaranBulanIni->nominal).",00.";} ?></p>
			</div> <!-- .card-body -->
		</div> <!-- .card -->
	</div> <!-- .col-md-->
</div>
<div class="row my-4">
	<div class="col-6 col-lg-3">
		<div class="card shadow mb-4">
			<div class="card-body">
				<i class="fe fe-gift fe-32 text-primary"></i>
				<h3 class="h5 mt-4 mb-1">Total Pemasukan</h3>
				<p class="text-muted"><strong>Sebesar:</strong> <?php $totalPemasukan = 0; if ($pemasukan === NULL || $pemasukan === ''){ echo 'Rp. 0,00.';}else{ foreach ($pemasukan as $pmsk) { $totalPemasukan += $pmsk['nominal'];} echo 'Rp. '.number_format($totalPemasukan).",00.";} ?></p>
			</div> <!-- .card-body -->
		</div> <!-- .card -->
	</div> <!-- .col-md-->
	<div class="col-6 col-lg-3">
		<div class="card shadow mb-4">
			<div class="card-body">
				<i class="fe fe-shopping-bag fe-32 text-success"></i>
				<h3 class="h5 mt-4 mb-1">Total saldo akhir</h3>
				<p class="text-muted">
                    <?php $totalPemasukanS = 0; $totalPengeluaranS = 0;
                        foreach ($pemasukan as $pmsk) { $totalPemasukanS += $pmsk['nominal'];}
                        foreach ($pengeluaran as $pmsk) { $totalPengeluaranS += $pmsk['nominal'];}
                        $total_saldo = $totalPemasukanS - $totalPengeluaranS;
                        if ($total_saldo < 0) {
                            echo 'Rp. 0,00. / Tidak ada saldo. / <span style="text-decoration: underline red;">Rp '.number_format($total_saldo).",00</span>";
                        } else {
                            echo 'Rp. '.number_format($total_saldo).",00.";
                        }
                    ?>
                </p>
			</div> <!-- .card-body -->
		</div> <!-- .card -->
	</div> <!-- .col-md-->
	<div class="col-6 col-lg-3">
		<div class="card shadow mb-4">
			<div class="card-body">
				<i class="fe fe-gift fe-32 text-success"></i>
				<h3 class="h5 mt-4 mb-1">Total Pengeluaran</h3>
				<p class="text-muted"><strong>Sebesar:</strong> <?php $totalPengeluaran = 0; if ($pengeluaran === NULL || $pengeluaran === ''){ echo 'Rp. 0,00.';}else{ foreach ($pengeluaran as $pmsk) { $totalPengeluaran += $pmsk['nominal'];} echo 'Rp. '.number_format($totalPengeluaran).",00.";} ?></p>
			</div> <!-- .card-body -->
		</div> <!-- .card -->
	</div> <!-- .col-md-->
    <div class="col-6 col-lg-3">
        <div class="card shadow mb-4">
			<div class="card-body">
                <i class="fe fe-file fe-32 text-warning"></i>
                <h3 class="h5 mt-4 mb-1">Cetak laporan pendataan</h3>
                <button class="btn btn-primary" id="btn-cetak">Cetak laporan <i class="fe fe-file"></i></button>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row my-4">
    <div class="col-md-12 ">
        <div class="card shadow mb-4 form-tambah" style="display: none;">
            <div class="card-header">
                <strong class="card-title">Cetak laporan pdf <span style="background-color: lightseagreen; border-radius: 4px; color: #fff;">terbaru </span></strong> 
            </div>
            <div class="card-body">
                <div class="row col-md-12">
                    <span><strong>Pilih,</strong> Laporan yang sesuai</span>
                </div>
                <hr>
                <form class="form-tambah" action="<?= base_url('laporan/Laporan'); ?>" method="post">
                    <div class="form-group row">
                        <label for="Tlaporan" class="col-sm-3 col-form-label">Tipe Laporan:</label>
                        <div class="col-sm-9">
                            <select name="tipeLaporan" class="form-control" id="Tlaporan">
                                <option value="" selected>Pilih Tipe Laporan: </option>
                                <option value="semuaDataPemasukan">Semua data Pemasukan</option>
                                <option value="semuaDataPengeluaran">Semua data Pengeluaran</option>
                                <option value="semuaData">Semua data Pemasukan & Pengeluaran</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                            <strong><span>Atau, Rentang Tanggal: </span><br></strong> 
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggalAwal" class="col-sm-3 col-form-label">Tanggal Awal: </label><br>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="tanggalAwal" id="tanggalAwal">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggalAkhir" class="col-sm-3 col-form-label">Tanggal Akhir: </label><br>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="tanggalAkhir" id="tanggalAkhir">
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <button type="submit" class="btn btn-primary">Cetak laporan <i class="fe fe-book fe-16"></i></button><strong><span style="margin: 5px;"><strong>/</strong></span></strong><button class="btn" type="reset" onclick="$('.form-tambah').slideUp();">Batal</button>
                    </div>  
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const alert = document.querySelector('alert');
    setTimeout(function() {
        targetElement.style.display = 'none';
    }, 10000);

    $(document).ready(function() {
        $(document).on('click', '#btn-cetak', function() {
            $('.form-tambah').slideDown();
        });
    });
</script>