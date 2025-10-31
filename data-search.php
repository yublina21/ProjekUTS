<?php
// Menghubungkan ke class Menu
include_once 'config/class-menu.php';
$menu = new Menu();

// Inisialisasi variabel pencarian
$kataKunci = '';
$cariMenu = [];

// Mengecek apakah parameter GET 'search' ada
if (isset($_GET['search'])) {
    // Gunakan htmlspecialchars untuk keamanan input pencarian
    $kataKunci = htmlspecialchars($_GET['search']);
    // Memanggil method searchMenu untuk mencari data menu
    $cariMenu = $menu->searchMenu($kataKunci);
}
?>
<!doctype html>
<html lang="en">
    <head>
        <?php include 'template/header.php'; ?>
    </head>

    <body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">
        <div class="app-wrapper">

            <?php include 'template/navbar.php'; ?>
            <?php include 'template/sidebar.php'; ?>

            <main class="app-main">

                <div class="app-content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="mb-0">Cari Menu</h3>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-end">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Cari Menu</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="app-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">

                                <!-- FORM PENCARIAN -->
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h3 class="card-title">Pencarian Menu</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="data-search.php" method="GET">
                                            <div class="mb-3">
                                                <label for="search" class="form-label">Masukkan jenis menu</label>
                                                <input type="text" class="form-control" id="search" name="search" placeholder="Cari berdasarkan nama atau kategori menu" value="<?php echo $kataKunci; ?>" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary"><i class="bi bi-search-heart-fill"></i> Cari</button>
                                        </form>
                                    </div>
                                </div>

                                <!-- HASIL PENCARIAN -->
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Hasil Pencarian</h3>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        if (isset($_GET['search'])) {
                                            // Jika ada data hasil pencarian
                                            if (count($cariMenu) > 0) {
                                                echo '<table class="table table-striped" role="table">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Menu</th>
                                                            <th>Kategori</th>
                                                            <th>Harga</th>
                                                            <th>Deskripsi</th>
                                                            <th>Status</th>
                                                            <th class="text-center">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';

                                                foreach ($cariMenu as $index => $row) {
                                                    // pastikan keys yang dipakai sesuai dengan return dari class-menu (nama_menu, id_menu)
                                                    $nama_menu = isset($row['nama_menu']) ? (string)$row['nama_menu'] : '';
                                                    $kategori  = isset($row['kategori']) ? (string)$row['kategori'] : '';
                                                    $deskripsi = isset($row['deskripsi']) ? (string)$row['deskripsi'] : '';
                                                    $harga_raw = isset($row['harga']) ? $row['harga'] : 0;
                                                    $id_menu   = isset($row['id_menu']) ? $row['id_menu'] : '';

                                                    // Ubah status menjadi badge (mengakomodasi 'Tersedia' atau 1)
                                                    if (isset($row['status']) && ($row['status'] === 'Tersedia' || $row['status'] === 1 || $row['status'] === '1')) {
                                                        $badge = '<span class="badge bg-success">Tersedia</span>';
                                                    } else {
                                                        $badge = '<span class="badge bg-danger">Tidak Tersedia</span>';
                                                    }

                                                    // Baris data menu — gunakan htmlspecialchars dengan fallback string supaya tidak mengirim null ke htmlspecialchars()
                                                    echo '<tr class="align-middle">
                                                            <td>' . ($index + 1) . '</td>
                                                            <td>' . htmlspecialchars($nama_menu ?? '') . '</td>
                                                            <td>' . htmlspecialchars($kategori ?? '') . '</td>
                                                            <td>Rp ' . number_format((int)$harga_raw, 0, ',', '.') . '</td>
                                                            <td>' . htmlspecialchars($deskripsi ?? '') . '</td>
                                                            <td>' . $badge . '</td>
                                                            <td class="text-center">
                                                                <button type="button" class="btn btn-sm btn-warning" onclick="window.location.href=\'data-edit.php?id=' . htmlspecialchars((string)$id_menu) . '\'"><i class="bi bi-pencil-square"></i> Edit</button>
                                                                <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm(\'Yakin ingin menghapus menu ini?\')){window.location.href=\'proses/proses-delete.php?id=' . htmlspecialchars((string)$id_menu) . '\'}"><i class="bi bi-trash-fill"></i> Hapus</button>
                                                            </td>
                                                        </tr>';
                                                }

                                                echo '</tbody></table>';
                                            } else {
                                                echo '<div class="alert alert-warning" role="alert">
                                                    Tidak ditemukan data menu yang sesuai dengan kata kunci "<strong>' . htmlspecialchars($_GET['search'] ?? '') . '</strong>".
                                                    </div>';
                                            }
                                        } else {
                                            echo '<div class="alert alert-info" role="alert">
                                                Silakan masukkan kata kunci pencarian di atas untuk mencari data menu.
                                                </div>';
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </main>

            <?php include 'template/footer.php'; ?>

        </div>

        <?php include 'template/script.php'; ?>
    </body>
</html>
