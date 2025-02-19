<?php
require_once __DIR__ . '/../controllers/ClienteController.php';
require_once __DIR__ . '/../controllers/PerroController.php';
require_once __DIR__ . '/../controllers/EmpleadoController.php';
require_once __DIR__ . '/../controllers/ServicioController.php';
require_once __DIR__ . '/../controllers/PerroServicioController.php';

// Instancias de los controladores
$clienteController = new ClienteController();
$perroController = new PerroController();
$empleadoController = new EmpleadoController();
$servicioController = new ServicioController();
$perroServicioController = new PerroServicioController();

$requestMethod = $_SERVER['REQUEST_METHOD'];
$path = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

// Verifica si la API está en una carpeta (ejemplo: api/)
$baseIndex = array_search('api', $path);
$resource = isset($path[$baseIndex + 1]) ? $path[$baseIndex + 1] : null;
$id = isset($path[$baseIndex + 2]) ? $path[$baseIndex + 2] : null;

// Función para manejar rutas
function handleRequest($controller) {
    global $requestMethod, $id;
    switch ($requestMethod) {
        case 'GET':
            if ($id) {
                $controller->getById($id);
            } else {
                $controller->getAll();
            }
            break;
        case 'POST':
            $data = json_decode(file_get_contents("php://input"), true);
            $controller->create($data);
            break;
        case 'PUT':
            if ($id) {
                $data = json_decode(file_get_contents("php://input"), true);
                $controller->update($id, $data);
            }
            break;
        case 'DELETE':
            if ($id) {
                $controller->delete($id);
            }
            break;
        default:
            echo json_encode(["error" => "Método no permitido"]);
            break;
    }
}

// Enrutamiento general
switch ($resource) {
    case 'clientes':
        handleRequest($clienteController);
        break;
    case 'perros':
        handleRequest($perroController);
        break;
    case 'empleados':
        handleRequest($empleadoController);
        break;
    case 'servicios':
        handleRequest($servicioController);
        break;
    case 'perro_servicio':
        handleRequest($perroServicioController);
        break;
    default:
        echo json_encode(["error" => "Ruta no encontrada"]);
        break;
}
