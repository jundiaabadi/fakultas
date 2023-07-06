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

    $delete = mysqli_query($conn, "DELETE FROM pengguna WHERE id = '$userID'");

    if (!$delete) {
        echo "Failed to delete user.";
    }
}
?>