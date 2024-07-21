<?php

include_once "../../config/helper.php";

if (isset($_GET["id"])) {
    $productID = $_GET["id"];
    echo json_encode(getProductById($productID));
}
