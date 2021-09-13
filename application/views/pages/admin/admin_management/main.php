<!-- content-header -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Admin Management</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Admin Management</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">

		<div class="row">
			<div class="col-sm-12 col-md-4">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Add New Admin</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="card-body">
						<form id="form_add">
							<div class="form_group mb-2">
								<label for="username">Username</label>
								<input type="text" class="form-control" id="username" name="username" onKeyDown="javascript: var keycode = keyPressed(event); if(keycode==32){ return false; }" required>
							</div>
							<div class="form_group mb-2">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="password" name="password" required>
							</div>
							<div class="form_group mb-2">
								<label for="name">Name</label>
								<input type="text" class="form-control" id="name" name="name" required>
							</div>
							<div class="form_group mb-3">
								<label for="id_ruangan">Ruangan</label>
								<select class="form-control" id="id_ruangan" name="id_ruangan">
									<option value="" selected>Semua Ruangan</option>
									<?php
									foreach ($arr_ruangan->result() as $item) {
										echo '<option value="' . $item->id . '">' . $item->nama . '</option>';
									}
									?>
								</select>
							</div>
							<button type="submit" class="btn btn-primary btn-block elevation-2z">Submit</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-8">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Admin Management</h3>

						<div class="card-tools">
							<button type="button" class="btn btn-tool" data-card-widget="collapse">
								<i class="fas fa-minus"></i>
							</button>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="table_data" class="table">
								<thead>
									<tr>
										<th class="align-middle">Username</th>
										<th class="align-middle">Nama</th>
										<th class="align-middle">Default Ruangan</th>
										<th class="text-center align-middle">Status</th>
										<th class="align-middle text-center"><i class="fas fa-cogs"></i></th>
									</tr>
								</thead>
								<tbody>

									<?php if ($arr->num_rows() > 0) : ?>
										<?php
										foreach ($arr->result() as $key) :
										?>

											<tr>
												<td class="align-middle">
													<?= $key->username; ?>
												</td>
												<td class="align-middle">
													<?= $key->name; ?>
												</td>
												<td class="align-middle">
													<?= ($key->nama_ruangan) ?? "Semua Ruangan"; ?>
												</td>
												<td class="text-center align-middle">
													<?php $badge_color = ($key->is_active == "yes") ? "success" : "dark"; ?>
													<span class="badge badge-<?= $badge_color; ?>">
														<?= strtoupper(($key->is_active == "yes") ? "Aktif" : "Tidak Aktif"); ?>
													</span>
												</td>
												<td class="text-center align-middle">
													<?php if ($key->id != 1) : ?>
														<div class="btn-group" role="group">
															<div class="btn-group" role="group">
																<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
																	Actions
																</button>
																<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
																	<button class="dropdown-item" onclick="modalEdit('<?= $key->id; ?>', '<?= $key->username; ?>', '<?= $key->name; ?>', '<?= $key->id_ruangan; ?>', '<?= $key->is_active; ?>');">
																		<i class="fas fa-pencil-alt fa-fw"></i> Edit
																	</button>
																	<button class="dropdown-item" onclick="modalDelete('<?= $key->id; ?>', '<?= $key->username; ?>');">
																		<i class="fas fa-trash fa-fw"></i> Delete
																	</button>
																	<button class="dropdown-item" onclick="modalReset('<?= $key->id; ?>', '<?= $key->username; ?>');">
																		<i class="fas fa-key fa-fw"></i> Reset Password
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

<form id="form_edit">
	<div class="modal fade" id="modal_edit" data-backdrop="static" data-keyboard="false" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form_group">
						<label for="username_edit">Username</label>
						<input type="text" class="form-control" id="username_edit" name="username" required readonly>
					</div>
					<div class="form_group">
						<label for="name_edit">Name</label>
						<input type="text" class="form-control" id="name_edit" name="name" required>
					</div>
					<div class="form_group">
						<label for="id_ruangan_edit">Ruangan</label>
						<select class="form-control" id="id_ruangan_edit" name="id_ruangan">
							<option value="">Semua Ruangan</option>
							<?php
							foreach ($arr_ruangan->result() as $item) {
								echo '<option value="' . $item->id . '">' . $item->nama . '</option>';
							}
							?>
						</select>
					</div>
					<div class="form_group">
						<label for="is_active_edit">Active</label>
						<select class="form-control" id="is_active_edit" name="is_active" required>
							<option value="yes">Yes</option>
							<option value="no">No</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_edit" name="id">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</form>

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
					Are you sure want to delete <span id="username_delete"></span> ?
				</div>
				<div class="modal-footer">
					<input type="hidden" id="id_delete" name="id">
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
