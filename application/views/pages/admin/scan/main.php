<!-- content-header -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Scan</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Scan</li>
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

		<div class="row">
			<div class="col-sm-12 col-md-4">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Scan</h3>
						<div class="card-tools">
							<a href="<?= site_url('history_laundry'); ?>" class="btn btn-primary btn-sm">
								<i class="fas fa-hand-holding-water fa-fw"></i> History Laundry
							</a>
						</div>
					</div>
					<div class="card-body">
						<form id="form">
							<div class="form-group">
								<label for="from_id_ruangan">Dari Ruangan</label>
								<select class="form-control" id="from_id_ruangan" name="from_id_ruangan" required>
									<?php
									foreach ($arr_ruangan->result() as $item) {
										echo '<option value="' . $item->id . '">' . $item->nama . '</option>';
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="to_id_ruangan">Ke Ruangan</label>
								<select class="form-control" id="to_id_ruangan" name="to_id_ruangan" required>
									<?php
									foreach ($arr_ruangan->result() as $item) {
										echo '<option value="' . $item->id . '">' . $item->nama . '</option>';
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label for="kode">Scan</label>
								<input type="text" class="form-control" id="kode" name="kode" list="kodes" required autofocus />
								<datalist id="kodes">
									<?php
									foreach ($arr_ukuran->result() as $item) {
										echo '<option value="' . $item->kode . '">';
									}
									?>
								</datalist>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-8">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">List Scan</h3>
					</div>
					<div class="card-body">
						<table class="table">
							<thead class="bg-dark">
								<tr>
									<th><i class="fas fa-cog"></i></th>
									<th>Barang</th>
									<th>Ukuran</th>
									<th>Dari Ruangan</th>
									<th>Ke Ruangan</th>
								</tr>
							</thead>
							<tbody id="vlist">
								<tr>
									<td colspan="5" class="text-center">Data Scan Kosong</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="card-footer">
						<button id="simpan" type="button" class="btn btn-primary btn-block btn-flat">Simpan Data Scan</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
