<?php 
session_start();
if(isset($_SESSION['user'])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.10.2/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
 
</head>

<body class="">
<header class="sticky top-0 left-0 w-full bg-white shadow-md z-50 py-4">
        <nav class="container mx-auto flex items-center justify-between px-6">
            <div class="flex items-center gap-4">
                <a href="home.php?controller=homeUso&action=showHome"><img src="../assets/groomer.webp" alt="Logo" class="h-16 w-16 rounded-full shadow-md"></a>
                <span class="text-2xl font-bold text-gray-700"><a href="home.php?controller=homeUso&action=showHome">RiberaPets</a></span>
            </div>
            <div class="hidden md:flex gap-4">
                <a href="home.php?controller=perroRecibeServicioUso&action=mostrarServiciosPorPerros" class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md transition-all hover:bg-blue-600 hover:scale-105">
                    Perros
                </a>
                <a href="home.php?controller=serviciosUso&action=showServicios" class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md transition-all hover:bg-blue-600 hover:scale-105">
                    Servicios
                </a>
                <a href="home.php?controller=empleadosUso&action=showEmpleados" class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md transition-all hover:bg-blue-600 hover:scale-105">
                    Empleados
                </a>
                <form id="clientesForm" action="./home.php?controller=clientesUso&action=showClientes" method="post" class="inline">
                    <input type="hidden" name="dniInfo" value="">
                    <button type="submit" class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md transition-all hover:bg-blue-600 hover:scale-105">
                        Clientes
                    </button>
                </form>
                <a href="logout.php" class="px-6 py-3 bg-red-500 text-white font-semibold rounded-lg shadow-md transition-all hover:bg-red-600 hover:scale-105">
                    LogOut
                </a>
            </div>
            <!-- Mobile Menu Button -->
            <button @click="menuOpen = !menuOpen" class="md:hidden px-4 py-3 bg-blue-500 text-white rounded-lg shadow-md hover:bg-gray-600" x-data="{ menuOpen: true }">
                ☰
            </button>
        </nav>
        <!-- Mobile Menu -->
        <div x-show="menuOpen" class="md:hidden flex flex-col items-center gap-4 bg-white shadow-md py-4" x-data="{ menuOpen: false }">
            <a href="home.php?controller=perroRecibeServicioUso&action=mostrarServiciosPorPerros" class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600">
                Perros
            </a>
            <a href="home.php?controller=serviciosUso&action=showServicios" class="px-6 py-3 bg-grey-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600">
                Servicios
            </a>
            <a href="home.php?controller=empleadosUso&action=showEmpleados" class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600">
                Empleados
            </a>
            <form id="clientesForm" action="./home.php?controller=clientesUso&action=showClientes" method="post" class="inline">
                <input type="hidden" name="dniInfo" value="">
                <button type="submit" class="px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600">
                    Clientes
                </button>
            </form>
        </div>
    </header>

    <div class="container mx-auto text-center">
        <?php
        // Incluye el front controller
        require_once __DIR__ . '../../FrontController.php';
        ?>
    </div>

</body>

</html>

<?php 
} else {
    header('Location: ../index.php');
}
?>