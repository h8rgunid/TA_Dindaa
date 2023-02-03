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
			<div id="content" data-url="<?= base_url('baby	') ?>">
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
							<?php if ((int) $_role['create']) { ?>
								<a href="<?= base_url('baby/add') ?>" class="btn btn-primary btn-sm"><i
										class="fa fa-plus"></i>&nbsp;&nbsp;Add</a>
							<?php } ?>
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
					<div class="card shadow">
						<div class="card-header"><strong>List Baby</strong></div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<td><strong>Baby ID</strong></td>
											<td><strong>Parent Name</strong></td>
											<td><strong>Baby Name</strong></td>
											<td><strong>Gender</strong></td>
											<td><strong>Place of Birth</strong></td>
											<td><strong>Date of Birth</strong></td>
											<td><strong>NIK</strong></td>
											<?php if ((int) $_role['update'] || (int) $_role['delete']) { ?>
												<td><strong>Action</strong></td>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php if ($this->session->role == 'user'): ?>
											<?php foreach ($baby_id as $baby): ?>
												<tr>
													<td>
														<?= $baby->id_baby ?>
													</td>
													<td>
														<?= $baby->name ?>
													</td>
													<td>
														<?= $baby->nama_baby ?>
													</td>
													<td>
														<?= $baby->jk ?>
													</td>
													<td>
														<?= $baby->tempat_lahir ?>
													</td>
													<td>
														<?= $baby->ttl ?>
													</td>
													<td>
														<?= $baby->nik ?>
													</td>
													<?php if ((int) $_role['update'] || (int) $_role['delete']) { ?>
														<td>
															<?php if ((int) $_role['update']) { ?>
																<a href="<?= base_url('baby/edit/' . $baby->id_baby) ?>"
																	class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
															<?php }
															if ((int) $_role['delete']) { ?>
																<a class="btn btn-danger btn-sm" href="#" data-toggle="modal"
																	data-target="#deleteModal-<?= $baby->id_baby ?>">
																	<i class="fa fa-trash"></i>
																</a>
																<div class="modal fade" id="deleteModal-<?= $baby->id_baby ?>"
																	tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
																	aria-hidden="true">
																	<div class="modal-dialog" role="document">
																		<div class="modal-content">
																			<div class="modal-header">
																				<h5 class="modal-title" id="logoutModalLabel">Delete?
																				</h5>
																				<button class="close" type="button" data-dismiss="modal"
																					aria-label="Close">
																					<span aria-hidden="true">×</span>
																				</button>
																			</div>
																			<div class="modal-body">Are you sure you want to delete this
																				data?</div>
																			<div class="modal-footer">
																				<button class="btn btn-secondary" type="button"
																					data-dismiss="modal">Cancel</button>
																				<a class="btn btn-primary"
																					href="<?= base_url('baby/delete/' . $baby->id_baby) ?>">Delete</a>
																			</div>
																		</div>
																	</div>
																</div>
															<?php } ?>
															<a href="<?= base_url('baby/edit/' . $baby->id_baby) ?>"
																class="btn btn-success btn-sm"><i class="fa fa-stethoscope"></i>
																Take Weight</a>
														</td>
													<?php } ?>
												</tr>
											<?php endforeach ?>
										<?php endif ?>
										<?php if ($this->session->role == 'admin'): ?>
											<?php foreach ($baby_users as $baby): ?>
												<tr>
													<td>
														<?= $baby->id_baby ?>
													</td>
													<td>
														<?= $baby->name ?>
													</td>
													<td>
														<?= $baby->nama_baby ?>
													</td>
													<td>
														<?= $baby->jk ?>
													</td>
													<td>
														<?= $baby->tempat_lahir ?>
													</td>
													<td>
														<?= $baby->ttl ?>
													</td>
													<td>
														<?= $baby->nik ?>
													</td>
													<?php if ((int) $_role['update'] || (int) $_role['delete']) { ?>
														<td>
															<?php if ((int) $_role['update']) { ?>
																<a href="<?= base_url('baby/edit/' . $baby->id_baby) ?>"
																	class="btn btn-success btn-sm"><i class="fa fa-pen"></i></a>
															<?php }
															if ((int) $_role['delete']) { ?>
																<a class="btn btn-danger btn-sm" href="#" data-toggle="modal"
																	data-target="#deleteModal-<?= $baby->id_baby ?>">
																	<i class="fa fa-trash"></i>
																</a>
																<div class="modal fade" id="deleteModal-<?= $baby->id_baby ?>"
																	tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
																	aria-hidden="true">
																	<div class="modal-dialog" role="document">
																		<div class="modal-content">
																			<div class="modal-header">
																				<h5 class="modal-title" id="logoutModalLabel">Delete?
																				</h5>
																				<button class="close" type="button" data-dismiss="modal"
																					aria-label="Close">
																					<span aria-hidden="true">×</span>
																				</button>
																			</div>
																			<div class="modal-body">Are you sure you want to delete this
																				data?</div>
																			<div class="modal-footer">
																				<button class="btn btn-secondary" type="button"
																					data-dismiss="modal">Cancel</button>
																				<a class="btn btn-primary"
																					href="<?= base_url('baby/delete/' . $baby->id_baby) ?>">Delete</a>
																			</div>
																		</div>
																	</div>
																</div>
															<?php } ?>
															<a href="<?= base_url('baby/edit/' . $baby->id_baby) ?>"
																class="btn btn-success btn-sm"><i class="fa fa-stethoscope"></i>
																Take Weight</a>
														</td>
													<?php } ?>
												</tr>
											<?php endforeach ?>
										</td <?php endif; ?>
									</tbody>
								</table>
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
	<script src="<?= base_url('assets') ?>/vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="<?= base_url('assets') ?>/vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body>

</html>