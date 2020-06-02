<h1>
	Users
</h1>
<!-- <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i></a></li>
	<li class="active">Users</li>
</ol> -->

<!-- Main Content -->
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Data User</h3>
		<div class="pull-right">
			<a href="<?= site_url('Admin/user/add') ?>" class="btn btn-primary btn-flat">
				<i class="fa fa-user-plus"></i> Tambah
			</a>
		</div>
	</div>
	<div class="box-body table-responsive">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>No</th>
					<th>Username</th>
					<th>Nama</th>
					<th>Email</th>
					<th>Level</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1;
				foreach ($row->result() as $key => $data) { ?>
					<tr>
						<td><?= $no++ ?>.</td>
						<td><?= $data->username ?></td>
						<td><?= $data->name ?></td>
						<td><?= $data->email ?></td>
						<td><?= $data->id_role == 1 ? "Admin" : "Member" ?></td>
						<td class="text-center" width="160px">
							<form action="<?= site_url('Admin/user/del') ?>" method="POST">
								<a href="<?= site_url('Admin/user/edit/' . $data->id_user) ?>" class="btn btn-primary btn-xs">
									<i class="fa fa-pencil"></i> Ubah
								</a>
								<input type="hidden" name="user_id" value="<?= $data->id_user ?>">
								<button onclick="return confirm('Apakah anda yakin?')" class="btn btn-danger btn-xs">
									<i class="fa fa-trash"></i> Hapus
								</button>
							</form>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

</div>
