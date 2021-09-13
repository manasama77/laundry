<!-- content-header -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Tambah Ruangan</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?= site_url('ruangan'); ?>">Ruangan</a></li>
					<li class="breadcrumb-item active">Tambah Ruangan</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-md-4 offset-4">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Edit Ruangan</h3>
						<div class="card-tools">
							<a href="<?= site_url('ruangan'); ?>" class="btn btn-secondary btn-sm">
								<i class="fas fa-step-backward"></i> List Ruangan
							</a>
						</div>
					</div>
					<div class="card-body">
						<form action="<?= site_url('ruangan/update'); ?>" method="post">
							<div class="form-group">
								<label for="nama">Nama Ruangan</label>
								<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Ruangan" value="<?= $arr->row()->nama; ?>" required>
							</div>
							<input type="hidden" name="id" value="<?= $arr->row()->id; ?>">
							<button type="submit" class="btn btn-primary btn-block">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
