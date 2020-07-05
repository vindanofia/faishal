<h1>
	Pegawai
</h1>
<!-- <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i></a></li>
	<li class="active">Users</li>
</ol> -->

<!-- Main Content -->
<?php $this->view('message') ?>
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Data Pegawai</h3>
		<div class="pull-right">
			<a href="<?= site_url('Admin/pegawai/add') ?>" class="btn btn-primary btn-flat">
				<i class="fa fa-user-plus"></i> Tambah
			</a>
			<a href="<?= site_url('Admin/pegawai/add') ?>" class="btn btn-primary btn-flat">
				<i class="fa fa-user-plus"></i> Import Excel
			</a>
		</div>
	</div>
	<div class="box-body table-responsive">
		<table class="table table-bordered table-striped" id="table1">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Pegawai</th>
					<th>NIP Pegawai</th>
					<th>Telepon</th>
					<th>Email</th>
					<th>Point</th>
					<th>Sanksi</th>
					<th>Potongan</th>
					<th>Opsi</th>
				</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#table1').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": {
				"url": "<?= site_url('Admin/pegawai/get_ajax') ?>",
				"type": "POST",
			},
			"columnDefs": [{
				"targets": [2, 3, 5, 6],
				"className": 'text-right'
			}, {
				"targets": [0, 8, -1],
				"className": 'text-center'
			}, {
				"targets": [0, 8, -1],
				"orderable": false
			}],
			"order": []
		})
	})
</script>
