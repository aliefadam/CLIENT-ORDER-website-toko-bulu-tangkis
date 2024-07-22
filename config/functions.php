<?php

include_once "database.php";
include_once "helper.php";
require_once "../vendor/autoload.php";
date_default_timezone_set('Asia/Jakarta');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function showPage()
{
    header("Location: ../pages/admin/index.php");
}

function tambahProduk($data, $files)
{
    global $conn;
    $nama_produk = $data["nama_produk"];
    $kategori = $data["kategori"];
    $deskripsi = $data["deskripsi"];
    $harga = $data["harga"];
    $stok = $data["stok"];
    $nama_variant = $data["nama_variant"] ?? "";
    $value_variant = $data["value_variant"] ?? "";
    $variants = [];

    $ekstensi = explode(".", $files["name"])[1];
    $gambar = date("YmdHis") . "_products." . $ekstensi;

    move_uploaded_file($files["tmp_name"], "../uploads/" . $gambar);

    $data_product = [
        "name" => $nama_produk,
        "category" => $kategori,
        "description" => $deskripsi,
        "price" => $harga,
        "image" => $gambar,
        "stock" => $stok
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

    $sql = "INSERT INTO product (" . implode(", ", $keys) . ") VALUES (" . implode(", ", $values) . ")";
    $conn->query($sql);

    $_SESSION["message"] = [
        "title" => "Sukses",
        "icon" => "success",
        "text" => "Produk ditambahkan"
    ];
    header("Location: ../pages/admin/products.php");
}


function editProduk($data, $files)
{
    global $conn;
    $nama_produk = $data["nama_produk"];
    $kategori = $data["kategori"];
    $deskripsi = $data["deskripsi"];
    $harga = $data["harga"];
    $nama_variant = $data["nama_variant"] ?? "";
    $value_variant = $data["value_variant"] ?? "";
    $variants = [];
    $product_id = $data["id"];

    $sql_get_old_product = "SELECT image FROM product WHERE id = '$product_id'";
    $result = $conn->query($sql_get_old_product);
    $old_product = $result->fetch_assoc();
    $old_image = $old_product['image'];

    if ($files["name"]) {
        $ekstensi = explode(".", $files["name"])[1];
        $gambar = date("YmdHis") . "_products." . $ekstensi;

        if ($old_image) {
            unlink("../uploads/" . $old_image);
        }
        move_uploaded_file($files["tmp_name"], "../uploads/" . $gambar);
    } else {
        $gambar = $old_image;
    }

    $data_product = [
        "name" => $nama_produk,
        "category" => $kategori,
        "description" => $deskripsi,
        "price" => $harga,
        "image" => $gambar
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

    if (empty($data_product["variants"])) {
        unset($data_product["variants"]);
        $sql = "UPDATE product SET variants = NULL WHERE id = '$product_id'";
        $conn->query($sql);
    }

    $update_fields = [];
    foreach ($data_product as $key => $value) {
        $update_fields[] = "$key = '$value'";
    }

    $sql = "UPDATE product SET " . implode(", ", $update_fields) . " WHERE id = '$product_id'";
    $conn->query($sql);

    $_SESSION["message"] = [
        "title" => "Sukses",
        "icon" => "success",
        "text" => "Produk berhasil diperbarui"
    ];
    header("Location: ../pages/admin/products.php");
}

function deleteProduct($id)
{
    global $conn;

    if (existInTransaction($id)) {
        $_SESSION["message"] = [
            "title" => "Gagal",
            "icon" => "error",
            "text" => "Produk ini sudah ada di transaksi"
        ];
        header("Location: ../pages/admin/products.php");
        exit;
    }

    $sql = "DELETE FROM product WHERE id = '$id'";
    $conn->query($sql);

    $_SESSION["message"] = [
        "title" => "Sukses",
        "icon" => "success",
        "text" => "Produk berhasil dihapus"
    ];
    header("Location: ../pages/admin/products.php");
}

function register($data)
{
    global $conn;

    $nama = $data["nama"];
    $email = $data["email"];
    $alamat = $data["alamat"];
    $password = $data["password"];
    $konfirmasi_password = $data["conf_password"];
    $role = "user";

    if ($password != $konfirmasi_password) {
        $_SESSION["message"] = [
            "title" => "Gagal",
            "icon" => "error",
            "text" => "Konfirmasi password tidak sesuai"
        ];
        header("Location: ../pages/auth/register.php");
        exit;
    }

    $check_email = "SELECT * FROM user WHERE email = '$email'";
    $result = $conn->query($check_email);
    if ($result->num_rows > 0) {
        $_SESSION["message"] = [
            "title" => "Gagal",
            "icon" => "error",
            "text" => "Email sudah digunakan akun lain"
        ];
        header("Location: ../pages/auth/register.php");
        exit;
    }


    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO user (name, email, address, password, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nama, $email, $alamat, $password, $role);
    $stmt->execute();
    $stmt->close();

    $_SESSION["message"] = [
        "title" => "Sukses",
        "icon" => "success",
        "text" => "Registrasi Berhasil, silahkan login!"
    ];
    header("Location: ../pages/auth/login.php");
}

function login($data)
{
    global $conn;
    $email = $data["email"];
    $password = $data["password"];
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    if (password_verify($password, $user["password"])) {
        $_SESSION["login"] = true;
        $_SESSION["user"] = [
            "id" => $user["id"],
            "name" => $user["name"],
            "address" => $user["address"],
            "email" => $user["email"],
            "role" => $user["role"],
        ];

        if ($user["role"] == "admin") {
            header("Location: ../pages/admin/index.php");
        } else {
            header("Location: ../pages/user/index.php");
        }
    } else {
        $_SESSION["message"] = [
            "title" => "Gagal",
            "icon" => "error",
            "text" => "Email atau password salah!"
        ];
        header("Location: ../pages/auth/login.php");
    }
}

function buy($data)
{
    global $conn;
    $userID = $_SESSION["user"]["id"];
    $productID = $data["id"];
    $listVariant = $data["list_variant"] == "[]" ? null : $data["list_variant"];
    $price = getProductById($productID)["price"];
    $qty = (int) $data["qty"];
    $subTotal = $price * $qty;
    $created_at = date("Y-m-d H:i:s");

    if ($qty > getProductById($productID)["stock"]) {
        $_SESSION["message"] = [
            "title" => "Gagal",
            "icon" => "error",
            "text" => "Stok tidak mencukupi"
        ];
        header("Location: ../pages/user/product-detail.php?id=" . $productID);
        exit;
    }

    $sql = "INSERT INTO transaction (user_id, product_id, list_variant, price, qty, sub_total, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issdids", $userID, $productID, $listVariant, $price, $qty, $subTotal, $created_at);
    $stmt->execute();

    $conn->query("UPDATE product SET stock = stock - " . $qty . " WHERE id = " . $productID);

    $type = "Keluar";
    $description = "Pembelian Produk";
    $sql = "INSERT INTO stock_mutation (product_id, type, description, qty, created_at) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $productID, $type, $description, $qty, $created_at);
    $stmt->execute();
    $stmt->close();

    header("Location: ../pages/user/thanks.php");
}

function exportExcel()
{
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $header = ['Nama Pembeli', 'Barang Dibeli', "Jumlah", 'Variant', 'Total Harga', 'Tanggal'];
    $column = 'A';

    foreach ($header as $heading) {
        $sheet->setCellValue($column . '1', $heading);
        $sheet->getStyle($column . '1')->getFont()->setBold(true);
        $column++;
    }

    $data = getTransactionForExport();
    $rowNumber = 2;

    foreach ($data as $row) {
        $sheet->setCellValue('A' . $rowNumber, $row->nama_pembeli);
        $sheet->setCellValue('B' . $rowNumber, $row->barang_dibeli);
        $sheet->setCellValue('C' . $rowNumber, $row->jumlah);
        $sheet->setCellValue('D' . $rowNumber, $row->list_variant == null ? "-" : $row->list_variant);
        $sheet->setCellValue('E' . $rowNumber, formatMoney($row->harga));
        $sheet->setCellValue('F' . $rowNumber, $row->tanggal);
        $rowNumber++;
    }

    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="laporan-penjualan.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
}

function tambahMutasi($data)
{
    global $conn;
    $product_id = $data["product_id"];
    $type = $data["jenis"] == "in" ? "Masuk" : "Keluar";
    $description = $type == "Masuk" ? "Barang masuk" : "Barang keluar";
    $qty = $data["jumlah"];
    $created_at = date("Y-m-d H:i:s");

    if ($type == "Keluar") {
        $stmt = $conn->prepare("SELECT stock FROM product WHERE id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($qty > $row["stock"]) {
            $_SESSION["message"] = [
                "title" => "Gagal",
                "icon" => "error",
                "text" => "Jumlah keluar lebih dari stok"
            ];
            header("Location: ../pages/admin/stock-mutation-add.php");
            exit;
        }
    }

    $sql = "INSERT INTO stock_mutation (product_id, type, description, qty, created_at) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $product_id, $type, $description, $qty, $created_at);
    $stmt->execute();

    if ($type == "Masuk") {
        $conn->query("UPDATE product SET stock = product.stock + $qty WHERE id = $product_id");
    } else {
        $conn->query("UPDATE product SET stock = product.stock - $qty WHERE id = $product_id");
    }
    $stmt->close();

    $_SESSION["message"] = [
        "title" => "Berhasil",
        "icon" => "success",
        "text" => "Mutasi stok berhasil ditambahkan"
    ];
    header("Location: ../pages/admin/stock-mutation.php");
}


if (isset($_GET['page'])) {
    showPage();
}

if (isset($_POST["tambah-produk"])) {
    tambahProduk($_POST, $_FILES["gambar"]);
}

if (isset($_POST["edit-produk"])) {
    editProduk($_POST, $_FILES["gambar"]);
}

if (isset($_POST["delete-product"])) {
    deleteProduct($_POST["id"]);
}

if (isset($_POST["register"])) {
    register($_POST);
}

if (isset($_POST["login"])) {
    login($_POST);
}

if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: ../pages/auth/login.php");
}

if (isset($_POST["buy"])) {
    buy($_POST);
}

if (isset($_GET["export-excel"])) {
    exportExcel();
}

if (isset($_POST["tambah-mutasi"])) {
    tambahMutasi($_POST);
}
