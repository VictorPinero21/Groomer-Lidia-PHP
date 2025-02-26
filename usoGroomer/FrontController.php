<?php
// Define las constantes para los controladores y las acciones predeterminadas
define('CONTROLADOR_DEFECTO', 'HomeUso');
define('ACCION_DEFECTO', 'showHome');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// redirige a la lista de libros
if (!isset($_GET['controller']) || !isset($_GET['action'])) {
    header('Location: index.php?controller=homeUso&action=showHome');
    exit();
}
if ($_GET['controller'] == 'UsersController') header('Location: ./index.php');

// Obtén el controlador y la acción desde los parámetros de la URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : CONTROLADOR_DEFECTO;
$action = isset($_GET['action']) ? $_GET['action'] : ACCION_DEFECTO;
// $dni = isset($_GET['dni']);

// Determina la ruta del controlador
$controllerFile = __DIR__ . '/usoApi/' . $controller . '.php';
    
// Verifica si el controlador existe
if (file_exists($controllerFile)) {
    require_once $controllerFile;

    // Crea una instancia del controlador
    $controllerObj = new $controller();

    // Verifica si la acción existe en el controlador
    if (method_exists($controllerObj, $action)) {
        // if ($dni !== null) {
        //     //Si se pasó un DNI, llamamos a la acción con él
        //     $controllerObj->$action($dni);
        // } else {
            //Si no hay DNI, llama a la acción sin parámetros
            $controllerObj->$action();
        // }
    } else {
        // Acción no encontrada, muestra un error
        echo "La acción '$action' no existe en el controlador '$controller'.";
    }
} else {
    // Controlador no encontrado, muestra un error
    echo "El controlador '$controller' no existe.";
}
