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
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('baby') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Back</a>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-6">
						<div class="card shadow">
							<div class="card-header"><strong>Fill in the form to update data!</strong></div>
							<div class="card-body">
								<?php if(validation_errors()): ?>
									<div class="alert alert-danger alert-dismissible fade show" role="alert">
										<?= validation_errors() ?>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
								<?php endif ?>
								<form action="<?= base_url('baby/edit/' . $baby->id_baby) ?>" id="form-edit" method="POST">
								<div class="form-row">
										<div class="form-group col-md-6">
											<label for="nama_baby"><strong>Baby Name</strong></label>
											<input type="text" name="nama_baby" placeholder="Enter baby name" autocomplete="off"  class="form-control" required value="<?= $baby->nama_baby ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="jk"><strong>Gender</strong></label>
											<input type="radio" name="jk" value="p" required>Female
											<input type="radio" name="jk" value="l" required>Male
										</div>
										<div class="form-group col-md-6">
											<label for="tempat_lahir"><strong>Place of Birth </strong></label>
											<input type="text" name="tempat_lahir" placeholder="Enter baby place of Birth" autocomplete="off"  class="form-control" required value="<?= $baby->tempat_lahir ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="ttl"><strong>Date of Birth</strong></label>
											<input type="date" name="ttl" value="<?= $baby->ttl ?>" required>
										</div>
										<div class="form-group col-md-6">
											<label for="nik"><strong>NIK</strong></label>
											<input type="text" name="nik" placeholder="Enter baby NIK" autocomplete="off"  class="form-control" required value="<?= $baby->nik?>">
										</div>
									</div>

									<hr>
									<div class="form-group">
										<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Submit</button>
										<button type="reset" class="btn btn-danger"><i class="fa fa-times"></i>&nbsp;&nbsp;Reset</button>
									</div>
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
