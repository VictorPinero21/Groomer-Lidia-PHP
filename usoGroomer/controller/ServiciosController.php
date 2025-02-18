<?php

class ServiciosController{

    private $Servicio;

    public function __construct() {
        $this->Servicio = new Servicios();
    }


    public function index(){
        $datos = $this->Servicio->getAll();
        //$this->view("index", $datos);
    }   

    public function borrar(){
        if(isset($_GET["Codigo"])){
            $cod = (int)$_GET["Codigo"];
            $query = $this->Servicio->borrarServicios($cod);
            if($query > 1){
                $dat = array("datos" => "SERVICIO BORRADO: " . $cod);
                //$this->view("mensajes", $dat);
            }else{
                $dat = array("datos" => "SERVICIO NO BORRADO, REVISA DATOS. " . $query);
                //$this->view("mensajes", $dat);
            }
        }else{
            $dat = array("datos" => "No hay DATOS en ese servicio ");
            //$this->view("mensajes", $dat);
        }
    }

    public function modificar(){
        if(isset($_POST["Codigo"])){
            $cod = $_POST["Codigo"];
            $precio = $_POST["Precio"];
            $query = $this->Servicio->modificarPrecioServicios($cod, $precio);
            if($query > 1){
                $dat = array("datos" => "SERVICIO MODIFICADO: " . $cod);
                //$this->view("mensajes", $dat);
            }else{
                $dat = array("datos" => "SERVICIO NO MODIFICADO, REVISA DATOS. " . $query);
                //$this->view("mensajes", $dat);
            }
        }else{
            $dat = array("datos" => "No hay DATOS en ese servicio ");
            //$this->view("mensajes", $dat);
        }
    }


    public function crear(){
        if(isset($_POST["Codigo"])){
            $cod = $_POST["Codigo"];
            $nom = $_POST["Nombre"];
            $pre = $_POST["Precio"];
            $save = $this->Servicio->save($cod, $nom, $pre);
            if($save > 0){
                $dat = array("datos" => "SERVICIO INSERTADO: " . $save);
                //$this->view("mensajes", $dat);
            }else{
                $dat = array("datos" => "SERVICIO NO INSERTADO, REVISA DATOS " . $save);
                //$this->view("mensajes", $dat);
            }
        }else{
            $dat = array("datos" => "No hay DATOS en Codigo ");
            //$this->view("mensajes", $dat);
        }
    }


    public function insertar(){
        //$this->view("insertarservicio", array("datos" => "Voy a abrir insertar"));
    }

}