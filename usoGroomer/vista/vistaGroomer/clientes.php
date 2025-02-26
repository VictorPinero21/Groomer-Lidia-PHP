<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Perros</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen p-4">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-2xl">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Lista de Clientes</h1>
        <div class="space-y-4">
                <div class="bg-gray-50 p-4 rounded-lg shadow flex justify-between items-center">
                    <span class="text-lg font-semibold"> </span>
                    <div class="space-x-2">
                        <a href="?eliminar=" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Eliminar</a>
                    </div>
                </div>
        </div>
        <div class="mt-6 text-center">
            <button onclick="openModal()" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Insertar Cliente</button>
        </div>
    </div>

<!-- Modal -->
<div id="modal" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-3xl">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4 text-center">Insertar Cliente</h2>
        <form action="insertar_cliente.php" method="post" onsubmit="return validarFormulario()">
            <div class="grid grid-cols-2 gap-4">
                <!-- Primera columna -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">DNI</label>
                    <input type="text" name="dni" id="dni" maxlength="9" required class="w-full p-2 border rounded" pattern="[0-9]{8}[A-Za-z]" title="Debe contener 8 números y una letra mayúscula">

                    <label class="block text-sm font-medium text-gray-700 mt-2">Teléfono</label>
                    <input type="text" name="tlfno" id="tlfno" maxlength="9" pattern="[0-9]{9}" required class="w-full p-2 border rounded" title="Debe contener 9 números">

                    <label class="block text-sm font-medium text-gray-700 mt-2">Dirección</label>
                    <input type="text" name="direccion" id="direccion" maxlength="200" required class="w-full p-2 border rounded">
                </div>

                <!-- Segunda columna -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="nombre" id="nombre" maxlength="15" required class="w-full p-2 border rounded">

                    <label class="block text-sm font-medium text-gray-700 mt-2">Primer Apellido</label>
                    <input type="text" name="apellido1" id="apellido1" maxlength="15" required class="w-full p-2 border rounded">

                    <label class="block text-sm font-medium text-gray-700 mt-2">Segundo Apellido</label>
                    <input type="text" name="apellido2" id="apellido2" maxlength="15" class="w-full p-2 border rounded">
                </div>
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
        let isValid = true;

        const dni = document.getElementById('dni').value;
        if (!dni.match(/^\d{8}[A-Za-z]$/)) {
            alert("El DNI debe contener 8 números seguidos de una letra mayúscula.");
            isValid = false;
        }

        const tlfno = document.getElementById('tlfno').value;
        if (!tlfno.match(/^\d{9}$/)) {
            alert("El teléfono debe contener 9 números.");
            isValid = false;
        }

        const nombre = document.getElementById('nombre').value;
        if (!nombre.trim()) {
            alert("El nombre no puede estar vacío.");
            isValid = false;
        }

        const apellido1 = document.getElementById('apellido1').value;
        if (!apellido1.trim()) {
            alert("El primer apellido no puede estar vacío.");
            isValid = false;
        }

        return isValid;
    }
</script>

</body>
</html>