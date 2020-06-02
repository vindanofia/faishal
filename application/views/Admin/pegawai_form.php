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
		<h3 class="box-title">Tambah Data Pegawai</h3>
		<div class="pull-right">
			<a href="<?= site_url('Admin/pegawai') ?>" class="btn btn-warning btn-flat">
				<i class="fa fa-undo"></i> Kembali
			</a>
		</div>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form action="<?= site_url('Admin/pegawai/process'); ?>" method="post">
					<div class="form-group">
						<label>Nama Pegawai *</label>
						<input type="text" name="name_peg" value="<?= set_value('name_peg') ?>" class="form-control">
					</div>
					<div class="form-group">
						<label>NIP Pegawai *</label>
						<input type="text" name="nip_peg" value="<?= set_value('nip_peg') ?>" class="form-control">
					</div>
					<div class="form-group">
						<label>Telp *</label>
						<input type="text" name="telp" value="<?= set_value('telp') ?>" class="form-control">
					</div>
					<div class="form-group">
						<label>Email *</label>
						<input type="email" name="email" value="<?= set_value('email') ?>" class="form-control">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success btn-flat">
							<i class="fa fa-paper-plane"></i> Simpan
						</button>
						<button type="reset" class="btn btn-flat">Reset</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</div>
