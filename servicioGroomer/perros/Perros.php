<?php
require_once './../Basedatos.php';
class Perros extends Basedatos
{
    private $table;
    private $conexion;

    public function __construct()
    {
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

    public function getUnPerro($Dni_duenio)
    {
        $objetosdep = array();
        try {
            $sql = "select * from $this->table where Dni_duenio = $Dni_duenio";
            $statement = $this->conexion->query($sql);
            $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement = null;

            return $registros;
        } catch (PDOException $e) {
            return "ERROR AL CARGAR.<br>" . $e->getMessage();
        }
    }

    public function borrarPerro($Numero_Chip)
    {
        try {
            $sql = "delete from $this->table where Numero_Chip= $Numero_Chip";
            $s = $this->conexion->prepare($sql);
            $s->bindParam(1, $Numero_Chip);
            $num = $s->execute();
            if ($s->rowCount() == 0)
                return "Perro no borrado o no encontrado: " . $Numero_Chip;
            else
                return "Perro Borrado: " . $Numero_Chip;
        } catch (PDOException $e) {
            return "Error al borrar perro.<br>" . $e->getMessage();
        }
    }


    public function insertarPerro($post)
    {
        try {
            // Verificación de que el ID_Perro ya exista en la base de datos
            $sqlVerificar = "SELECT COUNT(*) FROM $this->table WHERE ID_Perro = ?";
            $sentenciaVerificar = $this->conexion->prepare($sqlVerificar);
            $sentenciaVerificar->bindParam(1, $post['ID_Perro']);
            $sentenciaVerificar->execute();
            $existe = $sentenciaVerificar->fetchColumn();

            if ($existe > 0) {
                return "Error en la inserción: el perro ya está dado de alta";
            }

            // Verificación de que el Dni_duenio exista en la tabla clientes
            $sqlVerificarDni = "SELECT COUNT(*) FROM Clientes WHERE Dni = ?";
            $sentenciaVerificarDni = $this->conexion->prepare($sqlVerificarDni);
            $sentenciaVerificarDni->bindParam(1, $post['Dni_duenio']);
            $sentenciaVerificarDni->execute();
            $existeDni = $sentenciaVerificarDni->fetchColumn();

            if ($existeDni == 0) {
                return "Error en la inserción: el dueño no está dado de alta en la tabla clientes";
            }


            $sql = "insert into $this->table (Dni_duenio, Nombre, Fecha_Nto, Raza, Peso, Altura, Observaciones, Numero_Chip, Sexo) values (?,?,?,?,?,?,?,?,?)";
            $s = $this->conexion->prepare($sql);
            $s->bindParam(1, $post['Dni_duenio']);
            $s->bindParam(2, $post['Nombre']);
            $s->bindParam(3, $post['Fecha_Nto']);
            $s->bindParam(4, $post['Raza']);
            $s->bindParam(5, $post['Peso']);
            $s->bindParam(6, $post['Altura']);
            $s->bindParam(7, $post['Observaciones']);
            $s->bindParam(8, $post['Numero_Chip']);
            $s->bindParam(9, $post['Sexo']);
            $s->execute();

            return "Perro CHIP: " . $post['Numero_Chip'] . " insertado correctamente";
        } catch (PDOException $e) {
            return "Error al insertar el perro. Faltan datos. <br>" . $e->getMessage();
        }
    }

    public function actualizarPerro($post)
    {
        try {
            $sql = "update $this->table set Dni_duenio=?, Nombre=?, Fecha_Nto=?, Raza=?, Peso=?, Altura=?, Observaciones=?, Numero_Chip=?, Sexo=? where ID_Perro = ?";
            $sentencia = $this->conexion->prepare($sql);
            // extraemos los parámetros de la variable $post
            // suponemos que se llaman igual
            $sentencia->bindParam(1, $post['Dni_duenio']);
            $sentencia->bindParam(2, $post['Nombre']);
            $sentencia->bindParam(3, $post['Fecha_Nto']);
            $sentencia->bindParam(4, $post['Raza']);
            $sentencia->bindParam(5, $post['Peso']);
            $sentencia->bindParam(6, $post['Altura']);
            $sentencia->bindParam(7, $post['Observaciones']);
            $sentencia->bindParam(8, $post['Numero_Chip']);
            $sentencia->bindParam(9, $post['Sexo']);
            $sentencia->bindParam(10, $post['ID_Perro']);
            $num = $sentencia->execute();
            if ($sentencia->rowCount() == 0)
                return "Perro NO actualizado, o no existe el perro o no hay cambios: " . $post['ID_Perro'];
            else
                return "Perro actualizado: " . $post['ID_Perro'];
        } catch (PDOException $e) {
            return "Error al actualizar.<br>" . $e->getMessage();
        }
    }
}
