<?php include_once "../../components/header-user.php" ?>
<?php $product = (object) getProductById($_GET["id"]); ?>

<!-- Content -->
<div class="content container postion-relative">
    <div class="row mt-5">
        <div class="col-3">
            <img class="img-fluid border rounded shadow shadow-sm" src="../../uploads/<?= $product->image ?>" alt="">
        </div>
        <div class="col-6">
            <div class="">
                <h1 class="poppins-semibold text-primary"><?= $product->name ?></h1>
                <span
                    class="poppins-medium fs-3 text-secondary product-price"><?= formatMoney($product->price) ?></span>
            </div>
            <hr>
            <?php $variants = $product->variants != null ? json_decode($product->variants) : null; ?>
            <?php if ($variants != null) : ?>
            <div class="">
                <?php foreach ($variants as $index => $variant) : ?>
                <div class="">
                    <span class="d-block mb-2 poppins-medium">Pilih <?= $variant->name ?></span>
                    <div class="row">
                        <?php foreach ($variant->value as $index_value => $value) : ?>
                        <div class="col-auto">
                            <div class="border rounded py-2 px-3 mb-3 cursor-pointer select-variant select-variant-<?= $index ?> <?= $index_value == 0 ? "variant-active" : "" ?>"
                                data-index="<?= $index ?>">
                                <?= $value ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <hr>
            <?php endif; ?>
            <div class="">
                <?= $product->description ?>
            </div>
        </div>
        <div class="col-3 px-2">
            <span class="fs-6">
                <i class="fa-regular fa-circle-info me-2"></i> Pastikan semua sudah benar ya
            </span>
            <div class="mt-3">
                <button class="btn btn-primary w-100 text-center d-block">
                    <i class="fa-regular fa-money-bill-wave me-1"></i> Beli Sekarang
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->

<!-- script -->
<script type="module" src="../../assets/js/user/product-detail.js"></script>
<!-- end scripts -->

<?php include_once "../../components/footer-user.php" ?>