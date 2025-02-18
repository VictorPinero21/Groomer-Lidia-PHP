<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "groomer"; // Cambia esto por el nombre real de tu BD

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Array de empleados a insertar
$empleados = [
    ['7777777Z', 'admin@gromer.com', 'admin123', 'ADMIN', 'Pedro', 'Pedro', 'Pe', 'Calle San Francisco', 15, '45600', 'Talavera de la Reina', 'Toledo', '600112233', 'ADMIN'],
    ['12345678A', 'ana.popescu@gromer.com', 'aux123', 'AUXILIAR', 'Ana', 'Popescu', 'Dragomir', 'Calle San Francisco', 15, '45600', 'Talavera de la Reina', 'Toledo', '600112233', 'AUXILIAR'],
    ['56789012A', 'antonio.garcia@gromer.com', 'aux456', 'AUXILIAR', 'Antonio', 'García', 'López', 'Calle Mayor', 20, '45600', 'Talavera de la Reina', 'Toledo', '600112233', 'ATT.CLIENTE'],
    ['45678901A', 'giulia.rossi@gromer.com', 'nut123', 'EMPLEADO', 'Giulia', 'Rossi', 'Conti', 'Camino de Illescas', 15, '45200', 'Illescas', 'Toledo', '600445566', 'NUTRICIONISTA'],
    ['89012345C', 'carlota.romero@gromer.com', 'nut123', 'EMPLEADO', 'Carlota', 'Romero', 'Corinto', 'Calle del Camping', 20, '45683', 'Cazalegas', 'Toledo', '600445566', 'NUTRICIONISTA'],
    ['23456789B', 'maria.garcia@gromer.com', 'est123', 'EMPLEADO', 'María', 'García', 'López', 'Calle Mayor', 10, '45600', 'Talavera de la Reina', 'Toledo', '600223344', 'ESTILISTA'],
    ['34567890C', 'juan.martinez@gromer.com', 'est123', 'EMPLEADO', 'Juan', 'Martínez', 'Fernández', 'Calle Real', 5, '45890', 'Cebolla', 'Toledo', '600334455', 'ESTILISTA'],
    ['67890123B', 'maria.martinez@gromer.com', 'est123', 'EMPLEADO', 'María', 'Martínez', 'Fernández', 'Calle del Castillo', 10, '45560', 'Oropesa', 'Toledo', '600223344', 'ESTILISTA'],
    ['78901234C', 'ana.gonzalez@gromer.com', 'est123', 'EMPLEADO', 'Ana', 'González', 'Ruiz', 'Calle del Sol', 5, '45600', 'Talavera de la Reina', 'Toledo', '600334455', 'ESTILISTA']
];

$sql = "INSERT INTO empleados (Dni, Email, Password, Rol, Nombre, Apellido1, Apellido2, Calle, Numero, Cp, Poblacion, Provincia, Tlfno, Profesion) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Insertar empleados
foreach ($empleados as $emp) {
    $hashed_password = password_hash($emp[2], PASSWORD_DEFAULT);
    $stmt->bind_param("ssssssssisisss", ...array_merge(array_slice($emp, 0, 2), [$hashed_password], array_slice($emp, 3)));
    $stmt->execute();
}

echo "Empleados insertados correctamente.";

// Cerrar conexión
$stmt->close();
$conn->close();
