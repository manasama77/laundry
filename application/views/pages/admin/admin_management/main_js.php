<script>
	$(document).ready(function() {
		$('.bond_tooltip').tooltip({
			boundary: 'window'
		})

		$("#table_data").DataTable({
			"scrollX": "300px",
			"scrollY": "300px",
			order: [
				[0, 'asc']
			],
			responsive: false,
			lengthChange: false,
			autoWidth: false,
			buttons: ["copy", "csv", "excel", "pdf"],
			columnDefs: [{
				targets: [4],
				orderable: false
			}]
		}).buttons().container().appendTo('#table_data_wrapper .col-md-6:eq(0)');

		$('#form_add').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: '<?= site_url('admin_management/store'); ?>',
				method: 'post',
				dataType: 'json',
				data: $('#form_add').serialize(),
				beforeSend: function() {
					$.blockUI();
				}
			}).always(function(e) {
				$.unblockUI();
			}).fail(function(e) {
				console.log(e);
				if (e.responseText != '') {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						html: e.responseText,
					});
				}
			}).done(function(e) {
				console.log(e);
				if (e.code == 400) {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						html: e.status_text,
					});
				} else if (e.code == 500) {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						html: e.status_text,
					}).then(() => {
						window.location.reload();
					});
				} else if (e.code == 200) {
					Swal.fire({
						icon: 'success',
						title: 'Success...',
						html: e.status_text,
					}).then(() => {
						window.location.reload();
					});
				}
			});
		});

		$('#form_edit').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: '<?= site_url('admin_management/update'); ?>',
				method: 'post',
				dataType: 'json',
				data: $('#form_edit').serialize(),
				beforeSend: function() {
					$.blockUI();
				}
			}).always(function(e) {
				$.unblockUI();
			}).fail(function(e) {
				console.log(e);
				if (e.responseText != '') {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						html: e.responseText,
					});
				}
			}).done(function(e) {
				console.log(e);
				if (e.code == 500) {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						html: e.status_text,
					}).then(() => {
						window.location.reload();
					});
				} else if (e.code == 200) {
					Swal.fire({
						icon: 'success',
						title: 'Success...',
						html: e.status_text,
					}).then(() => {
						window.location.reload();
					});
				}
			});
		});

		$('#form_delete').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: '<?= site_url('admin_management/delete'); ?>',
				method: 'post',
				dataType: 'json',
				data: $('#form_delete').serialize(),
				beforeSend: function() {
					$.blockUI();
				}
			}).always(function(e) {
				$.unblockUI();
			}).fail(function(e) {
				console.log(e);
				if (e.responseText != '') {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						html: e.responseText,
					});
				}
			}).done(function(e) {
				console.log(e);
				if (e.code == 500) {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						html: e.status_text,
					}).then(() => {
						window.location.reload();
					});
				} else if (e.code == 200) {
					Swal.fire({
						icon: 'success',
						title: 'Success...',
						html: e.status_text,
					}).then(() => {
						window.location.reload();
					});
				}
			});
		});

		$('#form_reset').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: '<?= site_url('admin_management/reset'); ?>',
				method: 'post',
				dataType: 'json',
				data: $('#form_reset').serialize(),
				beforeSend: function() {
					$.blockUI();
				}
			}).always(function(e) {
				$.unblockUI();
			}).fail(function(e) {
				console.log(e);
				if (e.responseText != '') {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						html: e.responseText,
					});
				}
			}).done(function(e) {
				console.log(e);
				if (e.code == 500) {
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						html: e.status_text,
					}).then(() => {
						window.location.reload();
					});
				} else if (e.code == 200) {
					Swal.fire({
						icon: 'success',
						title: 'Success...',
						html: e.status_text,
					}).then(() => {
						window.location.reload();
					});
				}
			});
		});
	});

	function modalEdit(id, username, name, id_ruangan, is_active) {
		$('#id_edit').val(id);
		$('#username_edit').val(username);
		$('#name_edit').val(name);
		$('#id_ruangan_edit').val(id_ruangan);
		$('#is_active_edit').val(is_active);
		$('#modal_edit').modal('show');
	}

	function modalDelete(id, username) {
		$('#id_delete').val(id);
		$('#username_delete').text(username);
		$('#modal_delete').modal('show');
	}

	function modalReset(id, username) {
		$('#id_reset').val(id);
		$('#username_reset').val(username);
		$('#password_reset').val('');
		$('#modal_reset').modal('show');
	}

	function keyPressed() {
		var key = event.keyCode || event.charCode || event.which;
		return key;
	}
</script>
