<?php
session_start();

?>

<!-- Tambahkan Sweet Alert JS -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
// Tunggu hingga DOM selesai dimuat
document.addEventListener("DOMContentLoaded", function() {
    // Tampilkan Sweet Alert saat halaman dimuat
    swal({
        title: "Logout",
        text: "Apakah anda ingin logout?",
        icon: "warning",
        buttons: ["Tidak", "Ya"],
        dangerMode: true,
    }).then((willLogout) => {
        if (willLogout) {
            // Jika user menekan tombol "Ya", arahkan ke halaman login
            window.location = '../login.php';
        } else {
            // Jika user menekan tombol "Tidak", arahkan kembali ke halaman sebelumnya
            window.history.back();
        }
    });
});
</script>