<?php
class Clientes extends Basedatos {

    private $table;
    private $conexion;

    public function __construct() {
        $this->table = "CLIENTES";
        $this->conexion = $this->getConexion();
    }

    public function getAll() {
        $objetosdep = array();
        try {
            $sql = "select * from $this->table";
            $statement = $this->conexion->query($sql);
            $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement = null;
            // Retorna el array de registros
            return $registros;
        } catch (PDOException $e) {
            return "ERROR AL CARGAR.<br>" . $e->getMessage();
        }
    }

    public function getunCliente($id) {
        try {
            $sql = "SELECT * FROM $this->table WHERE IDCLIENTE=?";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(1, $id);
            $sentencia->execute();
            $row = $sentencia->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $row;
            }
            return "SIN DATOS";
        } catch (PDOException $e) {
            return "ERROR AL CARGAR.<br>" . $e->getMessage();
        }
    }

}

?>
