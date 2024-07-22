<?php include_once "../../components/header-admin.php" ?>

<!-- Content -->
<div class="content">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="text-primary">Daftar Transaksi</h3>
        <nav aria-label="breadcrumb" id="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
            </ol>
        </nav>
    </div>

    <div class="d-flex justify-content-end align-items-center mt-4">
        <a href="../../config/functions.php?export-excel" class="btn btn-success">
            <i class="fa-regular fa-file-excel"></i>
            Export Excel
        </a>
    </div>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th scope="col">Pembeli</th>
                <th scope="col">Barang Dibeli</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Varian</th>
                <th scope="col">Total Harga</th>
            </tr>
        </thead>
        <tbody id="user-list">
            <?php foreach (getAllTransaction() as $i => $transaction) : ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td style="width: 150px;"><?= $transaction->user_name ?> - <?= $transaction->user_email ?></td>
                <td style="width: 250px;"><?= $transaction->name ?></td>
                <td><?= $transaction->qty ?> x <?= formatMoney($transaction->price) ?></td>
                <td>
                    <?php if (empty($transaction->list_variant)) : ?>
                    Tidak ada variant
                    <?php endif; ?>
                    <ul>
                        <?php foreach (showVariant($transaction->list_variant) as $variant) : ?>
                        <li><?= $variant ?></li>
                        <?php endforeach; ?>
                    </ul>
                </td>
                <td><?= formatMoney($transaction->sub_total) ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<!-- End Content -->

<!-- scripts -->
<script type="module" src="../../assets/js/admin/users.js"></script>
<!-- end scripts -->

<?php include_once "../../components/footer-admin.php" ?>