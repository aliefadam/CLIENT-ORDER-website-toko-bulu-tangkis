<?php include_once "../../components/header-admin.php" ?>

<!-- Content -->
<div class="content">
    <div class="row">
        <div class="col-3">
            <div class="bg-white shadow shadow-sm rounded p-3 d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column">
                    <span>Pengguna Terdaftar</span>
                    <span class="poppins-bold fs-5"><?= getCountUser() ?></span>
                </div>
                <i class="fa-regular fa-user fs-4"></i>
            </div>
        </div>
        <div class="col-3">
            <div class="bg-white shadow shadow-sm rounded p-3 d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column">
                    <span>Total Barang</span>
                    <span class="poppins-bold fs-5"><?= getCountProduct() ?></span>
                </div>
                <i class="fa-regular fa-boxes-stacked fs-4"></i>
            </div>
        </div>
        <div class="col-3">
            <div class="bg-white shadow shadow-sm rounded p-3 d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column">
                    <span>Jumlah Transaksi</span>
                    <span class="poppins-bold fs-5"><?= getCountTransaction() ?></span>
                </div>
                <i class="fa-regular fa-money-simple-from-bracket fs-4"></i>
            </div>
        </div>
        <div class="col-3">
            <div class="bg-white shadow shadow-sm rounded p-3 d-flex justify-content-between align-items-center">
                <div class="d-flex flex-column">
                    <span>Total Pendapatan</span>
                    <span class="poppins-bold fs-5"><?= getTotalIncome() ?></span>
                </div>
                <i class="fa-sharp fa-solid fa-money-bill-1-wave fs-4"></i>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-6">
            <div class="bg-white rounded shadow shadow-sm p-3">
                <h1 class="poppins-medium fs-5 text-primary text-center">Data Transaksi Berdasarkan Kategori</h1>
                <canvas id="myChart" data-sepatu="<?= getTransactionCountByCategory("Sepatu") ?>"
                    data-raket="<?= getTransactionCountByCategory("Raket") ?>"
                    data-shuttlecock="<?= getTransactionCountByCategory("Shuttlecock") ?>" class=""></canvas>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->

<!-- Script -->
<script src="../../assets/js/admin/dashboard.js"></script>
<!-- End Script -->

<?php include_once "../../components/footer-admin.php" ?>