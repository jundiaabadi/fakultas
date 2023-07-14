<?php
include 'header.php';
?>

<!-- Content -->
<div class="content">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Edit Informasi</h4>
            </div>
            <div class="card-body">
                <?php
                if (isset($_GET['idinformasi'])) {
                    $idinformasi = $_GET['idinformasi'];
                    $informasi = mysqli_query($conn, "SELECT * FROM informasi WHERE id = '$idinformasi'");
                    $data = mysqli_fetch_assoc($informasi);

                    if (!$data) {
                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                        echo '<div class="alert alert-danger">Jurusan tidak ditemukan.</div>';
                    } else {
                        ?>
                <form accept="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control" id="judul" placeholder="Masukkan Judul"
                            value="<?= $data['judul'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" id="keterangan"
                            placeholder="Masukkan Keterangan" required><?= $data['keterangan'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="sumber" class="form-label">Sumber</label>
                        <input type="text" name="sumber" class="form-control" id="sumber"
                            placeholder="Masukkan Link/Sumber" value="<?= $data['sumber'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label><br>
                        <?php
                        if (!empty($data['gambar'])) {
                            echo '<img id="preview-gambar" src="../uploads/informasi/' . $data['gambar'] . '" width="100px" alt="Gambar Jurusan">';
                        }
                        ?>
                        <input type="file" name="gambar" class="form-control" onchange="previewImage(event)">
                        <p class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                    </div>
                    <input type="hidden" name="idinformasi" value="<?= $data['id'] ?>">
                    <a href="informasi.php" class="btn btn-secondary my-3">Kembali</a>
                    <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
                </form>

                <?php
                        if (isset($_POST['submit'])) {
                            $id = $_POST['idinformasi'];
                            $judul = addslashes(ucwords($_POST['judul']));
                            $keterangan = addslashes($_POST['keterangan']);
                            $sumber = addslashes(ucwords($_POST['sumber']));

                            $gambar = $_FILES['gambar'];
                            if ($gambar['error'] === 0) {
                                $filename = $gambar['name'];
                                $tmpname = $gambar['tmp_name'];
                                $filesize = $gambar['size'];
                                $formatfile = pathinfo($filename, PATHINFO_EXTENSION);
                                $allowedtype = array('png', 'jpg', 'jpeg', 'gif');

                                if (!in_array($formatfile, $allowedtype)) {
                                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                                    echo '<script>Swal.fire("Error", "Format File Tidak Diizinkan!!!", "error");</script>';
                                } elseif ($filesize > 2000000) {
                                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                                    echo '<script>Swal.fire("Error", "Maksimal Ukuran File 2MB!!!", "error");</script>';
                                } else {
                                    $existingFile = '../uploads/informasi/' . $data['gambar'];
                                    if (file_exists($existingFile)) {
                                        unlink($existingFile); // Remove the existing file
                                    }

                                    $rename = 'informasi' . time() . '.' . $formatfile;
                                    move_uploaded_file($tmpname, "../uploads/informasi/" . $rename);

                                    // Update data in the database
                                    $update = mysqli_query($conn, "UPDATE informasi SET judul = '$judul', keterangan = '$keterangan', sumber = '$sumber', gambar = '$rename' WHERE id = '$id'");

                                    if ($update) {
                                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                                        echo '<script>Swal.fire("Success", "Berhasil mengganti gambar.", "success");</script>';
                                        echo '<script>document.getElementById("preview-gambar").src = "../uploads/informasi/' . $rename . '";</script>';
                                    } else {
                                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                                        echo '<script>Swal.fire("Error", "Gagal memperbarui data informasi: ' . mysqli_error($conn) . '", "error");</script>';
                                    }
                                }
                            } else {
                                // Update data in the database without changing the imageHere's the continuation of the code to prevent storing the same image multiple times:                   // Update data in the database without changing the image
                             $update = mysqli_query($conn, "UPDATE informasi SET judul = '$judul', keterangan = '$keterangan', sumber = '$sumber' WHERE id = '$id'");

                                if ($update) {
                                    if ($judul !== $data['judul']) {
                                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                                        echo '<script>Swal.fire("Success", "Berhasil mengganti judul.", "success");</script>';
                                    } else if ($keterangan !== $data['keterangan']) {
                                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                                        echo '<script>Swal.fire("Success", "Berhasil mengganti keterangan.", "success");</script>';
                                    } else if ($sumber !== $data['sumber']) {
                                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                                        echo '<script>Swal.fire("Success", "Berhasil mengganti sumber.", "success");</script>';
                                    } else {
                                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                                        echo '<script>Swal.fire("Success", "Data informasi berhasil diperbarui.", "success");</script>';
                                    }
                                } else {
                                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                                    echo '<script>Swal.fire("Error", "Gagal memperbarui data informasi: ' . mysqli_error($conn) . '", "error");</script>';
                                }

                            }
                        }
                        ?>
                <?php
                    }
                } else {
                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                    echo '<div class="alert alert-danger">ID informasi tidak ditemukan.</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- Content -->


<?php
include 'footer.php';
?>