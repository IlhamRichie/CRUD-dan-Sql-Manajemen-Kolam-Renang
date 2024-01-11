<?php
$host       = "localhost";
$user       = "id21771275_aquafiesta123";
$pass       = "Ui&]<9/h#A|7$l5%";
$db         = "id21771275_kolamrenang";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {
    die("Tidak bisa terkoneksi ke database. Error: " . mysqli_connect_error());
}

$id_penggunaan = "";
$kolam_renang_id_kolam_renang = "";
$club_id_club = "";
$waktu_penggunaan = "";
$waktu_selesai = "";
$sukses = "";
$error = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id_pelatih = $_GET['id'];
    $sql1 = "DELETE FROM penggunaan WHERE id_penggunaan = '$id_penggunaan'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error  = "Gagal melakukan delete data";
    }
}

if ($op == 'edit') {
    $id_penggunaan = $_GET['id'];
    $sql1 = "SELECT * FROM penggunaan WHERE id_penggunaan = '$id_penggunaan'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $kolam_renang_id_kolam_renang = $r1['kolam_renang_id_kolam_renang'];
    $club_id_club = $r1['club_id_club'];
    $waktu_penggunaan = $r1['waktu_penggunaan'];
    $waktu_selesai = $r1['waktu_selesai'];

    if ($kolam_renang_id_kolam_renang == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $kolam_renang_id_kolam_renang = $_POST['kolam_renang_id_kolam_renang'];
    $club_id_club = $_POST['club_id_club'];
    $waktu_penggunaan = date('Y-m-d H:i:s', strtotime($_POST['waktu_penggunaan']));
    $waktu_selesai = date('Y-m-d H:i:s', strtotime($_POST['waktu_selesai']));
    if ($kolam_renang_id_kolam_renang && $club_id_club && $waktu_penggunaan && $waktu_selesai) {
        if ($op == 'edit') {
            $sql1 = "UPDATE penggunaan SET kolam_renang_id_kolam_renang = '$kolam_renang_id_kolam_renang', club_id_club = '$club_id_club', waktu_penggunaan = '$waktu_penggunaan', waktu_selesai = '$waktu_selesai' WHERE id_penggunaan = '$id_penggunaan'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error = "Data gagal diupdate";
            }
        } else {
            $sql1 = "INSERT INTO penggunaan (kolam_renang_id_kolam_renang, club_id_club, waktu_penggunaan, waktu_selesai) VALUES ('$kolam_renang_id_kolam_renang', '$club_id_club', '$waktu_penggunaan', '$waktu_selesai')";
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

// Tambahan untuk fitur pencarian
// Cek apakah ada istilah pencarian yang diberikan
if(isset($_POST['search'])) {
    $search = mysqli_real_escape_string($koneksi, $_POST['search']);

    $sql2 = "SELECT * FROM penggunaan WHERE 
              kolam_renang_id_kolam_renang LIKE '%$search%' OR 
              club_id_club LIKE '%$search%' OR 
              waktu_penggunaan LIKE '%$search%' OR 
              waktu_selesai LIKE '%$search%'
              ORDER BY id_penggunaan DESC";
} else {
    // Jika tidak ada istilah pencarian, ambil semua data
    $sql2 = "SELECT * FROM penggunaan ORDER BY id_penggunaan DESC";
}

$q2 = mysqli_query($koneksi, $sql2);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penggunaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 1200px
        }

        .card {
            margin-top: 10px;
        }

        .header-image {
            max-width: 100%;
            height: auto;
        }

        .header {
            background-color: white;
            padding: 10px;
            color: white;
            text-align: center;
            font-size: 24px;
        }

        .container {
            text-align: center;
        }
    </style>
    <script>
        function clearForm() {
            document.getElementById("kolam_renang_id_kolam_renang").value = "";
            document.getElementById("club_id_club").value = "";
            document.getElementById("waktu_penggunaan").value = "";
            document.getElementById("waktu_selesai").value = "";
        }
    </script>
</head>

<body>
    <div class="mx-auto">
        <!-- Header with Image -->
        <div class="header">
            <img src="Blue Simple Swimming Club Logo - Logos.png" alt="Header Image" class="header-image">
            <p>Kolam Renang</p>
        </div>
        
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header" style="background-color: #3498db; color: white;">
                Tambahkan / Sunting Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=penggunaan.php");
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=penggunaan.php");
                }
                ?>
                <form action="" method="POST">
                    <!-- Modify form fields accordingly -->
                    <div class="mb-3 row">
                        <label for="kolam_renang_id_kolam_renang" class="col-sm-2 col-form-label">ID Kolam Renang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kolam_renang_id_kolam_renang" name="kolam_renang_id_kolam_renang" value="<?php echo $kolam_renang_id_kolam_renang ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="club_id_club" class="col-sm-2 col-form-label">ID Club</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="club_id_club" name="club_id_club" value="<?php echo $club_id_club ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="waktu_penggunaan" class="col-sm-2 col-form-label">Waktu Penggunaan</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" id="waktu_penggunaan" name="waktu_penggunaan" value="<?php echo date('Y-m-d\TH:i', strtotime($waktu_penggunaan)) ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="waktu_selesai" class="col-sm-2 col-form-label">Waktu Selesai</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" id="waktu_selesai" name="waktu_selesai" value="<?php echo date('Y-m-d\TH:i', strtotime($waktu_selesai)) ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="search" class="col-sm-2 col-form-label">Search</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="search" name="search" placeholder="Masukkan kata kunci">
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-secondary" onclick="clearForm()">Refresh</button>
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
                <div class="col-12 mt-3">
                        <a href="dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
                </div>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white" style="background-color: #3498db;">
                <h1>Data Penggunaan Kolam Renang</h1>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">ID Kolam Renang</th>
                            <th scope="col">ID Club</th>
                            <th scope="col">Waktu Penggunaan</th>
                            <th scope="col">Waktu Selesai</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2 = "SELECT * FROM penggunaan ORDER BY id_penggunaan DESC";
                        $q2 = mysqli_query($koneksi, $sql2);
                        if (!$q2) {
                            die('Error in query: ' . mysqli_error($koneksi));
                        }
                        $urut = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id_penggunaan = $r2['id_penggunaan'];
                            $kolam_renang_id_kolam_renang = $r2['kolam_renang_id_kolam_renang'];
                            $club_id_club = $r2['club_id_club'];
                            $waktu_penggunaan = $r2['waktu_penggunaan'];
                            $waktu_selesai = $r2['waktu_selesai'];
                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $kolam_renang_id_kolam_renang ?></td>
                                <td scope="row"><?php echo $club_id_club ?></td>
                                <td scope="row"><?php echo date('Y-m-d H:i', strtotime($waktu_penggunaan)) ?></td>
                                <td scope="row"><?php echo date('Y-m-d H:i', strtotime($waktu_selesai)) ?></td>
                                <td scope="row">
                                    <a href="penggunaan.php?op=edit&id=<?php echo $id_penggunaan ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="penggunaan.php?op=delete&id=<?php echo $id_penggunaan ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>
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

<!-- footer.php -->

<footer class="footer">
    <div class="container">
        <p>&copy;Alah Sia Booy</p>
    </div>
</footer>

</html>
