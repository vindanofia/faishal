<h1>
	Sanksi Mitra
</h1>
<!-- <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i></a></li>
	<li class="active">Users</li>
</ol> -->

<!-- Main Content -->
<?php $this->view('message') ?>
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Data Sanksi Mitra</h3>
		<div class="pull-right">
			<a href="<?= site_url('Member/sanksi_mitra/add') ?>" class="btn btn-primary btn-flat">
				<i class="fa fa-user-plus"></i> Tambah
			</a>
		</div>
	</div>
	<div class="box-body table-responsive">
		<table class="table table-bordered table-striped" id="table1">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Sanksi Mitra</th>
					<th>Point</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				foreach ($row->result() as $key => $data) { ?>
					<tr>
						<td><?= $no++ ?>.</td>
						<td><?= $data->nama_sanksi_mitra ?></td>
						<td><?= $data->point_sanksi_mitra ?></td>
						<td class="text-center" width="160px">
							<a href="<?= site_url('Member/sanksi_mitra/edit/' . $data->id_sanksi_mitra) ?>" class="btn btn-primary btn-xs">
								<i class="fa fa-pencil"></i> Ubah
							</a>
							<a href="<?= site_url('Member/sanksi_mitra/del/' . $data->id_sanksi_mitra) ?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-xs">
								<i class="fa fa-trash"></i> Delete
							</a>
							<!-- <input type="hidden" name="sanksi_mitra_id" value="<?= $data->id_sanksi_mitra ?>">
							<button onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-xs">
									<i class="fa fa-trash"></i> Hapus
								</button> -->
							</form>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

</div>
