<!-- content-header -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">History Laundry</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">History Laundry</li>
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
			<div class="col-sm-12 col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">History Laundry</h3>
						<div class="card-tools">
							<a href="<?= site_url('scan'); ?>" class="btn btn-primary btn-sm">
								<i class="fas fa-plus"></i> Scan
							</a>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="table_data" class="table">
								<thead class="bg-dark">
									<tr>
										<th class="align-middle">Date Time</th>
										<th class="align-middle">Barang</th>
										<th class="align-middle text-center">Ukuran</th>
										<th class="align-middle text-center" style="min-width: 120px;">Dari & Ke</th>
										<th class="align-middle text-center">Status</th>
									</tr>
								</thead>
								<tbody>

									<?php if ($arr->num_rows() > 0) : ?>
										<?php
										foreach ($arr->result() as $key) :
										?>

											<tr>
												<td class="align-middle">
													<small><?= $key->created_at; ?></small>
												</td>
												<td class="align-middle">
													<?= $key->nama_barang; ?>
												</td>
												<td class="align-middle text-center">
													<?= $key->nama_ukuran; ?>
												</td>
												<td class="align-middle text-center">
													<?php
													if ($key->state == 'init') {
														echo 'Vendor';
													} else {
														echo $key->from_nama_ruangan;
													}
													?>
													<i class="fas fa-arrow-right ml-1 mr-1"></i>
													<?= $key->to_nama_ruangan; ?>
												</td>
												<td class="align-middle text-center">
													<?php
													if ($key->state == "init") {
														$badge_color = "primary";
													} elseif ($key->state == "in") {
														$badge_color = "success";
													} elseif ($key->state == "out") {
														$badge_color = "danger";
													}
													?>
													<span class="badge badge-<?= $badge_color; ?>">
														<?= strtoupper($key->state); ?>
													</span>
												</td>
											</tr>

										<?php endforeach; ?>
									<?php endif; ?>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<form id="form_delete">
	<div class="modal fade" id="modal_delete" data-backdrop="static" data-keyboard="false" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Delete</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Are you sure want to delete <kbd id="nama_delete"></kbd> ?
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id" name="id">
					<button type="submit" class="btn btn-primary">Yes</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</form>
