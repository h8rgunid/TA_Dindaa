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
			<div id="content" data-url="<?= base_url('baby') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
					<div class="clearfix">
						<div class="float-left">
							<h1 class="h3 m-0 text-gray-800">
								<?= $title ?>
							</h1>
						</div>
						<div class="float-right">
							<a href="<?= base_url('baby') ?>" class="btn btn-secondary btn-sm"><i
									class="fa fa-reply"></i>&nbsp;&nbsp;Back</a>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-md-6">
							<div class="card shadow">
								<div class="card-header"><strong>Fill in the form!</strong></div>
								<div class="card-body">
									<?php if (validation_errors()): ?>
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
											<?= validation_errors() ?>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
									<?php endif ?>
									<form action="<?= base_url('baby/add') ?>" id="form-add" method="POST">
										<?php if ($this->session->role == 'admin'): ?>
											<div class="form-row">
												<div class="form-group col-md-6">
													<label for="nama_baby"><strong>Baby Name</strong></label>
													<input type="text" name="nama_baby" placeholder="Enter baby name"
														autocomplete="off" class="form-control" required>
												</div>
												<div class="form-group col-md-6">
													<label for="jk"><strong>Gender</strong></label>
													<select class="form-control " id="jk" name="jk" required>
														<option value="">No Select</option>
														<option value="l">Laki-Laki</option>
														<option value="p">Perempuan</option>
													</select>
												</div>
												<div class="form-group col-md-6">
													<label for="tempat_lahir"><strong>Place of Birth </strong></label>
													<input type="text" name="tempat_lahir"
														placeholder="Enter baby place of Birth" autocomplete="off"
														class="form-control" required>
												</div>
												<div class="form-group col-md-6">
													<label for="ttl"><strong>Date of Birth</strong></label>
													<div>
														<input type="date" name="ttl" value="<?php echo date('Y-m-d'); ?>"
															required />
													</div>
												</div>
												<div class="form-group col-md-6">
													<label for="nik"><strong>NIK</strong></label>
													<input type="text" name="nik" placeholder="Enter baby NIK"
														autocomplete="off" class="form-control" required>
												</div>
												<div class="form-group col-md-6">
													<label for="id"><strong>Parent</strong></label>
													<select class="form-control " id="id" name="id" required>
														<option value="">No Select</option>
														<?php foreach ($baby_users as $parent): ?>
															<option value="<?php echo $parent->id; ?>"><?php echo " Email: ",$parent->email," Name: ",$parent->name; ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
											<hr>
											<div class="form-group">
												<button type="submit" class="btn btn-primary"><i
														class="fa fa-save"></i>&nbsp;&nbsp;Submit</button>
												<button type="reset" class="btn btn-danger"><i
														class="fa fa-times"></i>&nbsp;&nbsp;Reset</button>
											</div>
										<? endif ?>
										<?php if ($this->session->role == 'user'): ?>
											<div class="form-row">
												<div class="form-group col-md-6">
													<label for="nama_baby"><strong>Baby Name</strong></label>
													<input type="text" name="nama_baby" placeholder="Enter baby name"
														autocomplete="off" class="form-control" required>
												</div>
												<div class="form-group col-md-6">
													<label for="jk"><strong>Gender</strong></label>
													<select class="form-control " id="jk" name="jk" required>
														<option value="">No Select</option>
														<option value="l">Laki-Laki</option>
														<option value="p">Perempuan</option>
													</select>
												</div>
												<div class="form-group col-md-6">
													<label for="tempat_lahir"><strong>Place of Birth </strong></label>
													<input type="text" name="tempat_lahir"
														placeholder="Enter baby place of Birth" autocomplete="off"
														class="form-control" required>
												</div>
												<div class="form-group col-md-6">
													<label for="ttl"><strong>Date of Birth</strong></label>
													<div>
														<input type="date" name="ttl" value="<?php echo date('Y-m-d'); ?>"
															required />
													</div>
												</div>
												<div class="form-group col-md-6">
													<label for="nik"><strong>NIK</strong></label>
													<input type="text" name="nik" placeholder="Enter baby NIK"
														autocomplete="off" class="form-control" required>
												</div>
												<div class="form-group col-md-6">
													<label for="id"><strong>Parent</strong></label>
													<select class="form-control " id="id" name="id">
														<option value="<?php $this->session->userdata('name') ?>"><?php echo $this->session->userdata('name') ?></option>
													</select>
												</div>
											</div>
											<hr>
											<div class="form-group">
												<button type="submit" class="btn btn-primary"><i
														class="fa fa-save"></i>&nbsp;&nbsp;Submit</button>
												<button type="reset" class="btn btn-danger"><i
														class="fa fa-times"></i>&nbsp;&nbsp;Reset</button>
											</div>
										<? endif ?>
									</form>
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
</body>

</html>