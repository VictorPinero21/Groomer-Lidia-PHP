<?php
require_once __DIR__ . '/../models/Perros.php';

class PerroController
{
    private $perroModel;

    public function __construct()
    {
        $this->perroModel = new Perros();
    }

    public function getAllPerros()
    {
        echo json_encode($this->perroModel->getAllPerros());
    }

    //id perro, no dni dueño
    public function getUnPerro($Dni_duenio)
    {
        $perros = $this->perroModel->getUnPerro($Dni_duenio);
        if (empty($perros)) {
            echo json_encode(["error" => "No se encontraron perros para el dueño con DNI: $Dni_duenio"]);
        } else {
            echo json_encode($perros);
        }
    }

    //falta checkear que el dni del dueño exista en la tabla clientes
    public function insertarPerro()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (
            !isset($data["Dni_duenio"]) || !isset($data["Nombre"]) || !isset($data["Fecha_Nto"]) ||
            !isset($data["Raza"]) || !isset($data["Peso"]) || !isset($data["Altura"]) ||
            !isset($data["Observaciones"]) || !isset($data["Numero_Chip"]) || !isset($data["Sexo"])
        ) {
            echo json_encode(["error" => "Faltan datos"]);
            return;
        }

        $resultado = $this->perroModel->insertarPerro($data);
        echo json_encode(["mensaje" => $resultado]);
    }

    public function actualizarPerro()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data["ID_Perro"])) {
            echo json_encode(["error" => "Falta el ID del perro"]);
            return;
        }

        $resultado = $this->perroModel->actualizarPerro($data);
        echo json_encode(["mensaje" => $resultado]);
    }

    //esto no va con número de chip
    public function borrarPerro($Numero_Chip)
    {
        $resultado = $this->perroModel->borrarPerro($Numero_Chip);
        echo json_encode(["mensaje" => $resultado]);
    }
}
