<?php
include 'header.php'
?>
<!-- Content -->

<div class="content">

    <div class="container mt-5">
        <div class="card">
            <div class="card-header ">
                <h4>Jurusan</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <form method="GET" action="">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control-sm-lg" placeholder="Cari Jurusan">
                            <button type="submit" class="btn btn-primary mx-3 rounded">Cari</button>
                        </div>
                    </form>
                </div>
                <a href="tambah-jurusan.php" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Tambah
                    Jurusan</a>
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th class="border">No</th>
                            <th class="border">Nama</th>
                            <th class="border">Keterangan</th>
                            <th class="border">Gambar</th>
                            <th class="border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $condition = isset($_GET['search']) ? "WHERE nama LIKE '%".addslashes($_GET['search'])."%'" : "";
                        $jurusan = mysqli_query($conn, "SELECT * FROM jurusan ".$condition." ORDER BY id DESC");
                        if (mysqli_num_rows($jurusan) > 0) {
                            while ($p = mysqli_fetch_array($jurusan)) {
                        ?>
                        <tr class="text-center border">
                            <td class="border"><?= $no++ ?></td>
                            <td class="border"><?= $p['nama'] ?></td>
                            <td class="border"><?= $p['keterangan'] ?></td>
                            <td class="border"><img src="../uploads/jurusan/<?= $p['gambar'] ?>" width="100px"></td>
                            <td class="border">
                                <a href="edit-jurusan.php?idjurusan=<?= $p['id'] ?>" class="text-decoration-none"
                                    style="color: #ffbb00;"><i class="fa-solid fa-pen-to-square"
                                        style="color: #ffbb00;"></i> Edit</a>
                                |
                                <a href="hapus.php?idjurusan=<?= $p['id'] ?>" class="text-decoration-none"
                                    style="color: #f83030;"><i class="fa-regular fa-trash-can"
                                        style="color: #f83030;"></i> Hapus</a>
                            </td>
                        </tr>
                        <?php }} else { ?>
                        <tr>
                            <td colspan="5">Data Tidak Tersedia</td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
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