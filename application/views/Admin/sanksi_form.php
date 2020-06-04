<h1>
	Sanksi
</h1>
<!-- <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i></a></li>
	<li class="active">Users</li>
</ol> -->

<!-- Main Content -->
<div class="box">
	<div class="box-header">
		<h3 class="box-title"><?= ucfirst($page) ?> Data Sanksi</h3>
		<div class="pull-right">
			<a href="<?= site_url('Admin/sanksi') ?>" class="btn btn-warning btn-flat">
				<i class="fa fa-undo"></i> Kembali
			</a>
		</div>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form action="<?= site_url('Admin/sanksi/process'); ?>" method="post">
					<div class="form-group">
						<label>Nama sanksi *</label>
						<input type="hidden" name="id" value="<?= $row->id_sanksi ?>">
						<input type="text" name="nama_sanksi" value="<?= $row->nama_sanksi ?>" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Point *</label>
						<input type="number" name="point_sanksi" value="<?= $row->point_sanksi ?>" class="form-control" required>
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
