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
			<div id="content" data-url="<?= base_url('perkembangan') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('perkembangan') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Back</a>
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
								<form action="<?= base_url('perkembangan/edit/' . $perkembangan->id_perkembangan_bayi) ?>" id="form-edit" method="POST">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="name"><strong>Berat Baby</strong></label>
											<input type="text" name="berat_bayi" placeholder="Enter berat bayi" autocomplete="off"  class="form-control" required value="<?= $perkembangan->berat_bayi ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="ttl"><strong>Tanggal Menimbang</strong></label>
											<input type="date" name="tanggal" value="<?= $perkembangan->tanggal ?>" required/>
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
