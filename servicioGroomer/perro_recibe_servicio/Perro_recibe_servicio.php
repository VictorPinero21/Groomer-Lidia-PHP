<?php
require_once './../Basedatos.php';
class Perro_recibe_servicio extends Basedatos
{

    private $table;
    private $conexion;

    public function __construct()
    {
        $this->table = "perro_recibe_servicio";
        $this->conexion = $this->getConexion();
    }

    public function getAllPerrosConServicios()
    {
        $objetoperroconservicio = array();
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

   
    

    //B8. Método para borrar un Servicio: este método recibe un sr_cod y lo elimina de la tabla de perro_recibe_ser
    public function getUnPerroConServicio($Sr_Cod)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE Sr_Cod=?";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(1, $Sr_Cod);
            $sentencia->execute();
            $row = $sentencia->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row;
            }
            return "Servicio no encontrado";
        } catch (PDOException $e) {
            return "Error al cargar un cliente.<br>" . $e->getMessage();
        }
    }

    //B1
    public function insertarPerroConServicio($post)
    {
        try {
            // Verificación de que el DNI ya exista en la base de datos
            $sqlVerificar = "SELECT COUNT(*) FROM $this->table WHERE Sr_Cod = ?";
            $sentenciaVerificar = $this->conexion->prepare($sqlVerificar);
            $sentenciaVerificar->bindParam(1, $post['Sr_Cod']);
            $sentenciaVerificar->execute();
            $existe = $sentenciaVerificar->fetchColumn();

            if ($existe > 0) {
                return "Error en la inserción: ya hay un servicio para un perro con un cod_servicio igual al introducido ";
            }

            // Insertar el Servicio si el cod_servicio no existe
            $sql = "INSERT INTO $this->table VALUES (?,?,?,?,?,?,?)";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(1, $post['Sr_Cod']);
            $sentencia->bindParam(2, $post['Cod_Servicio']);
            $sentencia->bindParam(3, $post['ID_Perro']);
            $sentencia->bindParam(4, $post['Fecha']);
            $sentencia->bindParam(5, $post['Incidencias']);
            $sentencia->bindParam(6, $post['Precio_Final']);
            $sentencia->bindParam(6, $post['Dni']);
            $sentencia->execute();

            return "Codigo Servicios: " . $post['Sr_Cod'] . " insertado correctamente";
        } catch (PDOException $e) {
            return "Error al insertar el cliente. Faltan datos. <br>" . $e->getMessage();
        }
    }
    
    public function borrarPerroConServicio($Sr_Cod)
    {
        try {
            $sql = "delete from perro_recibe_servicio where Sr_Cod= ? ";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(1, $Sr_Cod);
            $num = $sentencia->execute();
            if ($sentencia->rowCount() == 0)
                return "El Servicio para un perro no existe, no se localiza el Sr_Cod: " . $Sr_cod;
            else
                return "Servicio realizado con Sr_Cod: " . $Sr_Cod . " borrado correctamente ";
        } catch (PDOException $e) {
            return "ERROR AL BORRAR.<br>" . $e->getMessage();
        }
    }

    public function actualizarPerroConServicio($post)
    {
        try {
            $sql = "update $this->table set Sr_Cod=?, Cod_Servicio=?, ID_Perro=?, Fecha=?, Incidencias=? , Precio_Final=?, Dni=?  where Sr_Cod = ?";
            $sentencia = $this->conexion->prepare($sql);
            // extraemos los parámetros de la variable $post
            // suponemos que se llaman igual
            $sentencia->bindParam(6, $post['Sr_Cod']);
            $sentencia->bindParam(1, $post['Cod_Servicio']);
            $sentencia->bindParam(2, $post['ID_Perro']);
            $sentencia->bindParam(3, $post['Fecha']);
            $sentencia->bindParam(4, $post['Incidencias']);
            $sentencia->bindParam(5, $post['Precio_Final']);
            $sentencia->bindParam(6, $post['Dni']);
            $sentencia->bindParam(7, $post['Sr_Cod']);
            $num = $sentencia->execute();
            if ($sentencia->rowCount() == 0)
                return "Servicio NO actualizado, o no existe el Cod_Servicio o no hay cambios: " . $post['Sr_Cod'];
            else
                return "Servicio actualizado: " . $post['Sr_Cod'];
        } catch (PDOException $e) {
            return "Error al actualizar.<br>" . $e->getMessage();
        }
    }
}
