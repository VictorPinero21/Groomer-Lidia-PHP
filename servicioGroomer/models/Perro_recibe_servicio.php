<?php
require_once __DIR__ . '/../config/Basedatos.php';

class Perro_recibe_servicio {
    private $conn;
    private $table = "perro_recibe_servicio";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAllPerrosConServicios() {
        try {
            $sql = "SELECT * FROM $this->table";
            $statement = $this->conn->query($sql);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["error" => "Error al cargar los registros: " . $e->getMessage()];
        }
    }

    public function getUnPerroConServicio($Sr_Cod) {
        try {
            $sql = "SELECT * FROM $this->table WHERE Sr_Cod = ?";
            $sentencia = $this->conn->prepare($sql);
            $sentencia->bindParam(1, $Sr_Cod);
            $sentencia->execute();
            $row = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $row ?: ["error" => "No se encontró un servicio con Sr_Cod: $Sr_Cod"];
        } catch (PDOException $e) {
            return ["error" => "Error al obtener el registro: " . $e->getMessage()];
        }
    }

    public function insertarPerroConServicio($post) {
        try {
            // Verificar si el servicio ya existe
            $sqlVerificar = "SELECT COUNT(*) FROM $this->table WHERE Sr_Cod = ?";
            $sentenciaVerificar = $this->conn->prepare($sqlVerificar);
            $sentenciaVerificar->bindParam(1, $post['Sr_Cod']);
            $sentenciaVerificar->execute();

            if ($sentenciaVerificar->fetchColumn() > 0) {
                return ["error" => "El servicio con Sr_Cod " . $post['Sr_Cod'] . " ya está registrado"];
            }

            // Insertar el nuevo servicio
            $sql = "INSERT INTO $this->table (Sr_Cod, Cod_Servicio, ID_Perro, Fecha, Incidencias, Precio_Final, Dni) 
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $sentencia = $this->conn->prepare($sql);
            $sentencia->execute([
                $post['Sr_Cod'], $post['Cod_Servicio'], $post['ID_Perro'], 
                $post['Fecha'], $post['Incidencias'], $post['Precio_Final'], $post['Dni']
            ]);

            return ["mensaje" => "Servicio con Sr_Cod " . $post['Sr_Cod'] . " insertado correctamente"];
        } catch (PDOException $e) {
            return ["error" => "Error al insertar el servicio: " . $e->getMessage()];
        }
    }

    public function borrarPerroConServicio($Sr_Cod) {
        try {
            $sql = "DELETE FROM $this->table WHERE Sr_Cod = ?";
            $sentencia = $this->conn->prepare($sql);
            $sentencia->bindParam(1, $Sr_Cod);
            $sentencia->execute();

            if ($sentencia->rowCount() == 0) {
                return ["error" => "No se encontró un servicio con Sr_Cod: $Sr_Cod"];
            }
            return ["mensaje" => "Servicio con Sr_Cod $Sr_Cod eliminado correctamente"];
        } catch (PDOException $e) {
            return ["error" => "Error al eliminar el servicio: " . $e->getMessage()];
        }
    }

    public function actualizarPerroConServicio($post) {
        try {
            $sql = "UPDATE $this->table 
                    SET Cod_Servicio=?, ID_Perro=?, Fecha=?, Incidencias=?, Precio_Final=?, Dni=?  
                    WHERE Sr_Cod = ?";
            $sentencia = $this->conn->prepare($sql);
            $sentencia->execute([
                $post['Cod_Servicio'], $post['ID_Perro'], $post['Fecha'],
                $post['Incidencias'], $post['Precio_Final'], $post['Dni'], $post['Sr_Cod']
            ]);

            if ($sentencia->rowCount() == 0) {
                return ["error" => "No se actualizó el servicio. Puede que no exista o los datos sean los mismos."];
            }
            return ["mensaje" => "Servicio con Sr_Cod " . $post['Sr_Cod'] . " actualizado correctamente"];
        } catch (PDOException $e) {
            return ["error" => "Error al actualizar el servicio: " . $e->getMessage()];
        }
    }
}
?>
