<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="favicon.ico">
	<title>Pembukuan Kas Buku,</title>
	<!-- Simple bar CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/tinydash/') ?>css/simplebar.css">
	<!-- Fonts CSS -->
	<link
		href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
		rel="stylesheet">
	<!-- Icons CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/tinydash/') ?>css/feather.css">
	<link rel="stylesheet" href="<?= base_url('assets/tinydash/') ?>css/select2.css">
	<link rel="stylesheet" href="<?= base_url('assets/tinydash/') ?>css/dropzone.css">
	<link rel="stylesheet" href="<?= base_url('assets/tinydash/') ?>css/uppy.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/tinydash/') ?>css/jquery.steps.css">
	<link rel="stylesheet" href="<?= base_url('assets/tinydash/') ?>css/jquery.timepicker.css">
	<link rel="stylesheet" href="<?= base_url('assets/tinydash/') ?>css/quill.snow.css">
	<!-- Date Range Picker CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/tinydash/') ?>css/daterangepicker.css">
	<!-- App CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/tinydash/') ?>css/app-light.css" id="lightTheme">
	<link rel="stylesheet" href="<?= base_url('assets/tinydash/') ?>css/app-dark.css" id="darkTheme" disabled>
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">
    <script src="<?= base_url('assets/tinydash/') ?>js/jquery.min.js"></script>
</head>

<body class="vertical  light  ">
	<div class="wrapper">
		<nav class="topnav navbar navbar-light">
			<button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
				<i class="fe fe-menu navbar-toggler-icon"></i>
			</button>
			<ul class="nav">
				<li class="nav-item">
					<a class="nav-link text-muted pr-0"
						role="button" data-toggle="dropdown" id="navbarDropdownMenuLink" aria-haspopup="true" aria-expanded="false">
						<span class="avatar avatar-sm mt-2">
                            <?php if (file_exists('assets/upload/profile/profile-picture/'.$this->session->userdata('profile'))) { ?>
						        <img src="<?= base_url('assets/upload/profile/profile-picture/'.$this->session->userdata('profile')) ?>" alt="..." class="avatar-img rounded-circle">
                            <?php } else { ?>
                                <img src="<?= base_url('assets/upload/profile/'.$this->session->userdata('profile')) ?>" alt="..." class="avatar-img rounded-circle">
                            <?php } ?>
						</span>
					</a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="<?= base_url('profile?username='.$this->session->userdata('username')) ?>"><i class="fe fe-user fe-16"></i> Profile</a>
                        <a class="dropdown-item" href="<?= base_url('user/logout') ?>"><i class="fe fe-logout fe-16"></i> Logout</a>
                        <div class="dropdown-divider"></div>
                    </div>
				</li>
			</ul>
		</nav>
        <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
            <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
            <i class="fe fe-x"><span class="sr-only"></span></i>
            </a>
            <nav class="vertnav navbar navbar-light">
            <!-- nav bar -->
            <div class="w-100 mb-4 d-flex">
                <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="<?= base_url('dash') ?>">
                <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                    <g>
                    <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                    <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                    <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                    </g>
                </svg>
                <strong><span>Pembukuan <i class="fe fe-book fe-25"></i></span></strong>
                </a>
            </div>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item <?php if ($this->uri->segment(1) === 'Dash' || $this->uri->segment(1) === 'dash'){echo "active";} ?>">
                    <a href="<?= base_url('Dash') ?>" class="nav-link">
                        <i class="fe fe-home fe-16"></i>
                        <span class="ml-3 item-text">Dashboard</span><span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>
            <br>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item <?php if ($this->uri->segment(1) === 'Pemasukan' || $this->uri->segment(1) === 'pemasukan'){echo "active";} ?>">
                    <a href="<?= base_url('Pemasukan') ?>" class="nav-link">
                        <i class="fe fe-shopping-cart fe-16"></i>
                        <span class="ml-3 item-text">Pemasukan</span>
                    </a>
                </li>
                <li class="nav-item <?php if ($this->uri->segment(1) === 'Pengeluaran' || $this->uri->segment(1) === 'pengeluaran'){echo "active";} ?>">
                    <a href="<?= base_url('Pengeluaran') ?>" class="nav-link">
                        <i class="fe fe-shopping-cart fe-16"></i>
                        <span class="ml-3 item-text">Pengeluaran</span>
                    </a>
                </li>
                <li class="nav-item <?php if ($this->uri->segment(1) === 'User' || $this->uri->segment(1) === 'user' || $this->uri->segment(1) === 'profile'){echo "active";} ?>">
                    <a href="<?= base_url('User') ?>" class="nav-link">
                        <i class="fe fe-user fe-16"></i>
                        <span class="ml-3 item-text">User</span>
                    </a>
                </li>
            </ul>
            </nav>
        </aside>
        <main role="main" class="main-content">
            <div class="container-fluid">