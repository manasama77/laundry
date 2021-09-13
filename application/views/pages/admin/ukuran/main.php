<!-- content-header -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Ukuran</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Ukuran</li>
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
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Ukuran</h3>
						<div class="card-tools">
							<a href="<?= site_url('ukuran/add'); ?>" class="btn btn-primary btn-sm">
								<i class="fas fa-plus"></i> Tambah Ukuran
							</a>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="table_data" class="table table-bordered">
								<thead class="bg-dark">
									<tr>
										<th class="align-middle">#</th>
										<th class="align-middle">Barang</th>
										<th class="align-middle text-center">Ukuran</th>
										<th class="align-middle">Kode</th>
										<th class="align-middle">Ruangan</th>
										<th class="align-middle text-right">Jumlah Laundry</th>
										<th class="align-middle text-right">Jumlah Pakai</th>
										<th class="align-middle text-right">Limit Laundry</th>
										<th class="align-middle text-right">Limit Pakai</th>
										<th class="align-middle text-center"><i class="fas fa-cogs"></i></th>
									</tr>
								</thead>
								<tbody>

									<?php if ($arr->num_rows() > 0) : ?>
										<?php
										$no = 0;
										foreach ($arr->result() as $key) :
											$bg = "bg-success";
											if ($key->limit_laundry > 0 || $key->limit_pakai > 0) {
												if ($key->jumlah_laundry >= $key->limit_laundry || $key->jumlah_pakai >= $key->limit_pakai) {
													$bg = "bg-danger";
												}
											}
										?>

											<tr class="<?= $bg; ?>">
												<td class="align-middle">
													<?= ++$no; ?>
												</td>
												<td class="align-middle">
													<?= $key->nama_barang; ?>
												</td>
												<td class="align-middle text-center">
													<?= $key->nama_ukuran; ?>
												</td>
												<td class="align-middle">
													<?= $key->kode; ?>
												</td>
												<td class="align-middle">
													<?= $key->nama_ruangan; ?>
												</td>
												<td class="align-middle text-right">
													<?= $key->jumlah_laundry; ?>
												</td>
												<td class="align-middle text-right">
													<?= $key->jumlah_pakai; ?>
												</td>
												<td class="align-middle text-right">
													<?= $key->limit_laundry; ?>
												</td>
												<td class="align-middle text-right">
													<?= $key->limit_pakai; ?>
												</td>
												<td class="text-center align-middle">
													<div class="btn-group" role="group">
														<div class="btn-group" role="group">
															<button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-toggle="dropdown">
																Actions
															</button>
															<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
																<a href="<?= site_url('ukuran/edit/' . $key->id); ?>" class="dropdown-item">
																	<i class=" fas fa-pencil-alt fa-fw"></i> Edit
																</a>
																<button class="dropdown-item" onclick="modalDelete(<?= $key->id; ?>, '<?= $key->nama_ukuran; ?>', '<?= $key->nama_ukuran; ?>');">
																	<i class="fas fa-trash fa-fw"></i> Delete
																</button>
																<hr>
																<a href="<?= site_url('ukuran/print/' . $key->id); ?>" class="dropdown-item" target="_blank">
																	<i class=" fas fa-qrcode fa-fw"></i> Print QR Code
																</a>
															</div>
														</div>
													</div>
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
