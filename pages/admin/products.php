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
                aria-describedby="basic-addon1">
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
        <tbody>
            <tr>
                <td>1</td>
                <td>Raket</td>
                <td>Raket</td>
                <td>Rp. 20000</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="products-detail.php" class="btn btn-sm btn-info">
                            <i class="fa-regular fa-eye"></i>
                            Detail
                        </a>
                        <a href="products-edit.php" class="btn btn-sm btn-warning">
                            <i class="fa-regular fa-pen-to-square"></i>
                            Edit
                        </a>
                        <a href="products-delete.php" class="btn btn-sm btn-danger">
                            <i class="fa-regular fa-trash-can"></i>
                            Hapus
                        </a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

</div>
<!-- End Content -->

<!-- scripts -->
<script src="../../assets/js/admin/products.js"></script>
<!-- end scripts -->

<?php include_once "../../components/footer-admin.php" ?>