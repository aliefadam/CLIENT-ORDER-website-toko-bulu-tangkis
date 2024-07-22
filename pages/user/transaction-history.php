<?php include_once "../../components/header-user.php" ?>

<!-- Content -->
<div class="content container">
    <header class="mt-5 text-center">
        <h1 class="poppins-bold text-primary">Riwayat Transaksi</h1>
    </header>

    <div class="row mt-5">
        <?php foreach (getTransactionUser() as $transaction) : ?>
        <div class="col-12 mb-3">
            <div class="bg-white rounded shadow shadow-sm p-3">
                <p>Belanja Pada <?= $transaction->created_at ?></p>
                <div class="row">
                    <div class="col-2">
                        <img class="img-fluid border rounded" width="" src="../../uploads/<?= $transaction->image ?>"
                            alt="">
                    </div>
                    <div class="col-8">
                        <p class="poppins-semibold fs-4 text-primary mb-1"><?= $transaction->name ?></p>
                        <span class="poppins-medium mb-3 d-block"><?= $transaction->qty ?> x
                            <?= formatMoney($transaction->price) ?></span>
                        <ul>
                            <?php foreach (showVariant($transaction->list_variant) as $variant) : ?>
                            <li><?= $variant ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="col-2">
                        <span class="d-block">Total Belanja</span>
                        <span
                            class="d-block poppins-semibold fs-5 text-secondary"><?= formatMoney($transaction->sub_total) ?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- End Content -->

<?php include_once "../../components/footer-user.php" ?>