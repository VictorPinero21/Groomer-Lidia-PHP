<?php

class EmpleadosModel extends Basedatos {
    private $table;
    private $conexion;

    public function __construct() {
        $this->table = "empleados";
        $this->conexion = $this->getConexion();
    }
    
      public function getAll() {
        $objetos = array();
        try {
            $sql = "select * from $this->table";
            $statement = $this->conexion->query($sql);
            $registros = $statement->fetchAll();
            $statement = null;
            //Retorna array de objetos departamento
            foreach ($registros as $row) {              
                array_push($objetos, new Empleados($row['emp_no'], 
                        $row['apellido'], $row['oficio'],
                         $row['dir'], $row['fecha_alt'],
                         $row['salario'], $row['comision'],
                         $row['dept_no']));
            }

            return $objetos;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    
  public function   insertaemple($emp_no, $apellido, $oficio,
        $dir, $fecha_alt, $salario,$comision, $dept_no){
      
         try {
            $sql = "insert into $this->table values ( ?,?,?, ?,?,?,?,?)";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(1, $emp_no);
            $sentencia->bindParam(2, $apellido);
            $sentencia->bindParam(3, $oficio);
            $sentencia->bindParam(4, $dir);
            $sentencia->bindParam(5, $fecha_alt);
            $sentencia->bindParam(6, $salario);
            $sentencia->bindParam(7, $comision);
            $sentencia->bindParam(8, $dept_no);
            $num = $sentencia->execute();
            return $emp_no. " INSERTADO."; //true-false
        } catch (PDOException $e) {
            return $e->getMessage();
        }
      
  }
    
  
   public function borrar($id) {

        try {
            $sql = "delete from $this->table where emp_no= ? ";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(1, $id);
            $num = $sentencia->execute();
            if($sentencia->rowCount() == 1){
                 return $id;
            }
            return "NO EXISTE EL COD A BORRAR: ".$id;
            $sentencia = null;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
