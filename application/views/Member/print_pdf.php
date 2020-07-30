<body>
	<img src="<?= site_url() ?>assets/dist/img/PJA.png" align="left" width="10%">
	<img src="<?= site_url() ?>assets/dist/img/k3.png" align="right" width="10%">
	<center>
		<h1>PT. Petro Jordan Abadi</h1>
		<h2>Safety, Health and Enviroment</h2>
		<h2><u>TEMUAN TINDAKAN PELANGGARAN</u></h2>
		<br>
		<div class="box-body table-responsive">
			<table class="table table-bordered table-striped" id="table1" border="1" width="100%" style="text-align:center;">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Pegawai</th>
						<th>List Pelanggaran</th>
						<th>Tanggal</th>
						<th>Lokasi</th>
						<th>Deskripsi</th>
						<th>Point</th>
						<th>Foto</th>
					</tr>
					<?php $no = 1;
					foreach ($row->result() as $key => $data) { ?>
						<tr>
							<td><?= $no++ ?>.</td>
							<td><?= $data->nama_pegawai ?></td>
							<td><?= $data->nama_list_pel ?></td>
							<td><?= $data->tanggal ?></td>
							<td><?= $data->lokasi ?></td>
							<td><?= $data->deskripsi ?></td>
							<td><?= $data->point_pel ?></td>
							<td><?= $data->gambar ?></td>
						</tr>
					<?php } ?>
				</thead>
			</table>
		</div>
	</center>
</body>
