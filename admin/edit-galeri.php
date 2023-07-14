<?php
include 'header.php';
?>
<!-- Include the TinyMCE library -->



<!-- Content -->
<div class="content">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Edit Galeri</h4>
            </div>
            <div class="card-body">
                <?php
                if (isset($_GET['idgaleri'])) {
                    $idgaleri = $_GET['idgaleri'];
                    $galeri = mysqli_query($conn, "SELECT * FROM galeri WHERE id = '$idgaleri'");
                    $data = mysqli_fetch_assoc($galeri);

                    if (!$data) {
                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                        echo '<div class="alert alert-danger">Galeri tidak ditemukan.</div>';
                    } else {
                        ?>
                <form accept="" method="post" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" placeholder="Masukkan Keterangan" rows="5"
                            required><?= htmlspecialchars($data['keterangan']) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label><br>
                        <?php
                        if (!empty($data['foto'])) {
                            echo '<img id="preview-gambar" src="../uploads/galeri/' . $data['foto'] . '" width="100px" alt="Galeri">';
                        }
                        ?>
                        <input type="file" name="gambar" class="form-control" onchange="previewImage(event)">
                        <p class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                    </div>
                    <input type="hidden" name="idgaleri" value="<?= $data['id'] ?>">
                    <a href="galeri.php" class="btn btn-secondary my-3">Kembali</a>
                    <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
                </form>

                <?php
                        if (isset($_POST['submit'])) {
                            $id = $_POST['idgaleri'];
                            $keterangan = addslashes($_POST['keterangan']);

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
                                    $existingFile = '../uploads/galeri/' . $data['foto'];
                                    if (file_exists($existingFile)) {
                                        unlink($existingFile); // Remove the existing file
                                    }

                                    $rename = 'galeri' . time() . '.' . $formatfile;
                                    move_uploaded_file($tmpname, "../uploads/galeri/" . $rename);

                                    // Update data in the database
                                    $update = mysqli_query($conn, "UPDATE galeri SET keterangan = '$keterangan', foto = '$rename' WHERE id = '$id'");

                                    if ($update) {
                                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                                        echo '<script>Swal.fire("Success", "Berhasil mengganti gambar.", "success");</script>';
                                        echo '<script>document.getElementById("preview-gambar").src = "../uploads/galeri/' . $rename . '";</script>';
                                    } else {
                                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                                        echo '<script>Swal.fire("Error", "Gagal memperbarui data galeri: ' . mysqli_error($conn) . '", "error");</script>';
                                    }
                                }
                            } else {
                                // Update data in the database without changing the image
                                $update = mysqli_query($conn, "UPDATE galeri SET keterangan = '$keterangan' WHERE id = '$id'");

                                if ($update) {
                                    if ($keterangan !== $data['keterangan']) {
                                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                                        echo '<script>Swal.fire("Success", "Berhasil mengganti keterangan.", "success");</script>';
                                    } else {
                                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                                        echo '<script>Swal.fire("Success", "Data galeri berhasil diperbarui.", "success");</script>';
                                    }
                                } else {
                                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                                    echo '<script>Swal.fire("Error", "Gagal memperbarui data galeri: ' . mysqli_error($conn) . '", "error");</script>';
                                }
                            }
                        }
                        ?>
                <?php
                    }
                } else {
                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                    echo '<div class="alert alert-danger">ID galeri tidak ditemukan.</div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- Content -->
<!-- Initialize TinyMCE -->


<?php
include 'footer.php';
?>