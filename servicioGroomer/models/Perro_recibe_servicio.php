<?php
require_once __DIR__ . '/../config/Basedatos.php';

class Perro_recibe_servicio
{
    private $conn;
    private $table = "perro_recibe_servicio";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Método para verificar si un valor existe en una columna de una tabla
    public function checkIfExists($table, $column, $value)
    {
        $sql = "SELECT COUNT(*) FROM $table WHERE $column = ?";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->execute([$value]);
        return $sentencia->fetchColumn() > 0;
    }

    public function getAllPerrosConServicios()
    {
        try {
            $sql = "SELECT * FROM $this->table ORDER BY Fecha DESC";
            $statement = $this->conn->query($sql);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ["error" => "Error al cargar los registros: " . $e->getMessage()];
        }
    }

    public function getUnPerroConServicio($Sr_Cod)
    {
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

    public function getServiciosPorEmpleado($dniEmpleado)
    {
        try {
            // Consultar todos los servicios realizados por el empleado, ordenados por fecha
            $sql = "SELECT Sr_Cod, Fecha, Cod_Servicio, ID_Perro, Dni, Precio_Final, Incidencias 
                FROM $this->table 
                WHERE Dni = ? 
                ORDER BY Fecha DESC";
            $sentencia = $this->conn->prepare($sql);
            $sentencia->execute([$dniEmpleado]);

            // Obtener todos los resultados
            $registros = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            if (count($registros) > 0) {
                return $registros;
            } else {
                return "El empleado no tiene servicios";
            }
        } catch (PDOException $e) {
            return ["error" => "Error al obtener los servicios: " . $e->getMessage()];
        }
    }


    public function insertarPerroConServicio($post)
    {
        try {
            // Insertar el nuevo servicio
            $sql = "INSERT INTO $this->table (Cod_Servicio, ID_Perro, Fecha, Incidencias, Precio_Final, Dni) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $sentencia = $this->conn->prepare($sql);
            $sentencia->execute([
                $post['Cod_Servicio'],
                $post['ID_Perro'],
                $post['Fecha'],
                $post['Incidencias'],
                $post['Precio_Final'],
                $post['Dni']
            ]);

            // Recuperar el último ID insertado (Sr_Cod)
            $srCod = $this->conn->lastInsertId();
            return ["mensaje" => "Servicio con Sr_Cod " . $srCod . " insertado correctamente"];
        } catch (PDOException $e) {
            return ["error" => "Error al insertar el servicio: " . $e->getMessage()];
        }
    }


    public function borrarPerroConServicio($Sr_Cod)
    {
        try {
            $sql = "DELETE FROM $this->table WHERE Sr_Cod = ?";
            $sentencia = $this->conn->prepare($sql);
            $sentencia->bindParam(1, $Sr_Cod);
            $sentencia->execute();

            if ($sentencia->rowCount() == 0) {
                return ["No se encontró un servicio con Sr_Cod: $Sr_Cod"];
            }
            return ["Servicio con Sr_Cod $Sr_Cod eliminado correctamente"];
        } catch (PDOException $e) {
            return [ "Error al eliminar el servicio: " . $e->getMessage()];
        }
    }

    public function actualizarPerroConServicio($post)
    {
        try {
            $sql = "UPDATE $this->table 
                    SET Cod_Servicio=?, ID_Perro=?, Fecha=?, Incidencias=?, Precio_Final=?, Dni=?  
                    WHERE Sr_Cod = ?";
            $sentencia = $this->conn->prepare($sql);
            $sentencia->execute([
                $post['Cod_Servicio'],
                $post['ID_Perro'],
                $post['Fecha'],
                $post['Incidencias'],
                $post['Precio_Final'],
                $post['Dni'],
                $post['Sr_Cod']
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
