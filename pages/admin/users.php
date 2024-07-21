<?php include_once "../../components/header-admin.php" ?>

<!-- Content -->
<div class="content">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="text-primary">Daftar Pengguna</h3>
        <nav aria-label="breadcrumb" id="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
            </ol>
        </nav>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="input-group w-50">
            <span class="input-group-text" id="basic-addon1">
                <i class="fa-regular fa-magnifying-glass"></i>
            </span>
            <input type="text" class="form-control py-2" placeholder="Cari Pengguna..." aria-label="Username"
                aria-describedby="basic-addon1" id="search-keyword">
        </div>
    </div>

    <table class="table mt-4">
        <thead>
            <tr>
                <!-- <th scope="col">#</th> -->
                <th>No</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Alamat</th>
                <th scope="col">Role</th>
            </tr>
        </thead>
        <tbody id="user-list">
            <?php foreach (getUser() as $i => $user) : ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= $user->name ?></td>
                <td><?= $user->email ?></td>
                <td><?= $user->address ?></td>
                <td><?= $user->role ?></td>
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