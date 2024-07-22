<?php include_once "../../components/header-admin.php" ?>

<!-- Content -->
<div class="content">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="text-primary">Daftar Produk</h3>
        <nav aria-label="breadcrumb" id="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Produk</li>
            </ol>
        </nav>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="input-group w-50">
            <span class="input-group-text" id="basic-addon1">
                <i class="fa-regular fa-magnifying-glass"></i>
            </span>
            <input type="text" class="form-control py-2" placeholder="Cari Produk..." aria-label="Username"
                aria-describedby="basic-addon1" id="search-keyword">
        </div>
        <a href="products-add.php" class="btn btn-primary">
            <i class="fa-regular fa-circle-plus"></i>
            Tambah Produk
        </a>
    </div>

    <table class="table mt-4">
        <thead>
            <tr>
                <!-- <th scope="col">#</th> -->
                <th>No</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Kategori</th>
                <th scope="col">Harga</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody id="product-list">
            <?php foreach (getProduct() as $i => $product) : ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td style="width: 500px;"><?= $product->name ?></td>
                <td><?= $product->category ?></td>
                <td><?= formatMoney($product->price) ?></td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="javascript:void(0)" class="btn btn-sm btn-info btn-detail-product"
                            data-product-id="<?= $product->id ?>" data-bs-toggle="modal"
                            data-bs-target="#detailProductModal">
                            <i class="fa-regular fa-eye"></i>
                            Detail
                        </a>
                        <a href="product-edit.php?id=<?= $product->id ?>" class="btn btn-sm btn-warning">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Edit
                        </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-delete-product"
                            data-product-id="<?= $product->id ?>" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fa-regular fa-trash-can"></i>
                            Hapus
                        </a>
                    </div>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <!-- Detail Product Modal -->
    <div class="modal fade" id="detailProductModal" tabindex="-1" aria-labelledby="detailProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detailProductModalLabel">Detail Produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="detailProductModalBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Delete Product Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../../config/functions.php" method="POST">
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus produk ini?
                        <input type="hidden" id="delete-id" name="id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" name="delete-product">Ya, Yakin!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Content -->

<!-- scripts -->
<script type="module" src="../../assets/js/admin/products.js"></script>
<!-- end scripts -->

<?php include_once "../../components/footer-admin.php" ?>