<?php if (isset($_SESSION["message"])) : ?>
    <script>
        Swal.fire({
            title: "<?= $_SESSION["message"]["title"] ?>",
            text: "<?= $_SESSION["message"]["text"] ?>",
            icon: "<?= $_SESSION["message"]["icon"] ?>",
        });
    </script>
    <?php unset($_SESSION["message"]); ?>
<?php endif ?>