<!-- content-header -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Barang</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Barang</li>
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
			<div class="col-sm-12 col-md-10">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Barang</h3>
						<div class="card-tools">
							<a href="<?= site_url('barang/add'); ?>" class="btn btn-primary btn-sm">
								<i class="fas fa-plus"></i> Tambah Barang
							</a>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="table_data" class="table">
								<thead>
									<tr>
										<th class="align-middle">#</th>
										<th class="align-middle">Barang</th>
										<th class="align-middle text-center"><i class="fas fa-cogs"></i></th>
									</tr>
								</thead>
								<tbody>

									<?php if ($arr->num_rows() > 0) : ?>
										<?php
										$no = 0;
										foreach ($arr->result() as $key) :
										?>

											<tr>
												<td class="align-middle">
													<?= ++$no; ?>
												</td>
												<td class="align-middle">
													<?= $key->nama; ?>
												</td>
												<td class="text-center align-middle">
													<div class="btn-group" role="group">
														<div class="btn-group" role="group">
															<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
																Actions
															</button>
															<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
																<a href="<?= site_url('barang/edit/' . $key->id); ?>" class="dropdown-item">
																	<i class=" fas fa-pencil-alt fa-fw"></i> Edit
																</a>
																<button class="dropdown-item" onclick="modalDelete(<?= $key->id; ?>, '<?= $key->nama; ?>');">
																	<i class="fas fa-trash fa-fw"></i> Delete
																</button>
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

<div class="modal fade" id="modal_ukuran" data-backdrop="static" data-keyboard="false" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ukuran <span id="nama_barang"></span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table table-dark">
					<thead id="vukuran">
						<tr>
							<th>-</th>
						</tr>
					</thead>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
