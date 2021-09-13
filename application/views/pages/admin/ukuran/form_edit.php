<!-- content-header -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Edit Barang</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?= site_url('barang'); ?>">Barang</a></li>
					<li class="breadcrumb-item active">Edit Barang</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<form id="form" action="<?= site_url('ukuran/update'); ?>" method="post">
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
									<?php foreach ($arr_barang->result() as $item) { ?>
										<option <?php ($item->id == $arr->row()->id_barang) ? "selected" : ""; ?> value="<?= $item->id; ?>"><?= $item->nama; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="nama">Nama Ukuran</label>
								<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Ukuran" value="<?= $arr->row()->nama_ukuran; ?>" required>
							</div>
							<div class="form-group">
								<label for="kode">Kode</label>
								<input type="text" class="form-control" id="kode" name="kode" placeholder="Kode" value="<?= $arr->row()->kode; ?>" required>
							</div>
							<div class="form-group">
								<label for="id_ruangan">Ruangan</label>
								<select class="form-control" id="id_ruangan" name="id_ruangan" required>
									<?php foreach ($arr_ruangan->result() as $item) { ?>
										<option <?php ($item->id == $arr->row()->id_ruangan) ? "selected" : ""; ?> value="<?= $item->id; ?>"><?= $item->nama; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="jumlah_laundry">Jumlah Laundry</label>
								<input type="number" class="form-control" id="jumlah_laundry" name="jumlah_laundry" placeholder="Jumlah Laundry" min="0" step="1" value="<?= $arr->row()->jumlah_laundry; ?>" required>
							</div>
							<div class="form-group">
								<label for="jumlah_pakai">Jumlah Pakai</label>
								<input type="number" class="form-control" id="jumlah_pakai" name="jumlah_pakai" placeholder="Jumlah Laundry" min="0" step="1" value="<?= $arr->row()->jumlah_pakai; ?>" required>
							</div>
							<input type="hidden" id="id" name="id" value="<?= $id; ?>" />
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
