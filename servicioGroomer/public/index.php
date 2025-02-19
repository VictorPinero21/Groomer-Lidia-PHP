<?php
header("Content-Type: application/json");

require_once __DIR__ . '/../routes/routes.php';

$request_uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$request_method = $_SERVER["REQUEST_METHOD"];

if (isset($routes[$request_method])) {
    [$handler, $params] = matchRoute($routes[$request_method], $request_uri);
    if ($handler) {
        call_user_func_array($handler, $params);
    } else {
        http_response_code(404);
        echo json_encode(["error" => "Ruta no encontrada"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
}
?>