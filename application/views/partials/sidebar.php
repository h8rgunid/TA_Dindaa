<ul class="navbar-nav bg-gradient-<?php if ($this->session->role == 'admin')
	echo 'danger';
else
	echo 'primary' ?> sidebar sidebar-dark accordion"
		id="accordionSidebar">
		<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
		<div class="sidebar-brand-text mx-3">Bidan</div>
	</a>
	<hr class="sidebar-divider my-0">
	<li class="nav-item <?= $active == 'dashboard' ? 'active' : '' ?>">
		<a class="nav-link" href="<?= base_url('dashboard') ?>">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span></a>
	</li>
	<hr class="sidebar-divider">

	<?php if ($this->session->role == 'admin'): ?>

		<hr class="sidebar-divider">

		<div class="sidebar-heading">
			Data Baby
		</div>

		<li class="nav-item <?= $active == 'baby' || $active == 'perkembangan' ? 'active' : '' ?>">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#baby">
				<i class="fas fa-fw fa-cogs"></i>
				<span>Management Baby</span>
			</a>
			<div id="baby" class="collapse <?= $active == 'baby' || $active == 'perkembangan' ? 'show' : '' ?>">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item <?= $active == 'baby' ? 'active' : '' ?>"
						href="<?= base_url('baby') ?>">Timbangan Bayi</a>
					<a class="collapse-item <?= $active == 'perkembangan' ? 'active' : '' ?>"
						href="<?= base_url('perkembangan') ?>">Cek Perkembangan Bayi</a>
				</div>
			</div>
		</li>

	<?php endif; ?>

	<?php if ($this->session->role == 'admin'): ?>

		<hr class="sidebar-divider">

		<div class="sidebar-heading">
			Settings
		</div>

		<li class="nav-item <?= $active == 'users' || $active == 'roles' || $active == 'access' ? 'active' : '' ?>">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser">
				<i class="fas fa-fw fa-cogs"></i>
				<span>User Manager</span>
			</a>
			<div id="collapseUser"
				class="collapse <?= $active == 'users' || $active == 'roles' || $active == 'access' ? 'show' : '' ?>">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item <?= $active == 'users' ? 'active' : '' ?>"
						href="<?= base_url('users') ?>">User</a>
					<a class="collapse-item <?= $active == 'roles' ? 'active' : '' ?>"
						href="<?= base_url('roles') ?>">Roles</a>
					<a class="collapse-item <?= $active == 'access' ? 'active' : '' ?>"
						href="<?= base_url('access') ?>">Access Level</a>
				</div>
			</div>
		</li>

	<?php endif; ?>

	<?php if ($this->session->role == 'user'): ?>

		<hr class="sidebar-divider">

		<div class="sidebar-heading">
			Data lab
		</div>

		<li class="nav-item <?= $active == 'baby' || $active == 'perkembangan' ? 'active' : '' ?>">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#lab">
				<i class="fas fa-fw fa-cogs"></i>
				<span>Management Baby</span>
			</a>
			<div id="lab" class="collapse <?= $active == 'baby' || $active == 'perkembangan' ? 'show' : '' ?>">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item <?= $active == 'baby' ? 'active' : '' ?>" href="<?= base_url('baby') ?>">Timbangan Bayi</a>
					<a class="collapse-item <?= $active == 'perkembangan' ? 'active' : '' ?>"
						href="<?= base_url('perkembangan') ?>">Cek Perkembangan Bayi</a>
				</div>
			</div>
		</li>

	<?php endif; ?>

	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>
</ul>