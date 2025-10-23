<!doctype html>
<html lang="en">
	<head>
		<?php include 'template/header.php'; // Menyertakan header template ?>
	</head>

	<body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">

		<div class="app-wrapper">

			<?php include 'template/navbar.php'; // Menyertakan navbar template ?>

			<?php include 'template/sidebar.php'; // Menyertakan sidebar template ?>

			<main class="app-main">

				<div class="app-content-header">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-6">
								<h3 class="mb-0">EPIC</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Home</li>
								</ol>
							</div>
						</div>
					</div>
				</div>

				<div class="app-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="card">

									<div class="card-header">
										<h3 class="card-title">EPIC, Siap Mengisi Energi Anda! 
											Temukan cita rasa terbaik dan pengalaman bersantap yang tak terlupakan.</h3>
										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse">
												<i data-lte-icon="expand" class="bi bi-plus-lg"></i>
												<i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
											</button>
											<button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
												<i class="bi bi-x-lg"></i>
											</button>
										</div>
									</div>

									<div class="card-body">
										<p>Halo! Epic adalah Sistem Informasi CRUD Manajemen Menu dan Pesanan restoran. Aplikasi ini bertujuan untuk mengajarkan Anda bagaimana merancang dashboard pengelolaan restoran dengan konsep CRUD (Create, Read, Update, Delete) menggunakan bahasa pemrograman PHP. Seluruh penulisan kode diimplementasikan dengan paradigma OOP (Object Oriented Programming).</p>
										<p>Silakan gunakan secara bijak, modifikasi kode, dan kembangkan fitur sesuai kebutuhan operasional restoran Anda! 🍽️👨‍🍳</p>
										<a href="data-input.php" class="btn btn-primary btn-lg"><i class="bi bi-clipboard-data-fill"></i> Input Daftar Menu</a>
										<a href="data-list.php" class="btn btn-success btn-lg"><i class="bi bi-card-list"></i> Lihat Daftar Menu</a>
										<a href="data-search.php" class="btn btn-warning btn-lg"><i class="bi bi-search-heart-fill"></i> Cari Daftar Menu</a>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>

			</main>

			<?php include 'template/footer.php'; // Menyertakan footer template ?>

		</div>
		
		<?php include 'template/script.php'; // Menyertakan script template ?>

	</body>
</html>