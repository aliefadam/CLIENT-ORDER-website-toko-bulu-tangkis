<?php include_once "../../components/header-auth.php" ?>

<!-- Content  -->
<main class="bg-body-tertiary d-flex align-items-center justify-content-center border">
    <div class="bg-white shadow shadow-sm rounded p-5" id="login-form">
        <i class="fa-sharp fa-regular fa-shuttlecock me-1 fs-1 text-center d-block mb-4"></i>
        <h1 class="text-center fs-3 poppins-semibold text-primary">Masuk ke Speed Sports</h1>

        <form action="../../config/functions.php" class="mt-5" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <button type="submit" name="login" class="btn btn-primary w-50 text-center mx-auto d-block">Masuk</button>

            <p class="text-center mt-4">Belum punya akun?
                <a href="register.php" class="text-decoration-none text-secondary hover:underlined">Daftar</a>
            </p>
        </form>
    </div>
</main>
<!-- End Content -->

<?php include_once "../../components/footer-auth.php" ?>