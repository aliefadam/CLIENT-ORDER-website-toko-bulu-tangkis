<?php
$basename = basename($_SERVER['PHP_SELF']);
$basename = str_replace(".php", "", $basename);
?>

<nav class="navbar fixed-top navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand text-white" href="#">
            <i class="fa-sharp fa-regular fa-shuttlecock me-1"></i> Speed Sports
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?= $basename == "index" ? "active" : "" ?>" aria-current="page"
                        href="index.php">
                        <i class="fa-regular fa-house me-1"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $basename == "transaction-history" ? "active" : "" ?>"
                        href="transaction-history.php">
                        <i class="fa-regular fa-clock-rotate-left me-1"></i> Riwayat Transaksi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../config/functions.php?logout">
                        <i class="fa-regular fa-left-from-bracket me-1"></i> Keluar
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>