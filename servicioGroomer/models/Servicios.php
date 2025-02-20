<?php
require_once __DIR__ . '/../config/Basedatos.php';

class Servicios
{
    private $conn;
    private $table = "servicios";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    public function getAllServicios()
    {
        try {
            $sql = "SELECT * FROM $this->table";
            $statement = $this->conn->query($sql);
            $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $registros;
        } catch (PDOException $e) {
            return "ERROR AL CARGAR.<br>" . $e->getMessage();
        }
    }

    public function getUnServicio($Codigo)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE Codigo = :Codigo";
            $statement = $this->conn->prepare($sql);
            $statement->bindParam(':Codigo', $Codigo);
            $statement->execute();
            $registros = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $registros;
        } catch (PDOException $e) {
            return "ERROR AL CARGAR.<br>" . $e->getMessage();
        }
    }

    public function borrarServicios($Codigo)
    {
        try {
            $sql = "DELETE FROM $this->table WHERE Codigo = :Codigo";
            $s = $this->conn->prepare($sql);
            $s->bindParam(':Codigo', $Codigo);
            $s->execute();

            if ($s->rowCount() == 0) {
                return "Registro no borrado o no localizado: " . $Codigo;
            } else {
                return "Registro Borrado: " . $Codigo;
            }
        } catch (PDOException $e) {
            return "Error al borrar.<br>" . $e->getMessage();
        }
    }

    public function modificarPrecioServicios($Codigo, $Precio)
    {
        try {
            $sql = "UPDATE $this->table SET Precio = :Precio WHERE Codigo = :Codigo";
            $s = $this->conn->prepare($sql);
            $s->bindParam(':Precio', $Precio);
            $s->bindParam(':Codigo', $Codigo);
            $s->execute();

            if ($s->rowCount() == 0) {
                return "Registro NO actualizado, o no existe o no hay cambios: " . $Codigo;
            } else {
                return "Registro actualizado: " . $Codigo;
            }
        } catch (PDOException $e) {
            return "Error al actualizar.<br>" . $e->getMessage();
        }
    }

    public function insertarServicio($servicio)
    {
        try {
            $codigo = '';
            if ($servicio['Tipo'] == 'BELLEZA') {
                $sql = "SELECT MAX(CAST(SUBSTR(Codigo, 5) AS UNSIGNED)) + 1 AS SIGUIENTE FROM $this->table WHERE SUBSTR(Codigo, 1, 4) = 'SVBE'";
                $statement = $this->conn->query($sql);
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $Codigo = 'SVBE' . str_pad($result['SIGUIENTE'], 3, '0', STR_PAD_LEFT);
            } elseif ($servicio['Tipo'] == 'NUTRICION') {
                $sql = "SELECT MAX(CAST(SUBSTR(Codigo, 6) AS UNSIGNED)) + 1 AS SIGUIENTE FROM $this->table WHERE SUBSTR(Codigo, 1, 5) = 'SVNUT'";
                $statement = $this->conn->query($sql);
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $Codigo = 'SVNUT' . str_pad($result['SIGUIENTE'], 3, '0', STR_PAD_LEFT);
            }

            $sql = "INSERT INTO $this->table (Codigo, Nombre, Descripcion, Precio) VALUES (:Codigo, :Nombre, :Descripcion, :Precio)";
            $s = $this->conn->prepare($sql);
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
