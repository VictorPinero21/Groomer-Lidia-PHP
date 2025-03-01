<?php
define('CONTROLADOR', 'homeApi');
define('ACCION', 'showHome');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_GET['controller']) || !isset($_GET['action'])) {
    header('Location: home.php?controller=homeApi&action=showHome');
    exit();
}
if ($_GET['controller'] == 'UsersController') header('Location: ./home.php');

$controller = isset($_GET['controller']) ? $_GET['controller'] : CONTROLADOR;
$action = isset($_GET['action']) ? $_GET['action'] : ACCION;

$controllerFile = __DIR__ . '/ApiController/' . $controller . '.php';
    
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerObj = new $controller();
    if (method_exists($controllerObj, $action)) {
            $controllerObj->$action();
    } else {
        echo "La acción '$action' no existe en el controlador '$controller'.";
    }
} else {
    echo "El controlador '$controller' no existe.";
}
