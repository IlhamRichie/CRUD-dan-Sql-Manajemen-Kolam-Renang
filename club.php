<?php
$host       = "localhost";
$user       = "id21771275_aquafiesta123";
$pass       = "Ui&]<9/h#A|7$l5%";
$db         = "id21771275_kolamrenang";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database. Error: " . mysqli_connect_error());
}

$id_club = "";
$club = "";
$penanggung_jawab = "";
$no_kontak = "";
$email = "";
$alamat = "";
$pelatih_id_pelatih = "";
$sukses = "";
$error = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id_club = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';

    if (!empty($id_club)) {
        $sql1 = "DELETE FROM club WHERE id_club = '$id_club'";
        $q1 = mysqli_query($koneksi, $sql1);

        if (!$q1) {
            die('Error in query: ' . mysqli_error($koneksi));
        } else {
            $error = "Data berhasil dihapus";
        }
    } else {
        $error = "ID club tidak valid";
    }
}

if ($op == 'edit') {
    $id_club = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';
    $sql1 = "SELECT * FROM club WHERE id_club = '$id_club'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $club = $r1['club'];
    $penanggung_jawab = $r1['penanggung_jawab'];
    $no_kontak = $r1['no_kontak'];
    $email = $r1['email'];
    $alamat = $r1['alamat'];
    $pelatih_id_pelatih = $r1['pelatih_id_pelatih'];

    if (empty($club)) {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $new_id_club = mysqli_real_escape_string($koneksi, $_POST['id_club']);
    $club = mysqli_real_escape_string($koneksi, $_POST['club']);
    $penanggung_jawab = mysqli_real_escape_string($koneksi, $_POST['penanggung_jawab']);
    $no_kontak = mysqli_real_escape_string($koneksi, $_POST['no_kontak']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $pelatih_id_pelatih = mysqli_real_escape_string($koneksi, $_POST['pelatih_id_pelatih']);

    if (!empty($club) && !empty($new_id_club) && !empty($penanggung_jawab) && !empty($no_kontak)) {
        if ($op == 'edit') {
            $sql1 = "UPDATE club SET id_club = '$new_id_club', club = '$club', penanggung_jawab = '$penanggung_jawab', no_kontak = '$no_kontak', email = '$email', alamat = '$alamat', pelatih_id_pelatih = '$pelatih_id_pelatih' WHERE id_club = '$id_club'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error = "Data gagal diupdate: " . mysqli_error($koneksi);
            }
        } else {
            $sql1 = "INSERT INTO club (id_club, club, penanggung_jawab, no_kontak, email, alamat, pelatih_id_pelatih) VALUES ('$new_id_club', '$club', '$penanggung_jawab', '$no_kontak', '$email', '$alamat', '$pelatih_id_pelatih')";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil memasukkan data baru";
            } else {
                $error = "Gagal memasukkan data: " . mysqli_error($koneksi);
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}

?>
<!-- ... (HTML part remains unchanged) ... -->

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- 1. Pengaturan Meta dan Title -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data club</title>

    <!-- 2. Penambahan Stylesheet Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    
    <!-- 3. Penambahan Stylesheet Custom -->
    <style>
        .mx-auto {
            width: 1400px
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
    <!-- 4. Container Utama dengan class mx-auto -->
    <div class="mx-auto">
        <!-- Header with Image -->
        <div class="header">
            <img src="Blue Simple Swimming Club Logo - Logos.png" alt="Header Image" class="header-image">
            <p>Kolam Renang</p>
        </div>
        <!-- 5. Formulir untuk Memasukkan Data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                // 6. Menampilkan Pesan Error Jika terdapat kesalahan di dalam codingan
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                // 7. Me-refresh Halaman Setelah 5 Detik Jika Terdapat Error
                    header("refresh:5;url=club.php");
                }
                ?>
                <?php
                // 8. Menampilkan Pesan Sukses
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                 // 9. Me-refresh Halaman Selama 5 Detik Jika Berhasil
                    header("refresh:5;url=club.php");
                }
                ?>
                
                <!-- 10. Formulir Untuk Memasukkan atau Mengedit Data -->
                <form action="" method="POST">
                     <!-- 11. Input Form untuk ID CLUB -->
                    <div class="mb-3 row">
                        <label for="id_club" class="col-sm-2 col-form-label">ID CLUB</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_club" name="id_club" value="<?php echo $id_club ?>">
                        </div>
                    </div>

                    <!-- 12. Input Form untuk NAMA CLUB -->
                    <div class="mb-3 row">
                        <label for="club" class="col-sm-2 col-form-label">NAMA CLUB</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="club" name="club" value="<?php echo $club?>">
                        </div>
                    </div>

                    <!-- . Input Form untuk PENANGGUNG JAWAB -->
                    <div class="mb-3 row">
                        <label for="penanggung_jawab" class="col-sm-2 col-form-label">PENANGGUNG JAWAB</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab" value="<?php echo $penanggung_jawab ?>">
                        </div>
                    </div>

                    <!-- . Input Form untuk NO KONTAK -->
                    <div class="mb-3 row">
                        <label for="no_kontak" class="col-sm-2 col-form-label">NO KONTAK</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no_kontak" name="no_kontak" value="<?php echo $no_kontak ?>">
                        </div>
                    </div>

                    <!-- . Input Form untuk EMAIL -->
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">EMAIL</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                        </div>
                    </div>

                    <!-- . Input Form untuk ALAMAT -->
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">ALAMAT</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                        </div>
                    </div>

                    <!-- . Input Form untuk ID PELATIH -->
                    <div class="mb-3 row">
                        <label for="pelatih_id_pelatih" class="col-sm-2 col-form-label">ID PELATIH</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pelatih_id_pelatih" name="pelatih_id_pelatih" value="<?php echo $pelatih_id_pelatih ?>">
                        </div>
                    </div>

                    <!-- 13. Tombol untuk Mengirimkan Formulir -->
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
                <div class="col-12 mt-3">
                        <a href="dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
                </div>
            </div>
        </div>

        <!-- 14. Menampilkan Data Club dalam Tabel -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Club
            </div>
            <div class="card-body">
                
                <!-- 15. Tabel untuk Menampilkan Data Club -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID CLUB</th>
                            <th scope="col">NAMA CLUB</th>
                            <th scope="col">PENANGGUNG JAWAB</th>
                            <th scope="col">NO KONTAK</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">ALAMAT</th>
                            <th scope="col">ID PELATIH</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // 16. Menampilkan Data Club dari Database
                        $sql2 = "SELECT * FROM club ORDER BY id_club DESC";
                        $q2 = mysqli_query($koneksi, $sql2);
                        if (!$q2) {
                            die('Error in query: ' . mysqli_error($koneksi));
                        }
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id_club = $r2['id_club'];
                            $club = $r2['club'];
                            $penanggung_jawab = $r2['penanggung_jawab'];
                            $no_kontak = $r2['no_kontak'];
                            $email = $r2['email'];
                            $alamat = $r2['alamat'];
                            $pelatih_id_pelatih = $r2['pelatih_id_pelatih'];
                        ?>
                        <!-- 17. Baris Tabel untuk Setiap Data Club -->
                            <tr>
                                <td scope="row"><?php echo $id_club ?></td>
                                <th scope="row"><?php echo $club ?></th>
                                <td scope="row"><?php echo $penanggung_jawab ?></td>
                                <td scope="row"><?php echo $no_kontak ?></td>
                                <td scope="row"><?php echo $email ?></td>
                                <td scope="row"><?php echo $alamat ?></td>
                                <td scope="row"><?php echo $pelatih_id_pelatih ?></td>
                                <!-- 18. Tombol Edit dan Delete untuk Setiap Baris Tabel -->
                                <td scope="row">
                                    <a href="club.php?op=edit&id=<?php echo $id_club ?>"><button type="button" class="btn btn-warning">EDIT</button></a>
                                    <a href="club.php?op=delete&id=<?php echo $id_club ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">DELETE</button></a>
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
</body>

</html>