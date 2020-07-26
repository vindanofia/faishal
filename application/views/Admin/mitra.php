<h1>
	Mitra
</h1>
<!-- <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i></a></li>
	<li class="active">Users</li>
</ol> -->

<!-- Main Content -->
<?php $this->view('message') ?>
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Data Mitra</h3>
		<div class="pull-right">
			<a href="<?= site_url('Admin/mitra/add') ?>" class="btn btn-primary btn-flat">
				<i class="fa fa-user-plus"></i> Tambah
			</a>
		</div>
	</div>
	<div class="box-body table-responsive">
		<table class="table table-bordered table-striped" id="table1">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama mitra</th>
					<th>Kode mitra</th>
					<th>Telepon</th>
					<th>Email</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				foreach ($row->result() as $key => $data) { ?>
					<tr>
						<td><?= $no++ ?>.</td>
						<td><?= $data->nama_mitra ?></td>
						<td><?= $data->kode_mitra ?></td>
						<td><?= $data->telp ?></td>
						<td><?= $data->email ?></td>
						<td class="text-center" width="160px">
							<a href="<?= site_url('Admin/mitra/edit/' . $data->id_mitra) ?>" class="btn btn-primary btn-xs">
								<i class="fa fa-pencil"></i> Ubah
							</a>
							<a href="<?= site_url('Admin/mitra/del/' . $data->id_mitra) ?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-xs">
								<i class="fa fa-trash"></i> Hapus
							</a>
							<!-- <input type="hidden" name="mitra_id" value="<?= $data->id_mitra ?>">
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
