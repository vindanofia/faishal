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
				<form action="<?= site_url('Member/pegawai/process'); ?>" method="post">
					<div class="form-group">
						<label>Nama Pegawai *</label>
						<input type="hidden" name="id" value="<?= $row->id_pegawai ?>">
						<input type="text" name="nama_peg" value="<?= $row->nama_pegawai ?>" class="form-control" required>
					</div>
					<div class="form-group">
						<label>NIP Pegawai *</label>
						<input type="text" name="nip_peg" value="<?= $row->nip_pegawai ?>" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Telp *</label>
						<input type="text" name="telp" value="<?= $row->telp ?>" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Email *</label>
						<input type="email" name="email" value="<?= $row->email ?>" class="form-control" required>
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
