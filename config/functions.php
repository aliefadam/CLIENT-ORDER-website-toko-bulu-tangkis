<?php

date_default_timezone_set('Asia/Jakarta');

function showPage()
{
    header("Location: ../pages/admin/index.php");
}

function tambahProduk($data, $files)
{
    $nama_produk = $data["nama_produk"];
    $kategori = $data["kategori"];
    $deskripsi = $data["deskripsi"];
    $harga = $data["harga"];
    $nama_variant = $data["nama_variant"] ?? "";
    $value_variant = $data["value_variant"] ?? "";
    $variants = [];

    $ekstensi = explode(".", $files["name"])[1];
    $gambar = date("YmdHis") . "_products." . $ekstensi;

    move_uploaded_file($files["tmp_name"], "../uploads/" . $gambar);

    $data_product = [
        "nama_produk" => $nama_produk,
        "kategori" => $kategori,
        "deskripsi" => $deskripsi,
        "harga" => $harga,
        "gambar" => $gambar
    ];

    if ($nama_variant != "") {
        foreach ($nama_variant as $key => $value) {
            $variants[] = [
                "name" => $value,
                "value" => explode(",", trim($value_variant[$key])),
            ];
        }
    }

    if (!empty($variants)) {
        $data_product["variants"] = json_encode($variants);
    }

    $keys = array_keys($data_product);
    $values = array_map(function ($value) {
        return "'" . $value . "'";
    }, array_values($data_product));

    $sql = "INSERT INTO produk (" . implode(", ", $keys) . ") VALUES (" . implode(", ", $values) . ")";
    var_dump($sql);
    exit;
}

if (isset($_GET['page'])) {
    showPage();
}

if (isset($_POST["tambah-produk"])) {
    tambahProduk($_POST, $_FILES["gambar"]);
}
