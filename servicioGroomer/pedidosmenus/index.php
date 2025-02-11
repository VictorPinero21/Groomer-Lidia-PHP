<?php

require_once ('Basedatos.php');
require_once ('Pedidos.php');
$dep = new Pedidos();
// informacion = file_get_contents(php://input)
// @header("HTTP/1.1 200 OK");

@header("Content-type: application/json");

// Consultar GET
//http://localhost/_servweb/aserviciomenus/pedidosmenus/?id=4
//http://localhost/_servweb/aserviciomenus/pedidosmenus/?cli=4
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['id'])) {
        $res = $dep->getunPedido($_GET['id']);
        echo json_encode($res);
        exit();
    }
    if (isset($_GET['cli'])) {
        $res = $dep->getPedidoClien($_GET['cli']);
        echo json_encode($res);
        exit();
    }

    $res = $dep->getAll();
    echo json_encode($res);
    exit();
}
// Crear un nuevo reg POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // se cargan toda la entrada que venga en php://input
    $in = file_get_contents('php://input');
    // echo "<br>EN EL SERVER " . $in;
    //Lo convierte a array
    $post = json_decode($in, true);
    $res = $dep->insertar($post);
    $resul['resultado'] = $res;
    echo json_encode($resul);
    exit();
}

// Borrar DELETE
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    if (isset($_GET['id']))
        $id = $_GET['id'];
    else
        $id = "";
    $res = $dep->borrar($id);
    $resul['resultado'] = $res;
    echo json_encode($resul);
    exit();
}


// En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");
