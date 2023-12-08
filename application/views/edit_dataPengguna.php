<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
    <div class="card-header">
        <strong class="card-title">Ubah data Pengguna</strong>
    </div>
    <div class="card-body">
        <form action="<?= base_url('user/editData') ?>" method="post">
            <input type="hidden" name="id_user" id="" value="<?= $data->id_user ?>">
            <div class="form-group row">
                <label for="username" class="col-sm-3 col-form-label">Username:</label>
                <div class="col-sm-9">
                    <input type="text" name="username" class="form-control" id="username" disabled readonly value="<?= $data->username ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-3 col-form-label">Nama:</label>
                <div class="col-sm-9">
                    <input type="text" name="nama" class="form-control" id="nama"  value="<?= $data->nama ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="level" class="col-sm-3 col-form-label">Tipe Pengguna:</label>
                <div class="col-sm-9">
                    <select name="level" id="level" class="form-control">
                        <option value="Admin" <?php if ($data->level == 'Admin') {echo "selected";} ?>>Admin</option>
                        <option value="User" <?php if ($data->level == 'User') {echo "selected";} ?>>User</option>
                    </select>
                </div>
            </div>
            <div class="form-group mb-2">
                <button onclick="event.preventDefault(); const konfirmasi = confirm('Apakah Anda yakin ingin mengedit data ini?'); if (konfirmasi === true){submit()}else{}" class="btn btn-primary">Ubah</button><strong>/</strong><button class="btn btn-batal-edit"><a style="text-decoration: none; color: black;" href="javascript:void(0)">Batal & Kembali</a></button>
            </div>
        </form>
    </div>
