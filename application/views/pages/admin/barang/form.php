<!-- content-header -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Tambah Barang</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?= site_url('barang'); ?>">Barang</a></li>
					<li class="breadcrumb-item active">Tambah Barang</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<form action="<?= site_url('barang/store'); ?>" method="post">
			<div class="row">
				<div class="col-sm-12 col-md-4">
					<div class="card">
						<div class="card-header bg-primary">
							<h3 class="card-title">Informasi Barang</h3>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="nama">Nama Barang</label>
								<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang" required>
							</div>
							<button type="submit" class="btn btn-primary btn-block">
								<i class="fas fa-check-circle"></i> Submit
							</button>
							<a href="<?= site_url('barang'); ?>" class="btn btn-secondary btn-sm btn-block">
								<i class="fas fa-step-backward"></i> List Barang
							</a>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</section>
