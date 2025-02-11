<?php
//FUNCIONES PARA EL CONTROLADOR FRONTAL
//Carga un controlador u otro en funcion de lo que se pase por la URL. Le pasamos "Tareas", busca si existe TareasController y hace un new TareasController
function cargarControlador($controller)
{

    $controlador = ucwords($controller) . 'Controller';
    $strFileController = 'controller/' . $controlador . '.php';

    if (!is_file($strFileController)) {
        $strFileController = 'controller/' . CONTROLADOR_DEFECTO . 'Controller.php';
        $controlador = CONTROLADOR_DEFECTO . 'Controller';
    }
    //Incluye el ficheroy lo devuelve
    require_once $strFileController;
    $controllerObj = new $controlador();
    return $controllerObj;
}

//la acción es el nombre del método que quiero ejecutar
function cargarAccion($controllerObj, $action)
{

    $accion = $action;
    $controllerObj->$accion();
}

//comprueba si existe antes del método cargarAcción
function lanzarAccion($controllerObj)
{

    if (isset($_GET["action"]) && method_exists($controllerObj, $_GET["action"])) {
        cargarAccion($controllerObj, $_GET["action"]);
    } else {
        cargarAccion($controllerObj, ACCION_DEFECTO);
    }
}
