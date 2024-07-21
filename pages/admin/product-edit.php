<?php include_once "../../components/header-admin.php" ?>

<!-- Content -->
<div class="content">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="text-primary">Edit Produk</h3>
        <nav aria-label="breadcrumb" id="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                <li class="breadcrumb-item"><a href="products.php">Produk</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Produk</li>
            </ol>
        </nav>
    </div>

    <form action="../../config/functions.php" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
        <div class="row mt-4 ">
            <div class="col-6" style="height: fit-content;">
                <div class="bg-white p-4 shadow shadow-sm">
                    <div class="mb-4">
                        <label for="name" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="name" name="nama_produk" value="<?= getProductById($_GET['id'])["name"] ?>" required>
                    </div>
                    <div class="mb-4">
                        <label for="kategori" class="form-label">Kategori Produk</label>
                        <select name="kategori" id="kategori" class="form-control form-select" required>
                            <option <?= getProductById($_GET['id'])["category"] == "" ? "selected" : "" ?> value="">--
                                Pilih Kategori --</option>
                            <option <?= getProductById($_GET['id'])["category"] == "Sepatu" ? "selected" : "" ?> value="Sepatu">Sepatu</option>
                            <option <?= getProductById($_GET['id'])["category"] == "Raket" ? "selected" : "" ?> value="Raket">Raket</option>
                            <option <?= getProductById($_GET['id'])["category"] == "Shuttlecock" ? "selected" : "" ?> value="Shuttlecock">Shuttlecock</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                        <textarea id="deskripsi" name="deskripsi" class="form-control" placeholder="Tulis Detail Produk" id="floatingTextarea2" style="height: 100px"><?= getProductById($_GET['id'])["description"] ?></textarea>
                    </div>
                    <div class=" mb-4">
                        <label for="harga" class="form-label">Harga</label>
                        <input required type="number" class="form-control" id="harga" name="harga" value="<?= getProductById($_GET['id'])["price"] ?>">
                    </div>
                </div>
            </div>
            <div class="col-6" style="height: fit-content;">
                <div class="bg-white p-4 shadow shadow-sm">
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <label for="name" class="form-label">Varian Produk</label>
                        <button id="btn-tambah-variant" class="btn btn-secondary" type="button">
                            <i class="fa-regular fa-circle-plus"></i>
                        </button>
                    </div>
                    <!-- Data Ditampilkan Dari Javascript -->
                    <div id="variant-list" class="mb-3">
                        <?php if (getProductById($_GET["id"])["variants"] != null) : ?>
                            <?php $variants = json_decode(getProductById($_GET["id"])["variants"], true); ?>
                            <?php foreach ($variants as $variant) : ?>
                                <?php $value_variant = implode(",", $variant["value"]); ?>
                                <div class="list mb-2">
                                    <div class="item-1">
                                        <input type="text" class="form-control" name="nama_variant[]" placeholder="Nama" value="<?= $variant["name"] ?>">
                                    </div>
                                    <div class="item-2">
                                        <input type="text" class="form-control" name="value_variant[]" placeholder="Nilai | Pisahkan Koma" value="<?= $value_variant ?>">
                                    </div>
                                    <div class="item-3">
                                        <button class="btn btn-danger btn-remove-value" type="button"><i class="fa-regular fa-circle-minus"></i></button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="mb-4">
                        <label for="gambar" class="form-label">Gambar</label>
                        <img class="w-50 d-block mb-2" src="../../uploads/<?= getProductById($_GET['id'])["image"] ?>" alt="">
                        <input type="file" class="form-control" id="gambar" name="gambar">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" name="edit-produk">
                            <i class="fa-regular fa-floppy-disk"></i>
                            Simpan Produk
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- End Content -->

<!-- scripts -->
<script type="module" src="../../assets/js/admin/product-edit.js"></script>

<script type="module">
    import {
        ClassicEditor,
        Font,
        FontSize,
        Autoformat,
        Bold,
        Italic,
        Underline,
        BlockQuote,
        Base64UploadAdapter,
        CKFinder,
        CKFinderUploadAdapter,
        CloudServices,
        CKBox,
        Essentials,
        Heading,
        Image,
        ImageCaption,
        ImageResize,
        ImageStyle,
        ImageToolbar,
        ImageUpload,
        PictureEditing,
        Indent,
        IndentBlock,
        Link,
        List,
        MediaEmbed,
        Mention,
        Paragraph,
        PasteFromOffice,
        Table,
        TableColumnResize,
        TableToolbar,
        TextTransformation,
        Alignment,
        TableProperties,
        TableCellProperties
    } from 'ckeditor5';

    ClassicEditor
        .create(document.querySelector('#deskripsi'), {
            plugins: [
                Essentials,
                Bold,
                Italic,
                Font,
                FontSize,
                Paragraph,
                List,
                BlockQuote,
                Bold,
                CKFinder,
                CKFinderUploadAdapter,
                CloudServices,
                Essentials,
                Heading,
                Image,
                ImageCaption,
                ImageResize,
                ImageStyle,
                ImageToolbar,
                ImageUpload,
                Base64UploadAdapter,
                Indent,
                IndentBlock,
                Italic,
                Link,
                List,
                Mention,
                Paragraph,
                PasteFromOffice,
                PictureEditing,
                Table,
                TableColumnResize,
                TableToolbar,
                TextTransformation,
                Underline,
                Alignment,
                TableProperties,
                TableCellProperties
            ],
            toolbar: [
                'undo',
                'redo',
                '|',
                'heading',
                '|',
                'bold',
                'italic',
                'underline',
                '|',
                'alignment:left',
                'alignment:center',
                'alignment:right',
                'alignment:justify',
                '|',
                'numberedList',
                'bulletedList',

            ],
            heading: {
                options: [{
                        model: 'paragraph',
                        title: 'Paragraph',
                        class: 'ck-heading_paragraph',
                    },
                    {
                        model: 'heading1',
                        view: 'h1',
                        title: 'Heading 1',
                        class: 'ck-heading_heading1',
                    },
                    {
                        model: 'heading2',
                        view: 'h2',
                        title: 'Heading 2',
                        class: 'ck-heading_heading2',
                    },
                    {
                        model: 'heading3',
                        view: 'h3',
                        title: 'Heading 3',
                        class: 'ck-heading_heading3',
                    },
                    {
                        model: 'heading4',
                        view: 'h4',
                        title: 'Heading 4',
                        class: 'ck-heading_heading4',
                    },
                ],
            },
            image: {
                resizeOptions: [{
                        name: 'resizeImage:original',
                        label: 'Default image width',
                        value: null,
                    },
                    {
                        name: 'resizeImage:50',
                        label: '50% page width',
                        value: '50',
                    },
                    {
                        name: 'resizeImage:75',
                        label: '75% page width',
                        value: '75',
                    },
                ],
                toolbar: [
                    'imageTextAlternative',
                    'toggleImageCaption',
                    '|',
                    'imageStyle:inline',
                    'imageStyle:wrapText',
                    'imageStyle:breakText',
                    '|',
                    'resizeImage',
                ],
            },
            link: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
            },
            table: {
                contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells'],
            },
            alignment: {
                options: ['left', 'center', 'right', 'justify']
            },
        })
        .then((editor) => {
            window.editor = editor;
        })
        .catch( /* ... */ );
</script>
<!-- end scripts -->

<?php include_once "../../components/footer-admin.php" ?>