<?php
session_start();
include '../koneksi.php';
if(!isset($_SESSION['status_login'])){
    echo "<script>window.location = '../login.php?msg=Harap Login Terlebih Dahulu!!!'</script>";
}
$identitas = mysqli_query($conn, "SELECT * FROM pengaturan ORDER BY id DESC LIMIT 1");
$unpri = mysqli_fetch_object($identitas);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin - <?= $unpri->nama ?></title>
    <link rel="icon" href="../uploads/identitas/<?= $unpri->favicon ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <script src="https://cdn.tiny.cloud/1/8qpns8fueyt89ymyfnthy461m3lh7locym8rcwjvc9lox1ys/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
    tinymce.init({
        selector: '#keterangan',
        height: 300,
        // ...
    });
    </script>
    <style>
    .navbar-lg .navbar-nav .nav-link {
        font-size: 20px;
        color: #fff;
    }

    .dropdown-item {
        font-size: 20px;
        color: black;
    }

    .dropdown-menu {
        background-color: white;
    }

    .navbar {
        background-color: #f8f9fa;
        position: sticky;
        top: 0;
        z-index: 999;
    }

    .sidebar {
        height: calc(100vh - 150px);
        /* Kurangi tinggi sidebar dengan tinggi navbar */
        color: black;
        position: fixed;
        top: 150px;
        /* Ubah top menjadi 150px */
        left: 0;
        width: 250px;
        padding-top: 40px;
        background-color: #007bff;
    }

    .sidebar .nav-link {
        font-size: 18px;
        color: #fff;
    }

    .sidebar .nav-link i {
        margin-right: 10px;
    }

    .content {

        margin-left: 250px;
        /* Tambahkan margin-left untuk mengakomodasi sidebar */
    }

    .content-wrapper {
        padding: 20px;
    }

    .content-wrapper h1 {
        font-size: 30px;
        margin-bottom: 20px;
    }

    .navbar .dropdown-toggle::after {
        display: none;
        /* Hide the default dropdown toggle arrow */
    }

    .navbar .dropdown-toggle {
        background-color: transparent;
        border: none;
        color: #fff;
        font-size: 20px;
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .navbar .dropdown-toggle i {
        margin-right: 5px;
    }

    .navbar .dropdown-menu {
        margin-top: 0;
        right: 0;
        left: auto;
        min-width: unset;
    }

    .navbar .dropdown-menu::before {
        content: none;
        /* Hide the default dropdown menu triangle */
    }

    .navbar .dropdown-menu .dropdown-item {
        font-size: 16px;
        color: black;
    }

    .navbar .dropdown-menu .dropdown-item:hover {
        background-color: #007bff;
        color: #fff;
    }

    .navbar .dropdown-menu .dropdown-item i {
        margin-right: 10px;
    }

    .navbar-nav.ml-auto .nav-item:last-child .nav-link {
        padding-right: 0;
    }

    .navbar-nav.ml-auto .nav-item:last-child .nav-link i {
        margin-right: 0;
    }

    .dropdown-menu a.dropdown-item:hover {
        background-color: #007bff;
        color: #fff;
    }

    .navbar-logo {
        font-size: 30px;
        color: black;
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg p-4 navbar-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand navbar-logo" href="#">
                <h3 style="width: 100px; font-size: 24px; font-family: 'Poppins', sans-serif; font-weight: 600; color: #fff;"
                    alt="Logo">Fakultas Teknik - <?= $unpri->nama ?></h3>
            </a>

            <button class=" navbar-toggler bg-primary" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <!-- Tambahkan kelas ms-auto di sini -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <!-- Ubah nilainya menjadi false -->
                            <i class="fas fa-user"></i> <?= $_SESSION['uname'] ?> (<?= $_SESSION['ulevel'] ?>)
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="ubah-password.php">Ubah Password</a></li>
                            <li><a class="dropdown-item" href="logout.php">Keluar</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End of Navbar -->

    <!-- Sidebar -->
    <div class="sidebar bg-primary text-black">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            </li>
            <?php if($_SESSION['ulevel'] == 'Super Admin') { ?>
            <li class="nav-item">
                <a class="nav-link" href="pengguna.php">
                    <i class="fas fa-users"></i> Pengguna
                </a>
            </li>
            <?php } elseif($_SESSION['ulevel'] == 'Admin') { ?>
            <li class="nav-item">
                <a class="nav-link" href="jurusan.php">
                    <i class="fas fa-university"></i> Jurusan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="galeri.php">
                    <i class="fas fa-images"></i> Galeri
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="informasi.php">
                    <i class="fas fa-info-circle"></i> Informasi
                </a>
            </li>
            <li class="nav-item">

                <ul class="nav flex-column ml-3">
                    <li class="nav-item">
                        <a class="nav-link" href="identitas-kampus.php">
                            <i class="fas fa-university"></i> Identitas Kampus
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tentang-fakultas.php">
                            <i class="fas fa-info-circle"></i> Tentang Fakultas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dekan.php">
                            <i class="fas fa-user"></i> Dekan Fakultas Teknik
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dosen.php">
                            <i class="fas fa-chalkboard-teacher"></i> Dosen Pengajar
                        </a>
                    </li>

                </ul>
            </li>
            <?php } ?>

        </ul>
    </div>
    <!-- End of Sidebar -->



    <!-- Scripts -->
    <!-- Tambahkan skrip jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Tambahkan skrip Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
    </script>

</body>

</html>