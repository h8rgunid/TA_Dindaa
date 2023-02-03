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
			<div id="content" data-url="<?= base_url('users') ?>">
				<!-- load Topbar -->
				<?php $this->load->view('partials/topbar.php') ?>

				<div class="container-fluid">
				<div class="clearfix">
					<div class="float-left">
						<h1 class="h3 m-0 text-gray-800"><?= $title ?></h1>
					</div>
					<div class="float-right">
						<a href="<?= base_url('users') ?>" class="btn btn-secondary btn-sm"><i class="fa fa-reply"></i>&nbsp;&nbsp;Back</a>
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
								<form action="<?= base_url('users/edit/' . $user->id) ?>" id="form-edit" method="POST">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="name"><strong>Name</strong></label>
											<input type="text" name="name" placeholder="Enter your name" autocomplete="off"  class="form-control" required value="<?= $user->name ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="role"><strong>Role</strong></label>
											<select required name="role" id="role" class="form-control" required>
												<option value="" disabled selected>--- Choose Role ---</option>
												<?php foreach ($list_roles as $role) { ?>
													<option value="<?php echo $role->id; ?>" <?= $role->id == $user->role_id ? 'selected' : ''; ?>> <?php echo $role->name; ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="username"><strong>Email</strong></label>
											<input type="text" name="email" placeholder="Enter your email" autocomplete="off"  class="form-control" required value="<?= $user->email ?>">
										</div>
										<div class="form-group col-md-6">
											<label for="password"><strong>Password</strong></label>
											<input type="password" name="password" placeholder="Enter your password" autocomplete="off"  class="form-control">
										</div>
									</div>
									<!-- <div class="form-row">
										<div class="form-group col-md-6">
											<label for="password"><strong>Day of Work (Week)</strong></label>
											<div class="form-check pl-3">
												<table class="table-borderless col-md-6">
													<?php
														$days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
														$no = 1;
														foreach ($days as $day) { ?>
															<tr>
																<td><?= $day ?></td>
																<td><input class="fa fa-fw" type="checkbox" name="<?= 'd'.$no ?>" <?= $user->{'d'.$no} ? 'checked' : '' ?>></td>
															</tr>
													<?php $no++; } ?>
												</table>
											</div>
										</div>
									</div> -->
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
