<?php

class Pedidos extends Basedatos {

    private $table;
    private $conexion;

    public function __construct() {
        $this->table = "PEDIDOSMENUS";
        $this->conexion = $this->getConexion();
    }

    // Recibe el array de los post
    public function insertar($post) {
        try {
            $sql = "insert into $this->table (IDPEDIDOMENU,IDCLIENTE, IDMENU,FECHAPEDIDO) values (?, ?,?,?)";
            $sentencia = $this->conexion->prepare($sql);
            // extraemos los parámetros de la variable post
            // suponemos que se llaman igual
            $sentencia->bindParam(1, $post['idpedidomenu']);
            $sentencia->bindParam(2, $post['idcliente']);
            $sentencia->bindParam(3, $post['idmenu']);
            $sentencia->bindParam(4, $post['fechapedido']);
            $num = $sentencia->execute();
            return "Registro insertado con id: " . $post['idpedidomenu'];
        } catch (PDOException $e) {
            return "Error al grabar.<br>" . $e->getMessage();
        }
    }

    // Devuelve un array departamento
    public function getunPedido($id) {
        try {
            $sql = "SELECT * FROM $this->table WHERE IDPEDIDOMENU=?";
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

    public function getPedidoClien($idcliente) {
        $objetosdep = array();
        try {
            $sql = "select * from $this->table where IDCLIENTE =? order by IDPEDIDOMENU ";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(1, $idcliente);
            $sentencia->execute();
            $registros = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            $todos = array();
            foreach ($registros as $fila) {
                //nombre de menú
                $sql2 = "SELECT * FROM MENUS WHERE IDMENU=?";
                $sentencia2 = $this->conexion->prepare($sql2);
                $sentencia2->bindParam(1, $fila['IDMENU']);
                $sentencia2->execute();
                $row2 = $sentencia2->fetch(PDO::FETCH_ASSOC);
                $unreg = array('IDPEDIDOMENU' => $fila['IDPEDIDOMENU'],
                    'IDCLIENTE' => $fila['IDCLIENTE'],
                    'IDMENU' => $fila['IDMENU'],
                    'FECHAPEDIDO' => $fila['FECHAPEDIDO'],
                    'NOMBREMENU' => $row2['NOMBRE'],
                    'PVP' => $row2['PVP']
                );
                $todos[] = $unreg;
            }
     
            return $todos;
        } catch (PDOException $e) {
            return "ERROR AL CARGAR.<br>" . $e->getMessage();
        }
    }

    public function borrar($id) {
        try {
            $sql = "delete from $this->table where IDPEDIDOMENU= ? ";
            $sentencia = $this->conexion->prepare($sql);
            $sentencia->bindParam(1, $id);
            $num = $sentencia->execute();
            if ($sentencia->rowCount() == 0)
                return "Registro NO Borrado, no se localiza: " . $id;
            else
                return "Registro Borrado: " . $id;
        } catch (PDOException $e) {
            return "ERROR AL BORRAR.<br>" . $e->getMessage();
        }
    }

}

?>
