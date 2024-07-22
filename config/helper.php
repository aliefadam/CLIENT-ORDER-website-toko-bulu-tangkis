<?php

session_start();
include_once "database.php";
date_default_timezone_set('Asia/Jakarta');

function isLogin()
{
    return isset($_SESSION["login"]);
}

function getProduct()
{
    global $conn;
    $sql = "SELECT * FROM product";
    $result = mysqli_query($conn, $sql);

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = (object)$row;
    }

    return $data;
}

function getProductById($id)
{
    global $conn;
    $query = "SELECT * FROM product WHERE id = $id";
    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}

function getProductByCategory($category)
{
    global $conn;
    $query = "SELECT * FROM product WHERE category = '$category' AND stock > 0";
    $result = mysqli_query($conn, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = (object)$row;
    }
    return $data;
}

function searchProductByCategory($category, $keyword)
{
    global $conn;
    $query = "SELECT * FROM product WHERE category = '$category' AND name LIKE '%$keyword%'";
    $result = mysqli_query($conn, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = (object)$row;
    }
    return $data;
}

function searchProduct($keyword)
{
    global $conn;
    $query = "SELECT * FROM product WHERE name LIKE '%$keyword%' OR category LIKE '%$keyword%' OR description LIKE '%$keyword%'";
    $result = mysqli_query($conn, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = (object)$row;
    }
    return $data;
}

function getUser()
{
    global $conn;
    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = (object)$row;
    }
    return $data;
}

function searchUser($keyword)
{
    global $conn;
    $query = "SELECT * FROM user WHERE name LIKE '%$keyword%' OR email LIKE '%$keyword%' OR address LIKE '%$keyword%'";
    $result = mysqli_query($conn, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = (object)$row;
    }
    return $data;
}

function getTransactionUser()
{
    global $conn;
    $sql = "SELECT * FROM transaction 
    INNER JOIN user ON transaction.user_id = user.id 
    INNER JOIN product ON transaction.product_id = product.id 
    WHERE user_id = " . $_SESSION["user"]["id"] . "
    ORDER BY created_at DESC";

    $result = mysqli_query($conn, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = (object)$row;
    }
    return $data;
}

function getAllTransaction()
{
    global $conn;
    $sql = "SELECT transaction.*, user.name as user_name, user.email as user_email, user.address as user_address, product.* 
            FROM transaction 
            INNER JOIN user ON transaction.user_id = user.id 
            INNER JOIN product ON transaction.product_id = product.id
            ORDER BY transaction.created_at DESC";

    $result = mysqli_query($conn, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = (object)$row;
    }
    return $data;
}

function getTransactionForExport()
{
    global $conn;
    $sql = "SELECT transaction.*, user.name as user_name, user.email as user_email, user.address as user_address, product.name as product_name 
            FROM transaction 
            INNER JOIN user ON transaction.user_id = user.id 
            INNER JOIN product ON transaction.product_id = product.id
            ORDER BY transaction.created_at DESC";

    $result = mysqli_query($conn, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = (object)[
            'nama_pembeli' => $row['user_name'] . " - " . $row['user_email'],
            'barang_dibeli' => $row['product_name'],
            "jumlah" => $row['qty'] . " x " . formatMoney($row['price']),
            'list_variant' => $row["list_variant"],
            'harga' => $row['sub_total'],
            'tanggal' => $row['created_at']
        ];
    }
    return $data;
}


function showVariant($variant)
{
    return $variant != null ? json_decode($variant) : [];
}

function formatMoney($num)
{
    return "Rp. " . number_format($num, 0, ',', '.');
}


function getCountUser()
{
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM user";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row["count"];
}

function getCountProduct()
{
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM product";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row["count"];
}

function getCountTransaction()
{
    global $conn;
    $sql = "SELECT COUNT(*) as count FROM transaction";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row["count"];
}

function getTotalIncome()
{
    global $conn;
    $sql = "SELECT SUM(sub_total) as total FROM transaction";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return formatMoney($row["total"] ?? 0);
}

function getTransactionCountByCategory($category)
{
    global $conn;
    $sql = "
        SELECT COUNT(*) as count 
        FROM transaction t
        INNER JOIN product p ON t.product_id = p.id
        WHERE p.category = '$category'
    ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row["count"];
}

function getMutationStock()
{
    global $conn;
    $sql = "SELECT *, product.name as product_name, stock_mutation.description as stock_mutation_description FROM stock_mutation INNER JOIN product ON stock_mutation.product_id = product.id ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = (object)$row;
    }
    return $data;
}

function existInTransaction($productID)
{
    global $conn;
    $sql = "SELECT * FROM transaction WHERE product_id = $productID";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}
