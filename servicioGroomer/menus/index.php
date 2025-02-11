<?php

require_once ('Basedatos.php');
require_once ('Menus.php');
$dep = new Menus();
// informacion = file_get_contents(php://input)
// @header("HTTP/1.1 200 OK");

@header("Content-type: application/json");

//http://localhost/_servweb/aserviciomenus/menus/
// Consultar GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['id'])) {
        $res = $dep->getunMenu($_GET['id']);
        echo json_encode($res);
        exit();
    } else {
        $res = $dep->getAll();
        echo json_encode($res);
        exit();
    }
}

// En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

