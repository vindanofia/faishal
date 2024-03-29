<h1>
	Realisasi Apresiasi Pegawai
</h1>
<!-- <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i></a></li>
	<li class="active">Users</li>
</ol> -->

<!-- Main Content -->
<?php $this->view('message') ?>
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Data Realisasi Apresiasi Pegawai</h3>
		<div class="pull-right">
			<a href="<?= site_url('Member/penghargaan_pegawai/add') ?>" class="btn btn-primary btn-flat">
				<i class="fa fa-user-plus"></i> Tambah
			</a>
			<a href="<?= site_url('Member/penghargaan_pegawai/export_pdf') ?>" target="_blank" class="btn btn-primary btn-flat">
				<i class="fa fa-print"></i> Cetak PDF
			</a>
		</div>
	</div>
	<div class="box-body table-responsive">
		<table class="table table-bordered table-striped" id="table1">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama Pegawai</th>
					<th>Tindakan Apresiasi</th>
					<th>Tanggal</th>
					<th>Lokasi</th>
					<th>Deskripsi</th>
					<th>Point</th>
					<th>Gambar</th>
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
				"url": "<?= site_url('Member/penghargaan_pegawai/get_ajax') ?>",
				"type": "POST",
			},
			"columnDefs": [{
				"targets": [2, 3, 5, 6],
				"className": 'text-right'
			}, {
				"targets": [0, 7, -1],
				"className": 'text-center'
			}, {
				"targets": [0, 7, -1],
				"orderable": false
			}],
			"order": []
		})
	})
</script>
