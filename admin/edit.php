<?php
include 'header.php';

if (isset($_GET['idpengguna'])) {
    $userID = $_GET['idpengguna'];

    $pengguna = mysqli_query($conn, "SELECT * FROM pengguna WHERE id = '$userID'");
    $data = mysqli_fetch_array($pengguna);
}
?>

<!-- Content -->
<div class="content" style="min-height: 5000px;">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Edit Pengguna</h4>
            </div>
            <div class="card-body">
                <form accept="" method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama"
                            value="<?= $data['nama'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="user" class="form-label">Username</label>
                        <input type="text" name="user" class="form-control" id="user" placeholder="Masukkan Username"
                            value="<?= $data['username'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select name="level" class="form-select" id="level" style="max-width: 150px" required>
                            <option value="">Pilih</option>
                            <option value="Super Admin" <?= ($data['level'] == 'Super Admin') ? 'selected' : '' ?>>Super
                                Admin</option>
                            <option value="Admin" <?= ($data['level'] == 'Admin') ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </div>
                    <a href="pengguna.php" class="btn btn-secondary my-3">Kembali</a>
                    <input type="submit" name="submit" value="Simpan" class="btn btn-primary">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $nama = addslashes(ucwords($_POST['nama']));
                    $user = $_POST['user'];
                    $level = $_POST['level'];

                    $update = mysqli_query($conn, "UPDATE pengguna SET nama='$nama', username='$user', level='$level' WHERE id='$userID'");

                    if ($update) {
                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                        echo '<script>
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil Diubah",
                                showConfirmButton: true,
                                timer: 6000
                            }).then(() => {
                                window.location.href = "pengguna.php";
                            });
                        </script>';
                    } else {
                        echo "Gagal mengubah pengguna.";
                    }
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
    integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
</script>