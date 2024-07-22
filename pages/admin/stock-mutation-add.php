<?php include_once "../../components/header-admin.php" ?>

<!-- Content -->
<div class="content">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="text-primary">Tambah Mutasi</h3>
        <nav aria-label="breadcrumb" id="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                <li class="breadcrumb-item"><a href="stock-mutation.php">Mutasi Stok</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Mutasi</li>
            </ol>
        </nav>
    </div>

    <form action="../../config/functions.php" method="POST">
        <div class="row mt-4 ">
            <div class="col-6" style="height: fit-content;">
                <div class="bg-white p-4 shadow shadow-sm">
                    <div class="mb-4">
                        <label for="product_id" class="form-label">Produk yang dimutasi</label>
                        <select name="product_id" id="product_id" class="form-control form-select" required>
                            <option value="">-- Pilih Produk --</option>
                            <?php foreach (getProduct() as $product) : ?>
                                <option value="<?= $product->id ?>"><?= $product->name ?> (Stock: <?= $product->stock ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="jenis" class="form-label">Jenis mutasi</label>
                        <select name="jenis" id="jenis" class="form-control form-select" required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="in">Masuk</option>
                            <option value="out">Keluar</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="jumlah" class="form-label">Jumlah</label>
                        <input required min="0" type="number" class="form-control" id="jumlah" name="jumlah">
                    </div>

                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" name="tambah-mutasi">
                            <i class="fa-regular fa-floppy-disk"></i>
                            Tambah Mutasi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- End Content -->

<!-- script -->
<script>
    $("select#product_id").select2({
        theme: "bootstrap-5",
    });
</script>
<!-- end script -->

<?php include_once "../../components/footer-admin.php" ?>