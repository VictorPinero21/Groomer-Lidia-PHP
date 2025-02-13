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

    public function borrarServicios($Codigo) {
        try {
            $sql = "delete from $this->table where Codigo= $Codigo";
            $s = $this->conexion->prepare($sql);
            $s->bindParam(1, $Codigo);
            $num = $s->execute();
            if ($s->rowCount() == 0)
                return "Registro no borrado o no localizado: " . $Codigo;
            else
                return "Registro Borrado: " . $Codigo;
        } catch (PDOException $e) {
            return "Error al borrar.<br>" . $e->getMessage();
        }
    }

    public function modificarPrecioServicios($Codigo, $Precio) {
        try {
            $sql = "update $this->table set Precio=$Precio where Codigo= $Codigo";
            $s = $this->conexion->prepare($sql);
            $s->bindParam(1, $Precio);
            $s->bindParam(2, $Codigo);
            $num = $s->execute();
            if ($s->rowCount() == 0)
                return "Registro NO actualizado, o no existe o no hay cambios: " . $Codigo;
            else
                return "Registro actualizado: " . $Codigo;
        } catch (PDOException $e) {
            return "Error al actualizar.<br>" . $e->getMessage();
        }
    }



 
    public function insertarServicio($servicio) {
        try {
            $codigo = '';
            if ($servicio['Tipo'] == 'BELLEZA') {
                $sql = "SELECT MAX(CAST(SUBSTR(Codigo, 5) AS UNSIGNED)) + 1 AS SIGUIENTE FROM $this->table WHERE SUBSTR(Codigo, 1, 4) = 'SVBE'";
                $statement = $this->conexion->query($sql);
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $Codigo = 'SVBE' . str_pad($result['SIGUIENTE'], 3, '0', STR_PAD_LEFT);
            } elseif ($servicio['Tipo'] == 'NUTRICION') {
                $sql = "SELECT MAX(CAST(SUBSTR(Codigo, 6) AS UNSIGNED)) + 1 AS SIGUIENTE FROM $this->table WHERE SUBSTR(Codigo, 1, 5) = 'SVNUT'";
                $statement = $this->conexion->query($sql);
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $Codigo = 'SVNUT' . str_pad($result['SIGUIENTE'], 3, '0', STR_PAD_LEFT);
            }

            $sql = "INSERT INTO $this->table (Codigo, Nombre, Descripcion, Precio) VALUES (:Codigo, :Nombre, :Descripcion, :Precio)";
            $s = $this->conexion->prepare($sql);
            $s->bindParam(':Codigo', $Codigo);
            $s->bindParam(':Nombre', $servicio['Nombre']);
            $s->bindParam(':Precio', $servicio['Precio']);
            $s->bindParam(':Descripcion', $servicio['Descripcion']);
            $s->execute();

            return "Servicio insertado con Código: " . $Codigo;
        } catch (PDOException $e) {
            return "Error al insertar.<br>" . $e->getMessage();
        }
    }

}
?>