<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<h4>Grafik Tingkat Pelanggaran Pegawai</h4>
				<form action="" class="row">
					<div class="form-group col-md-2">
						<label>Periode</label>
						<input type="text" onchange="updatePelChart(this)" class="form-control month-year-picker" readonly required>
					</div>
				</form>
				<canvas id="pel-chart"></canvas>

				<div class="mr-5 ml-5 row">
					<h5 class="col-md-2 text-center"><strong>Keterangan :</strong></h5>
					<div class="col-md-10 ket-area">

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<h4>Grafik Tingkat Pelanggaran Pegawai Mitra</h4>
				<form action="" class="row">
					<div class="form-group col-md-2">
						<label>Periode</label>
						<input type="text" onchange="updatePelChart2(this)" class="form-control month-year-picker" readonly required>
					</div>
				</form>
				<canvas id="pel-chart2"></canvas>

				<div class="mr-5 ml-5 row">
					<h5 class="col-md-2 text-center"><strong>Keterangan :</strong></h5>
					<div class="col-md-10 ket-area2">

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
