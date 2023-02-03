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
					<div class="card shadow">
						<div class="card-header"><strong>List Perkembangan</strong></div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<td><strong>ID Baby</strong></td>
											<td><strong>Parent Name</strong></td>
											<td><strong>Baby Name</strong></td>
											<td><strong>Berat Baby Check Terakhir Kali</strong></td>
											<?php if ($this->session->role == 'user'): ?>
												<td> <strong>Action</strong></td>
											<?php endif; ?>
											<?php if ((int) $_role['update'] || (int) $_role['delete']) { ?>
												<td><strong>Action</strong></td>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php if ($this->session->role == 'user'): ?>
											<?php foreach ($list_perkembangan_per_user as $perkembangan): ?>
												<tr>
													<td>
														<?= $perkembangan->id_bayi ?>
													</td>
													<td>
														<?= $perkembangan->name ?>
													</td>
													<td>
														<?= $perkembangan->nama_baby ?>
													</td>
													<td>
														<?= $perkembangan->berat_bayi ?> KG
													</td>
													<td>
														<a href="<?= base_url('perkembangan/history/' . $perkembangan->id_bayi) ?>"
															class="btn btn-success btn-sm"><i class="fa fa-history"></i></a>

													<?php endforeach ?>
												</td <?php endif; ?>
												<?php if ($this->session->role == 'admin'): ?>
											<?php foreach ($list_perkembangan as $perkembangan): ?>
											<tr>
												<td>
													<?= $perkembangan->id_bayi ?>
												</td>
												<td>
													<?= $perkembangan->name ?>
												</td>
												<td>
													<?= $perkembangan->nama_baby ?>
												</td>
												<td>
													<?= $perkembangan->berat_bayi ?> KG
												</td>

												<?php if ((int) $_role['update'] || (int) $_role['delete']) { ?>
													<td>
														<?php if ((int) $_role['update']) { ?>
														<?php }
														if ((int) $_role['delete']) { ?>
															<a class="btn btn-danger btn-sm" href="#" data-toggle="modal"
																data-target="#deleteModal-<?= $perkembangan->id_perkembangan_bayi ?>">
																<i class="fa fa-trash"></i>
															</a>
															<div class="modal fade"
																id="deleteModal-<?= $perkembangan->id_perkembangan_bayi ?>"
																tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
																aria-hidden="true">
																<div class="modal-dialog" role="document">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title" id="logoutModalLabel">Delete?
																			</h5>
																			<button class="close" type="button" data-dismiss="modal"
																				aria-label="Close">
																				<span aria-hidden="true"></span>
																			</button>
																		</div>
																		<div class="modal-body">Are you sure you want to delete this
																			data?</div>
																		<div class="modal-footer">
																			<button class="btn btn-secondary" type="button"
																				data-dismiss="modal">Cancel</button>
																			<a class="btn btn-primary"
																				href="<?= base_url('perkembangan/delete/' . $perkembangan->id_bayi) ?>">Delete</a>
																		</div>
																	</div>
																</div>
															</div>
														<?php } ?>
														<a href="<?= base_url('perkembangan/history/' . $perkembangan->id_bayi) ?>"
															class="btn btn-success btn-sm"><i class="fa fa-history"></i></a>
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