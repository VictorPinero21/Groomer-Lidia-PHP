<?php
require_once './../Basedatos.php';
class Clientes extends Basedatos
{

    private $table;
    private $conexion;

    public function __construct()
    {
        $this->table = "clientes";
        $this->conexion = $this->getConexion();
    }

    public function getAllClientes()
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
            return "Error al cargar todos los clientes.<br>" . $e->getMessage();
        }
    }

    public function getUnCliente($dni)
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
            return "Cliente no encontrado";
        } catch (PDOException $e) {
            return "Error al cargar un cliente.<br>" . $e->getMessage();
        }
    }

    //B1
   
public function insertarCliente($post)
{
    try {
        // Check if the DNI already exists
        $sqlVerificar = "SELECT COUNT(*) FROM $this->table WHERE Dni = ?";
        $sentenciaVerificar = $this->conexion->prepare($sqlVerificar);
        $sentenciaVerificar->bindParam(1, $post['Dni']);
        $sentenciaVerificar->execute();
        $existe = $sentenciaVerificar->fetchColumn();

        if ($existe > 0) {
            return "Error: Cliente con DNI " . $post['Dni'] . " ya existe.";
        }

        // Insert the new client
        $sql = "INSERT INTO $this->table (Dni, Nombre, Apellido1, Apellido2, Direccion, Tlfno) 
                VALUES (:Dni, :Nombre, :Apellido1, :Apellido2, :Direccion, :Tlfno)";
        $sentencia = $this->conexion->prepare($sql);

        $sentencia->bindParam(':Dni', $post['Dni']);
        $sentencia->bindParam(':Nombre', $post['Nombre']);
        $sentencia->bindParam(':Apellido1', $post['Apellido1']);
        $sentencia->bindParam(':Apellido2', $post['Apellido2']);
        $sentencia->bindParam(':Direccion', $post['Direccion']);
        $sentencia->bindParam(':Tlfno', $post['Tlfno']);

        $sentencia->execute();

        return "Cliente con DNI " . htmlspecialchars($post['Dni']) . " insertado correctamente.";
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage()); // Log error instead of exposing it
        return "Error al insertar el cliente.";
    }
}
    //B6
    public function borrarCliente($dni)
    {
        try {
            $sql = "delete from clientes where Dni= ? ";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(1, $dni);
            $num = $sentencia->execute();
            if ($sentencia->rowCount() == 0)
                return "El cliente no existe, no se localiza el DNI: " . $dni;
            else
                return "Cliente DNI: " . $dni . " borrado correctamente ";
        } catch (PDOException $e) {
            return "Error al borrar el cliente.<br>" . $e->getMessage();
        }
    }

    public function actualizarCliente($post)
    {
        try {
            $sql = "update $this->table set Nombre=?, Apellido1=?, Apellido2=?, Direccion=?, Tlfno=? where Dni = ?";
            $sentencia = $this->conexion->prepare($sql);
            // extraemos los parámetros de la variable $post
            // suponemos que se llaman igual
            $sentencia->bindParam(6, $post['Dni']);
            $sentencia->bindParam(1, $post['Nombre']);
            $sentencia->bindParam(2, $post['Apellido1']);
            $sentencia->bindParam(3, $post['Apellido2']);
            $sentencia->bindParam(4, $post['Direccion']);
            $sentencia->bindParam(5, $post['Tlfno']);
            $num = $sentencia->execute();
            if ($sentencia->rowCount() == 0)
                return "Cliente NO actualizado, o no existe el cliente o no hay cambios: " . $post['Dni'];
            else
                return "Cliente actualizado: " . $post['Dni'];
        } catch (PDOException $e) {
            return "Error al actualizar.<br>" . $e->getMessage();
        }
    }
}
