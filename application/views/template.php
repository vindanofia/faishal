<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SHE - PJA</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
	<!-- Datatables -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/skins/_all-skins.min.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/bower_components/jvectormap/jquery-jvectormap.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<!-- Site wrapper -->
	<!-- Modal Awal -->
	<div class="modal fade in" id="my-modal">
		<div class="modal-dialog moda-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">x</button>
					<div class="modal-title">
						<h5>Edit Profile</h5>
					</div>
				</div>
				<div class="modal-body">
					<form id="mb">
						<div class="form-group <?= form_error('fullname') ? 'has-error' : null ?>">
							<label>Nama *</label>
							<input type="hidden" name="id" value="">
							<input type="text" name="fullname" class="form-control">
							<?= form_error('fullname') ?>
						</div>
						<div class="form-group <?= form_error('username') ? 'has-error' : null ?>">
							<label>Username *</label>
							<input type="text" name="username" class="form-control">
							<?= form_error('username') ?>
						</div>
						<div class="form-group <?= form_error('email') ? 'has-error' : null ?>">
							<label>Email *</label>
							<input type="email" name="email" class="form-control">
							<?= form_error('email') ?>
						</div>
						<div class="form-group <?= form_error('password') ? 'has-error' : null ?>">
							<label>Password</label><small> (Kosongi apabila tidak ada perubahan)</small>
							<input type="password" name="password" class="form-control">
							<?= form_error('password') ?>
						</div>
						<div class="form-group <?= form_error('passconf') ? 'has-error' : null ?>">
							<label>Ketik Ulang Password</label>
							<input type="password" name="passconf" class="form-control">
							<?= form_error('passconf') ?>
						</div>
						<div class="form-group clearfix">
							<button type="button" data-dismiss="modal">Batal</button>
							<button type="button" id='btn' class="btn btn-success pull-right">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- End Modal -->

	<div class="wrapper">

		<header class="main-header">
			<!-- Logo -->
			<a href="<?= base_url('Admin/dashboard'); ?>" class="logo">
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>SHE</b> PJA</span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<!-- Messages: style can be found in dropdown.less-->
						<!-- User Account: style can be found in dropdown.less -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?= base_url() ?>assets/dist/img/user.png" class="user-image" alt="User Image">
								<span class="hidden-xs"><?= $this->fungsi->user_login()->username ?></span>
							</a>
							<ul class="dropdown-menu">
								<!-- User image -->
								<li class="user-header">
									<img src="<?= base_url() ?>assets/dist/img/user.png" class="img-circle" alt="User Image">

									<p>
										<?= ucfirst($this->fungsi->user_login()->name) ?>
										<small><?= $this->fungsi->user_login()->email ?></small>
									</p>
								</li>
								<!-- Menu Footer-->
								<li class="user-footer">
									<div class="pull-left">
										<a href="<?= site_url('edit_profile/edit/' . $this->session->userdata('user_id')); ?>" class="btn btn-default btn-flat bg-red">Edit Profile</a>
									</div>
									<div class="pull-right">
										<a href="<?= site_url('auth/logout'); ?>" class="btn btn-default btn-flat bg-red">Sign out</a>
									</div>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
		</header>

		<!-- =============================================== -->

		<!-- Left side column. contains the sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel">
					<div class="pull-left image">
						<img src="<?= base_url() ?>assets/dist/img/user.png" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<p><?= ucfirst($this->fungsi->user_login()->username) ?></p>
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>
				<!-- search form -->
				<form action="#" method="get" class="sidebar-form">
					<div class="input-group">
						<input type="text" name="q" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</form>
				<!-- /.search form -->
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">MAIN NAVIGATION</li>
					<li <?= $this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
						<a href="<?= base_url('Admin/dashboard'); ?>">
							<i class="fa fa-dashboard"></i> <span>Dashboard</span>
						</a>
					</li>
					<li class="treeview <?= $this->uri->segment(1) == 'user' ||
											$this->uri->segment(1) == 'pegawai' ||
											$this->uri->segment(1) == 'mitra' ||
											$this->uri->segment(1) == 'jenis_pelanggaran' ||
											$this->uri->segment(1) == 'list_pelanggaran' ||
											$this->uri->segment(1) == 'jenis_penghargaan' ||
											$this->uri->segment(1) == 'sanksi' ? 'active' : '' ?> ">
						<a href="#">
							<i class="fa fa-files-o"></i>
							<span>Master Data</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li <?= $this->uri->segment(1) == 'user' ? 'class="active"' : '' ?>>
								<a href="<?= site_url('Admin/user'); ?>"><i class="fa fa-circle-o"></i> User</a></li>
							<li <?= $this->uri->segment(1) == 'pegawai' ? 'class="active"' : '' ?>>
								<a href="<?= site_url('Admin/pegawai'); ?>"><i class="fa fa-circle-o"></i> Pegawai</a></li>
							<li <?= $this->uri->segment(1) == 'mitra' ? 'class="active"' : '' ?>>
								<a href="<?= site_url('Admin/mitra'); ?>"><i class="fa fa-circle-o"></i> Perusahaan Mitra</a></li>
							<li <?= $this->uri->segment(1) == 'pegawai_mitra' ? 'class="active"' : '' ?>>
								<a href="<?= site_url('Admin/pegawai_mitra'); ?>"><i class="fa fa-circle-o"></i> Pegawai Mitra</a></li>
							<li <?= $this->uri->segment(1) == 'list_pelanggaran' ? 'class="active"' : '' ?>>
								<a href="<?= site_url('Admin/list_pelanggaran'); ?>"><i class="fa fa-circle-o"></i> Daftar Tindakan Pelanggaran</a></li>
							<li <?= $this->uri->segment(1) == 'jenis_penghargaan' ? 'class="active"' : '' ?>>
								<a href="<?= site_url('Admin/reward'); ?>"><i class="fa fa-circle-o"></i> Daftar Tindakan Apresiatif</a></li>
							<li <?= $this->uri->segment(1) == 'sanksi' ? 'class="active"' : '' ?>>
								<a href="<?= site_url('Admin/sanksi'); ?>"><i class="fa fa-circle-o"></i> Sanksi Pegawai</a></li>
							<li <?= $this->uri->segment(1) == 'sanksi_mitra' ? 'class="active"' : '' ?>>
								<a href="<?= site_url('Admin/sanksi_mitra'); ?>"><i class="fa fa-circle-o"></i> Sanksi Pegawai Mitra</a></li>
							<li <?= $this->uri->segment(1) == 'konten' ? 'class="active"' : '' ?>>
								<a href="<?= site_url('Admin/konten'); ?>"><i class="fa fa-circle-o"></i> Konten</a></li>
						</ul>
					</li>

					<!-- <li class="treeview">
						<a href="#">
							<i class="fa fa-laptop"></i>
							<span>Realisasi</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li><a href="<?= site_url('Admin/pelanggaran_pegawai'); ?>"><i class="fa fa-circle-o"></i> Pelanggaran Pegawai</a></li>
							<li><a href="<?= site_url('Admin/pelanggaran_mitra'); ?>"><i class="fa fa-circle-o"></i> Pelanggaran Mitra</a></li>
							<li><a href="<?= site_url('Admin/penghargaan_pegawai'); ?>"><i class="fa fa-circle-o"></i> Apresiasi Pegawai</a></li>
						</ul>
					</li> -->
				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- =============================================== -->
		<!-- jQuery 3 -->
		<script src="<?= base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">

			<!-- Main content -->
			<section class="content">

				<?php echo $contents ?>

			</section>

		</div>
		<!-- /.content-wrapper -->

		<footer class="main-footer">
			<strong>PT. Petro Jordan Abadi.</strong>
		</footer>

		<!-- Bootstrap 3.3.7 -->
		<script src="<?= base_url() ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- SlimScroll -->
		<script src="<?= base_url() ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<!-- FastClick -->
		<script src="<?= base_url() ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
		<!-- AdminLTE App -->
		<script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
		<!-- Datatables -->
		<script src="<?= base_url() ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
		<!-- Datatables -->
		<script src="<?= base_url() ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
		<!-- AdminLTE for demo purposes -->
		<script src="<?= base_url() ?>assets/dist/js/demo.js"></script>
		<!-- Sparkline -->
		<script src="<?= base_url() ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
		<!-- jvectormap  -->
		<script src="<?= base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
		<script src="<?= base_url() ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
		<!-- SlimScroll -->
		<!-- ChartJS -->
		<script src="<?= base_url() ?>assets/bower_components/chart.js/Chart.js"></script>
		<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
		<script src="<?= base_url() ?>assets/dist/js/pages/dashboard2.js"></script>
		<script src="<?= base_url() ?>assets/dist/dist/sweetalert2.all.min.js"></script>

		<script>
			$(document).ready(function() {
				$('#table1').DataTable()
			})
			$('#change').click(function(e) {
				e.preventDefault();
				$('#my-modal').modal({
					backdrop: 'static',
					show: true
				});
				id = $(this).data('id');
				// mengambil nilai data-id yang di click
				$.ajax({
					url: '<?= site_url('edit_profile/edit/') ?>' + id, //ini url manggil controller bukan?
					success: function(data) {
						$("input[name='id']").val(data.id);
						$("input[name='fullname']").val(data.name);
						$("input[name='username']").val(data.username);
						$("input[name='email']").val(data.email);
						$("input[name='password']").val(data.password);
					}
				});
			});
		</script>
</body>

</html>
