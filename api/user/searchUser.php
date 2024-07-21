<?php

include_once "../../config/helper.php";

if (isset($_GET["keyword"])) {
    $keyword = $_GET["keyword"];
    echo json_encode(searchUser($keyword));
}
