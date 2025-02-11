<?php

class ControladorBase
{

    public function __construct()
    {
        require_once "Conexion.php";
        //Incluir todos los modelos
        foreach (glob("modelo/*.php") as $file) {
            require_once $file;
        }
    }

    public function url($controlador = CONTROLADOR_DEFECTO, $accion = ACCION_DEFECTO)
    {
        $urlString = "index.php?controller=" . $controlador . "&action=" . $accion;
        return $urlString;
    }

    public function view($vista, $data)
    {
        //$dat = array("datos" => "Abro index.php ", "datos1" => "dato1" );
        foreach ($data as $id_assoc => $value) {
            $$id_assoc = $value; //esto te crea una variable por cada posición del array, la variable se llama como la clave y se iguala al valor. Ejmeplo, "nombre" => "Lidia" te crea $nombre=lidia
        }
        require_once 'vista/comun/cabecera.php';
        require_once 'vista/' . $vista . 'View.php';
        require_once 'vista/comun/pie.php';
    }

    public function redirect($controlador = CONTROLADOR_DEFECTO, $accion = ACCION_DEFECTO)
    {
        header("Location:index.php?controller=" . $controlador . "&action=" . $accion);
    }
}
