<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

<?php
include '../koneksi.php';

if (isset($_GET['idpengguna'])) {
    $userID = $_GET['idpengguna'];

    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "question",
                title: "Apakah Anda yakin ingin menghapus?",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil Dihapus",
                        showConfirmButton: true,
                        timer: 6000
                    }).then(() => {
                        window.location.href = "pengguna.php";
                    });
                } else {
                    window.location.href = "pengguna.php";
                }
            });
        });
    </script>';
      if (isset($_GET['batal'])) {
        exit; // Menghentikan eksekusi script jika aksi "Batal" ditemukan
    }

    $delete = mysqli_query($conn, "DELETE FROM pengguna WHERE id = '$userID'");

    if (!$delete) {
        echo "Failed to delete user.";
    }
}
if (isset($_GET['idjurusan'])) {
    $idjurusan = $_GET['idjurusan'];

    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "question",
                title: "Apakah Anda yakin ingin menghapus?",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil Dihapus",
                        showConfirmButton: true,
                        timer: 6000
                    }).then(() => {
                        window.location.href = "jurusan.php";
                    });
                } else {
                    window.location.href = "jurusan.php";
                    exit;
                }
            });
        });
    </script>';
      if (isset($_GET['batal'])) {
        exit; // Menghentikan eksekusi script jika aksi "Batal" ditemukan
    }

    $jurusan = mysqli_query($conn, "SELECT gambar FROM jurusan WHERE id = '$idjurusan' ");
    if(mysqli_num_rows($jurusan) > 0) {
        $p = mysqli_fetch_object($jurusan);
        if(file_exists("../uploads/jurusan/".$p->gambar)) {
            unlink("../uploads/jurusan/".$p->gambar);
        };

    }

    $delete = mysqli_query($conn, "DELETE FROM jurusan WHERE id = '$idjurusan'");

    if (!$delete) {
        echo "Failed to delete jurusan.";
    }
}

if (isset($_GET['idgaleri'])) {
    $idgaleri = $_GET['idgaleri'];

    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "question",
                title: "Apakah Anda yakin ingin menghapus?",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil Dihapus",
                        showConfirmButton: true,
                        timer: 6000
                    }).then(() => {
                        window.location.href = "galeri.php";
                    });
                } else {
                    window.location.href = "galeri.php";
                     exit;
                }
            });
        });
    </script>';
      if (isset($_GET['batal'])) {
        exit; // Menghentikan eksekusi script jika aksi "Batal" ditemukan
    }

    $galeri = mysqli_query($conn, "SELECT foto FROM galeri WHERE id = '$idgaleri' ");
    if(mysqli_num_rows($galeri) > 0) {
        $p = mysqli_fetch_object($galeri);
        if(file_exists("../uploads/galeri/".$p->foto)) {
            unlink("../uploads/galeri/".$p->foto);
        };

    }

    $delete = mysqli_query($conn, "DELETE FROM galeri WHERE id = '$idgaleri'");

    if (!$delete) {
        echo "Failed to delete galeri.";
    }
}
if (isset($_GET['idinformasi'])) {
    $idinformasi = $_GET['idinformasi'];

    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "question",
                title: "Apakah Anda yakin ingin menghapus?",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil Dihapus",
                        showConfirmButton: true,
                        timer: 6000
                    }).then(() => {
                        window.location.href = "informasi.php";
                    });
                } else {
                    window.location.href = "informasi.php";
                     exit;
                }
            });
        });
    </script>';
      if (isset($_GET['batal'])) {
        exit; // Menghentikan eksekusi script jika aksi "Batal" ditemukan
    }

    $informasi = mysqli_query($conn, "SELECT gambar FROM informasi WHERE id = '$idinformasi' ");
    if(mysqli_num_rows($informasi) > 0) {
        $p = mysqli_fetch_object($informasi);
        if(file_exists("../uploads/informasi/".$p->gambar)) {
            unlink("../uploads/informasi/".$p->gambar);
        };

    }

    $delete = mysqli_query($conn, "DELETE FROM informasi WHERE id = '$idinformasi'");

    if (!$delete) {
        echo "Failed to delete informasi.";
    }
}
if (isset($_GET['iddosen'])) {
    $iddosen = $_GET['iddosen'];

    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>';
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "question",
                title: "Apakah Anda yakin ingin menghapus?",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil Dihapus",
                        showConfirmButton: true,
                        timer: 6000
                    }).then(() => {
                        window.location.href = "dosen.php";
                    });
                } else {
                    window.location.href = "dosen.php";
                     exit;
                }
            });
        });
    </script>';
      if (isset($_GET['batal'])) {
        exit; // Menghentikan eksekusi script jika aksi "Batal" ditemukan
    }

    $dosen = mysqli_query($conn, "SELECT gambar FROM dosen WHERE id = '$iddosen' ");
    if(mysqli_num_rows($dosen) > 0) {
        $p = mysqli_fetch_object($dosen);
        if(file_exists("../uploads/dosen/".$p->gambar)) {
            unlink("../uploads/dosen/".$p->gambar);
        };

    }

    $delete = mysqli_query($conn, "DELETE FROM dosen WHERE id = '$iddosen'");

    if (!$delete) {
        echo "Failed to delete data dosen.";
    }
}
?>