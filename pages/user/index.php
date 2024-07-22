<?php include_once "../../components/header-user.php" ?>

<!-- Content -->
<div class="content container">
    <header class="mt-5 text-center">
        <h1 class="poppins-bold text-primary">SPEED SPORTS</h1>
        <p class="fs-4 poppins-medium">Dapatkan Peralatan Bulu Tangkis Berkualitas dengan Harga Terbaik</p>
    </header>

    <div class="raket">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="flex-2 leading-none">Raket</h3>
            <div class="flex-1 input-group">
                <span class="input-group-text" id="basic-addon1">
                    <i class="fa-regular fa-magnifying-glass"></i>
                </span>
                <input type="text" class="form-control" placeholder="Cari produk di kategori raket"
                    aria-label="Username" id="search-raket" aria-describedby="basic-addon1">
            </div>
        </div>
        <hr>

        <div class="row g-3" id="Raket-list">
            <?php foreach (getProductByCategory("raket") as $product) :  ?>
            <a class="col-3 text-decoration-none" href="product-detail.php?id=<?= $product->id ?>">
                <div class="border rounded p-2">
                    <img src="../../uploads/<?= $product->image ?>" class="img-fluid" alt="">
                    <div class="mt-2 px-2">
                        <h2 class="poppins-medium fs-4 text-primary"><?= substr($product->name, 0, 19) ?>...</h2>
                        <span
                            class="poppins-medium fs-5 text-secondary product-price"><?= formatMoney($product->price) ?></span>
                    </div>
                </div>
            </a>
            <?php endforeach;  ?>
        </div>
    </div>

    <div class="sepatu mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="flex-2 leading-none">Sepatu</h3>
            <div class="flex-1 input-group">
                <span class="input-group-text" id="basic-addon1">
                    <i class="fa-regular fa-magnifying-glass"></i>
                </span>
                <input type="text" id="search-sepatu" class="form-control" placeholder="Cari produk di kategori sepatu"
                    aria-label="Username" aria-describedby="basic-addon1">
            </div>
        </div>
        <hr>

        <div class="row g-3" id="Sepatu-list">
            <?php foreach (getProductByCategory("sepatu") as $product) :  ?>
            <a class="col-3 text-decoration-none" href="product-detail.php?id=<?= $product->id ?>">
                <div class="border rounded p-2">
                    <img src="../../uploads/<?= $product->image ?>" class="img-fluid" alt="">
                    <div class="mt-2 px-2">
                        <h2 class="poppins-medium fs-4 text-primary"><?= substr($product->name, 0, 19) ?>...</h2>
                        <span
                            class="poppins-medium fs-5 text-secondary product-price"><?= formatMoney($product->price) ?></span>
                    </div>
                </div>
            </a>
            <?php endforeach;  ?>
        </div>
    </div>

    <div class="shuttlecock mt-5">
        <div class="d-flex justify-content-between align-items-center">
            <h3 class="flex-2 leading-none">Shuttlecock</h3>
            <div class="flex-1 input-group">
                <span class="input-group-text" id="basic-addon1">
                    <i class="fa-regular fa-magnifying-glass"></i>
                </span>
                <input type="text" id="search-shuttlecock" class="form-control"
                    placeholder="Cari produk di kategori shuttlecock" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>
        </div>
        <hr>

        <div class="row g-3" id="Shuttlecock-list">
            <?php foreach (getProductByCategory("shuttlecock") as $product) :  ?>
            <a class="col-3 text-decoration-none" href="product-detail.php?id=<?= $product->id ?>">
                <div class="border rounded p-2">
                    <img src="../../uploads/<?= $product->image ?>" class="img-fluid" alt="">
                    <div class="mt-2 px-2">
                        <h2 class="poppins-medium fs-4 text-primary"><?= substr($product->name, 0, 19) ?>...</h2>
                        <span
                            class="poppins-medium fs-5 text-secondary product-price"><?= formatMoney($product->price) ?></span>
                    </div>
                </div>
            </a>
            <?php endforeach;  ?>
        </div>
    </div>
</div>
<!-- End Content -->

<!-- script -->
<script type="module" src="../../assets/js/user/product.js"></script>
<!-- end script -->

<?php include_once "../../components/footer-user.php" ?>