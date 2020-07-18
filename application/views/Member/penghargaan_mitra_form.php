<h1>
	Realisasi Penghargaan Mitra
</h1>
<!-- <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i></a></li>
	<li class="active">Users</li>
</ol> -->

<!-- Main Content -->
<div class="box">
	<div class="box-header">
		<h3 class="box-title"><?= ucfirst($page) ?> Realisasi Penghargaan mitra</h3>
		<div class="pull-right">
			<a href="<?= site_url('Member/penghargaan_mitra') ?>" class="btn btn-warning btn-flat">
				<i class="fa fa-undo"></i> Kembali
			</a>
		</div>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<?php echo form_open_multipart('Member/penghargaan_mitra/process') ?>
				<div class="form-group">
					<label>Nama Perusahaan *</label>
					<input type="hidden" name="id" value="<?= $row->id_penghargaan_mitra ?>">
					<?php echo form_dropdown(
						'mitra',
						$mitra,
						$selectedmitra,
						['class' => 'form-control', 'required' => 'required', 'onChange' => 'getPegawai(this)']
					) ?>
				</div>
				<div class="form-group">
					<label>Nama Pegawai *</label>
					<?php echo form_dropdown(
						'pegawai_mitra',
						$pegawai_mitra,
						$selectedpegmitra,
						['class' => 'form-control', 'required' => 'required']
					) ?>
				</div>
				<div class="form-group">
					<label>Jenis penghargaan *</label>
					<?php echo form_dropdown(
						'jenis_penghargaan',
						$jenis_penghargaan,
						$selectedjenispel,
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

<script>
	var getPegawai = function(e) {
		$.get('pegawai_mitra/' + $(e).val(), function(result) {
			$('select[name="pegawai_mitra"]').empty();
			if (result.length > 0) {
				$.each(result, function(index, value) {
					$('select[name="pegawai_mitra"]').append('<option value=\
					"' + value.id_pegawai_mitra + '">' + value.nama_pegawai_mitra + '</option>');
				});
			} else {
				$('select[name="pegawai_mitra"]').append('<option>- Pilih -</option>');
			}
		})
	}
</script>
