<h1>
	Realisasi Pelanggaran Pegawai
</h1>
<!-- <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i></a></li>
	<li class="active">Users</li>
</ol> -->

<!-- Main Content -->
<div class="box">
	<div class="box-header">
		<h3 class="box-title"><?= ucfirst($page) ?> Realisasi Pelanggaran Pegawai</h3>
		<div class="pull-right">
			<a href="<?= site_url('Admin/pelanggaran_pegawai') ?>" class="btn btn-warning btn-flat">
				<i class="fa fa-undo"></i> Kembali
			</a>
		</div>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<?php echo form_open_multipart('Admin/pelanggaran_pegawai/process') ?>
				<div class="form-group">
					<label>Nama Pegawai *</label>
					<input type="hidden" name="id" value="<?= $row->id_pelanggaran_peg ?>">
					<select name="pegawai" class="form-control" required>
						<option value="">- Pilih -</option>
						<?php foreach ($pegawai->result() as $key => $data) { ?>
							<option value="<?= $data->id_pegawai ?>" <?= $data->id_pegawai == $row->id_pegawai ? "selected" : null ?>><?= $data->nama_pegawai ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>List Pelanggaran *</label>
					<?php echo form_dropdown(
						'list_pelanggaran',
						$list_pelanggaran,
						$selectedlistpel,
						['class' => 'form-control', 'required' => 'required']
					) ?>
				</div>
				<div class="form-group">
					<label>Tanggal *</label>
					<input type="datetime-local" name="tanggal" value="<?= $row->tanggal ?>" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Lokasi *</label>
					<input type="text" name="lokasi" value="<?= $row->lokasi ?>" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Deskripsi</label>
					<input type="text" name="deskripsi" value="<?= $row->deskripsi ?>" class="form-control">
				</div>
				<div class="form-group">
					<label>Foto</label>
					<?php if ($page == 'edit') {
						if ($row->foto != null) { ?>
							<div style="margin-bottom: 5px">
								<img src="<?= base_url('uploads/' . $row->foto) ?>" style="width:100px">
							</div>
					<?php
						}
					} ?>
					<input type="file" name="image" class="form-control">
				</div>
				<div class="form-group">
					<button type="submit" name="<?= $page ?>" class="btn btn-success btn-flat">
						<i class="fa fa-paper-plane"></i> Simpan
					</button>
					<button type="reset" class="btn btn-flat">Reset</button>
				</div>
				<?php echo form_close() ?>
			</div>
		</div>
	</div>

</div>
