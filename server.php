<?php
require './vendor/autoload.php';
header('Content-type:application/json');
Predis\Autoloader::register();
$client = new Predis\Client();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'));
    $key = uniqid('lagoon42_');
    $client->set($key, json_encode($input->config));
    $conf = ['config' => $key];
    $obj = (object) $conf;
    echo json_encode($obj);
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo $client->get($_GET['config']);
}