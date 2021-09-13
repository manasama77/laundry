<!-- content-header -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Tambah Ukuran</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?= site_url('ukuran'); ?>">Ukuran</a></li>
					<li class="breadcrumb-item active">Tambah Ukuran</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<?php if ($this->session->flashdata('success')) { ?>
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong><?= $this->session->flashdata('success'); ?></strong>
			</div>
		<?php } ?>
		<form action="<?= site_url('ukuran/store'); ?>" method="post">
			<div class="row">
				<div class="col-sm-12 col-md-4">
					<div class="card">
						<div class="card-header bg-primary">
							<h3 class="card-title">Informasi Ukuran</h3>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="id_barang">Barang</label>
								<select class="form-control" id="id_barang" name="id_barang" required>
									<option value="" selected disabled>-Pilih Barang-</option>
									<?php foreach ($arr_barang->result() as $item) { ?>
										<option value="<?= $item->id; ?>"><?= $item->nama; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="nama">Nama Ukuran</label>
								<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Ukuran" required>
							</div>
							<div class="form-group">
								<label for="kode">Kode</label>
								<input type="text" class="form-control" id="kode" name="kode" placeholder="Kode" required>
							</div>
							<div class="form-group">
								<label for="id_ruangan">Ruangan</label>
								<select class="form-control" id="id_ruangan" name="id_ruangan" required>
									<?php foreach ($arr_ruangan->result() as $item) { ?>
										<option value="<?= $item->id; ?>"><?= $item->nama; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="jumlah_laundry">Inisiasi Jumlah Laundry</label>
								<input type="number" class="form-control" id="jumlah_laundry" name="jumlah_laundry" placeholder="Jumlah Laundry" min="0" step="1" value="0" required>
							</div>
							<div class="form-group">
								<label for="jumlah_pakai">Inisiasi Jumlah Pakai</label>
								<input type="number" class="form-control" id="jumlah_pakai" name="jumlah_pakai" placeholder="Jumlah Laundry" min="0" step="1" value="0" required>
							</div>
							<div class="form-group">
								<label for="limit_laundry">Limit Laundry</label>
								<input type="number" class="form-control" id="limit_laundry" name="limit_laundry" placeholder="Limit Laundry" min="0" step="1" value="0" required>
							</div>
							<div class="form-group">
								<label for="limit_pakai">Limit Pakai</label>
								<input type="number" class="form-control" id="limit_pakai" name="limit_pakai" placeholder="Limit Laundry" min="0" step="1" value="0" required>
							</div>
							<button type="submit" class="btn btn-primary btn-block">
								<i class="fas fa-check-circle"></i> Submit
							</button>
							<a href="<?= site_url('ukuran'); ?>" class="btn btn-secondary btn-sm btn-block">
								<i class="fas fa-step-backward"></i> List Ukuran
							</a>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</section>
