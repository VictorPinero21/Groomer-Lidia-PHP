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
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Lista de Perros</h1>
        <div class="space-y-4">
            <div class="bg-gray-50 p-4 rounded-lg shadow flex justify-between items-center">
                <span class="text-lg font-semibold"> </span>
                <div class="space-x-2">
                    <a href="?eliminar=" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Eliminar</a>
                </div>
            </div>
        </div>
        <div class="mt-6 text-center">
            <button onclick="openModal()" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Insertar Perro</button>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-semibold text-gray-700 mb-4">Insertar Perro</h2>
            <form action="insertar_perro.php" method="post" onsubmit="return validarFormulario()">
                <!-- ID Perro -->
                <input type="number" name="id_perro" id="id_perro" placeholder="ID Perro" required class="w-full mb-4 p-2 border rounded">

                <!-- DNI Dueño -->
                <input type="text" name="dni_dueño" id="dni_dueño" placeholder="DNI del Dueño" maxlength="9" pattern="[0-9]{8}[A-Za-z]" required class="w-full mb-4 p-2 border rounded" title="Debe contener 8 números seguidos de una letra mayúscula">

                <!-- Nombre -->
                <input type="text" name="nombre" id="nombre" placeholder="Nombre" maxlength="20" required class="w-full mb-4 p-2 border rounded">

                <!-- Fecha de Nacimiento -->
                <input type="date" name="fecha_nto" id="fecha_nto" required class="w-full mb-4 p-2 border rounded">

                <!-- Raza -->
                <input type="text" name="raza" id="raza" placeholder="Raza" maxlength="40" required class="w-full mb-4 p-2 border rounded">

                <!-- Peso -->
                <input type="number" name="peso" id="peso" placeholder="Peso (kg)" step="0.001" required class="w-full mb-4 p-2 border rounded">

                <!-- Altura -->
                <input type="number" name="altura" id="altura" placeholder="Altura (cm)" required class="w-full mb-4 p-2 border rounded">

                <!-- Observaciones -->
                <input type="text" name="observaciones" id="observaciones" placeholder="Observaciones" maxlength="200" class="w-full mb-4 p-2 border rounded">

                <!-- Número de Chip -->
                <input type="text" name="n_chip" id="n_chip" placeholder="Número de Chip" maxlength="15" required class="w-full mb-4 p-2 border rounded">

                <!-- Sexo -->
                <select name="sexo" id="sexo" required class="w-full mb-4 p-2 border rounded">
                    <option value="Macho">Macho</option>
                    <option value="Hembra">Hembra</option>
                </select>

                <div class="flex justify-end space-x-2">
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

            const dniDueño = document.getElementById('dni_dueño').value;
            if (!dniDueño.match(/^\d{8}[A-Za-z]$/)) {
                alert("El DNI del dueño debe contener 8 números seguidos de una letra mayúscula.");
                isValid = false;
            }

            const nombre = document.getElementById('nombre').value;
            if (!nombre.trim()) {
                alert("El nombre no puede estar vacío.");
                isValid = false;
            }

            const fechaNto = document.getElementById('fecha_nto').value;
            if (!fechaNto) {
                alert("Debes ingresar una fecha de nacimiento válida.");
                isValid = false;
            }

            const raza = document.getElementById('raza').value;
            if (!raza.trim()) {
                alert("La raza no puede estar vacía.");
                isValid = false;
            }

            const peso = parseFloat(document.getElementById('peso').value);
            if (isNaN(peso) || peso <= 0) {
                alert("El peso debe ser un número positivo.");
                isValid = false;
            }

            const altura = parseFloat(document.getElementById('altura').value);
            if (isNaN(altura) || altura <= 0) {
                alert("La altura debe ser un número positivo.");
                isValid = false;
            }

            const observaciones = document.getElementById('observaciones').value;
            if (observaciones.length > 200) {
                alert("Las observaciones no pueden superar los 200 caracteres.");
                isValid = false;
            }

            const nChip = document.getElementById('n_chip').value;
            if (!nChip.match(/^\d{1,15}$/)) {
                alert("El número de chip debe contener hasta 15 dígitos.");
                isValid = false;
            }

            const sexo = document.getElementById('sexo').value;
            if (sexo !== "Macho" && sexo !== "Hembra") {
                alert("El sexo debe ser 'Macho' o 'Hembra'.");
                isValid = false;
            }

            return isValid;
        }
    </script>


</body>

</html>