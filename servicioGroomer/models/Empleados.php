<?php
require_once './../config/Basedatos.php';
class Empleados extends Basedatos
{

    private $table;
    private $conexion;

    public function __construct()
    {
        $this->table = "empleados";
        $this->conexion = $this->getConexion();
    }

    public function getAllEmpleados()
    {
        $objetocliente = array();
        try {
            $sql = "select * from $this->table";
            $statement = $this->conexion->query($sql);
            $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement = null;
            // Retorna el array de registros
            return $registros;
        } catch (PDOException $e) {
            return "Error al cargar todos los empleados.<br>" . $e->getMessage();
        }
    }

    public function getUnEmpleado($dni)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE Dni=?";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(1, $dni);
            $sentencia->execute();
            $row = $sentencia->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row;
            }
            return "Empleado no encontrado";
        } catch (PDOException $e) {
            return "Error al cargar un empleado.<br>" . $e->getMessage();
        }
    }

    //B4
    public function insertarEmpleado($post)
    {
        try {
            // Verificación de que el DNI ya exista en la base de datos
            $sqlVerificar = "SELECT COUNT(*) FROM $this->table WHERE Dni = ?";
            $sentenciaVerificar = $this->conexion->prepare($sqlVerificar);
            $sentenciaVerificar->bindParam(1, $post['Dni']);
            $sentenciaVerificar->execute();
            $existe = $sentenciaVerificar->fetchColumn();

            if ($existe > 0) {
                return "Error en la inserción: el empleado ya está dado de alta";
            }

            // Cifrar la contraseña antes de almacenarla
            $passwordCifrada = password_hash($post['Password'], PASSWORD_DEFAULT);


            // Insertar el empleado si el DNI no existe
            $sql = "INSERT INTO $this->table VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(1, $post['Dni']);
            $sentencia->bindParam(2, $post['Email']);
            $sentencia->bindParam(3, $passwordCifrada); // Aquí usamos la contraseña cifrada
            $sentencia->bindParam(4, $post['Rol']);
            $sentencia->bindParam(5, $post['Nombre']);
            $sentencia->bindParam(6, $post['Apellido1']);
            $sentencia->bindParam(7, $post['Apellido2']);
            $sentencia->bindParam(8, $post['Calle']);
            $sentencia->bindParam(9, $post['Numero']);
            $sentencia->bindParam(10, $post['Cp']);
            $sentencia->bindParam(11, $post['Poblacion']);
            $sentencia->bindParam(12, $post['Provincia']);
            $sentencia->bindParam(13, $post['Tlfno']);
            $sentencia->bindParam(14, $post['Profesion']);
            $sentencia->execute();

            return "Empleado DNI: " . $post['Dni'] . " insertado correctamente";
        } catch (PDOException $e) {
            return "Error al insertar el empleado. Faltan datos. <br>" . $e->getMessage();
        }
    }
    //B6
    public function borrarEmpleado($dni)
    {
        try {
            $sql = "delete from empleados where Dni= ? ";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(1, $dni);
            $num = $sentencia->execute();
            if ($sentencia->rowCount() == 0)
                return "El empleado no existe, no se localiza el DNI: " . $dni;
            else
                return "Empleado DNI: " . $dni . " borrado correctamente ";
        } catch (PDOException $e) {
            return "Error al borrar el empleado.<br>" . $e->getMessage();
        }
    }

    public function actualizarEmpleado($post)
    {
        try {
            $sql = "update $this->table set Email=?, Password=?, Rol=?, Apellido1=?, Apellido2=?, Calle=?, Numero=?, Cp=?, Poblacion=?, Provincia=?, Tlfno=?, Profesion=? where Dni = ?";
            $sentencia = $this->conexion->prepare($sql);
            // Cifrar la contraseña antes de almacenarla
            $passwordCifrada = password_hash($post['Password'], PASSWORD_DEFAULT);
            // extraemos los parámetros de la variable $post
            // suponemos que se llaman igual
            $sentencia->bindParam(14, $post['Dni']);
            $sentencia->bindParam(1, $post['Email']);
            $sentencia->bindParam(2, $passwordCifrada); // Aquí usamos la contraseña cifrada
            $sentencia->bindParam(3, $post['Rol']);
            $sentencia->bindParam(4, $post['Nombre']);
            $sentencia->bindParam(5, $post['Apellido1']);
            $sentencia->bindParam(6, $post['Apellido2']);
            $sentencia->bindParam(7, $post['Calle']);
            $sentencia->bindParam(8, $post['Numero']);
            $sentencia->bindParam(9, $post['Cp']);
            $sentencia->bindParam(10, $post['Poblacion']);
            $sentencia->bindParam(11, $post['Provincia']);
            $sentencia->bindParam(12, $post['Tlfno']);
            $sentencia->bindParam(13, $post['Profesion']);
            $num = $sentencia->execute();
            if ($sentencia->rowCount() == 0)
                return "Empleado NO actualizado, o no existe el empleado o no hay cambios: " . $post['Dni'];
            else
                return "Empleado actualizado: " . $post['Dni'];
        } catch (PDOException $e) {
            return "Error al actualizar.<br>" . $e->getMessage();
        }
    }
}
