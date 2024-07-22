<?php
$basename = basename($_SERVER['PHP_SELF']);
$basename = str_replace(".php", "", $basename);
?>

<div class="fixed-top d-flex flex-column flex-shrink-0 p-3 bg-white shadow" style="width: 280px; height: 100vh;">
    <a href="" class="d-flex align-items-center justify-content-center mb-3 mb-md-0 link-body-emphasis text-decoration-none text-center">
        <span class="poppins-medium fs-5">
            <i class="fa-sharp fa-regular fa-shuttlecock me-1"></i> Speed Sports
        </span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <span class="poppins-medium sidebar-title">Beranda</span>
        <li class="nav-item mb-1">
            <a href="index.php" class="nav-link <?= $basename == "index" ? "active" : "" ?> sidebar" aria-current="page">
                <i class="fa-regular fa-house me-1 py-2"></i>
                Beranda
            </a>
        </li>
        <span class="poppins-medium sidebar-title mt-3">Master</span>
        <li class="nav-item mb-1">
            <a href="products.php" class="nav-link <?= $basename == "products" || $basename == "products-add" || $basename == "product-edit" ? "active" : "" ?> sidebar" aria-current="page">
                <i class="fa-regular fa-boxes-stacked me-1 py-2"></i>
                Produk
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="stock-mutation.php" class="nav-link <?= $basename == "stock-mutation" ? "active" : "" ?> sidebar" aria-current="page">
                <i class="fa-regular fa-truck-ramp-couch me-1 py-2"></i>
                Mutasi Stok
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="users.php" class="nav-link <?= $basename == "users" ? "active" : "" ?> sidebar" aria-current="page">
                <i class="fa-regular fa-users me-1 py-2"></i>
                Pengguna
            </a>
        </li>
        <span class="poppins-medium sidebar-title mt-3">Transaksi</span>
        <li class="nav-item mb-1">
            <a href="transaction.php" class="nav-link <?= $basename == "transaction" ? "active" : "" ?> sidebar" aria-current="page">
                <i class="fa-regular fa-cart-shopping me-1 py-2"></i>
                Transaksi
            </a>
        </li>
    </ul>
</div>