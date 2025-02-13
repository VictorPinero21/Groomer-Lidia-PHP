<?php

class Servicios extends Basedatos {

    private $table;
    private $conexion;

    public function __construct() {
        $this->table = "servicios";
        $this->conexion = $this->getConexion();
    }

    public function getAll() {
        $objetosdep = array();
        try {
            $sql = "select * from $this->table";
            $statement = $this->conexion->query($sql);
            $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement = null;

            return $registros;
        } catch (PDOException $e) {
            return "ERROR AL CARGAR.<br>" . $e->getMessage();
        }
    }

    public function borrarServicios($cod) {
        try {
            $sql = "delete from $this->table where Codigo= ? ";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(1, $cod);
            $num = $sentencia->execute();
            if ($sentencia->rowCount() == 0)
                return "Registro no borrado o no localizado: " . $cod;
            else
                return "Registro Borrado: " . $cod;
        } catch (PDOException $e) {
            return "Error al borrar.<br>" . $e->getMessage();
        }
    }

    public function modificarPrecioServicios($cod, $precio) {
        try {
            $sql = "update $this->table set Precio=? where Codigo=?";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(1, $Precio);
            $sentencia->bindParam(2, $Codigo);
            $num = $sentencia->execute();
            if ($sentencia->rowCount() == 0)
                return "Registro NO actualizado, o no existe o no hay cambios: " . $cod;
            else
                return "Registro actualizado: " . $cod;
        } catch (PDOException $e) {
            return "Error al actualizar.<br>" . $e->getMessage();
        }
    }


    //metodo para insrtar un nuevo servicio
 
    public function insertarServicio($cod, $nom, $precio) {
        try {
            $sql = "insert into $this->table values(?,?,?)";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(1, $Codigo);
            $sentencia->bindParam(2, $Nombre);
            $sentencia->bindParam(3, $Precio); 
            $sentencia->bindParam(3, $Descripcion);
            $num = $sentencia->execute();
            if ($num == 0)
                return "Servicio no insertado";
            else
                return "Servicio insertado";
        } catch (PDOException $e) {
            return "Error al insertar servicio.<br>" . $e->getMessage();
        }
    }

}
?>