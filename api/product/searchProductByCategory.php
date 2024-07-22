<?php

include_once "../../config/helper.php";

if (isset($_GET["keyword"])) {
    $category = $_GET["category"];
    $keyword = $_GET["keyword"];

    echo json_encode(searchProductByCategory($category, $keyword));
}