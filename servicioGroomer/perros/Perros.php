<?php

    class Perros extends Basedatos{
        private $table;
        private $conexion;

        public function __construct(){
            $this->table = "Perros";
            $this->conexion = $this->getConexion();
        }


        public function getAllPerros()
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
            return "Error al cargar todos los perros.<br>" . $e->getMessage();
        }
    }

        public function getUnPerro($Dni_duenio){
            $objetosdep = array();
            try{
                $sql = "select * from $this->table where Dni_duenio = $Dni_duenio";
                $statement = $this->conexion->query($sql);
                $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
                $statement = null;

                return $registros;
            }catch(PDOException $e){
                return "ERROR AL CARGAR.<br>".$e->getMessage();
            }
        }

        public function borrarPerros($Numero_Chip){
            try{
                $sql = "delete from $this->table where Numero_Chip= $Numero_Chip";
                $s = $this->conexion->prepare($sql);
                $s->bindParam(1, $Numero_Chip);
                $num = $s->execute();
                if($s->rowCount() == 0)
                    return "Perro no borrado o no encontrado: ".$Numero_Chip;
                else
                    return "Perro Borrado: ".$Numero_Chip;
            }catch(PDOException $e){
                return "Error al borrar perro.<br>".$e->getMessage();
            }
        }


        public function insertarNuevoPerro($perro){
            try{
            $sql = "insert into $this->table (Dni_duenio, Nombre, Fecha_Nto, Raza, Peso, Altura, Observaciones, Numero_Chip, Sexo) values (?,?,?,?,?,?,?)";
            $s = $this->conexion->prepare($sql);
            $s->bindParam(1, $perro->Dni_duenio);
            $s->bindParam(2, $perro->Nombre);
            $s->bindParam(3, $perro->Fecha_Nto);
            $s->bindParam(3, $perro->Raza);
            $s->bindParam(3, $perro->Peso);
            $s->bindParam(3, $perro->Altura);
            $s->bindParam(4, $perro->Observaciones);
            $s->bindParam(5, $perro->Numero_Chip);
            $s->bindParam(6, $perro->Sexo);
            $num = $s->execute();
            if($s->rowCount() == 0)
                return "Perro no insertado.";
            else
                return "Registro insertado.";
            }catch(PDOException $e){
            return "Error al insertar perro.<br>".$e->getMessage();
            }
        }


    }
?>