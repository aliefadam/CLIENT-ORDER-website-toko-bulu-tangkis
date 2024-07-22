<nav class="navbar navbar-expand-lg bg-white shadow shadow-sm" style="position: fixed; width: calc(100% - 280px);">
    <div class="container-fluid">
        <a class="navbar-brands text-decoration-none text-black" href="#"><?= date("D, d M Y") ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active text-danger" aria-current="page" href="../../config/functions.php?logout">
                        <i class="fa-regular fa-left-from-bracket me-1"></i> Keluar
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>