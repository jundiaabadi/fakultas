<?php
include 'header.php';

if (isset($_GET['idpengguna'])) {
    $userID = $_GET['idpengguna'];

    $pengguna = mysqli_query($conn, "SELECT * FROM pengguna WHERE id = '$userID'");
    $data = mysqli_fetch_array($pengguna);
}
?>

<!-- Content -->
<div class="content">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Ubah Password</h4>
            </div>
            <div class="card-body">
                <form accept="" method="post">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="pass1" class="form-control" id="pass1"
                            placeholder="Masukkan Password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="pass2" class="form-control" id="pass2"
                            placeholder="Masukkan Password Kembali" required>
                    </div>

                    <a href="pengguna.php" class="btn btn-secondary my-3">Kembali</a>
                    <input type="submit" name="submit" value="Ubah Password" class="btn btn-primary">
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $pass1 = addslashes($_POST['pass1']);
                    $pass2 = addslashes($_POST['pass2']);
                    if($pass2 != $pass1) {
                         echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                        echo '<script>
                            Swal.fire({
                                icon: "error",
                                title: "Password Tidak Sesuai",
                                showConfirmButton: true,
                                timer: 6000
                            }).then(() => {
                                window.location.href = "ubah-password.php";
                            });
                        </script>';
                    }else {
                         $update = mysqli_query($conn, "UPDATE pengguna SET password='".MD5($pass1)."' WHERE id='".$_SESSION['uid']."' ");

                    if ($update) {
                        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
                        echo '<script>
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil Mengubah Password",
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