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

<?php if (isset($data_profile)) { ?>
<style>
    img[src=""] {
        display: none;
    }
</style>
<div class="row justify-content-center" style="border-bottom: 0.5px solid grey;">
	<div class="col-12">
		<h2 class="h3 mb-4 page-title"><span style="border-bottom: 2px solid orange;">Profile</span> <span
				class="badge badge-primary"><?= $data_profile->username ?></span></h2>
		<div class="row mt-5 align-items-center">
            <div class="col-md-3 text-center mb-5">
                <div class="avatar avatar-xl">
                    <?php if (file_exists('assets/upload/profile/profile-picture/' . $data_profile->foto_profile)) {?>
                        <img src="<?= base_url('assets/upload/profile/profile-picture/'. $data_profile->foto_profile . '?'.time() . '&w=300&h=300&q=100&fit=contain')?>" alt="..." class="avatar-img rounded-circle" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;" width="100%" height="100%">
                    <?php } else if (file_exists('assets/upload/profile/' . $data_profile->foto_profile)) { ?>
                        <img src="<?= base_url('assets/upload/profile/'. $data_profile->foto_profile . '?'.time() . '&w=300&h=300&q=100&fit=contain') ?>" alt="..." class="avatar-img rounded-circle" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;" width="100%" height="100%">
                    <?php } else { ?>
                        <img src="<?= base_url('assets/tinydash/assets/avatars/face-1.jpg') ?>" alt="..." class="avatar-img rounded-circle" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;" width="100%" height="100%">
                    <?php } ?>
                </div>
            </div>
			<div class="col">
				<div class="row align-items-center">
					<div class="col-md-7">
						<h4><?= $data_profile->level ?>, <span style="border-bottom: 2px solid orange;"><?= $data_profile->username ?></span></h4>
						<p class="small mb-3"><span class="badge badge-dark">
                            <?php if (isset($data_diri)) {
                                if ($data_diri->kecamatan != null && $data_diri->kabupaten != null && $data_diri->provinsi != null ){
                                    echo ucfirst($data_diri->kecamatan).', '.ucfirst($data_diri->kabupaten).', '.ucfirst($data_diri->provinsi);
                                } else {
                                    echo "---";     
                                }
                            }
                            if ($data_diri == null) {
                                echo "---";
                            } ?>
                        </span></p>
					</div>
				</div>
				<div class="row mb-4">
					<div class="col-md-7">
						<p class="text-muted"><?php if (isset($data_diri)) {
                            if ($data_diri->deskripsi != null){
                                echo '<strong>Deskripsi:</strong> '.ucfirst($data_diri->deskripsi);
                            } else {
                                echo "<strong>Deskripsi:</strong> ---";     
                            }
                        }
                        if ($data_diri == null) {
                            echo "<strong>Deskripsi:</strong> ---";
                        } ?></p>
					</div>
					<div class="col">
                        <?php if (isset($data_diri)) { ?>
                        <p class="small mb-0 text-muted"><strong>Tentang:</strong></p>
						<p class="small mb-0 text-muted"><?php if ($data_diri->email != null){echo 'Email: '.$data_diri->email;} ?></p>
						<p class="small mb-0 text-muted"><?php if ($data_diri->alamat != null){echo 'Alamat: '.ucfirst($data_diri->alamat).', ';} ?></p>
                        <p class="small mb-0 text-muted"><?php if ($data_diri->kecamatan != null){echo ucfirst($data_diri->kecamatan).', ';}
                                                               if ($data_diri->kabupaten != null){echo ucfirst($data_diri->kabupaten).', ';}
                                                               if ($data_diri->provinsi != null){echo ucfirst($data_diri->provinsi).', ';} ?></p>
						<p class="small mb-0 text-muted"><?php if ($data_diri->no_telp != null){$no_telp = preg_replace('/^0/', '+62', $data_diri->no_telp); echo 'No_telp: '.$no_telp;} ?></p>
                        <?php } if ($data_diri == null) { ?>
                            <p class="small mb-0 text-muted"><strong>Tentang:</strong> ---</p>
                        <?php } ?>
					</div>
				</div>
			</div>
		</div>
        <!-- Validasi user/pengguna itu sendiri -->
        <?php if ($this->session->userdata('username') == $data_profile->username) : ?>
		<div class="row">
			<div class="col-md-4">
				<div class="card mb-4 shadow">
					<div class="card-body my-n3">
						<div class="row align-items-center">
							<div class="col">
								<span>
									<h3 class="h5 mt-4 mb-2" style="border-bottom: 2px solid grey">Ubah Foto Profile</h3>
								</span>

								<!-- Form profile -->
								<div class="card mb-2 mt-2">
									<div class="card-header">
										<strong class="card-title">Ubah Foto Anda,</strong>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-12">
                                                <div id="img-preview" style="border: 1px solid grey; max-height: 420px;">
                                                    <?php if (file_exists('assets/upload/profile/profile-picture/' . $data_profile->foto_profile)) {?>
                                                        <img src="<?= base_url('assets/upload/profile/profile-picture/'. $data_profile->foto_profile)?>" alt="..." class="avatar-img" style="width: 100%; height: 400px; object-fit: contain; padding: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;" data-data-profile-asli="<?= base_url('assets/upload/profile/profile-picture/'.$data_profile->foto_profile) ?>" width="100%" height="100%">
                                                    <?php } else if (file_exists('assets/upload/profile/' . $data_profile->foto_profile)) { ?>
                                                        <img src="<?= base_url('assets/upload/profile/'. $data_profile->foto_profile) ?>" alt="..." class="avatar-img" style="width: 100%; height: 400px; object-fit: contain; padding: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;" data-data-profile-asli="<?= base_url('assets/upload/profile/'.$data_profile->foto_profile) ?>" width="100%" height="100%">
                                                    <?php } else { ?>
                                                        <img src="<?= base_url('assets/tinydash/assets/avatars/face-1.jpg') ?>" alt="..." class="avatar-img" style="width: 100%; height: 400px; object-fit: contain; padding: 10px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;" data-data-profile-asli="<?= base_url('assets/tinydash/assets/avatars/face-1.jpg') ?>" width="100%" height="100%">
                                                    <?php } ?>
                                                </div>
                                                <form id="ubah_profile" action="<?= base_url('profile/edit_foto_profile') ?>" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="username" value="<?= $this->session->userdata('username') ?>">
                                                    <div class="form-group pb-2 mt-2" style="border-top: 1px solid grey;">
                                                        <label for="simpleinput">Foto profile:</label>
                                                        <input type="file" class="form-control-file" name="file" id="file">
                                                    </div>
                                                    <hr style="display: block;">
                                                    <p style="margin: 0 auto;" id="dimensiGambar"></p>
                                                    <p id="ukuranGambar"></p>
                                                    <button type="submit" class="btn btn-primary" 
                                                        onclick="const konfirmasi = confirm('Apakah anda yakin untuk mengganti foto profile anda?'); if (konfirmasi === false){event.preventDefault();}else{$('#ubah_profile').submit();}">Ubah</button>
                                                    <button type="reset" class="btn btn-warning ml-2" id="resetGambar">Batal</button>
                                                </form>
											</div> 
										</div>
									</div>
								</div>
								<!-- /Form profile -->
							</div>
						</div> 
					</div> 
				</div> 

                <div class="card mb-4 shadow">
					<div class="card-body my-n3">
						<div class="row align-items-center">
							<div class="col">
								<span>
									<h3 class="h5 mt-4 mb-1" style="border-bottom: 2px solid grey">Ubah Password</h3>
                                </span>
								
                                <div class="card mb-2 mt-2">
									<div class="card-header">
										<strong class="card-title">Ubah Password Anda,</strong>
									</div>
									<div class="card-body">
                                        <form action="<?= base_url('profile/ubah_password') ?>" method="post">
                                            <input type="hidden" name="id" value="<?= $data_profile->id_user ?>">
                                            <div class="form-group">
                                                <label for="">Password lama</label>
                                                <input type="password" name="password_lama" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Password baru</label>
                                                <input type="password" name="password_baru" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Konfirmasi Password baru</label>
                                                <input type="password" name="konfirmasi_password_baru" class="form-control">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Ubah</button><button type="reset" class="btn btn-warning ml-2">Batal</button>
                                        </form>
                                    </div>
                                </div>
							</div> 
						</div> 
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="card mb-4 shadow">
					<div class="card-body my-n3">
						<div class="row align-items-center">
							<div class="col">
                                <span>
									<h3 class="h5 mt-4 mb-2" style="border-bottom: 2px solid grey">Ubah Data diri Anda</h3>
                                </span>

                                <div class="card mb-2 mt-2">
									<div class="card-header">
										<strong class="card-title">Ubah Foto Anda,</strong>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-md-12">
                                                <form action="<?= base_url('profile/edit_data_profile') ?>" method="post">
                                                    <input type="hidden" name="id" value="<?= $data_profile->id_user ?>">
                                                    <div class="form-group">
                                                        <label for="simpleinput">Username:</label>
                                                        <input type="text" readonly disabled class="form-control" value="<?= $data_profile->username ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="simpleinput">Password:</label>
                                                        <input type="text" readonly disabled class="form-control" value="<?= $data_profile->password ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="simpleinput">Nama:</label>
                                                        <input type="text" title="Edit nama Anda," id="nama" name="nama" class="form-control" value="<?= $data_profile->nama ?>" data-nama="<?= $data_profile->nama ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="simpleinput">Tipe pengguna:</label>
                                                        <input type="text" readonly disabled class="form-control" value="<?= $data_profile->level ?>">
                                                    </div>
                                                    <hr>
                                                    <!-- Keterangan tambahan -->
                                                    
                                                    <div class="form-group">
                                                        <label for="simpleinput">Deskripsi Anda:</label>
                                                        <textarea class="form-control" name="deskripsi"><?= $data_diri == null ? '': $data_diri->deskripsi ?></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="simpleinput">No_telp:</label>
                                                        <input type="text" class="form-control" value="<?= $data_diri == null ? '': $data_diri->no_telp ?>" name="no_telp" inputmode="tel">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="simpleinput">Alamat Rumah:</label>
                                                        <input type="text" class="form-control" value="<?= $data_diri == null ? '': $data_diri->alamat ?>" name="alamat">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="simpleinput">Kecamatan:</label>
                                                        <input type="text" class="form-control" value="<?= $data_diri == null ? '': $data_diri->kecamatan ?>" name="kecamatan">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="simpleinput">Kota/Kabupaten:</label>
                                                        <input type="text" class="form-control" value="<?= $data_diri == null ? '': $data_diri->kabupaten ?>" name="kota">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="simpleinput">Provinsi:</label>
                                                        <input type="text" class="form-control" value="<?= $data_diri == null ? '': $data_diri->provinsi ?>" name="prov">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="simpleinput">Email Anda:</label>
                                                        <input type="email" class="form-control" value="<?= $data_diri == null ? '': $data_diri->email ?>" name="email" inputmode="email">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Ubah</button><button type="reset" class="btn btn-warning ml-2" id="batal-edit">Batal</button>
                                                </form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        <?php endif; ?>
	</div>
</div>

<script>
var gambarUkuran = $('#dimensiGambar');
var ukuranGambar = $('#ukuranGambar');
var imagePreview = $('#img-preview').find('img');
var fileInput = $('#file');
var resetButton = $('#resetGambar');

resetButton.click(function() {
    event.preventDefault();
    fileInput.val('');
    ukuranGambar.text('');
    gambarUkuran.text('');
    let dataProfile = imagePreview.data('data-profile-asli');
    imagePreview.attr('src', dataProfile);
});

$('#file').on('change', function() {
    var input = this;
    gambarUkuran.text('');
    ukuranGambar.text('');
    
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var url = e.target.result;
            imagePreview.attr('src', url);

            var fileSize = input.files[0].size; 
            var fileSizeKB = fileSize / 1024;
            gambarUkuran.append(fileSizeKB.toFixed(2) + ' KB');

            // Memuat diimensi gambar terlebih dahulu
            // Lebar dan tinggi gambar,,
            var image = new Image();
            image.src = url;
            image.onload = function() {
                var width = image.width;
                var height = image.height;
                let lebar = width + ' pixels';
                let tinggi = height + ' pixels';
                ukuranGambar.append(lebar+' x '+tinggi);
            };
        };
        
        reader.readAsDataURL(input.files[0]);
    }
});

$('#batal-edit').on('click', function() {
    $('#nama').val('');
    const nama = $('#nama').data('nama');
    $('#nama').val(nama);
});


</script>
<?php } else { ?>
<div class="row my-4">
    <div class="col-lg-12 col-md-12">
        <h1>Error!,</h1>
        <p>Maaf terjadi kesalahan dalam memuat halaman ini, mohon tunggu beberapa saat lagi dan muat ulang halaman ini</p>
    </div>
</div>
<?php } ?>