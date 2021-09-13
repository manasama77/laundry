<!-- content-header -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Ruangan</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Ruangan</li>
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
			<div class="col-sm-12 col-md-8">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Ruangan</h3>
						<div class="card-tools">
							<a href="<?= site_url('ruangan/add'); ?>" class="btn btn-primary btn-sm">
								<i class="fas fa-plus"></i> Tambah Ruangan
							</a>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="table_data" class="table">
								<thead>
									<tr>
										<th class="align-middle">#</th>
										<th class="align-middle">Ruangan</th>
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
													<?php if ($key->id != 1) : ?>
														<div class="btn-group" role="group">
															<div class="btn-group" role="group">
																<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
																	Actions
																</button>
																<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
																	<a href="<?= site_url('ruangan/edit/' . $key->id); ?>" class="dropdown-item">
																		<i class=" fas fa-pencil-alt fa-fw"></i> Edit
																	</a>
																	<button class="dropdown-item" onclick="modalDelete(<?= $key->id; ?>, '<?= $key->nama; ?>');">
																		<i class="fas fa-trash fa-fw"></i> Delete
																	</button>
																</div>
															</div>
														</div>
													<?php endif; ?>
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

<form id="form_reset">
	<div class="modal fade" id="modal_reset" data-backdrop="static" data-keyboard="false" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Reset Password</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form_group mb-2">
						<label for="username_reset">Username</label>
						<input type="text" class="form-control" id="username_reset" name="username" required readonly>
					</div>
					<div class="form_group mb-2">
						<label for="password_reset">New Password</label>
						<input type="password" class="form-control" id="password_reset" name="password" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_reset" name="id">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</form>
