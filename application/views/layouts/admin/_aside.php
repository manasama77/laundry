<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<a href="<?= site_url('dashboard'); ?>" class="brand-link">
		<img src="<?= base_url('public/img/logo.png'); ?>" alt="<?= APP_NAME; ?> LOGO" class="img-fluid brand-image" style="opacity: .8; max-width: 60px;">
		<span class="brand-text font-weight-bold text-white"><?= APP_NAME; ?></span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?= base_url(); ?>public/img/pp/<?= $this->session->userdata(SESI . 'profile_picture'); ?>" class="img-circle elevation-2" alt="Member Image">
			</div>
			<div class="info">
				<span class="d-block text-white"><small><?= $this->session->userdata(SESI . 'name'); ?></small></span>
				<div class="btn-group">
					<!-- <a href="<?= site_url('profile'); ?>" class="btn btn-info btn-sm btn-flat text-white">
						<i class="fas fa-user"></i> Profile
					</a> -->
					<a href="<?= site_url('logout'); ?>" class="btn btn-danger btn-sm btn-flat text-white">
						<i class="fas fa-sign-out-alt"></i> Sign Out
					</a>
				</div>
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column nav-flat nav-compact nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item">
					<a href="<?= site_url('dashboard'); ?>" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('ruangan'); ?>" class="nav-link">
						<i class="nav-icon fas fa-person-booth"></i>
						<p>
							Ruangan
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('barang'); ?>" class="nav-link">
						<i class="nav-icon fas fa-tshirt"></i>
						<p>
							Barang
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('ukuran'); ?>" class="nav-link">
						<i class="nav-icon fas fa-tshirt"></i>
						<p>
							Ukuran
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('history_laundry'); ?>" class="nav-link">
						<i class="nav-icon fas fa-hand-holding-water"></i>
						<p>
							History Laundry
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('scan'); ?>" class="nav-link">
						<i class="nav-icon fas fa-qrcode"></i>
						<p>
							Scan
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?= site_url('admin_management'); ?>" class="nav-link">
						<i class="nav-icon fas fa-users"></i>
						<p>
							Admin Management
						</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
