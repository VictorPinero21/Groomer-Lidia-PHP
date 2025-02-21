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
            if (empty($servicio['Nombre']) || empty($servicio['Precio']) || empty($servicio['Descripcion']) || empty($servicio['Tipo'])) {
                return "Faltan datos";
            }

            $Codigo = '';
            if ($servicio['Tipo'] == 'BELLEZA') {
                $sql = "SELECT IFNULL(MAX(CAST(SUBSTR(Codigo, 5) AS UNSIGNED)), 0) + 1 AS SIGUIENTE FROM $this->table WHERE Codigo LIKE 'SVBE%'";
                $statement = $this->conn->query($sql);
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $Codigo = 'SVBE' . $result['SIGUIENTE'];
            } elseif ($servicio['Tipo'] == 'NUTRICION') {
                $sql = "SELECT IFNULL(MAX(CAST(SUBSTR(Codigo, 6) AS UNSIGNED)), 0) + 1 AS SIGUIENTE FROM $this->table WHERE Codigo LIKE 'SVNUT%'";
                $statement = $this->conn->query($sql);
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                $Codigo = 'SVNUT' . $result['SIGUIENTE'];
            } else {
                return "Tipo de servicio inválido";
            }

            $sql = "INSERT INTO $this->table (Codigo, Nombre, Descripcion, Precio) VALUES (:Codigo, :Nombre, :Descripcion, :Precio)";
            $s = $this->conn->prepare($sql);
            $s->bindParam(':Codigo', $Codigo);
            $s->bindParam(':Nombre', $servicio['Nombre']);
            $s->bindParam(':Descripcion', $servicio['Descripcion']);
            $s->bindParam(':Precio', $servicio['Precio']);
            $s->execute();

            if ($s->rowCount() > 0) {
                return "Servicio CODIGO: $Codigo insertado correctamente";
            } else {
                return "Error al insertar. La fila no se ha insertado.";
            }
        } catch (PDOException $e) {
            return "Error al insertar.<br>" . $e->getMessage();
        }
    }
}
