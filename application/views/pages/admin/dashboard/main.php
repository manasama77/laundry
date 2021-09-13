<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Dashboard</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a></li>
					<li class="breadcrumb-item active">Dashboard</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box">
					<span class="info-box-icon bg-primary elevation-1"><i class="fas fa-tshirt"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Jumlah Barang</span>
						<span class="info-box-number">
							<?= $card['count_barang']; ?>
						</span>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-3">
				<div class="info-box">
					<span class="info-box-icon bg-info elevation-1"><i class="fas fa-tshirt"></i></span>
					<div class="info-box-content">
						<span class="info-box-text">Jumlah Ukuran</span>
						<span class="info-box-number">
							<?= $card['count_ukuran']; ?>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<?php foreach ($card['count_ruangan'] as $key => $value) : ?>
				<div class="col-12 col-sm-6 col-md-4">
					<div class="info-box">
						<span class="info-box-icon bg-purple elevation-1"><i class="fas fa-person-booth"></i></span>
						<div class="info-box-content">
							<span class="info-box-text">Barang di Ruangan <?= $key; ?></span>
							<span class="info-box-number">
								<?= $value; ?>
							</span>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
