<?php
require_once __DIR__ . "/Entities/TodoManage.php";
require_once __DIR__ . "/partials/header.php";
if(!isset($_GET["id"]) or empty($_GET["id"])) {
    include_once __DIR__ . '/partials/not_found.php';
    exit();
}

$todo = \Entities\TodoManage::GetOne($_GET["id"]);

if(empty($todo)) {
    include_once __DIR__ . '/partials/not_found.php';
    exit();
}

\Entities\TodoManage::DeleteOne($todo["Id"]);

header("Location: index.php");

require_once __DIR__ . "/partials/footer.php";
