<?php
require_once __DIR__ . '/../controllers/ClienteController.php';

$clienteController = new ClienteController();

$routes = [
    "POST" => [
        "/api/clientes" => [$clienteController, "insertarCliente"]
    ],
    "DELETE" => [
        "/api/clientes/{dni}" => [$clienteController, "borrarCliente"]
    ],
    "GET" => [
        "/api/clientes" => [$clienteController,"getAllClientes"]
    ]
];

function matchRoute($routes, $request_uri) {
    foreach ($routes as $route => $handler) {
        $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $route);
        if (preg_match("#^$pattern$#", $request_uri, $matches)) {
            array_shift($matches);
            return [$handler, $matches];
        }
    }
    return [null, []];
}
?>
