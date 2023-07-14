<?php
include 'koneksi.php';
$identitas = mysqli_query($conn, "SELECT * FROM pengaturan ORDER BY id DESC LIMIT 1");
$unpri = mysqli_fetch_object($identitas);
?>


<!DOCTYPE html>
<html>

<head>
    <title>Homepage <?= $unpri->nama ?></title>
    <link rel="icon" href="uploads/identitas/<?= $unpri->favicon ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="assets/css/style1.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <style>
    .quote {
        border-left: 3px solid #000;
        padding-left: 20px;
        font-style: italic;
        font-size: 18px;
        line-height: 1.5;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid mx-5">
            <img src="uploads/identitas/<?= $unpri->logo ?>" width="70">
            <a class="navbar-brand" href="index.php" style="font-size: 30px;"> <?= $unpri->nama ?></a>

            <button class=" navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end mx-5" id="navbarNavAltMarkup">
                <div class="navbar-nav justify-content-end">
                    <a class="nav-link active mx-4" aria-current="page" href="index.php"
                        style="font-size: 25px;">Beranda</a>
                    <a class="nav-link mx-4" href="#" style="font-size: 25px;">Tentang Fakultas</a>
                    <a class="nav-link mx-4" href="#" style="font-size: 25px;">Jurusan</a>
                    <a class="nav-link mx-4" href="" style="font-size: 25px;">Galeri</a>
                    <a class="nav-link mx-4" href="" style="font-size: 25px;">Informasi</a>
                    <a class="nav-link mx-4" href="" style="font-size: 25px;">Kontak</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- navbar end -->

    <!-- hero -->
    <!-- hero content -->
    <div class="container pb-5 mb-5 pt-5 mt-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-6 mb-lg-0">
                <div class="">
                    <h5 class="text-dark mb-4"><i
                            class="fe fe-check icon-xxs icon-shape bg-light-success text-success rounded-circle me-2"></i>Fakultas
                        Teknik Universitas Pramita Indonesia</h5>
                    <h1 class="display-3 fw-bold mb-3">Selamat Datang Kawan Kawan Mahasiswa Teknik</h1>
                    <p class="pe-lg-10 mb-5" style="font-size: 20px">Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                        veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
                        aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                        pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
                        mollit anim id est laborum..</p>
                    <a href="#" class="btn btn-primary">Read More</a>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="images">
                    <img src="assets/komponen/shapes.png" alt="Image" class="float-right custom-hero-image" />
                    <img src="assets/komponen/hero.png" alt="Image" class="float-right " />
                </div>
            </div>
        </div>
    </div>
    <!-- hero -->

    <!-- sambutan -->
    <div class="container">
        <h1 class="text-center my-4">Sambutan Dekan</h1>
        <div class="divider"></div>
        <div class="text-center">
            <img src="uploads/identitas/<?= $unpri->foto_dekan ?>" width="150" class="rounded-circle mt-4 mb-3" ">
            <h3 class=" text-primary my-4"><?= $unpri->nama_dekan ?></h3>

            <p class="quote" style="border-left: 3px solid #000; padding-left: 10px; word-wrap: break-word;">
                <?= $unpri->sambutan_dekan ?>
            </p>
        </div>
    </div>
    <!-- sambutan -->

    <!-- jurusan -->
    <div class="container">
        <h1 class="text-center my-4">Jurusan</h1>
        <div class="divider"></div>
        <div class="row my-5">
            <?php
        $jurusan = mysqli_query($conn, "SELECT * FROM jurusan ORDER BY id DESC");
        if (mysqli_num_rows($jurusan) > 0) {
            while ($j = mysqli_fetch_array($jurusan)) {
                ?>
            <div class="col-4">
                <div class="card">
                    <a href="#" class="thumbnail-link"></a>
                    <div class="thumbnail-box">
                        <img src="uploads/jurusan/<?= $j['gambar'] ?>" class="thumbnail-img">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 20px;"><?= $j['nama'] ?></h5>
                        <p class="card-text"><?= $j['keterangan'] ?></p>
                    </div>
                </div>
            </div>
            <?php }} else { ?>
            <div class="col-12 text-center">
                Tidak ada DATA
            </div>
            <?php } ?>
        </div>
    </div>
    </div>
    <!-- jurusan -->

    <!-- informasi -->
    <div class="container">
        <h1 class="text-center my-5">Informasi Terkini</h1>
        <div class="divider"></div>
        <div class="container mt-5">
            <div class="row">
                <?php 
            $informasi = mysqli_query($conn, "SELECT * FROM informasi ORDER BY id DESC");
            if (mysqli_num_rows($informasi) > 0) {
                while ($p = mysqli_fetch_array($informasi)) {
            ?>
                <div class="col-md-3 col-sm-6">
                    <div class="card card-block">
                        <img src="uploads/informasi/<?= $p['gambar'] ?>" alt="Foto Informasi">
                        <h5 class="card-title mt-3 mb-3"><?= $p['judul'] ?></h5>
                        <p class="card-text">
                            <?= htmlspecialchars(substr(strip_tags($p['keterangan']), 0, 50)) ?>...
                            <?php if (strlen($p['keterangan']) > 50) { ?> <a href="<?= $p['sumber'] ?>"
                                target="_blank">Baca Selengkapnya</a>
                            <?php } ?>
                        </p>
                    </div>
                </div>
                <?php 
                } // Tutup while
            } else { // Jika tidak ada data informasi
                echo '<div class="col-12 text-center">Tidak ada informasi tersedia.</div>';
            }
            ?>
            </div>
        </div>
    </div>

    <!-- informasi -->








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <script async src='https://d2mpatx37cqexb.cloudfront.net/delightchat-whatsapp-widget/embeds/embed.min.js'>
    </script>
    <script>
    var wa_btnSetting = {
        "btnColor": "#16BE45",
        "ctaText": "WhatsApp",
        "cornerRadius": 50,
        "marginBottom": 20,
        "marginLeft": 20,
        "marginRight": 20,
        "btnPosition": "right",
        "whatsAppNumber": "081283733281",
        "welcomeMessage": "Hello",
        "zIndex": 999999,
        "btnColorScheme": "light"
    };
    window.onload = () => {
        _waEmbed(wa_btnSetting);
    };
    </script>

</body>
</body>

</html>