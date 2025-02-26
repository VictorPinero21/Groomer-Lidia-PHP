<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        function showForm(event, id) {
            event.preventDefault();

            document.querySelectorAll('.form-container').forEach(form => {
                form.classList.add('hidden');
            });

            document.getElementById(id).classList.remove('hidden');
        }
    </script>

</head>

<body class="bg-gray-100 flex flex-col items-center justify-center h-screen">

    <header class="fixed top-0 left-0 w-full bg-white shadow-md z-50">
        <nav class="p-4 rounded-lg flex flex-col items-center gap-4 md:flex-row md:justify-center">
            <a href="" onclick="showForm(event, 'formPerros')" class="w-64 text-center px-8 py-4 bg-green-500 text-white font-semibold rounded-lg shadow-md transition-all hover:bg-green-600 hover:scale-105">
                Perros
            </a>
            <a href="" onclick="showForm(event, 'formServicios')" class="w-64 text-center px-8 py-4 bg-blue-500 text-white font-semibold rounded-lg shadow-md transition-all hover:bg-blue-600 hover:scale-105">
                Servicios
            </a>
            <a href="" onclick="showForm(event, 'formEmpleados')" class="w-64 text-center px-8 py-4 bg-purple-500 text-white font-semibold rounded-lg shadow-md transition-all hover:bg-purple-600 hover:scale-105">
                Empleados
            </a>
            <a href="" onclick="showForm(event, 'formClientes')" class="w-64 text-center px-8 py-4 bg-red-500 text-white font-semibold rounded-lg shadow-md transition-all hover:bg-red-600 hover:scale-105">
                Clientes
            </a>
        </nav>
    </header>

    <main class="bg-gray-100 flex flex-col items-center justify-center min-h-screen p-4 w-2/4 h-3/4">

        <!-- Formulario clientes -->
        <div id="formClientes" class="form-container hidden bg-gray-100 p-12 rounded-lg shadow-md w-full">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Lista de Clientes</h1>
            <div class="space-y-6">
                <div class="bg-gray-50 p-6 rounded-lg shadow flex justify-between items-center">
                    <span class="text-lg font-semibold"> </span>
                    <div class="space-x-3">
                        <a href="?eliminar=" class="bg-red-500 text-white px-6 py-3 rounded hover:bg-red-600">Eliminar</a>
                    </div>
                </div>
            </div>
            <div class="mt-8 text-center">
                <button onclick="openModalC()" class="bg-blue-500 text-white px-8 py-3 rounded hover:bg-blue-600">Insertar Cliente</button>
            </div>
        </div>

        <!-- Formulario empleados -->
        <div id="formEmpleados" class="form-container hidden bg-gray-100 p-12 rounded-lg shadow-md w-full max-w-full">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Lista de Empleados</h1>
            <div class="space-y-6">
                <div class="bg-gray-50 p-6 rounded-lg shadow flex justify-between items-center">
                    <span class="text-lg font-semibold"></span>
                    <div class="space-x-3">
                        <a href="?eliminar=" class="bg-red-500 text-white px-6 py-3 rounded hover:bg-red-600">Eliminar</a>
                    </div>
                </div>
            </div>
            <div class="mt-8 text-center">
                <button onclick="openModalE()" class="bg-blue-500 text-white px-8 py-3 rounded hover:bg-blue-600">Insertar Empleado</button>
            </div>
        </div>

        <!-- Formulario perros -->
        <div id="formPerros" class="form-container hidden bg-gray-100 p-12 rounded-lg shadow-md w-full max-w-full">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Lista de Perros</h1>
            <div class="space-y-6">
                <div class="bg-gray-50 p-6 rounded-lg shadow flex justify-between items-center">
                    <span class="text-lg font-semibold"> </span>
                    <div class="space-x-3">
                        <a href="?eliminar=" class="bg-red-500 text-white px-6 py-3 rounded hover:bg-red-600">Eliminar</a>
                    </div>
                </div>
            </div>
            <div class="mt-8 text-center">
                <button onclick="openModalP()" class="bg-blue-500 text-white px-8 py-3 rounded hover:bg-blue-600">Insertar Perro</button>
            </div>
        </div>

        <!-- Formulario servicios-->
        <div id="formServicios" class="form-container hidden bg-gray-100 p-12 rounded-lg shadow-md w-full max-w-full">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Lista de Servicios</h1>
            <div class="space-y-6">
                <div class="bg-gray-50 p-6 rounded-lg shadow flex justify-between items-center">
                    <span class="text-lg font-semibold"> </span>
                    <div class="space-x-3">
                        <a href="?eliminar=" class="bg-red-500 text-white px-6 py-3 rounded hover:bg-red-600">Eliminar</a>
                    </div>
                </div>
            </div>
            <div class="mt-8 text-center">
                <button onclick="openModalS()" class="bg-blue-500 text-white px-8 py-3 rounded hover:bg-blue-600">Insertar Servicio</button>
            </div>
        </div>









        <!-- Modal empleados -->
        <div id="modalE" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
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
                        <button type="button" onclick="closeModalE()" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Cancelar</button>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Insertar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal clientes -->

        <div id="modalC" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
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
                        <button type="button" onclick="closeModalC()" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Cancelar</button>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Insertar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal perros -->

        <div id="modalP" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
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
                        <button type="button" onclick="closeModalP()" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Cancelar</button>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Insertar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal servicios -->
        <div id="modalS" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50 flex items-center justify-center">
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
                        <button type="button" onclick="closeModalS()" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Cancelar</button>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Insertar</button>
                    </div>
                </form>
            </div>
        </div>


        <script>
            function openModalE() {
                document.getElementById('modalE').classList.remove('hidden');
            }

            function closeModalE() {
                document.getElementById('modalE').classList.add('hidden');
            }

            function openModalC() {
                document.getElementById('modalC').classList.remove('hidden');
            }

            function closeModalC() {
                document.getElementById('modalC').classList.add('hidden');
            }

            function openModalP() {
                document.getElementById('modalP').classList.remove('hidden');
            }

            function closeModalP() {
                document.getElementById('modalP').classList.add('hidden');
            }

            function openModalS() {
                document.getElementById('modalS').classList.remove('hidden');
            }

            function closeModalS() {
                document.getElementById('modalS').classList.add('hidden');
            }
        </script>
    </main>


</body>

</html>