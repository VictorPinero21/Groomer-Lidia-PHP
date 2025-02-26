<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Servicios</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen p-4">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-2xl">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">Lista de Servicios</h1>
        <div class="space-y-4">
                <div class="bg-gray-50 p-4 rounded-lg shadow flex justify-between items-center">
                    <span class="text-lg font-semibold">  </span>
                    <div class="space-x-2">
                        <a href="?eliminar=" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Eliminar</a>
                    </div>
                </div>
        </div>
        <div class="mt-6 text-center">
            <button onclick="openModal()" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Insertar Servicio</button>
        </div>
    </div>

    <!-- Modal -->
<div id="modal" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-semibold text-gray-700 mb-4">Insertar Servicio</h2>
        <form action="insertar_servicio.php" method="post" onsubmit="return validarFormulario()">
            <!-- Código -->
            <input type="text" name="codigo" id="codigo" placeholder="Código" 
                   maxlength="6" pattern="^[A-Za-z0-9]{1,6}$" 
                   title="El código debe tener hasta 6 caracteres alfanuméricos."
                   required class="w-full mb-4 p-2 border rounded">

            <!-- Nombre -->
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" 
                   maxlength="100" pattern=".*\S.*" 
                   title="El nombre no puede estar vacío ni contener solo espacios."
                   required class="w-full mb-4 p-2 border rounded">

            <!-- Precio -->
            <input type="number" name="precio" id="precio" placeholder="Precio" 
                   step="0.01" min="0.01" 
                   title="El precio debe ser un número positivo."
                   required class="w-full mb-4 p-2 border rounded">

            <!-- Descripción -->
            <textarea name="descripcion" id="descripcion" placeholder="Descripción" 
                      maxlength="200" required class="w-full mb-4 p-2 border rounded"></textarea>

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

        const codigo = document.getElementById('codigo').value;
        if (!codigo.match(/^[A-Za-z0-9]{1,6}$/)) {
            alert("El código debe contener hasta 6 caracteres alfanuméricos.");
            isValid = false;
        }

        const nombre = document.getElementById('nombre').value;
        if (!nombre.trim()) {
            alert("El nombre no puede estar vacío.");
            isValid = false;
        }

        const precio = parseFloat(document.getElementById('precio').value);
        if (isNaN(precio) || precio <= 0) {
            alert("El precio debe ser un número positivo.");
            isValid = false;
        }

        const descripcion = document.getElementById('descripcion').value;
        if (descripcion.length > 200) {
            alert("La descripción no puede superar los 200 caracteres.");
            isValid = false;
        }

        return isValid;
    }
</script>


</body>
</html>
