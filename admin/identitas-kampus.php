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
                <h4>Identitas Kampus</h4>
            </div>
            <div class="card-body">

                <form accept="" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Kampus"
                            value="<?= $unpri->nama ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" id="email"
                            placeholder="Masukkan Email Kampus/Fakultas" value="<?= $unpri->email ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" name="telepon" class="form-control" id="telepon"
                            placeholder="Telepon Kampus/Fakultas" value="<?= $unpri->telepon ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" class="form-control" id="alamat" placeholder="Masukkan Keterangan"
                            required><?= $unpri->alamat ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="gmaps" class="form-label">Google Maps</label>
                        <textarea name="gmaps" class="form-control" id="gmaps" placeholder="Masukkan Google Maps"
                            required><?= $unpri->google_maps ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label><br>
                        <?php
                            echo '<img id="preview-logo" src="../uploads/identitas/' . $unpri->logo . '" width="100px" alt="Logo Kampus">';       
                        ?>
                        <input type="file" name="logo" class="form-control" onchange="previewImage(event)">
                        <p class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                    </div>
                    <div class="mb-3">
                        <label for="favicon" class="form-label">Favicon</label><br>
                        <?php
                            echo '<img id="preview-favicon" src="../uploads/identitas/' . $unpri->favicon . '" width="100px" alt="Favicon">';
                        ?>
                        <input type="file" name="favicon" class="form-control" onchange="previewImage(event)">
                        <p class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                    </div>

                    <a href="index.php" class="btn btn-secondary my-3">Kembali</a>
                    <input type="submit" id="submit-button" name="submit" value="Simpan Perubahan"
                        class="btn btn-primary">
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
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $gmaps = $_POST['gmaps'];

    // Update data in the database
    $query = "UPDATE pengaturan SET nama='$nama', email='$email', telepon='$telepon', alamat='$alamat', google_maps='$gmaps' WHERE id=1";
    
    // Execute the query and handle the result
    // Assuming you're using mysqli to connect to the database
      // Check if a new logo is uploaded
    if ($_FILES['logo']['tmp_name'] !== "") {
        $logoName = $_FILES['logo']['name'];
        $logoTmp = $_FILES['logo']['tmp_name'];
        $logoPath = "../uploads/identitas/" . $logoName;
        move_uploaded_file($logoTmp, $logoPath);
    } else {
        $logoName = $unpri->logo;
    }
    
    // Check if a new favicon is uploaded
    if ($_FILES['favicon']['tmp_name'] !== "") {
        $faviconName = $_FILES['favicon']['name'];
        $faviconTmp = $_FILES['favicon']['tmp_name'];
        $faviconPath = "../uploads/identitas/" . $faviconName;
        move_uploaded_file($faviconTmp, $faviconPath);
    } else {
        $faviconName = $unpri->favicon;
    }

    // Update data in the database
    $query = "UPDATE pengaturan SET nama='$nama', email='$email', telepon='$telepon', alamat='$alamat', google_maps='$gmaps', logo='$logoName', favicon='$faviconName' WHERE id=1";
    
    // Execute the query and handle the result
    // Assuming you're using mysqli to connect to the database
    if (mysqli_query($conn, $query)) {
        // Data updated successfully
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Data Updated',
                    text: 'The data has been updated successfully.',
                });
              </script>";
        echo "<script>
         setTimeout(function() {
            window.location.href = 'identitas-kampus.php';
         }, 2000); // Redirect to the identitas-kampus.php after 2 seconds (adjust the delay as needed)
      </script>";
    } else {
        // Error occurred while updating data
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error updating data: " . mysqli_error($conn) . "',
                });
              </script>";
        echo "<script>
         setTimeout(function() {
            window.location.href = 'identitas-kampus.php';
         }, 2000); // Redirect to the identitas-kampus.php after 2 seconds (adjust the delay as needed)
      </script>";
    }

    // Rest of the code...
}
?>

<!-- Rest of the HTML code -->

<?php
include 'footer.php';
?>