<?php
$host       = "localhost";
$user       = "id21771275_aquafiesta123";
$pass       = "Ui&]<9/h#A|7$l5%";
$db         = "id21771275_kolamrenang";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { // Check connection
    die("Tidak bisa terkoneksi ke database");
}

$id_pelatih = "";
$nama_pelatih = "";
$no_kontak = "";
$alamat = "";
$email = "";
$gender_id_gender = "";
$sukses = "";
$error = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id_pelatih = $_GET['id'];
    $sql1 = "DELETE FROM pelatih WHERE id_pelatih = '$id_pelatih'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1) {
        $sukses = "Berhasil hapus data";
    } else {
        $error  = "Gagal melakukan delete data";
    }
}

if ($op == 'edit') {
    $id_pelatih = $_GET['id'];
    $sql1 = "SELECT * FROM pelatih WHERE id_pelatih = '$id_pelatih'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $nama_pelatih = $r1['nama_pelatih'];
    $no_kontak = $r1['no_kontak'];
    $alamat = $r1['alamat'];
    $email = $r1['email'];
    $gender_id_gender = $r1['gender_id_gender'];

    if ($nama_pelatih == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $nama_pelatih = $_POST['nama_pelatih'];
    $no_kontak = $_POST['no_kontak'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $gender_id_gender = $_POST['gender_id_gender'];

    if ($nama_pelatih && $no_kontak && $alamat && $email && $gender_id_gender) {
        if ($op == 'edit') {
            $sql1 = "UPDATE pelatih SET nama_pelatih = '$nama_pelatih', no_kontak = '$no_kontak', alamat = '$alamat', email = '$email', gender_id_gender = '$gender_id_gender' WHERE id_pelatih = '$id_pelatih'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else {
            $sql1   = "INSERT INTO pelatih(nama_pelatih, no_kontak, alamat, email, gender_id_gender) VALUES ('$nama_pelatih', '$no_kontak', '$alamat', '$email', '$gender_id_gender')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelatih</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 1200px
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
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=pelatih.php");
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=pelatih.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nama_pelatih" class="col-sm-2 col-form-label">Nama Pelatih</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_pelatih" name="nama_pelatih" value="<?php echo $nama_pelatih ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="no_kontak" class="col-sm-2 col-form-label">No Kontak</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="no_kontak" name="no_kontak" value="<?php echo $no_kontak ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="gender_id_gender" class="col-sm-2 col-form-label">Gender</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="gender_id_gender" id="gender_id_gender">
                                <option value="">- Pilih Gender -</option>
                                <option value="0" <?php if ($gender_id_gender == 0) echo "selected" ?>>Perempuan</option>
                                <option value="1" <?php if ($gender_id_gender == 1) echo "selected" ?>>Laki-Laki</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                    <div class="col-12 mt-3">
                        <a href="dashboard.php" class="btn btn-secondary">Kembali ke Dashboard</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Pelatih
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Pelatih</th>
                            <th scope="col">No Kontak</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Email</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "SELECT * FROM pelatih ORDER BY id_pelatih DESC";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id_pelatih = $r2['id_pelatih'];
                            $nama_pelatih = $r2['nama_pelatih'];
                            $no_kontak = $r2['no_kontak'];
                            $alamat = $r2['alamat'];
                            $email = $r2['email'];
                            $gender_id_gender = $r2['gender_id_gender'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $nama_pelatih ?></td>
                                <td scope="row"><?php echo $no_kontak ?></td>
                                <td scope="row"><?php echo $alamat ?></td>
                                <td scope="row"><?php echo $email ?></td>
                                <td scope="row"><?php echo ($gender_id_gender == 0) ? 'Perempuan' : 'Laki-Laki' ?></td>
                                <td scope="row">
                                    <a href="pelatih.php?op=edit&id=<?php echo $id_pelatih ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="pelatih.php?op=delete&id=<?php echo $id_pelatih ?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>
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