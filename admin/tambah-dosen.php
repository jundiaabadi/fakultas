<?php
include 'header.php';
?>

<!-- Content -->

<style>
.notification {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #4CAF50;
    color: white;
    padding: 20px;
    border-radius: 5px;
    animation: fadeOut 3s ease-in;
}

@keyframes fadeOut {
    0% {
        opacity: 1;
    }

    100% {
        opacity: 0;
    }
}
</style>

<div class="content">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Dosen</h4>
            </div>
            <div class="card-body">
                <form accept="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Dosen"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" id="keterangan"
                            placeholder="Masukkan Keterangan" aria-hidden="true"></textarea>

                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Gambar</label>
                        <input type="file" name="gambar" class="form-control" required>
                    </div>
                    <a href="dosen.php" class="btn btn-secondary my-3">Kembali</a>
                    <input type="submit" name="submit" value="simpan" class="btn btn-primary">

                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $nama = addslashes(ucwords($_POST['nama']));
                    $ket = addslashes($_POST['keterangan']);
                    $filename = $_FILES['gambar']['name'];
                    $tmpname = $_FILES['gambar']['tmp_name'];
                    $filesize = $_FILES['gambar']['size'];
                    $formatfile = pathinfo($filename, PATHINFO_EXTENSION);
                    $rename = 'dosen' . time() . '.' . $formatfile;
                    $allowedtype = array('png', 'jpg', 'jpeg', 'gif');
                    
                    // Validasi jika nama dosen sudah ada
                    $query = mysqli_query($conn, "SELECT * FROM dosen WHERE nama = '$nama'");
                    if (mysqli_num_rows($query) > 0) {
                        echo '<script>document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                            icon: "error",
                            title: "Nama Dosen Sudah Ada!!!",
                            showConfirmButton: true,
                            timer: 6000
                        });
                    });
                </script>';
                    } elseif (!in_array($formatfile, $allowedtype)) {
                        echo '<script>document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                            icon: "error",
                            title: "Format File Tidak Diizinkan!!!",
                            showConfirmButton: true,
                            timer: 6000
                        });
                    });
                </script>';
                    } elseif ($filesize > 2000000) {
                        echo '<script>document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                            icon: "error",
                            title: "Maksimal Ukuran File 2MB!!!",
                            showConfirmButton: true,
                            timer: 6000
                        });
                    });
                </script>';
                    } else {
                        move_uploaded_file($tmpname, "../uploads/dosen/" . $rename);
        
                        $simpan = mysqli_query($conn, "INSERT INTO dosen VALUES (
                            null,
                            '".$nama."',
                            '".$ket."',
                            '".$rename."',
                            null,
                            null
                        )");
                        if ($simpan) {
                            echo '<script>document.addEventListener("DOMContentLoaded", function() {
                                Swal.fire({
                                icon: "success",
                                title: "Berhasil Ditambahkan",
                                showConfirmButton: true,
                                timer: 6000
                            });
                        });
                    </script>';
                        } else {
                            echo '<script>document.addEventListener("DOMContentLoaded", function() {
                                Swal.fire({
                                icon: "error",
                                title: "Gagal Disimpan!!",
                                text: "'.mysqli_error($conn).'",
                                showConfirmButton: true,
                                timer: 6000
                            });
                        });
                    </script>';
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- Content -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
    integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
</script>

<?php
include 'footer.php';
?>