<?php
include 'header.php';
$identitas = mysqli_query($conn, "SELECT * FROM pengaturan ORDER BY id DESC LIMIT 1");
$unpri = mysqli_fetch_object($identitas);

?>
<!-- Content -->
<div class="content">
    <div class="container">
        <div class="card-body mt-3">
            <h3>Selamat Datang <?= $_SESSION['uname']  ?> Di Halaman Admin Fakultas <?= $unpri->nama ?> </h3>
        </div>
    </div>
</div>
</div>
<!-- Content -->
<?php
include 'footer.php' 
?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
    integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
</script>