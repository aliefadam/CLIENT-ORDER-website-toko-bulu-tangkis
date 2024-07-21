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
    $query = "SELECT * FROM product WHERE category = '$category'";
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



function formatMoney($num)
{
    return "Rp. " . number_format($num, 0, ',', '.');
}