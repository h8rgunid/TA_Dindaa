<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('partials/head.php') ?>
</head>

<body id="page-top">
	<div id="wrapper">
		<!-- load sidebar -->
		<?php $this->load->view('partials/sidebar.php') ?>

		<div id="content-wrapper" class="d-flex flex-column">
			<div id="content" data-url="<?= base_url('dashboard') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800">
								<?= $title ?>
							</h1>
						</div>
					</div>
					<hr>
					<?php if ($this->session->flashdata('success')): ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							<?= $this->session->flashdata('success') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php elseif ($this->session->flashdata('error')): ?>
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							<?= $this->session->flashdata('error') ?>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<?php endif ?>


					<?php if ($this->session->role == 'user'): ?>
						<?php $no = 0;
						foreach ($count_baby_id as $baby):
							$no++ ?>
							<div class="row">
								<div class="col-xl-8 col-lg-7">
									<div class="card shadow mb-4">
										<!-- Card Header - Dropdown -->
										<div
											class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
											<h6 class="m-0 font-weight-bold text-primary">Grafik Perkembangan Berat
												<?= $baby->nama_baby ?>
											</h6>
											<!-- <div class="dropdown no-arrow">
																<!-- <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
																	data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																	<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
																</a> -->
											<!-- <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
																	aria-labelledby="dropdownMenuLink">
																	<div class="dropdown-header">Dropdown Header:</div>
																	<a class="dropdown-item" href="#">Action</a>
																	<a class="dropdown-item" href="#">Another action</a>
																	<div class="dropdown-divider"></div>
																	<a class="dropdown-item" href="#">Something else here</a>
																</div> -->
											<!-- </div>  -->
										</div>
										<!-- Card Body -->

										<div class="card-body">
											<div class="chart-area">
												<canvas id="myAreaChart<?= $no ?>"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach ?>
					<?php endif ?>
					<?php if ($this->session->role == 'admin'): ?>
						<div class="row">
							<div class="col-xl-8 col-lg-7">
								<div class="card shadow mb-4">
									<!-- Card Header - Dropdown -->
									<div
										class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
										<h6 class="m-0 font-weight-bold text-primary">Grafik Perkembangan Berat Bayi
										</h6>
										<!-- <div class="dropdown no-arrow">
															<!-- <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
																data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
															</a> -->
										<!-- <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
																aria-labelledby="dropdownMenuLink">
																<div class="dropdown-header">Dropdown Header:</div>
																<a class="dropdown-item" href="#">Action</a>
																<a class="dropdown-item" href="#">Another action</a>
																<div class="dropdown-divider"></div>
																<a class="dropdown-item" href="#">Something else here</a>
															</div> -->
										<!-- </div>  -->
									</div>
									<!-- Card Body -->

									<div class="card-body">
										<div class="chart-area">
											<canvas id="myAreaChart"></canvas>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php endif ?>
					<div class="row">

						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
												Jumlah Bayi</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">
												<?= $count_baby ?>
											</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-box fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Berat
												Tertinggi</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">
												<?php foreach ($beratavg as $berat) {
													echo $berat->berat_bayi;
												} ?> KG
											</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-box fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Berat
												Tertinggi</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">
												<?php foreach ($beratmax as $berat) {
													echo $berat->berat_bayi;
												} ?> KG
											</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-box fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-xl-3 col-md-6 mb-4">
							<div class="card border-left-primary shadow h-100 py-2">
								<div class="card-body">
									<div class="row no-gutters align-items-center">
										<div class="col mr-2">
											<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Bayi
												yang sudah Menimbang</div>
											<div class="h5 mb-0 font-weight-bold text-gray-800">
												<?= $count_menimbang ?>
											</div>
										</div>
										<div class="col-auto">
											<i class="fas fa-box fa-2x text-gray-300"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="card shadow">
								<div class="card-header"><strong>User Session</strong></div>
								<div class="card-body">
									<strong>Name : </strong><br>
									<input type="text" value="<?= $this->session->name ?>" readonly
										class="form-control mt-2 mb-2">
									<strong>Email : </strong><br>
									<input type="text" value="<?= $this->session->email ?>" readonly
										class="form-control mt-2 mb-2">
									<strong>Role : </strong><br>
									<input type="text" value="<?= $this->session->role ?>" readonly
										class="form-control mt-2 mb-2">
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<hr>
			<!-- load footer -->
			<?php $this->load->view('partials/footer.php') ?>
		</div>
	</div>
	<?php $this->load->view('partials/js.php') ?>
	<script src="<?= base_url('assets/js/demo/datatables-demo.js') ?>"></script>
	<script src="<?= base_url('assets') ?>/vendor/chart.js/Chart.js"></script>
	<script src="<?= base_url('assets/js/demo/chart-area-demo.js') ?>"></script>
	<script src="<?= base_url('assets') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('assets') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
	<script>
		<?php if ($this->session->role == 'user'): ?>
			<?php $no = 0;
			$n = 0;
			foreach ($count_baby_id as $baby):
				
				$a = 'berat_per_bulan'.$n;
				
				// var_dump($$a);
				// die();
				$no++; $n++;?>
				
				var ctx = document.getElementById("myAreaChart<?= $no ?>");
				var myLineChart = new Chart(ctx, {
					type: 'line',
					data: {

						labels: [<?php foreach ($$a as $row): ?> '<?php echo ($row->ptanggal); ?>', <?php endforeach ?>],
						datasets: [{
							label: "Berat ",
							lineTension: 0.3,
							backgroundColor: "rgba(78, 115, 223, 0.05)",
							borderColor: "rgba(78, 115, 223, 1)",
							pointRadius: 3,
							pointBackgroundColor: "rgba(78, 115, 223, 1)",
							pointBorderColor: "rgba(78, 115, 223, 1)",
							pointHoverRadius: 3,
							pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
							pointHoverBorderColor: "rgba(78, 115, 223, 1)",
							pointHitRadius: 10,
							pointBorderWidth: 2,
							data: [<?php foreach ($$a as $row): ?> '<?php echo $row->pberat; ?>', <?php endforeach ?>],
						}],
					},
					options: {
						maintainAspectRatio: false,
						layout: {
							padding: {
								left: 10,
								right: 25,
								top: 25,
								bottom: 0
							}
						},
						scales: {
							xAxes: [{
								time: {
									unit: 'date'
								},
								gridLines: {
									display: false,
									drawBorder: false
								},
								ticks: {
									maxTicksLimit: 7
								}
							}],
							yAxes: [{
								ticks: {
									maxTicksLimit: 5,
									padding: 10,
									// Include a dollar sign in the ticks
									callback: function (value, index, values) {
										return number_format(value);
									}
								},
								gridLines: {
									color: "rgb(234, 236, 244)",
									zeroLineColor: "rgb(234, 236, 244)",
									drawBorder: false,
									borderDash: [2],
									zeroLineBorderDash: [2]
								}
							}],
						},
						legend: {
							display: false
						},
						tooltips: {
							backgroundColor: "rgb(255,255,255)",
							bodyFontColor: "#858796",
							titleMarginBottom: 10,
							titleFontColor: '#6e707e',
							titleFontSize: 14,
							borderColor: '#dddfeb',
							borderWidth: 1,
							xPadding: 15,
							yPadding: 15,
							displayColors: false,
							intersect: false,
							mode: 'index',
							caretPadding: 10,
							callbacks: {
								label: function (tooltipItem, chart) {
									var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
									return datasetLabel + number_format(tooltipItem.yLabel) + " Kg, ";
								}
							}
						}
					}
				});
				
			<?php endforeach ?>
		<?php endif ?>
		<?php if ($this->session->role == 'admin'): ?>
			var ctx = document.getElementById("myAreaChart");
			var myLineChart = new Chart(ctx, {
				type: 'line',
				data: {

					labels: [<?php foreach ($berat_per_bulan as $row): ?> '<?php echo ($row->ptanggal); ?>', <?php endforeach ?>],
					datasets: [{
						label: "Berat ",
						lineTension: 0.3,
						backgroundColor: "rgba(78, 115, 223, 0.05)",
						borderColor: "rgba(78, 115, 223, 1)",
						pointRadius: 3,
						pointBackgroundColor: "rgba(78, 115, 223, 1)",
						pointBorderColor: "rgba(78, 115, 223, 1)",
						pointHoverRadius: 3,
						pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
						pointHoverBorderColor: "rgba(78, 115, 223, 1)",
						pointHitRadius: 10,
						pointBorderWidth: 2,
						data: [<?php foreach ($berat_per_bulan as $row): ?> '<?php echo $row->pberat; ?>', <?php endforeach ?>],
					}],
				},
				options: {
					maintainAspectRatio: false,
					layout: {
						padding: {
							left: 10,
							right: 25,
							top: 25,
							bottom: 0
						}
					},
					scales: {
						xAxes: [{
							time: {
								unit: 'date'
							},
							gridLines: {
								display: false,
								drawBorder: false
							},
							ticks: {
								maxTicksLimit: 7
							}
						}],
						yAxes: [{
							ticks: {
								maxTicksLimit: 5,
								padding: 10,
								// Include a dollar sign in the ticks
								callback: function (value, index, values) {
									return number_format(value);
								}
							},
							gridLines: {
								color: "rgb(234, 236, 244)",
								zeroLineColor: "rgb(234, 236, 244)",
								drawBorder: false,
								borderDash: [2],
								zeroLineBorderDash: [2]
							}
						}],
					},
					legend: {
						display: false
					},
					tooltips: {
						backgroundColor: "rgb(255,255,255)",
						bodyFontColor: "#858796",
						titleMarginBottom: 10,
						titleFontColor: '#6e707e',
						titleFontSize: 14,
						borderColor: '#dddfeb',
						borderWidth: 1,
						xPadding: 15,
						yPadding: 15,
						displayColors: false,
						intersect: false,
						mode: 'index',
						caretPadding: 10,
						callbacks: {
							label: function (tooltipItem, chart) {
								var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
								return datasetLabel + number_format(tooltipItem.yLabel) + " Kg, ";
							}
						}
					}
				}
			});
			<?php endif ?>
	</script>

</body>


</html>