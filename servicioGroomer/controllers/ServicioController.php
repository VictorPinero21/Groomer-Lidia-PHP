<?php
require_once __DIR__ . '/../models/Servicios.php';

class ServicioController {
    private $servicioModel;

    public function __construct() {
        $this->servicioModel = new Servicios();
    }

    public function getAllServicios() {
        echo json_encode($this->servicioModel->getAllServicios());
    }

    public function getUnServicio($Codigo) {
        $servicio = $this->servicioModel->getUnServicio($Codigo);
        if (empty($servicio)) {
            echo json_encode(["error" => "No se encontró el servicio con código: $Codigo"]);
        } else {
            echo json_encode($servicio);
        }
    }

    public function insertarServicio() {
        $data = json_decode(file_get_contents("php://input"), true);
    
        // Validar que se reciban todos los datos necesarios
        if (!isset($data["Tipo"]) || !isset($data["Nombre"]) || !isset($data["Descripcion"]) || !isset($data["Precio"])) {
            echo json_encode(["error" => "Faltan datos"]);
            return;
        }
    
        // Llamar al modelo para insertar el servicio
        $resultado = $this->servicioModel->insertarServicio($data);
        echo json_encode(["mensaje" => $resultado]);
    }

    public function modificarPrecioServicios() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data["Codigo"]) || !isset($data["Precio"])) {
            echo json_encode(["error" => "Faltan datos"]);
            return;
        }

        $resultado = $this->servicioModel->modificarPrecioServicios($data["Codigo"], $data["Precio"]);
        echo json_encode(["mensaje" => $resultado]);
    }

    public function borrarServicios($Codigo) {
        $resultado = $this->servicioModel->borrarServicios($Codigo);
        echo json_encode(["mensaje" => $resultado]);
    }
}
?>
