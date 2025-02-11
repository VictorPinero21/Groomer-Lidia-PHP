<?php

class DepartamentoModel extends Basedatos {

    private $table;
    private $conexion;

    public function __construct() {
        $this->table = "departamentos";
        $this->conexion = $this->getConexion();
    }

    public function save($depno, $nom, $loc) {

        try {
            $sql = "insert into departamentos values ( ?,?,?)";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(1, $depno);
            $sentencia->bindParam(2, $nom);
            $sentencia->bindParam(3, $loc);
            $num = $sentencia->execute();
            return $num; //true-false
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    //Devuelve un objeto departamento
    public function getUnDepartamento($nudep) {
        try {
            $sql = "SELECT * FROM departamentos WHERE dept_no=?";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(1, $nudep);
            $sentencia->execute();
            $row = $sentencia->fetch();
            if ($row) {
                $depa = new Departamentos($row['dept_no'], $row['dnombre'], $row['loc']);
                return $depa;
            }
            return null;
        } catch (PDOException $e) {
            return "ERROR AL CARGAR .<br>" . $e->getMessage();
        }
    }

    public function getAll() {
        if ($this->conexion) {
            $objetosdep = array();
            try {
                $sql = "select * from $this->table";
                $statement = $this->conexion->query($sql);
                $registros = $statement->fetchAll();
                $statement = null;
                //Retorna array de objetos departamento
                foreach ($registros as $row) {
                    array_push($objetosdep, new Departamentos($row['dept_no'], $row['dnombre'], $row['loc']));
                }

                return $objetosdep;
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        } else {
            return $this->getMensajeError();
        }
    }

    public function borrar($depno) {

        try {
            $sql = "delete from departamentos where dept_no= ? ";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(1, $depno);
            $num = $sentencia->execute();
            if($sentencia->rowCount() == 1){
                 return $depno;
            }
            return "NO EXISTE EL COD A BORRAR: ".$depno;
            $sentencia = null;
 
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

}

?>