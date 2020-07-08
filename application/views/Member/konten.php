<h1>
	Realisasi Konten
</h1>
<!-- <ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i></a></li>
	<li class="active">Users</li>
</ol> -->

<!-- Main Content -->
<?php $this->view('message') ?>
<div class="box">
	<div class="box-header">
		<h3 class="box-title">Data Realisasi Konten</h3>
		<div class="pull-right">
			<a href="<?= site_url('Member/konten/add') ?>" class="btn btn-primary btn-flat">
				<i class="fa fa-user-plus"></i> Tambah
			</a>
		</div>
	</div>
	<div class="box-body table-responsive">
		<table class="table table-bordered table-striped" id="table1">
			<thead>
				<tr>
					<th>No</th>
					<th>Judul Konten</th>
					<th>Deskripsi Konten</th>
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
				"url": "<?= site_url('Member/konten/get_ajax') ?>",
				"type": "POST",
			},
			"columnDefs": [{
				"targets": [0, 3],
				"className": 'text-center'
			}, {
				"targets": [0, 4, -1],
				"orderable": false
			}],
			"order": []
		})
	})
</script>
