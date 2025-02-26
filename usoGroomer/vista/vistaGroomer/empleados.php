<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen p-4">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-2xl">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Lista de Empleados</h1>
        <div class="space-y-4">
                <div class="bg-gray-50 p-4 rounded-lg shadow flex justify-between items-center">
                    <span class="text-lg font-semibold"></span>
                    <div class="space-x-2">
                        <a href="?eliminar=" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Eliminar</a>
                    </div>
                </div>
        </div>
        <div class="mt-6 text-center">
            <button onclick="openModal()" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Insertar Empleado</button>
        </div>
    </div>

    <!-- Modal -->
<div id="modal" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-3xl">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4 text-center">Insertar Empleado</h2>
        <form action="insertar_empleado.php" method="post" onsubmit="return validarFormulario()">
            <div class="grid grid-cols-2 gap-4">
                <!-- Primera columna -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">DNI</label>
                    <input type="text" name="dni" id="dni" maxlength="9" minlength="9" required class="w-full p-2 border rounded" pattern="[0-9]{8}[A-Z]" title="Debe contener 8 números y una letra mayúscula">
                    
                    <label class="block text-sm font-medium text-gray-700 mt-2">Email</label>
                    <input type="email" name="email" id="email" maxlength="50" required class="w-full p-2 border rounded">
                    
                    <label class="block text-sm font-medium text-gray-700 mt-2">Password</label>
                    <input type="password" name="password" id="password" minlength="8" required class="w-full p-2 border rounded" title="Debe tener al menos 8 caracteres">
                    
                    <label class="block text-sm font-medium text-gray-700 mt-2">Rol</label>
                    <select name="rol" id="rol" class="w-full p-2 border rounded" required>
                        <option value="EMPLEADO">Empleado</option>
                        <option value="ADMIN">Admin</option>
                        <option value="AUXILIAR">Auxiliar</option>
                    </select>
                </div>

                <!-- Segunda columna -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="nombre" id="nombre" maxlength="20" required class="w-full p-2 border rounded">
                    
                    <label class="block text-sm font-medium text-gray-700 mt-2">Primer Apellido</label>
                    <input type="text" name="apellido1" id="apellido1" maxlength="15" required class="w-full p-2 border rounded">
                    
                    <label class="block text-sm font-medium text-gray-700 mt-2">Segundo Apellido</label>
                    <input type="text" name="apellido2" id="apellido2" maxlength="15" class="w-full p-2 border rounded">
                    
                    <label class="block text-sm font-medium text-gray-700 mt-2">Profesión</label>
                    <select name="profesion" id="profesion" class="w-full p-2 border rounded" required>
                        <option value="NUTRICIONISTA">Nutricionista</option>
                        <option value="ESTILISTA">Estilista</option>
                        <option value="AUXILIAR">Auxiliar</option>
                        <option value="ATT.CLIENTE">Atención al Cliente</option>
                        <option value="ADMIN">Admin</option>
                    </select>
                </div>
            </div>

            <!-- Tercera fila (Dirección) -->
            <div class="grid grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Calle</label>
                    <input type="text" name="calle" id="calle" maxlength="30" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Número</label>
                    <input type="number" name="numero" id="numero" min="1" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">CP</label>
                    <input type="text" name="cp" id="cp" maxlength="5" pattern="[0-9]{5}" class="w-full p-2 border rounded" title="Debe contener 5 números">
                </div>
            </div>

            <!-- Cuarta fila (Ubicación) -->
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Población</label>
                    <input type="text" name="poblacion" id="poblacion" maxlength="50" class="w-full p-2 border rounded">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Provincia</label>
                    <input type="text" name="provincia" id="provincia" maxlength="20" class="w-full p-2 border rounded">
                </div>
            </div>

            <!-- Teléfono y botones -->
            <div class="mt-4">
                <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                <input type="text" name="tlfno" id="tlfno" maxlength="9" pattern="[0-9]{9}" class="w-full p-2 border rounded" title="Debe contener 9 números">
            </div>

            <!-- Botones -->
            <div class="flex justify-end space-x-2 mt-4">
                <button type="button" onclick="closeModal()" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Cancelar</button>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Insertar</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('modal').classList.remove('hidden');
    }
    
    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }

    function validarFormulario() {
        const dni = document.getElementById("dni").value;
        const dniRegex = /^[0-9]{8}[A-Z]$/;
        if (!dniRegex.test(dni)) {
            alert("DNI inválido. Debe contener 8 números y una letra mayúscula.");
            return false;
        }

        const cp = document.getElementById("cp").value;
        const cpRegex = /^[0-9]{5}$/;
        if (cp && !cpRegex.test(cp)) {
            alert("Código postal inválido. Debe contener 5 números.");
            return false;
        }

        const telefono = document.getElementById("tlfno").value;
        const telefonoRegex = /^[0-9]{9}$/;
        if (telefono && !telefonoRegex.test(telefono)) {
            alert("Teléfono inválido. Debe contener 9 números.");
            return false;
        }

        return true;
    }
</script>



</body>
</html>