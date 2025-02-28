<?php
require_once __DIR__ . '/../config/Basedatos.php';

class Empleados {
    private $conn;
    private $table = "empleados";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAllEmpleados() {
        try {
            $sql = "SELECT * FROM $this->table";
            $statement = $this->conn->query($sql);
            $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $registros;
        } catch (PDOException $e) {
            return ["error" => "Error al cargar los empleados: " . $e->getMessage()];
        }
    }

    public function getUnEmpleado($dni) {
        try {
            $sql = "SELECT * FROM $this->table WHERE Dni = ?";
            $sentencia = $this->conn->prepare($sql);
            $sentencia->bindParam(1, $dni);
            $sentencia->execute();
            $row = $sentencia->fetch(PDO::FETCH_ASSOC);

            return $row ? $row : ["error" => "Empleado no encontrado"];
        } catch (PDOException $e) {
            return ["error" => "Error al cargar el empleado: " . $e->getMessage()];
        }
    }

    public function insertarEmpleado($post)
    {
        try {
            // Verificar si el empleado ya existe por DNI
            $sqlVerificarDni = "SELECT COUNT(*) FROM $this->table WHERE Dni = ?";
            $sentenciaVerificarDni = $this->conn->prepare($sqlVerificarDni);
            $sentenciaVerificarDni->bindParam(1, $post['Dni']);
            $sentenciaVerificarDni->execute();
    
            if ($sentenciaVerificarDni->fetchColumn() > 0) {
                return ["error" => "El empleado con DNI " . $post['Dni'] . " ya está registrado"];
            }
    
            // Verificar si el correo electrónico ya existe
            $sqlVerificarEmail = "SELECT COUNT(*) FROM $this->table WHERE Email = ?";
            $sentenciaVerificarEmail = $this->conn->prepare($sqlVerificarEmail);
            $sentenciaVerificarEmail->bindParam(1, $post['Email']);
            $sentenciaVerificarEmail->execute();
    
            if ($sentenciaVerificarEmail->fetchColumn() > 0) {
                return ["error" => "El correo electrónico " . $post['Email'] . " ya está registrado"];
            }
    
            // Cifrar la contraseña antes de almacenarla
            $passwordCifrada = password_hash($post['Password'], PASSWORD_DEFAULT);
    
            // Insertar el empleado
            $sql = "INSERT INTO $this->table (Dni, Email, Password, Rol, Nombre, Apellido1, Apellido2, Calle, Numero, Cp, Poblacion, Provincia, Tlfno, Profesion) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $sentencia = $this->conn->prepare($sql);
            $sentencia->execute([
                $post['Dni'], $post['Email'], $passwordCifrada, $post['Rol'], $post['Nombre'],
                $post['Apellido1'], $post['Apellido2'], $post['Calle'], $post['Numero'], 
                $post['Cp'], $post['Poblacion'], $post['Provincia'], $post['Tlfno'], 
                $post['Profesion']
            ]);
    
            return ["mensaje" => "Empleado con DNI " . $post['Dni'] . " insertado correctamente"];
        } catch (PDOException $e) {
            return ["error" => "Error al insertar el empleado: " . $e->getMessage()];
        }
    }
    

    public function borrarEmpleado($dni) {
        try {
            $sql = "DELETE FROM $this->table WHERE Dni = ?";
            $sentencia = $this->conn->prepare($sql);
            $sentencia->bindParam(1, $dni);
            $sentencia->execute();

            if ($sentencia->rowCount() == 0) {
                return ["error" => "Empleado no encontrado con DNI: $dni"];
            } else {
                return ["mensaje" => "Empleado DNI $dni eliminado correctamente"];
            }
        } catch (PDOException $e) {
            return ["error" => "Error al borrar el empleado: " . $e->getMessage()];
        }
    }

    public function actualizarEmpleado($post) {
        try {
            // Cifrar la nueva contraseña si se proporciona
            $passwordCifrada = password_hash($post['Password'], PASSWORD_DEFAULT);

            $sql = "UPDATE $this->table 
                    SET Email=?, Password=?, Rol=?, Nombre=?, Apellido1=?, Apellido2=?, Calle=?, Numero=?, Cp=?, 
                        Poblacion=?, Provincia=?, Tlfno=?, Profesion=? 
                    WHERE Dni = ?";
            $sentencia = $this->conn->prepare($sql);
            $sentencia->execute([
                $post['Email'], $passwordCifrada, $post['Rol'], $post['Nombre'], $post['Apellido1'], 
                $post['Apellido2'], $post['Calle'], $post['Numero'], $post['Cp'], 
                $post['Poblacion'], $post['Provincia'], $post['Tlfno'], 
                $post['Profesion'], $post['Dni']
            ]);

            if ($sentencia->rowCount() == 0) {
                return ["error" => "Empleado no actualizado. Puede que no exista o los datos sean iguales."];
            } else {
                return ["mensaje" => "Empleado DNI " . $post['Dni'] . " actualizado correctamente"];
            }
        } catch (PDOException $e) {
            return ["error" => "Error al actualizar el empleado: " . $e->getMessage()];
        }
    }
}
?>
