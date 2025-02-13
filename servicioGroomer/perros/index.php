<?php

require_once('Basedatos.php');
require_once('Perros.php');
$perro = new Perros();
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

    if (isset($_GET['Dni_duenio'])) {
        $res = $perro->getUnPerro($_GET['Dni_duenio']);
        echo json_encode($res);
        exit();
    } else {
        $res = $perro->getAllPerros();
        echo json_encode($res);
        exit();
    }
}

// En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");
