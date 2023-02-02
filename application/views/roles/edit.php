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
			<div id="content" data-url="<?= base_url('roles') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('roles') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Back</a>
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
								<form action="<?= base_url('roles/edit/' . $role->id) ?>" id="form-edit" method="POST">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="name"><strong>Role ID</strong></label>
											<input type="text" name="id" placeholder="Enter your role id" autocomplete="off"  class="form-control" required value="<?= $role->id ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="name"><strong>Role Name</strong></label>
											<input type="text" name="name" placeholder="Enter your role name" autocomplete="off"  class="form-control" required value="<?= $role->name ?>">
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
