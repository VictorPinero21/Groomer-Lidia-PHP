<?php

class WebController extends ControladorBase {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dat = array();
        $this->view("index", $dat);
    }

    public function insertar() {
        $dat = array();
        $clientes = json_decode(file_get_contents("http://localhost/_servweb/aserviciomenus/clientes/"), true);
        $menus = json_decode(file_get_contents("http://localhost/_servweb/aserviciomenus/menus/"), true);
        $this->view("insertar", array("clientes" => $clientes, "menus" => $menus));
    }

    public function insertaya() {
        $envio = json_encode(
                array("idpedidomenu" => $_POST['idpedido'],
                    "idcliente" => $_POST['idcliente'],
                    "idmenu" => $_POST['idmenu'],
                    "fechapedido" => $_POST['fecha']));
        $urlmiservicio = "http://localhost/_servweb/aserviciomenus/pedidosmenus/";
        $conexion = curl_init();
        curl_setopt($conexion, CURLOPT_URL, $urlmiservicio);
        //Cabecera, tipo de datos y longitud de envío
        curl_setopt($conexion, CURLOPT_HTTPHEADER,
                array('Content-type: application/json', 'Content-Length: ' . mb_strlen($envio)));
        //Tipo de petición
        curl_setopt($conexion, CURLOPT_POST, TRUE);
        //Campos que van en el envío
        curl_setopt($conexion, CURLOPT_POSTFIELDS, $envio);
        //para recibir una respuesta
        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, true);

        $mensaje = json_decode(curl_exec($conexion), false);

        curl_close($conexion);
        //Volver a la vista

        $clientes = json_decode(file_get_contents("http://localhost/_servweb/aserviciomenus/clientes/"), true);
        $menus = json_decode(file_get_contents("http://localhost/_servweb/aserviciomenus/menus/"), true);

        $this->view("insertar", array("clientes" => $clientes,
            "menus" => $menus, "mensaje" => $mensaje->resultado,
            "idpedido" => $_POST['idpedido'], "idcliente" => $_POST['idcliente'],
            "idmenu" => $_POST['idmenu']));
    }

    public function listar() {
        $clientes = json_decode(file_get_contents("http://localhost/_servweb/aserviciomenus/clientes/"), true);
        $this->view("listarborrar", array("clientes" => $clientes));
    }

    public function borrapedido() {

        $id = $_GET['num'];
        //Para quedarnos con el cliente
        $urlmiservicio = "http://localhost/_servweb/aserviciomenus/pedidosmenus/?id=" . $_GET['num'];
        $pedido = json_decode(file_get_contents($urlmiservicio), true);
        $cli = $pedido['IDCLIENTE'];

        //lo borramos
        $conexion = curl_init();
        curl_setopt($conexion, CURLOPT_URL, $urlmiservicio);
        curl_setopt($conexion, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($conexion, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($conexion, CURLOPT_RETURNTRANSFER, true);

        $mensaje = json_decode(curl_exec($conexion), false);

        $pedidosclien = json_decode(file_get_contents("http://localhost/_servweb/aserviciomenus/pedidosmenus/?cli=" . $cli), true);
        $clientes = json_decode(file_get_contents("http://localhost/_servweb/aserviciomenus/clientes/"), true);
        $this->view("listarborrar", array('pedidosclien' => $pedidosclien,
            "clientes" => $clientes, 'idcliente' => $cli, "mensaje" => $mensaje->resultado));
    }

    public function listarcliente() {
        $cli = $_POST['idcliente'];
        $pedidosclien = json_decode(file_get_contents("http://localhost/_servweb/aserviciomenus/pedidosmenus/?cli=" . $cli), true);

        $clientes = json_decode(file_get_contents("http://localhost/_servweb/aserviciomenus/clientes/"), true);
        $this->view("listarborrar", array('pedidosclien' => $pedidosclien,
            "clientes" => $clientes, 'idcliente' => $cli));
    }

}

?>