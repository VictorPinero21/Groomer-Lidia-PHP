<?php
session_start();

// Verifica si la sesión ya está activa
if (isset($_SESSION['user'])) {
    header('Location: ./views/home.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        // URL de la API para obtener todos los empleados
        $api_url = 'http://localhost:8000/api/empleados/';
        
        // Realizar petición GET a la API
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            $error = "Error al conectar con la API";
        } else {
            $empleados = json_decode($response, true);

            if (!is_array($empleados)) {
                $error = "Error en la respuesta de la API";
            } else {
                foreach ($empleados as $empleado) {
                    if ($empleado['Email'] === $email && password_verify($password, $empleado['Password'])) {
                        $_SESSION['user'] = [
                            'dni' => $empleado['Dni'],
                            'nombre' => $empleado['Nombre'],
                            'apellido1' => $empleado['Apellido1'],
                            'apellido2' => $empleado['Apellido2'],
                            'rol' => $empleado['Rol']
                        ];
                        
                        header("Location: ./views/home.php");
                        exit();
                    }
                }
                $error = "Correo o contraseña incorrectos";
            }
        }
    } else {
        $error = "Por favor, completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Iniciar Sesión</h1>
        
        <?php if (isset($error)) : ?>
            <p class="text-red-500 text-center"><?php echo $error; ?></p>
        <?php endif; ?>
        
        <form action="index.php" method="POST" class="space-y-4">
            <input type="email" name="email" placeholder="Correo electrónico" required class="w-full p-2 border rounded">
            <input type="password" name="password" placeholder="Contraseña" required class="w-full p-2 border rounded">
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600">Ingresar</button>
        </form>
    </div>
</body>
</html>
