<?php

require_once('./../Basedatos.php');
require_once('Clientes.php');
$cliente = new Clientes();
// informacion = file_get_contents(php://input)
// @header("HTTP/1.1 200 OK");

@header("Content-type: application/json");
//$REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
//$REQUEST_URI = $_SERVER['REQUEST_URI'];
//echo "<br>Server. REQUEST_METHOD: ". $REQUEST_METHOD;
//echo "<br>Server. REQUEST_URI: ". $REQUEST_URI;
//echo "<br>";
// Consultar GET
//http://localhost/_servweb/aserviciomenus/clientes/
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['Dni'])) {
        $res = $cliente->getUnCliente($_GET['Dni']);
        echo json_encode($res);
        exit();
    } else {
        $res = $cliente->getAllClientes();
        echo json_encode($res);
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos JSON enviados por Postman
    $postData = json_decode(file_get_contents("php://input"), true);

    // Verificar si se recibieron los datos correctamente
    if (isset($postData['post'])) {
        $res = $cliente->insertarCliente($postData['post']);
        echo json_encode(["message" => $res]);
        exit();
    } else {
        echo json_encode(["error" => "Invalid request. No data received."]);
        exit();
    }
}




// En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");
