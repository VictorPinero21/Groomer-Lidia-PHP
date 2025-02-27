<!-- <?php
session_start();  // Inicia la sesión

// Verifica si la sesión ya está activa
if (isset($_SESSION['user'])) {
    header('Location: ../home');  // Si ya está logueado, redirige a home.php
    exit();
}

require_once "../Groomer-Lidia-PHP/servicioGroomer/config/Basedatos.php"; 

$pdo = (new Database())->connect(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $stmt = $pdo->prepare("SELECT * FROM empleados WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica si el usuario existe y la contraseña es correcta
        if ($user && $password === $user['Password']) {
            $_SESSION['user'] = $user['nombre'];  // Establece la sesión
            var_dump($_SESSION);
            header("Location: ../home.php");  // Redirige a home.php
            exit();
        } else {
            $error = "Correo o contraseña incorrectos";
        }
    } else {
        $error = "Por favor, completa todos los campos.";
    }
}


?> -->

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
