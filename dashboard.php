<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AQUAFIESTA ADMIN</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #3498db;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        .header img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #fff;
        }

        p {
            color: #333;
        }

        .button-container {
            margin-top: 20px;
            display: flex;
            justify-content: space-around; /* Menggunakan space-around untuk tata letak yang lebih baik */
        }

        .custom-button {
            display: inline-block;
            width: 150px; /* Menyesuaikan lebar sesuai keinginan */
            padding: 15px 20px; /* Mengurangi padding agar lebih kompak */
            margin: 10px;
            font-size: 16px; /* Mengurangi ukuran font agar lebih sesuai */
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            background-color: #3498db;
            color: #fff;
            border: none;
            outline: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .custom-button:hover {
            background-color: #c0392b;
        }

        @media(max-width: 600px) {
            /* Mengubah lebar tombol pada layar kecil */
            .custom-button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="Blue Simple Swimming Club Logo - Logos(2).png" alt="Aquafiesta Resort Pool">
        <h1>AQUAFIESTA ADMIN</h1>
        <p>Admin Dashboard for Aquafiesta Resort Pool</p>
    </div>

    <div class="container">
        <h2>Selamat Datang, Admin!</h2>
        <p>Anda memiliki kendali penuh atas aktivitas dan manajemen di Aquafiesta Resort Pool. Pastikan untuk menjaga keamanan dan kenyamanan pengguna.</p>

        <div class="button-container">
            <a href="club.php" class="custom-button">Kelola Club</a>
            <a href="penggunaan.php" class="custom-button">Kelola Penggunaan</a>
            <a href="penyewaan.php" class="custom-button">Kelola Penyewaaan</a>
            <a href="pelatih.php" class="custom-button">Kelola Pelatih</a>
            <a href="dashboard.php" class="custom-button">Logout</a>
        </div>
    </div>
</body>
</html>
