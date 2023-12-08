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
    <?php if ($this->session->userdata('level') === 'Admin') : ?>
        <button class="btn btn-primary" style="box-shadow: 0 0 24px rgba(0, 0, 0, 0.1); margin-bottom: 15px;" onclick="$('.form-tambah').fadeIn('slow'); $('.form-tambah').get(0).scrollIntoView({ behavior: 'smooth', block: 'end' });">tambah data baru <i class="fe fe-plus fe-16"></i></button>
    <?php endif; ?>
    <div class="card shadow">
        <div class="card-body">
            <h2 class="h4 mb-1">Data-data Pengguna.</h2>
            <p class="mb-3">Keterangan dan informasi mengenai Data-data pengguna yang ada,</p>
            <div class="table-responsive" width="100%">
                <table id="tabel_dataPengguna" class="table table-stripped display">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Level</th>
                            <th>Profile</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($dataUser as $data) { ?>
                            <tr>
                                <td><?= ++$no ?></td>
                                <td><?= $data['username'] ?><?php if ($this->session->userdata('username') === $data['username']){echo '(Anda)';} ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td><?= $data['level'] ?></td>
                                <td><a href="<?= base_url('profile?username=' . $data['username'] . '') ?>">Kunjungi</a></td>

                                <?php if ($this->session->userdata('level') === 'User' && $this->session->userdata('username') === $data['username']) { ?>
                                    <td><a class="btn btn-warning" style="color: #fff; text-decoration: none;" href="<?= base_url('profile?username='.$this->session->userdata('username')) ?>"><i class="fe fe-edit fe-16"></i></a></td>
                                <?php }  else if ($this->session->userdata('level') === 'Admin' && $this->session->userdata('username') === $data['username']) { ?>
                                    <td><a class="btn btn-warning" style="color: #fff; text-decoration: none;" href="<?php if ($this->session->userdata('username') === $data['username']){echo base_url('profile?username='.$this->session->userdata('username'));} ?>"><i class="fe fe-edit fe-16"></i></a><span style="margin-left: 10px;">---</span></td>
                                <?php } else if ($this->session->userdata('level') === 'Admin') { ?> 
                                    <td><a class="btn btn-warning edit-btn" style="color: #fff; text-decoration: none;" href="javascript:void(0)" data-id="<?= $data['id_user'] ?>"><i class="fe fe-edit fe-16"></i></a><button onclick="const konfirmasi = confirm('Apakah Anda yakin ingin menghapus data ini?'); if (konfirmasi === true){location.href='<?= base_url('user/hapus_data/' . $data['id_user']) ?>'}else{}" class="btn btn-danger" style="margin-left: 10px;" ><i class="fe fe-trash fe-16"></i></button>
                                <?php } else {echo '<td>---</td>';} ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<hr>
<!-- Tag Edit data pengguna -->
<div class="col-md-12 my-4">
    <div class="card shadow mb-4" id="form-edit" style="display: none;">
        
    </div>
</div>
<!-- Tag Edit data pengguna -->
<hr>
<!-- Tag Tambah data pengguna -->
<div class="col-md-12 my-4">
    <div class="card shadow mb-4 form-tambah" style="display: none;">
        <div class="card-header">
            <strong class="card-title">Tambah data Pengguna <span style="background-color: lightseagreen; border-radius: 4px; color: #fff;">baru</span></strong>
        </div>
        <div class="card-body">
            <form class="form-tambah" action="<?= base_url('user/tambah') ?>" method="post">
                <div class="form-group row">
                    <label for="username" class="col-sm-3 col-form-label">Username:</label>
                    <div class="col-sm-9">
                        <input type="text" autofocus name="username" class="form-control" id="username" placeholder="Masukkan username">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama:</label>
                    <div class="col-sm-9">
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan nama">    
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-3 col-form-label">Password:</label>
                    <div class="col-sm-9">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password"> 
                        <button id="togglePassword" onclick="event.preventDefault(); lihatPassword()">Lihat Password</button>   
                    </div>
                </div>
                <div class="form-group row">
                    <label for="level" class="col-sm-3 col-form-label">Tipe Pengguna:</label>
                    <div class="col-sm-9">
                        <select name="level" id="level" class="form-control">
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <button onclick="event.preventDefault(); const konfirmasi_tambah = confirm('Apakah Anda yakin ingin menambah data baru?'); if (konfirmasi_tambah === true){cekFormTambah()}else{}" class="btn btn-primary">Tambah <i class="fe fe-plus fe-16"></i></button><strong><span style="margin: 5px;"><strong>/</strong></span></strong><button class="btn" onclick="event.preventDefault(); $('.form-tambah').fadeOut();">Batal</button>
                </div>  
            </form>
        </div>
    </div>
</div>
<!-- Tag Tambah data pengguna -->
<script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>
<script>
    new DataTable('#tabel_dataPengguna');
    function cekFormTambah() {
        const username = document.getElementById('username').value;
        const nama = document.getElementById('nama').value;
        const password = document.getElementById('password').value;
        const level = document.getElementById('level').value;
        
        if (username === '' || nama === '' || password === '' || level === '') {
            alert('Data tidak boleh ada yang kosong');
        } else {
            $('.form-tambah').submit();
        }
    }

    function lihatPassword() {
        const passwordField = document.getElementById('password');
        const toggleButton = document.getElementById('togglePassword');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            toggleButton.textContent = 'Sembunyikan Password';
        } else {
            passwordField.type = 'password';
            toggleButton.textContent = 'Lihat Password';
        }
    }
    
    document.getElementById('password').addEventListener('blur', function() {
        console.log('blur');
        const passwordField = document.getElementById('password');
        const toggleButton = document.getElementById('togglePassword');
        if (passwordField.value === ''){
            passwordField.type = 'password';
            toggleButton.textContent = 'Lihat Password';
        }
        passwordField.type = 'password';
        toggleButton.textContent = 'Lihat Password';
    });

    $(document).ready(function() {
        $('.edit-btn').on('click', function() {
            const userId = $(this).data('id');

            $.ajax({
                url: '<?= base_url('user') ?>/halaman_edit/' + userId,
                method: 'GET',
                success: function(response) {
                    $('#form-edit').fadeIn('slow', function() {
                        $('#form-edit').html(response);
                    });
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        });

        $(document).on('click', '.btn-batal-edit', function() {
            $('#form-edit').fadeOut('slow');
        });
    });

</script>
