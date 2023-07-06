<?php
session_start();
include '../koneksi.php';
if(!isset($_SESSION['status_login'])){
    echo "<script>window.location = '../login.php?msg=Harap Login Terlebih Dahulu!!!'</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
    .navbar-lg .navbar-nav .nav-link {
        font-size: 20px;
    }

    .dropdown-item {
        font-size: 20px;
    }

    .navbar-brand {
        font-size: 30px;
    }


    .navbar {
        justify-content: center;
    }

    .nav-item {
        position: relative;
    }

    .dropdown-menu {
        margin-top: 0;
    }

    .dropdown-item:hover {
        background-color: #007bff;
        color: #fff;
    }
    </style>
</head>


<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-primary text-white p-4 navbar-lg ">
    <div class="container-fluid">
        <a class="navbar-brand text-white fw-medium" href="#">Fakultas Teknik</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-center justify-content-center align-items-center align-content-center"
            id="navbarNavDropdown">
            <ul class="navbar-nav text-white ">
                <li class="nav-item">
                    <a class="nav-link nav-link-hover text-white mx-3" aria-current="page"
                        href="index.php">Dashboard</a>
                </li>
                <?php if($_SESSION['ulevel'] == 'Super Admin'){
                        
                    ?>
                <li class="nav-item">
                    <a class="nav-link nav-link-hover text-white mx-3" href="pengguna.php">Pengguna</a>
                </li>
                <?php } elseif($_SESSION['ulevel'] == 'Admin') { ?>
                <li class="nav-item">
                    <a class="nav-link nav-link-hover text-white mx-3" href="jurusan.php">Jurusan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-hover text-white mx-3" href="galeri.php">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-hover text-white mx-3" href="informasi.php">Informasi</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-link-hover text-white mx-3" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Pengaturan
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Identitas Kampus</a></li>
                        <li><a class="dropdown-item" href="#">Tentang Fakultas</a></li>
                        <li><a class="dropdown-item" href="#">Dosen Pengajar</a></li>
                    </ul>
                </li>
                <?php }
                    ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-link-hover text-white mx-3" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $_SESSION['uname'] ?> (<?= $_SESSION['ulevel'] ?>)
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="ubah-password.php">Ubah password</a></li>
                        <li><a class="dropdown-item" href="logout.php">Keluar</a></li>

                    </ul>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
</nav>
<!-- navbar -->