<?php
include 'header.php'
?>
<!-- Content -->

<heavscode-file:
    //vscode-app/c:/Users/user/AppData/Local/Programs/Microsoft%20VS%20Code/resources/app/out/vs/code/electron-sandbox/workbench/workbench.htmld>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
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
</heavscode-file:>

<div class="content">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Pengguna</h4>
            </div>
            <div class="card-body">
                <form accept="" method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="user" class="form-label">Username</label>
                        <input type="text" name="user" class="form-control" id="user" placeholder="Masukkan Username"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select name="level" class="form-select" id="level" style="max-width: 150px" required>
                            <option value="">Pilih</option>
                            <option value="Super Admin">Super Admin</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <a href="pengguna.php" class="btn btn-secondary my-3">Kembali</a>
                    <input type="submit" name="submit" value="simpan" class="btn btn-primary">

                </form>
                <?php
                if(isset($_POST['submit'])){
                    $nama = addslashes(ucwords($_POST['nama']));
                    $user = addslashes($_POST['user']);
                    $level = $_POST['level'];
                    $pass = 'unpriteknik';

                    $cek = mysqli_query($conn, "SELECT username FROM pengguna WHERE username='".$user."' ");
                    if(mysqli_num_rows($cek) > 0 ){
                         echo '<script>document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                        icon: "error",
                        title: "Username Sudah Digunakan!!!",
                        showConfirmButton: true,
                        timer: 6000
                    });
                });
              </script>';
                    } else {
                        $simpan = mysqli_query($conn, "INSERT INTO pengguna VALUES (
                        null,
                        '".$nama."',
                        '".$user."',
                        '".MD5($pass)."',
                        '".$level."',
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
        echo 'Gagal Disimpan!!' . mysqli_error($conn);
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