<?php
require_once "index.php";

use Models\Sport\Atleta as Atleta;

$id = ( isset($_GET['id']) ) ? $_GET['id'] : 0;
$message = "";

$item = $id ? new Atleta($id) : new Atleta();

if (isset($_REQUEST['act']) && $_REQUEST['act'] == 'del') {
    $item->delete();
}

if (!empty($_POST["item"])) {

    foreach ($_POST["item"] as $k => $v) {
        $item->$k = $v;
    }

    if ($item->validate()) {
        $item->save();
    } else {
        $message = $item->getErrors();
    }
}

$list = Atleta::getAll();
echo json_encode(["list" => $list, "message" => $message]);
