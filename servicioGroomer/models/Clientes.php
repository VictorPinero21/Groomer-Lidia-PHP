<?php
require_once __DIR__ . '/../config/Basedatos.php';

class Cliente
{
    private $conn;
    private $table = "clientes";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function insertarCliente($dni, $nombre, $apellido1, $apellido2, $direccion, $tlfno)
    {
        $query = "INSERT INTO " . $this->table . " (dni, nombre, apellido1, apellido2, direccion, tlfno) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$dni, $nombre, $apellido1, $apellido2, $direccion, $tlfno]);
    }

    public function getUnCliente($dni)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE dni = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$dni]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function borrarCliente($dni)
    {
        $query = "DELETE FROM " . $this->table . " WHERE dni = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$dni]);
    }

    public function getAllClientes()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
