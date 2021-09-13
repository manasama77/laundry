<script>
	$(document).ready(function() {
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
				targets: [2],
				orderable: false
			}]
		}).buttons().container().appendTo('#table_data_wrapper .col-md-6:eq(0)');

		$('#form_delete').on('submit', function(e) {
			e.preventDefault();

			$.ajax({
				url: '<?= site_url('barang/delete'); ?>',
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
	});

	function modalDelete(id, nama) {
		$('#id').val(id);
		$('#nama_delete').text(nama);
		$('#modal_delete').modal('show');
	}
</script>
