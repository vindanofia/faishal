<h1>
	Pegawai
</h1>
<!-- <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i></a></li>
	<li class="active">Users</li>
</ol> -->

<!-- Main Content -->
<div class="box">
	<div class="box-header">
		<h3 class="box-title"><?= ucfirst($page) ?> Data Pegawai</h3>
		<div class="pull-right">
			<a href="<?= site_url('Member/pegawai') ?>" class="btn btn-warning btn-flat">
				<i class="fa fa-undo"></i> Kembali
			</a>
		</div>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<p class="alert alert-info">Anda dapat download Format Excel
					<a href="<?= site_url('Member/pegawai/downloadFormat'); ?>"><strong>Disini</strong></a>
				</p>
				<form action="<?= site_url('Member/pegawai/processImport'); ?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>File *</label>
						<input type="file" name="file_excel" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" class="form-control" required>
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
