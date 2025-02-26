<?php
require_once __DIR__ . '/../config/Basedatos.php';

class Perros {
    private $conn;
    private $table = "perros";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAllPerros() {
        try {
            $sql = "SELECT * FROM $this->table";
            $statement = $this->conn->query($sql);
            $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $registros;
        } catch (PDOException $e) {
            return ["error" => "Error al cargar los perros: " . $e->getMessage()];
        }
    }

    public function getUnPerro($Dni_duenio) {
        try {
            $sql = "SELECT * FROM $this->table WHERE Dni_duenio = ?";
            $statement = $this->conn->prepare($sql);
            $statement->bindParam(1, $Dni_duenio);
            $statement->execute();
            $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $registros ?: ["error" => "No se encontraron perros para el dueño con DNI: $Dni_duenio"];
        } catch (PDOException $e) {
            return ["error" => "Error al cargar los datos: " . $e->getMessage()];
        }
    }

    public function borrarPerro($Numero_Chip) {
        try {
            $sql = "DELETE FROM $this->table WHERE Numero_Chip = ?";
            $sentencia = $this->conn->prepare($sql);
            $sentencia->bindParam(1, $Numero_Chip);
            $sentencia->execute();

            if ($sentencia->rowCount() == 0) {
                return ["error" => "No se encontró un perro con CHIP: $Numero_Chip"];
            } else {
                return ["mensaje" => "Perro con CHIP: $Numero_Chip eliminado correctamente"];
            }
        } catch (PDOException $e) {
            return ["error" => "Error al borrar el perro: " . $e->getMessage()];
        }
    }

    public function insertarPerro($post) {
        try {
            // Verificar si el perro ya existe
            $sqlVerificar = "SELECT COUNT(*) FROM $this->table WHERE Numero_Chip = ?";
            $sentenciaVerificar = $this->conn->prepare($sqlVerificar);
            $sentenciaVerificar->bindParam(1, $post['Numero_Chip']);
            $sentenciaVerificar->execute();

            if ($sentenciaVerificar->fetchColumn() > 0) {
                return ["error" => "El perro con CHIP: " . $post['Numero_Chip'] . " ya está registrado"];
            }

            // Verificar si el dueño existe en la tabla clientes
            $sqlVerificarDni = "SELECT COUNT(*) FROM clientes WHERE Dni = ?";
            $sentenciaVerificarDni = $this->conn->prepare($sqlVerificarDni);
            $sentenciaVerificarDni->bindParam(1, $post['Dni_duenio']);
            $sentenciaVerificarDni->execute();

            if ($sentenciaVerificarDni->fetchColumn() == 0) {
                return ["error" => "El dueño con DNI: " . $post['Dni_duenio'] . " no está registrado"];
            }

            // Insertar el perro
            $sql = "INSERT INTO $this->table (Dni_duenio, Nombre, Fecha_Nto, Raza, Peso, Altura, Observaciones, Numero_Chip, Sexo) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $sentencia = $this->conn->prepare($sql);
            $sentencia->execute([
                $post['Dni_duenio'], $post['Nombre'], $post['Fecha_Nto'], $post['Raza'], $post['Peso'],
                $post['Altura'], $post['Observaciones'], $post['Numero_Chip'], $post['Sexo']
            ]);

            return ["Perro con CHIP: " . $post['Numero_Chip'] . " insertado correctamente"];
        } catch (PDOException $e) {
            return ["error" => "Error al insertar el perro: " . $e->getMessage()];
        }
    }

    public function actualizarPerro($post) {
        try {
            $sql = "UPDATE $this->table 
                    SET Dni_duenio=?, Nombre=?, Fecha_Nto=?, Raza=?, Peso=?, Altura=?, Observaciones=?, Numero_Chip=?, Sexo=? 
                    WHERE ID_Perro = ?";
            $sentencia = $this->conn->prepare($sql);
            $sentencia->execute([
                $post['Dni_duenio'], $post['Nombre'], $post['Fecha_Nto'], $post['Raza'], $post['Peso'],
                $post['Altura'], $post['Observaciones'], $post['Numero_Chip'], $post['Sexo'], 
                $post['ID_Perro']
            ]);

            if ($sentencia->rowCount() == 0) {
                return ["error" => "No se actualizó el perro. Puede que no exista o los datos sean iguales."];
            } else {
                return ["mensaje" => "Perro con ID: " . $post['ID_Perro'] . " actualizado correctamente"];
            }
        } catch (PDOException $e) {
            return ["error" => "Error al actualizar el perro: " . $e->getMessage()];
        }
    }
}
?>
