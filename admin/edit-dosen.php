<?php
include 'header.php';
?>

<!-- Content -->
<div class="content">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Edit Dosen</h4>
            </div>
            <div class="card-body">
                <?php
                if (isset($_GET['iddosen'])) {
                    $iddosen = $_GET['iddosen'];
                    $dosen = mysqli_query($conn, "SELECT * FROM dosen WHERE id = '$iddosen'");
                    $data = mysqli_fetch_assoc($dosen);

                    if (!$data) {
                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                        echo '<div class="alert alert-danger">Dosen tidak ditemukan.</div>';
                    } else {
                        ?>
                <form accept="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Dosen"
                            value="<?= $data['nama'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" id="keterangan"
                            placeholder="Masukkan Keterangan" required><?= $data['keterangan'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label><br>
                        <?php
                        if (!empty($data['gambar'])) {
                            echo '<img id="preview-gambar" src="../uploads/dosen/' . $data['gambar'] . '" width="100px" alt="Foto Dosen">';
                        }
                        ?>
                        <input type="file" name="gambar" class="form-control" onchange="previewImage(event)">
                        <p class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                    </div>
                    <input type="hidden" name="iddosen" value="<?= $data['id'] ?>">
                    <a href="dosen.php" class="btn btn-secondary my-3">Kembali</a>
                    <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
                </form>

                <?php
                        if (isset($_POST['submit'])) {
                            $id = $_POST['iddosen'];
                            $nama = addslashes(ucwords($_POST['nama']));
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
                                    $existingFile = '../uploads/dosen/' . $data['gambar'];
                                    if (file_exists($existingFile)) {
                                        unlink($existingFile); // Remove the existing file
                                    }

                                    $rename = 'dosen' . time() . '.' . $formatfile;
                                    move_uploaded_file($tmpname, "../uploads/dosen/" . $rename);

                                    // Update data in the database
                                    $update = mysqli_query($conn, "UPDATE dosen SET nama = '$nama', keterangan = '$keterangan', gambar = '$rename' WHERE id = '$id'");

                                    if ($update) {
                                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                                        echo '<script>Swal.fire("Success", "Berhasil mengganti foto dosen.", "success");</script>';
                                        echo '<script>document.getElementById("preview-gambar").src = "../uploads/dosen/' . $rename . '";</script>';
                                    } else {
                                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                                        echo '<script>Swal.fire("Error", "Gagal memperbarui data dosen: ' . mysqli_error($conn) . '", "error");</script>';
                                    }
                                }
                            } else {
                                // Update data in the database without changing the imageHere's the continuation of the code to prevent storing the same image multiple times:                   // Update data in the database without changing the image
                                $update = mysqli_query($conn, "UPDATE dosen SET nama = '$nama', keterangan = '$keterangan' WHERE id = '$id'");

                                if ($update) {
                                    if ($nama !== $data['nama']) {
                                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                                        echo '<script>Swal.fire("Success", "Berhasil mengganti nama dosen.", "success");</script>';
                                    } else if ($keterangan !== $data['keterangan']) {
                                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                                        echo '<script>Swal.fire("Success", "Berhasil mengganti keterangan.", "success");</script>';
                                    } else {
                                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                                        echo '<script>Swal.fire("Success", "Data dosen berhasil diperbarui.", "success");</script>';
                                    }
                                } else {
                                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                                    echo '<script>Swal.fire("Error", "Gagal memperbarui data dosen: ' . mysqli_error($conn) . '", "error");</script>';
                                }
                            }
                        }
                        ?>
                <?php
                    }
                } else {
                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                    echo '<div class="alert alert-danger">ID dosen tidak ditemukan.</div>';
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