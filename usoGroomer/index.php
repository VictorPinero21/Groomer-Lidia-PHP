<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.2/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class', // Esto permite que 'dark:' responda a la clase 'dark' en <html>
        };
    </script>
    <title>RiberaPets</title>
</head>

<body class="bg-gray-100 flex flex-col items-center justify-center h-screen">
<header class="fixed top-0 left-0 w-full bg-white shadow-md z-50">
    <nav class="p-4 rounded-lg flex flex-col items-center gap-4 md:flex-row md:justify-center">
        <a href="index.php?controller=perroRecibeServicioUso&action=mostrarServiciosPorPerros" class="w-64 text-center px-8 py-4 bg-green-500 text-white font-semibold rounded-lg shadow-md transition-all hover:bg-green-600 hover:scale-105">
            Perros
        </a>
        <a href="index.php?controller=serviciosUso&action=showServicios" class="w-64 text-center px-8 py-4 bg-blue-500 text-white font-semibold rounded-lg shadow-md transition-all hover:bg-blue-600 hover:scale-105">
            Servicios
        </a>
        <a href="index.php?controller=empleadosUso&action=showEmpleados" class="w-64 text-center px-8 py-4 bg-purple-500 text-white font-semibold rounded-lg shadow-md transition-all hover:bg-purple-600 hover:scale-105">
            Empleados
        </a>
        <form id="clientesForm" action="./index.php?controller=clientesUso&action=showClientes" method="post" style="display: inline;">
            <input type="hidden" name="dniInfo" value="">
            <a href="#" onclick="document.getElementById('clientesForm').submit();" class="w-64 text-center px-8 py-4 bg-red-500 text-white font-semibold rounded-lg shadow-md transition-all hover:bg-red-600 hover:scale-105">
                Clientes
            </a>
        </form>
    </nav>
</header>

    <div class="container mx-auto text-center">
        <?php
        // Incluye el front controller
        require_once __DIR__ . '/FrontController.php';
        ?>
    </div>

</body>

</html>