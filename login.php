<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Halaman Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- page login -->
    <div class="page-login">
        <div class="box">
            <div class="box-header">
                Login
            </div>
            <div class="box-body">
                <?php
                if(isset($_GET['msg'])){
                    echo "<div class='alert alert-warning'>".$_GET['msg']."</div>";
                }
                ?>
                <form action="" method="POST">
                    <div class="form-group">
                        <i class="fas fa-user"></i>
                        <label>Username</label>
                        <input type="text" name="user" placeholder="Username" class="input-control">
                    </div>
                    <div class="form-group">
                        <i class="fas fa-key"></i>
                        <label>Password</label>
                        <input type="password" name="pass" placeholder="Password" class="input-control">
                    </div>
                    <input type="submit" name="submit" value="login" class="btn btn-primary">
                </form>

                <?php 
                 if(isset($_POST['submit'])) {
                    $user = mysqli_real_escape_string($conn, $_POST['user']);
                    $pass = mysqli_real_escape_string($conn, $_POST['pass']);
                    
                    $cek = mysqli_query($conn, "SELECT * FROM pengguna WHERE username = '".$user."' ");
                    if (mysqli_num_rows($cek) > 0) {
                        $d = mysqli_fetch_object($cek);
                        if(md5($pass) == $d->password) {
                            $_SESSION['status_login'] = true;
                            $_SESSION['uid']          = $d->id;    
                            $_SESSION['uname']        = $d->nama;    
                            $_SESSION['ulevel']       = $d->level;

                            echo '<div class="alert alert-success" role="alert">Login berhasil!</div>';
                            echo "<script>window.location = 'admin/index.php'</script>";
                         
                        } else {
                            echo '<div class="alert alert-warning" role="alert">Password yang anda masukkan salah!!</div>';
                        }
                    } else {
                        echo '<div class="alert alert-warning" role="alert">Username yang anda masukkan salah!!</div>';
                    };
                 }
                ?>
            </div>
            <div class="box-footer">
                <a href="index.php">Halaman Utama</a>
            </div>
        </div>
    </div>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>