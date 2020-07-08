<h1>
	Pegawai Mitra
</h1>
<!-- <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i></a></li>
	<li class="active">Users</li>
</ol> -->

<!-- Main Content -->
<div class="box">
	<div class="box-header">
		<h3 class="box-title"><?= ucfirst($page) ?> Data Pegawai Mitra</h3>
		<div class="pull-right">
			<a href="<?= site_url('Member/pegawai_mitra') ?>" class="btn btn-warning btn-flat">
				<i class="fa fa-undo"></i> Kembali
			</a>
		</div>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form action="<?= site_url('Member/pegawai_mitra/process'); ?>" method="post">
					<div class="form-group">
						<div class="form-group">
							<label>Perusahaan *</label>
							<?php echo form_dropdown(
								'mitra',
								$mitra,
								$selectedmitra,
								['class' => 'form-control', 'required' => 'required']
							) ?>
						</div>
						<label>Nama pegawai_mitra *</label>
						<input type="hidden" name="id" value="<?= $row->id_pegawai_mitra ?>">
						<input type="text" name="nama_pegawai_mitra" value="<?= $row->nama_pegawai_mitra ?>" class="form-control" required>
					</div>
					<div class="form-group">
						<label>NIP pegawai_mitra *</label>
						<input type="text" name="nip_pegawai_mitra" value="<?= $row->nip_pegawai_mitra ?>" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Telp *</label>
						<input type="text" name="telp_peg_mitra" value="<?= $row->telp_peg_mitra ?>" class="form-control" required>
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
