<?php
require_once __DIR__ . '/../controllers/ClienteController.php';
require_once __DIR__ . '/../controllers/EmpleadoController.php';
require_once __DIR__ . '/../controllers/PerroController.php';
require_once __DIR__ . '/../controllers/PerroServicioController.php';
require_once __DIR__ . '/../controllers/ServicioController.php';

$clienteController = new ClienteController();
$empleadoController = new EmpleadoController();
$perroController = new PerroController();
$perroServicioController = new PerroServicioController();
$servicioController = new ServicioController();

$routes = [
    "POST" => [
        "/api/clientes/" => [$clienteController, "insertarCliente"],
        "/api/clientes/{dni}" => [$clienteController, "modificarCliente"],
        "/api/empleados/" => [$empleadoController, "insertarEmpleado"],
        "/api/empleados/{dni}" => [$empleadoController, "actualizarEmpleado"],
        "/api/perros/" => [$perroController, "insertarPerro"],
        "/api/perros/{id}" => [$perroController, "actualizarPerro"],
        "/api/perroservicios/" => [$perroServicioController, "insertarPerroConServicio"],
        "/api/perroservicios/{id}" => [$perroServicioController, "actualizarPerroConServicio"],
        "/api/servicios/" => [$servicioController, "insertarServicio"],
        "/api/servicios/{id}" => [$servicioController, "modificarPrecioServicios"],
    ],
    "PUT" => [
        "/api/clientes/{dni}" => [$clienteController, "modificarCliente"],
        "/api/empleados/{dni}" => [$empleadoController, "actualizarEmpleado"],
        "/api/perros/{id}" => [$perroController, "actualizarPerro"],
        "/api/perroservicios/{id}" => [$perroServicioController, "actualizarPerroConServicio"],
        "/api/servicios/{id}" => [$servicioController, "modificarPrecioServicios"]
    ],
    "DELETE" => [
        "/api/clientes/{dni}" => [$clienteController, "borrarCliente"],
        "/api/empleados/{dni}" => [$empleadoController, "borrarEmpleado"],
        "/api/perros/{id}" => [$perroController, "borrarPerro"],
        "/api/perroservicios/{id}" => [$perroServicioController, "borrarPerroConServicio"],
        "/api/servicios/{id}" => [$servicioController, "borrarServicios"]
    ],
    "GET" => [
        "/api/clientes" => [$clienteController, "getAllClientes"],
        "/api/clientes/{dni}" => [$clienteController, "getUnCliente"],
        "/api/empleados/" => [$empleadoController, "getAllEmpleados"],
        "/api/empleados/{dni}" => [$empleadoController, "getUnEmpleado"],
        "/api/perros/" => [$perroController, "getAllPerros"],
        "/api/perros/{id}" => [$perroController, "getUnPerro"],
        "/api/perroservicios/" => [$perroServicioController, "getAllPerrosConServicios"],
        "/api/perroservicios/{id}" => [$perroServicioController, "getUnPerroConServicio"],
        "/api/servicios/" => [$servicioController, "getAllServicios"],
        "/api/servicios/{id}" => [$servicioController, "getUnServicio"],
    ],

];

function matchRoute($routes, $request_uri)
{
    foreach ($routes as $route => $handler) {
        $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $route);
        if (preg_match("#^$pattern$#", $request_uri, $matches)) {
            array_shift($matches);
            return [$handler, $matches];
        }
    }
    return [null, []];
}
