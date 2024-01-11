<?php
$host       = "localhost";
$user       = "id21771275_aquafiesta123";
$pass       = "Ui&]<9/h#A|7$l5%";
$db         = "id21771275_kolamrenang";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak dapat terkoneksi ke database. Error: " . mysqli_connect_error());
}
//Kode di atas digunakan untuk menghubungkan aplikasi ke database MySQL menggunakan fungsi mysqli_connect. 
//Jika koneksi gagal, aplikasi akan menampilkan pesan kesalahan.
// Inisialisasi variabel


$id_penyewaan = "";
$kolam_renang_id = "";
$club_id = "";
$awal_sewa = "";
$akhir_sewa = "";
$sukses = "";
$error = "";
// Periksa jenis operasi (tambah, edit, hapus, atau cari)
if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
//Variabel diinisialisasi dan jenis operasi (tambah, edit, hapus, atau cari) ditentukan berdasarkan parameter yang diterima melalui URL.


// Handle operasi hapus
if ($op == 'delete') {
    $id_penyewaan = $_GET['id'];
    $sql1 = "DELETE FROM penyewaan WHERE id_penyewaan = '$id_penyewaan'";
    $q1 = mysqli_query($koneksi, $sql1);
    if (!$q1) {
        die('Error dalam query: ' . mysqli_error($koneksi));
    } else {
        $error = ""; // Bersihkan pesan kesalahan jika penghapusan berhasil
        $sukses = "Data berhasil dihapus"; // Setel pesan sukses
    }
}
// Handle operasi edit
if ($op == 'edit') {
    $id_penyewaan = $_GET['id'];
    $sql1 = "SELECT * FROM penyewaan WHERE id_penyewaan = '$id_penyewaan'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $kolam_renang_id = $r1['kolam_renang_id_kolam_renang'];
    $club_id = $r1['club_id_club'];
    $awal_sewa = $r1['awal_sewa'];
    $akhir_sewa = $r1['akhir_sewa'];

    if ($kolam_renang_id == '') {
        $error = "Data tidak ditemukan";
    }
}
//Bagian ini menangani operasi hapus dan edit. Jika operasi adalah hapus,
// data yang sesuai dihapus dari database. Jika operasi adalah edit, 
//data yang akan diedit diambil dari database untuk ditampilkan pada formulir.




// Handle pengiriman formulir operasi tambah/edit
if (isset($_POST['simpan'])) {
    $kolam_renang_id = $_POST['kolam_renang_id'];
    $club_id = $_POST['club_id'];
    $awal_sewa = $_POST['awal_sewa'];
    $akhir_sewa = $_POST['akhir_sewa'];

    if ($kolam_renang_id && $club_id && $awal_sewa && $akhir_sewa) {
        if ($op == 'edit') {
            $sql1 = "UPDATE penyewaan SET kolam_renang_id_kolam_renang = '$kolam_renang_id', club_id_club = '$club_id', awal_sewa = '$awal_sewa', akhir_sewa = '$akhir_sewa' WHERE id_penyewaan = '$id_penyewaan'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diperbarui";
            } else {
                $error = "Data gagal diperbarui";
            }
        } else {
            $sql1 = "INSERT INTO penyewaan (kolam_renang_id_kolam_renang, club_id_club, awal_sewa, akhir_sewa) VALUES ('$kolam_renang_id', '$club_id', '$awal_sewa', '$akhir_sewa')";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil memasukkan data baru";
            } else {
                $error = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
//Kode ini menangani pengiriman formulir tambah atau edit. Data yang dimasukkan melalui formulir akan disimpan ke database.





// Handle pencarian
if ($op == 'search' && isset($_GET['cari'])) {
    $searchValue = $_GET['cari'];
    $sql2 = "SELECT * FROM penyewaan WHERE kolam_renang_id_kolam_renang = '$searchValue' ORDER BY id_penyewaan DESC";
} else {
    // Query default tanpa pencarian
    $sql2 = "SELECT * FROM penyewaan ORDER BY id_penyewaan DESC";
}
//Jika operasi adalah pencarian ($op == 'search'),
// maka query database akan disesuaikan untuk mencari data sesuai dengan nilai yang dimasukkan.
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penyewaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px;
        }

        .card {
            margin-top: 10px;
        }

        .header {
            background-color: white;
            padding: 10px;
            color: white;
            text-align: center;
            font-size: 24px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- Header with Image -->
        <div class="header">
            <img src="Blue Simple Swimming Club Logo - Logos.png" alt="Header Image" class="header-image">
            <p>Kolam Renang</p>
        </div>
        <!-- Form untuk memasukkan atau mengedit data -->
        <div class="card">
            <div class="card-header">
                Tambah / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=penyewaan.php");
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=penyewaan.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="kolam_renang_id" class="col-sm-2 col-form-label">ID Kolam Renang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kolam_renang_id" name="kolam_renang_id" value="<?php echo $kolam_renang_id ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="club_id" class="col-sm-2 col-form-label">ID Club</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="club_id" name="club_id" value="<?php echo $club_id ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="awal_sewa" class="col-sm-2 col-form-label">Awal Sewa</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="awal_sewa" name="awal_sewa" value="<?php echo $awal_sewa ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="akhir_sewa" class="col-sm-2 col-form-label">Akhir Sewa</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="akhir_sewa" name="akhir_sewa" value="<?php echo $akhir_sewa ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
                <div class="col-12 mt-3">
                        <a href="dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
                </div>
            </div>
        </div>

        <!-- Tabel untuk menampilkan data penyewaan -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Penyewaan
            </div>
            <div class="card-body">
                <!-- Tombol Pencarian dan Refresh -->
                <div class="mb-3">
                    <input type="text" id="cari" class="form-control" placeholder="Cari ID Kolam Renang">
                    <button class="btn btn-primary" onclick="searchData()">Cari</button>
                    <button class="btn btn-secondary" onclick="refreshData()">Refresh</button>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID Kolam Renang</th>
                            <th scope="col">ID Club</th>
                            <th scope="col">Awal Sewa</th>
                            <th scope="col">Akhir Sewa</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $q2 = mysqli_query($koneksi, $sql2);
                        if (!$q2) {
                            die('Error dalam query: ' . mysqli_error($koneksi));
                        }
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id_penyewaan = $r2['id_penyewaan'];
                            $kolam_renang_id = $r2['kolam_renang_id_kolam_renang'];
                            $club_id = $r2['club_id_club'];
                            $awal_sewa = $r2['awal_sewa'];
                            $akhir_sewa = $r2['akhir_sewa'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $kolam_renang_id ?></td>
                                <td scope="row"><?php echo $club_id ?></td>
                                <td scope="row"><?php echo $awal_sewa ?></td>
                                <td scope="row"><?php echo $akhir_sewa ?></td>
                                <td scope="row">
                                    <a href="penyewaan.php?op=edit&id=<?php echo $id_penyewaan ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="penyewaan.php?op=delete&id=<?php echo $id_penyewaan ?>" onclick="return confirm('Yakin mau hapus data?')"><button type="button" class="btn btn-danger">Hapus</button></a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Script JavaScript digunakan untuk menangani fungsi pencarian dan refresh pada halaman. -->
    <script>
        function searchData() {
            var searchValue = document.getElementById("cari").value;
            window.location.href = "penyewaan.php?op=search&cari=" + searchValue;
        }

        function refreshData() {
            window.location.href = "penyewaan.php";
        }
    </script>
</body>

</html>