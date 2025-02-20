<?php
require_once __DIR__ . '/../models/Clientes.php';

class ClienteController
{
    private $clienteModel;

    public function __construct()
    {
        $this->clienteModel = new Cliente();
    }

    public function insertarCliente()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data["dni"]) || !isset($data["nombre"]) || !isset($data["apellido1"]) || !isset($data["apellido2"]) || !isset($data["direccion"]) || !isset($data["tlfno"])) {
            echo json_encode(["error" => "Faltan datos"]);
            return;
        }

        if ($this->clienteModel->getUnCliente($data["dni"])) {
            echo json_encode(["error" => "El Cliente ya está dado de alta"]);
            return;
        }

        if ($this->clienteModel->insertarCliente($data["dni"], $data["nombre"], $data["apellido1"], $data["apellido2"] ?? "", $data["direccion"], $data["tlfno"])) {
            echo json_encode(["mensaje" => "Cliente DNI: {$data["dni"]} insertado correctamente"]);
        } else {
            echo json_encode(["error" => "Error al insertar"]);
        }
    }

    public function borrarCliente($dni)
    {
        if (!$this->clienteModel->getUnCliente($dni)) {
            echo json_encode(["error" => "El cliente no existe"]);
            return;
        }

        if ($this->clienteModel->borrarCliente($dni)) {
            echo json_encode(["mensaje" => "Cliente DNI: $dni borrado correctamente"]);
        } else {
            echo json_encode(["error" => "Error al borrar cliente"]);
        }
    }

    public function getAllClientes()
    {
        echo json_encode($this->clienteModel->getAllClientes());
    }

    // **Nuevo método agregado para corregir el error**
    public function getUnCliente($dni)
    {
        $cliente = $this->clienteModel->getUnCliente($dni);
        if ($cliente) {
            echo json_encode($cliente);
        } else {
            echo json_encode(["error" => "Cliente no encontrado"]);
        }
    }
}
