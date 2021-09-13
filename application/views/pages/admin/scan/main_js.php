<script>
	let form = $('#form');
	let from_id_ruangan = $('#from_id_ruangan');
	let to_id_ruangan = $('#to_id_ruangan');
	let kode = $('#kode');
	let simpan = $('#simpan');
	let vlist = $('#vlist');

	let scanList = [];
	let emptyList = `<tr><td colspan="5" class="text-center">Data Scan Kosong</td></tr>`;

	$(document).ready(function() {
		init();

		form.on('submit', function(e) {
			e.preventDefault();
		});

		kode.on('keypress', function(e) {
			if (e.which == 13) {
				prosesScan();
			}
		});

		simpan.on('click', function(e) {
			checkListScan();
		});
	});

	function init() {
		localStorage.removeItem('scan_list');
	}

	function prosesScan() {
		if (kode.val()) {
			if (from_id_ruangan.val() == to_id_ruangan.val()) {
				Swal.fire({
					icon: 'warning',
					title: 'Oops...',
					html: "Tujuan Ruangan Tidak Boleh Sama",
					showConfirmButton: false,
					timer: 2000,
					timerProgressBar: true
				}).then(() => {
					renderList();
					kode.val('').focus();
				});
			} else {
				checkKode();
			}
		}
	}

	function checkKode() {
		$.ajax({
			url: '<?= site_url('scan/kode'); ?>',
			method: 'get',
			dataType: 'json',
			data: {
				from_id_ruangan: from_id_ruangan.val(),
				from_nama_ruangan: $('#from_id_ruangan option:selected').text(),
				kode: kode.val(),
			},
			beforeSend: function() {
				kode.attr('disabled', true);
				vlist.block({
					message: `<i class="fas fa-spinner fa-spin"></i>`
				});
			}
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
			if (e.code == 404) {
				Swal.fire({
					icon: 'warning',
					title: 'Oops...',
					html: e.message,
					showConfirmButton: false,
					timer: 2000,
					timerProgressBar: true
				}).then(() => {
					renderList();
					kode.val('').focus();
				});
			} else if (e.code == 400) {
				Swal.fire({
					icon: 'warning',
					title: 'Oops...',
					html: e.message,
					showConfirmButton: false,
					timer: 5000,
					timerProgressBar: true
				}).then(() => {
					renderList();
					kode.val('').focus();
				});
			} else if (e.code == 200) {
				let from_nama_ruangan = $('#from_id_ruangan option:selected').text();
				let to_nama_ruangan = $('#to_id_ruangan option:selected').text();
				let nama_barang = e.nama_barang;
				let nama_ukuran = e.nama_ukuran;
				storeScan(from_nama_ruangan, to_nama_ruangan, nama_barang, nama_ukuran);
			}
		});
	}

	function storeScan(from_nama_ruangan, to_nama_ruangan, nama_barang, nama_ukuran) {
		let nested = JSON.stringify({
			from_id_ruangan: from_id_ruangan.val(),
			from_nama_ruangan: from_nama_ruangan,
			to_id_ruangan: to_id_ruangan.val(),
			to_nama_ruangan: to_nama_ruangan,
			kode: kode.val(),
			nama_barang: nama_barang,
			nama_ukuran: nama_ukuran,
		});

		scanList.push(nested);
		localStorage.setItem("scan_list", JSON.stringify(scanList));
		Swal.fire({
			icon: 'success',
			title: 'Proses Scan Berhasil...',
			showConfirmButton: false,
			timer: 1500,
			timerProgressBar: true,
			toast: true
		}).then(() => {
			renderList();
		});
	}

	function renderList() {
		if (scanList.length == 0) {
			vlist.html(emptyList);
		} else {
			vlist.html("");
			for (let i in scanList) {
				let item = JSON.parse(scanList[i]);
				nestedHTML = `
				<tr>
					<td>
						<button class="btn btn-danger btn-sm" onclick="deleteScan(${i})">
							<i class="fas fa-trash"></i>
						</button>
					</td>
					<td>${item.nama_barang}</td>
					<td>${item.nama_ukuran}</td>
					<td>${item.from_nama_ruangan}</td>
					<td>${item.to_nama_ruangan}</td>
				</tr>
				`;
				vlist.append(nestedHTML);
			}
		}

		setTimeout(function() {
			kode.attr('disabled', false);
			vlist.unblock();
			kode.val('').focus();
		}, 500);

	}

	function deleteScan(index) {
		kode.attr('disabled', true);
		vlist.block({
			message: `<i class="fas fa-spinner fa-spin"></i>`
		});

		setTimeout(function() {
			scanList.splice(index, 1);
			localStorage.setItem("scan_list", JSON.stringify(scanList));
			renderList();
		}, 1000);
	}

	function checkListScan() {
		if (scanList.length == 0) {
			Swal.fire({
				icon: 'warning',
				title: 'Oops...',
				html: "Data Scan Kosong",
				showConfirmButton: false,
				timer: 2000,
				timerProgressBar: true
			}).then(() => {
				kode.val('').focus();
			});
		} else {
			console.log("Simpan");
			$.ajax({
				url: '<?= site_url('scan/store'); ?>',
				method: 'post',
				dataType: 'json',
				data: {
					data: scanList
				},
				beforeSend: function() {
					$.blockUI({
						message: `<i class="fas fa-spinner fa-spin"></i>`
					});
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
						title: e.message,
						showConfirmButton: false,
						timer: 5000,
						timerProgressBar: true,
						toast: false
					}).then(() => {
						window.location.reload();
					});
				} else {
					Swal.fire({
						icon: 'success',
						title: e.message,
						showConfirmButton: false,
						timer: 2000,
						timerProgressBar: true,
						toast: false
					}).then(() => {
						window.location.reload();
					});
				}
			});
		}
	}
</script>
