<?php include_once "../../components/header-admin.php" ?>

<!-- Content -->
<div class="content">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="text-primary">Mutasi Stok</h3>
        <nav aria-label="breadcrumb" id="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Mutasi Stok</li>
            </ol>
        </nav>
    </div>

    <div class="d-flex justify-content-end align-items-center mt-4">
        <a href="stock-mutation-add.php" class="btn btn-primary">
            <i class="fa-regular fa-circle-plus"></i>
            Tambah Mutasi
        </a>
    </div>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Jenis Mutasi</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Tanggal</th>
            </tr>
        </thead>
        <tbody id="product-list">
            <?php foreach (getMutationStock() as $i => $mutation) : ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td style="width: 400px"><?= $mutation->product_name ?></td>
                    <td>
                        <?php if ($mutation->type == "Masuk") : ?>
                            <span class="badge bg-success">Masuk</span>
                        <?php else : ?>
                            <span class="badge bg-danger">Keluar</span>
                        <?php endif ?>
                    </td>
                    <td>
                        <span class=""> <?= $mutation->qty ?></span>
                    </td>
                    <td><?= $mutation->stock_mutation_description ?></td>
                    <td><?= $mutation->created_at ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<!-- End Content -->


<?php include_once "../../components/footer-admin.php" ?>