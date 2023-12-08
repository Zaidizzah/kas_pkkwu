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

<div class="col-md-12 my-4">
    <button class="btn btn-success" style="margin-bottom: 15px; box-shadow: 0 0 24px rgba(0, 0, 0, 0.1);" onclick="$('.form-tambah-pemasukan').fadeIn('slow'); $('.form-tambah-pemasukan').get(0).scrollIntoView({ behavior: 'smooth', block: 'end' });">Tambah Pemasukan <i class="fe fe-plus fe-16"></i></button>
    <div class="card shadow">
        <div class="card-body">
            <h2 class="h4 mb-1">Data-data Pemasukan.</h2>
            <p class="mb-3">Keterangan dan informasi mengenai Data-data pemasukan yang ada,</p>
            <div class="table-responsive" width="100%">
                <table id="tabel_dataPengguna" class="table table-stripped display">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Keterangan</th>
                            <th>Nominal Pemasukan</th>
                            <th>Pendata</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <?php if (isset($pemasukan)) : ?>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pemasukan as $data) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['keterangan'] ?></td>
                                <td>Rp. <?= number_format($data['nominal']) ?>,00</td>
                                <td><?= $data['username'] ?></td>
                                <td><?= $data['tanggal'] ?></td>
                                <td><button onclick="const konfirmasi = confirm('Apakah Anda yakin ingin menghapus data ini?'); if (konfirmasi === true){location.href='<?= base_url('pemasukan/hapusPemasukan/' . $data['id_transaksi']) ?>'}else{}" class="btn btn-danger" style="margin-left: 10px;" ><i class="fe fe-trash fe-16"></i></button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <td style="border: 2px solid lightgrey; border-right: none;"><strong>Jumlah data Pemasukan: </strong></td>
                        <td style="border: 2px solid lightgrey; border-left: none;"><?= count($pemasukan); ?></td>
                        <td style="border: 2px solid lightgrey; border-right: none;"><strong>Total Pemasukan: </strong></td>
                        <td style="border: 2px solid lightgrey; border-left: none;" colspan="3"><?php
                        $data_saldo = 0;
                        foreach ($pemasukan as $pmsk) {
                            $data_saldo += $pmsk['nominal'];
                        }
                        echo 'Rp '.number_format($data_saldo).',00';
                        ?></td>
                    </tfoot>
                    <?php ; else : ?>
                        <tbody>
                            <td colspan="6"><strong>Maaf,</strong> data Pemasukan tidak ada.</td>
                        </tbody>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="col-md-12 my-4">
    <div class="card shadow mb-4 form-tambah-pemasukan" style="display: none;">
        <div class="card-header">
            <strong class="card-title">Tambah data Pemasukan <span style="background-color: lightseagreen; border-radius: 4px; color: #fff;">baru</span></strong>
        </div>
        <div class="card-body">
            <form class="form-tbh-pemasukan" onsubmit="unformatNominal()" action="<?= base_url('pemasukan/tambah') ?>" method="post">
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-3 col-form-label">Keterangan Pemasukan:</label>
                    <div class="col-sm-9">
                        <textarea name="keterangan" autofocus class="form-control" id="keterangan" placeholder="Masukkan keterangan"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nominal" class="col-sm-3 col-form-label">Nominal Pemasukan:</label>
                    <div class="col-sm-9">
                        <input type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1'); formatNominal(this)" pattern="[0-9]*" 
                        title="Hanya nominal yang diperbolehkan" name="nominal" class="form-control" inputmode="numeric" id="nominal" placeholder="Masukkan nilai nominal">    
                    </div>
                </div>
                <div class="form-group mb-2">
                    <button onclick="event.preventDefault(); const konfirmasi_tambah = confirm('Apakah Anda yakin ingin menambah data baru?'); if (konfirmasi_tambah === true){cekFormTambah()}else{}" class="btn btn-primary">Tambah <i class="fe fe-plus fe-16"></i></button><strong><span style="margin: 5px;"><strong>/</strong></span></strong><button class="btn" onclick="event.preventDefault(); $('.form-tambah-pemasukan').fadeOut();">Batal</button>
                </div>  
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>
<script>
    new DataTable('#tabel_dataPengguna');
    function cekFormTambah() {
        const keterangan = document.getElementById('keterangan').value;
        const nominal = document.getElementById('nominal').value;
        
        if (keterangan === '' || nominal === '') {
            alert('Data tidak boleh ada yang kosong');
        } else {
            $('.form-tbh-pemasukan').submit();
        }
    }

    function formatNominal(input) {
        input.value = input.value.replace(/[^0-9]/g, '');

        const value = parseInt(input.value);
        if (!isNaN(value)) {
            input.value = `Rp. ${value.toLocaleString('id-ID')}`; // format angka dalam konteks uang rupiah
        } else {
            input.value = '';
        }
    }

    function unformatNominal() {
        const input = document.getElementById('nominal');
        const value = input.value.replace('Rp. ', '').replace(/\D/g, '');
        input.value = value;
    }
</script>