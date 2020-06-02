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
		<h3 class="box-title">Data Pegawai</h3>
		<div class="pull-right">
			<a href="<?= site_url('Admin/pegawai/add') ?>" class="btn btn-primary btn-flat">
				<i class="fa fa-user-plus"></i> Tambah
			</a>
		</div>
	</div>
	<div class="box-body table-responsive">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Pegawai</th>
					<th>NIP Pegawai</th>
					<th>Telepon</th>
					<th>Email</th>
					<th>Point</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				foreach ($row->result() as $key => $data) { ?>
					<tr>
						<td><?= $no++ ?>.</td>
						<td><?= $data->nama_pegawai ?></td>
						<td><?= $data->nip_pegawai ?></td>
						<td><?= $data->telp ?></td>
						<td><?= $data->email ?></td>
						<td><?= $data->point ?></td>
						<td class="text-center" width="160px">
							<!-- <form action="<?= site_url('Admin/pegawai/del') ?>" method="POST"> -->
							<!-- <a href="<?= site_url('Admin/pegawai/edit/' . $data->id_pegawai) ?>" class="btn btn-primary btn-xs">
									<i class="fa fa-pencil"></i> Ubah
								</a> -->
							<a href="<?= site_url('Admin/pegawai/del/' . $data->id_pegawai) ?>" onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-xs">
								<i class="fa fa-trash"></i> Delete
							</a>
							<!-- <input type="hidden" name="pegawai_id" value="<?= $data->id_pegawai ?>">
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
