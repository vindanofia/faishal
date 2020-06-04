<h1>
	Jenis Pelanggaran
</h1>
<!-- <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i></a></li>
	<li class="active">Users</li>
</ol> -->

<!-- Main Content -->
<div class="box">
	<div class="box-header">
		<h3 class="box-title"><?= ucfirst($page) ?> Data Jenis Pelanggaran</h3>
		<div class="pull-right">
			<a href="<?= site_url('Admin/jenis_pelanggaran') ?>" class="btn btn-warning btn-flat">
				<i class="fa fa-undo"></i> Kembali
			</a>
		</div>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form action="<?= site_url('Admin/jenis_pelanggaran/process'); ?>" method="post">
					<div class="form-group">
						<label>Nama jenis_pelanggaran *</label>
						<input type="hidden" name="id" value="<?= $row->id_jenis_pel ?>">
						<input type="text" name="nama_pel" value="<?= $row->nama_jenis_pel ?>" class="form-control" required>
					</div>
					<div class="form-group">
						<button type="submit" name="<?= $page ?>" class="btn btn-success btn-flat">
							<i class="fa fa-paper-plane"></i> Simpan
						</button>
						<button type="reset" class="btn btn-flat">Reset</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>
