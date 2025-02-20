<?php
require_once __DIR__ . '/../models/Perro_recibe_servicio.php';

class PerroServicioController {
    private $perroRecibeServicioModel;

    public function __construct() {
        $this->perroRecibeServicioModel = new Perro_recibe_servicio();
    }

    public function getAllPerrosConServicios() {
        echo json_encode($this->perroRecibeServicioModel->getAllPerrosConServicios());
    }

    public function getUnPerroConServicio($Sr_Cod) {
        $servicio = $this->perroRecibeServicioModel->getUnPerroConServicio($Sr_Cod);
        if (empty($servicio)) {
            echo json_encode(["error" => "No se encontró el servicio con Sr_Cod: $Sr_Cod"]);
        } else {
            echo json_encode($servicio);
        }
    }

    public function insertarPerroConServicio() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data["Sr_Cod"]) || !isset($data["Cod_Servicio"]) || !isset($data["ID_Perro"]) || 
            !isset($data["Fecha"]) || !isset($data["Incidencias"]) || !isset($data["Precio_Final"]) || 
            !isset($data["Dni"])) {
            echo json_encode(["error" => "Faltan datos"]);
            return;
        }

        $resultado = $this->perroRecibeServicioModel->insertarPerroConServicio($data);
        echo json_encode(["mensaje" => $resultado]);
    }

    public function actualizarPerroConServicio() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data["Sr_Cod"]) || !isset($data["Cod_Servicio"]) || !isset($data["ID_Perro"]) || 
            !isset($data["Fecha"]) || !isset($data["Incidencias"]) || !isset($data["Precio_Final"]) || 
            !isset($data["Dni"])) {
            echo json_encode(["error" => "Faltan datos"]);
            return;
        }

        $resultado = $this->perroRecibeServicioModel->actualizarPerroConServicio($data);
        echo json_encode(["mensaje" => $resultado]);
    }

    public function borrarPerroConServicio($Sr_Cod) {
        $resultado = $this->perroRecibeServicioModel->borrarPerroConServicio($Sr_Cod);
        echo json_encode(["mensaje" => $resultado]);
    }
}
?>
