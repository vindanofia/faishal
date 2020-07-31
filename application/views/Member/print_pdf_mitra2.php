<head>
	<title>Cetak Laporan</title>
</head>

<body>
	<img src="<?= site_url() ?>assets/dist/img/PJA.png" align="left" width="10%">
	<img src="<?= site_url() ?>assets/dist/img/k3.png" align="right" width="10%">
	<center>
		<h1>PT. Petro Jordan Abadi</h1>
		<h2>Safety, Health and Enviroment</h2>
		<h2><u>TINDAKAN APRESIASI MITRA</u></h2>
		<br>
		<div class="box-body table-responsive">
			<table class="table table-bordered table-striped" id="table1" border="1" width="100%" style="text-align:center;">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Perusahaan</th>
						<th>Nama Pegawai</th>
						<th>Tindakan Apresiasi</th>
						<th>Tanggal</th>
						<th>Lokasi</th>
						<th>Deskripsi</th>
						<th>Point</th>
						<th>Foto</th>
					</tr>
					<?php $no = 1;
					foreach ($row as $data) { ?>
						<tr>
							<td><?= $no++ ?>.</td>
							<td><?= $data->nama_mitra ?></td>
							<td><?= $data->nama_pegawai_mitra ?></td>
							<td><?= $data->nama_reward ?></td>
							<td><?= $data->tanggal ?></td>
							<td><?= $data->lokasi ?></td>
							<td><?= $data->deskripsi ?></td>
							<td><?= $data->point_penghargaan ?></td>
							<td><img src="<?= base_url() . 'uploads/apresiasi/' . $data->foto ?>" style="width: 250px"></td>
						</tr>
					<?php } ?>
				</thead>
			</table>
		</div>
	</center>
</body>
