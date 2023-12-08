<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Halaman Login</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;">
                    <div class="card-header">
                        <h3 class="text-center">Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo base_url('Login/login') ?>" method="post">
                            <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                            </div>
                            <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($this->session->flashdata('error')){ ?>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6 mt-5" width="100%">
                    <div class="alert alert-danger" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                        <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>
