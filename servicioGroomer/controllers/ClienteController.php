<?php
require_once __DIR__ . '/../models/Clientes.php';

class ClienteService {
    private $clienteModel;

    public function __construct() {
        $this->clienteModel = new Clientes();
    }

    public function obtenerTodosLosClientes() {
        return $this->clienteModel->getAllClientes();
    }

    public function obtenerClientePorDni($dni) {
        return $this->clienteModel->getUnCliente($dni);
    }

    public function crearCliente($data) {
        return $this->clienteModel->insertarCliente($data);
    }

    public function actualizarCliente($dni, $data) {
        $data['Dni'] = $dni; // Aseguramos que el DNI esté en los datos
        return $this->clienteModel->actualizarCliente($data);
    }

    public function eliminarCliente($dni) {
        return $this->clienteModel->borrarCliente($dni);
    }
}
