<?php
require_once __DIR__ . '/../models/Perro_recibe_servicio.php';

//tiene 3 relaciones, checkear ids por todas partes antes de insertar
class PerroServicioController
{
    private $perroRecibeServicioModel;

    public function __construct()
    {
        $this->perroRecibeServicioModel = new Perro_recibe_servicio();
    }

    public function getAllPerrosConServicios()
    {
        echo json_encode($this->perroRecibeServicioModel->getAllPerrosConServicios());
    }

    public function getUnPerroConServicio($Sr_Cod)
    {
        $servicio = $this->perroRecibeServicioModel->getUnPerroConServicio($Sr_Cod);
        if (empty($servicio)) {
            echo json_encode(["error" => "No se encontró el servicio con Sr_Cod: $Sr_Cod"]);
        } else {
            echo json_encode($servicio);
        }
    }

    public function getServiciosPorEmpleado($dniEmpleado)
    {
        $resultado = $this->perroRecibeServicioModel->getServiciosPorEmpleado($dniEmpleado);

        if (is_array($resultado)) {
            // Si se encuentran servicios, devolverlos en formato JSON
            echo json_encode($resultado);
        } else {
            // Si no hay servicios, devolver el mensaje adecuado
            echo json_encode(["mensaje" => $resultado]);
        }
    }


    public function insertarPerroConServicio()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        // Comprobar que no faltan datos
        if (
            !isset($data["Cod_Servicio"]) || !isset($data["ID_Perro"]) ||
            !isset($data["Fecha"]) || !isset($data["Incidencias"]) || !isset($data["Precio_Final"]) ||
            !isset($data["Dni"])
        ) {
            echo json_encode(["error" => "Faltan datos"]);
            return;
        }

        // Comprobar que el Cod_Servicio existe en la tabla servicios
        if (!$this->perroRecibeServicioModel->checkIfExists("servicios", "Codigo", $data['Cod_Servicio'])) {
            echo json_encode(["error" => "El Código del Servicio no existe"]);
            return;
        }

        // Comprobar que el ID_Perro existe en la tabla perros
        if (!$this->perroRecibeServicioModel->checkIfExists("perros", "ID_Perro", $data['ID_Perro'])) {
            echo json_encode(["error" => "El ID_Perro no existe"]);
            return;
        }

        // Comprobar que el DNI del empleado existe en la tabla empleados
        if (!$this->perroRecibeServicioModel->checkIfExists("empleados", "Dni", $data['Dni'])) {
            echo json_encode(["error" => "El DNI del empleado no existe"]);
            return;
        }

        // Comprobar que el precio sea numérico y mayor o igual a 0
        if (!is_numeric($data['Precio_Final']) || $data['Precio_Final'] < 0) {
            echo json_encode(["error" => "El precio debe ser un número mayor o igual a 0"]);
            return;
        }

        // Comprobar que la fecha del servicio no sea futura (<= sysdate)
        $fechaServicio = strtotime($data['Fecha']);
        $fechaActual = strtotime(date('Y-m-d H:i:s'));
        if ($fechaServicio > $fechaActual) {
            echo json_encode(["error" => "La fecha del servicio no puede ser futura"]);
            return;
        }

        // Si todas las validaciones pasan, insertar el servicio
        $resultado = $this->perroRecibeServicioModel->insertarPerroConServicio($data);
        echo json_encode(["mensaje" => $resultado]);
    }



    public function actualizarPerroConServicio()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        if (
            !isset($data["Sr_Cod"]) || !isset($data["Cod_Servicio"]) || !isset($data["ID_Perro"]) ||
            !isset($data["Fecha"]) || !isset($data["Incidencias"]) || !isset($data["Precio_Final"]) ||
            !isset($data["Dni"])
        ) {
            echo json_encode(["error" => "Faltan datos"]);
            return;
        }

        $resultado = $this->perroRecibeServicioModel->actualizarPerroConServicio($data);
        echo json_encode(["mensaje" => $resultado]);
    }

    public function borrarPerroConServicio($Sr_Cod)
    {
        $resultado = $this->perroRecibeServicioModel->borrarPerroConServicio($Sr_Cod);
        echo json_encode(["mensaje" => $resultado]);
    }
}
