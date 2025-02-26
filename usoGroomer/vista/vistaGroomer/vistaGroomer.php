
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación Cliente</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Aplicación Cliente</h1>
    
    <h2 class="text-2xl font-semibold text-gray-700 mb-4">Listar Servicios Realizados</h2>
    <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
        <tr class="bg-green-500 text-white">
            <th class="p-3">Fecha</th>
            <th class="p-3">Código Servicio</th>
            <th class="p-3">ID Perro</th>
            <th class="p-3">Nombre Empleado</th>
            <th class="p-3">Precio Final</th>
            <th class="p-3">Incidencia</th>
        </tr>
        <!-- <?php
        $sql = "SELECT sr.fecha, sr.codigo_servicio, sr.id_perro, e.nombre AS empleado, sr.precio_final, sr.incidencia 
                FROM perro_recibe_servicio sr 
                JOIN empleados e ON sr.dni_empleado = e.dni";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr class='border-b'>"
                    . "<td class='p-3'>{$row['fecha']}</td>"
                    . "<td class='p-3'>{$row['codigo_servicio']}</td>"
                    . "<td class='p-3'>{$row['id_perro']}</td>"
                    . "<td class='p-3'>{$row['empleado']}</td>"
                    . "<td class='p-3'>{$row['precio_final']}</td>"
                    . "<td class='p-3'>{$row['incidencia']}</td>"
                    . "</tr>";
            }
        }
        ?> -->
    </table>
</body>
</html>
