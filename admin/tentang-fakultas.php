<?php
include 'header.php';
$identitas = mysqli_query($conn, "SELECT * FROM pengaturan ORDER BY id DESC LIMIT 1");
$unpri = mysqli_fetch_object($identitas);
?>

<!-- Content -->
<div class="content">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Tentang Kampus</h4>
            </div>
            <div class="card-body">

                <form accept="" method="post" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="tentang" class="form-label">Tentang Fakultas</label>
                        <textarea name="tentang" class="form-control" id="keterangan"
                            placeholder="Masukkan Keterangan"><?= $unpri->tentang_fakultas ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Kampus</label><br>
                        <?php
                        echo '<img id="preview-logo" src="../uploads/identitas/' . $unpri->foto_kampus . '" width="100px" alt="Logo Kampus">';
                        ?>
                        <input type="file" name="foto" class="form-control" onchange="previewImage(event)">
                        <p class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                    </div>


                    <a href="index.php" class="btn btn-secondary my-3">Kembali</a>
                    <input type="submit" id="submit" name="submit" value="Simpan Perubahan" class="btn btn-primary">
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Content -->

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- End SweetAlert -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php
// Process form submission
if (isset($_POST['submit'])) {
    // Retrieve form data
    $tentang = addslashes($_POST['tentang']);

    // Update data in the database
    $query = "UPDATE pengaturan SET tentang_fakultas='$tentang' WHERE id=1";

    // Execute the query and handle the result
    if (mysqli_query($conn, $query)) {
        // Check if a new logo is uploaded
        if ($_FILES['foto']['tmp_name'] !== "") {
            $fotoName = $_FILES['foto']['name'];
            $fotoTmp = $_FILES['foto']['tmp_name'];
            $fotoPath = "../uploads/identitas/" . $fotoName;
            move_uploaded_file($fotoTmp, $fotoPath);
        } else {
            $fotoName = $unpri->foto_kampus;
        }

        // Update foto_kampus in the database
        $queryFoto = "UPDATE pengaturan SET foto_kampus='$fotoName' WHERE id=1";
        if (mysqli_query($conn, $queryFoto)) {
            // Data updated successfully
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Data Updated',
                    text: 'The data has been updated successfully.',
                }).then(function() {
                    window.location.href = 'tentang-fakultas.php';
                });
              </script>";
        } else {
            // Error occurred while updating data
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error updating data: " . mysqli_error($conn) . "',
                }).then(function() {
                    window.location.href = 'tentang-fakultas.php';
                });
              </script>";
        }
    } else {
        // Error occurred while updating data
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error updating data: " . mysqli_error($conn) . "',
                }).then(function() {
                    window.location.href = 'tentang-fakultas.php';
                });
              </script>";
    }
}
?>

<!-- Rest of the HTML code -->

<?php
include 'footer.php';
?>