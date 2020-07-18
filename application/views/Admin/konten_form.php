<h1>
	Konten
</h1>
<!-- <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i></a></li>
	<li class="active">Users</li>
</ol> -->

<!-- Main Content -->
<div class="box">
	<div class="box-header">
		<h3 class="box-title"><?= ucfirst($page) ?> Data Konten</h3>
		<div class="pull-right">
			<a href="<?= site_url('Admin/konten') ?>" class="btn btn-warning btn-flat">
				<i class="fa fa-undo"></i> Kembali
			</a>
		</div>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<?php echo form_open_multipart('Admin/konten/process') ?>
				<div class="form-group">
					<label>Judul Konten *</label>
					<input type="hidden" name="id" value="<?= $row->id_konten ?>">
					<input type="text" name="judul_konten" value="<?= $row->judul_konten ?>" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Deskripsi *</label>
					<textarea name="deskripsi_konten" style="width:395px; height:80px" class="form-control" required><?= $row->deskripsi_konten ?></textarea>
				</div>
				<div class="form-group">
					<label>Gambar *</label>
					<?php if ($page == 'edit') {
						if ($row->foto != null) { ?>
							<div style="margin-bottom: 5px">
								<img src="<?php echo base_url(); ?>uploads/konten/<?= $row->foto ?>" style="width:80%">
							</div>
					<?php
						}
					} ?>
					<input type="file" name="image" class="form-control" required>
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
