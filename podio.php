<?php

require_once "index.php";

use Models\Sport\Podio as Podio;

$id = ( isset($_GET['id']) ) ? $_GET['id'] : 0;
$message = "";

$item = $id ? new Podio($id) : new Podio();

$list = Podio::getAll();
echo json_encode(["items" => $list, "message" => $message]);