<?php
require_once __DIR__ . '/../models/Empleados.php';

class EmpleadoController
{
    private $empleadoModel;

    public function __construct()
    {
        $this->empleadoModel = new Empleados();
    }

    public function getAllEmpleados()
    {
        echo json_encode($this->empleadoModel->getAllEmpleados());
    }

    public function getUnEmpleado($dni)
    {
        $empleado = $this->empleadoModel->getUnEmpleado($dni);
        if (!$empleado) {
            echo json_encode(["error" => "Empleado no encontrado"]);
        } else {
            echo json_encode($empleado);
        }
    }

    public function insertarEmpleado()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (
            !isset($data["Dni"]) || !isset($data["Email"]) || !isset($data["Password"]) ||
            !isset($data["Rol"]) || !isset($data["Nombre"]) || !isset($data["Apellido1"]) ||
            !isset($data["Apellido2"]) ||
            !isset($data["Calle"]) || !isset($data["Numero"]) || !isset($data["Cp"]) ||
            !isset($data["Poblacion"]) || !isset($data["Provincia"]) || !isset($data["Tlfno"]) ||
            !isset($data["Profesion"])
        ) {
            echo json_encode(["error" => "Faltan datos"]);
            return;
        }

        $resultado = $this->empleadoModel->insertarEmpleado($data);
        echo json_encode(["mensaje" => $resultado]);
    }

    public function actualizarEmpleado()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data["Dni"])) {
            echo json_encode(["error" => "Falta el DNI del empleado"]);
            return;
        }

        $resultado = $this->empleadoModel->actualizarEmpleado($data);
        echo json_encode(["mensaje" => $resultado]);
    }

    public function borrarEmpleado($dni)
    {
        $resultado = $this->empleadoModel->borrarEmpleado($dni);
        echo json_encode(["mensaje" => $resultado]);
    }
}
