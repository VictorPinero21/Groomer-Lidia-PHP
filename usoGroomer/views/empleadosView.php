<?php
class EmpleadosView
{


    public function showAddEmpleadoForm()
    {
?>
        <!-- Formulario para agregar un nuevo empleado -->
        <div class="bg-white p-8 rounded-lg shadow-lg mb-8 max-w-3xl mx-auto">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6 text-center">Nuevo Empleado</h2>
            <form action="../index.php?controller=empleados&action=addEmpleado" method="post">
                <input type="hidden" name="accion" value="nuevo_empleado">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label for="dni" class="block text-gray-700">DNI</label>
                        <input type="text" class="form-control w-full border rounded-lg py-3 px-4" id="dni" name="dni" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="block text-gray-700">Email</label>
                        <input type="email" class="form-control w-full border rounded-lg py-3 px-4" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="block text-gray-700">Password</label>
                        <input type="password" class="form-control w-full border rounded-lg py-3 px-4" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="rol" class="block text-gray-700">Rol</label>
                        <select class="form-control w-full border rounded-lg py-3 px-4" id="rol" name="rol" required>
                            <option value="EMPLEADO">EMPLEADO</option>
                            <option value="AUXILIAR">AUXILIAR</option>
                            <option value="ADMIN">ADMIN</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="block text-gray-700">Nombre</label>
                        <input type="text" class="form-control w-full border rounded-lg py-3 px-4" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido1" class="block text-gray-700">Apellido 1</label>
                        <input type="text" class="form-control w-full border rounded-lg py-3 px-4" id="apellido1" name="apellido1" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido2" class="block text-gray-700">Apellido 2</label>
                        <input type="text" class="form-control w-full border rounded-lg py-3 px-4" id="apellido2" name="apellido2" required>
                    </div>
                    <div class="form-group">
                        <label for="calle" class="block text-gray-700">Calle</label>
                        <input type="text" class="form-control w-full border rounded-lg py-3 px-4" id="calle" name="calle" required>
                    </div>
                    <div class="form-group">
                        <label for="numero" class="block text-gray-700">Número</label>
                        <input type="text" class="form-control w-full border rounded-lg py-3 px-4" id="numero" name="numero" required>
                    </div>
                    <div class="form-group">
                        <label for="cp" class="block text-gray-700">Código Postal</label>
                        <input type="text" class="form-control w-full border rounded-lg py-3 px-4" id="cp" name="cp" required>
                    </div>
                    <div class="form-group">
                        <label for="poblacion" class="block text-gray-700">Población</label>
                        <input type="text" class="form-control w-full border rounded-lg py-3 px-4" id="poblacion" name="poblacion" required>
                    </div>
                    <div class="form-group">
                        <label for="provincia" class="block text-gray-700">Provincia</label>
                        <input type="text" class="form-control w-full border rounded-lg py-3 px-4" id="provincia" name="provincia" required>
                    </div>
                    <div class="form-group">
                        <label for="tlfno" class="block text-gray-700">Teléfono</label>
                        <input type="text" class="form-control w-full border rounded-lg py-3 px-4" id="tlfno" name="tlfno" required>
                    </div>
                    <div class="form-group">
                        <label for="profesion" class="block text-gray-700">Profesión</label>
                        <select class="form-control w-full border rounded-lg py-3 px-4" id="profesion" name="profesion" required>
                            <option value="ESTILISTA">ESTILISTA</option>
                            <option value="NUTRICIONISTA">NUTRICIONISTA</option>
                            <option value="AUXILIAR">AUXILIAR</option>
                            <option value="ATT.CLIENTE">ATT.CLIENTE</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="w-48 bg-green-500 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg mt-6 mx-auto block">Agregar Empleado</button>
            </form>
        </div>
    <?php
    }

    public function showSearchEmpleadoByDNIForm()
    {
    ?>
        <!-- Formulario para buscar empleado por DNI -->
        <div class="bg-white p-8 rounded-lg shadow-lg mb-8 max-w-3xl mx-auto">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6 text-center">Buscar Empleado por DNI</h2>
            <form action="../index.php?controller=empleados&action=addEmpleado" method="get">
                <div class="form-group">
                    <label for="buscarDni" class="block text-gray-700">DNI</label>
                    <input type="text" class="form-control w-full border rounded-lg py-3 px-4" id="buscarDni" name="dni" required>
                </div>

                <button type="submit" class="w-48 bg-blue-500 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg mt-6 mx-auto block">Buscar</button>
            </form>
        </div>
    <?php


    }

    public function showDeleteEmpleadoForm()
    {
    ?>
        <!-- Formulario para eliminar empleado por DNI -->
        <!-- Formulario para eliminar empleado por DNI -->
        <div class="bg-white p-8 rounded-lg shadow-lg mb-8 max-w-3xl mx-auto">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6 text-center">Eliminar Empleado</h2>

            <form action="../index.php?controller=empleados&action=addEmpleado" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <div class="form-group">
                    <label for="eliminarDni" class="block text-gray-700">DNI</label>
                    <input type="text" class="form-control w-full border rounded-lg py-3 px-4" id="eliminarDni" name="dni" required>
                </div>

                <button type="submit" class="w-48 bg-red-500 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-lg mt-6 mx-auto block">Eliminar</button>
            </form>
        </div>
    <?php
    }
    public function showEmpleados($empleadosLista)
    {
    ?>
        <!-- Mostrar la lista de empleados -->
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-3xl mx-auto">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6 text-center">Lista de Empleados</h2>
            <form action="./index.php?controller=empleadosUso&action=showEmpleados" method="post" class="text-center mb-6">
                <input type="hidden" name="listar" value="true">
                <button type="submit" class="w-48 bg-gray-500 hover:bg-gray-700 text-white font-semibold py-3 px-6 rounded-lg">Cargar Empleados</button>
            </form>
            <ul class="list-none space-y-3">
                <?php
                if (!empty($empleadosLista)) {
                    foreach ($empleadosLista as $empleado) {
                        echo "<li class='bg-gray-50 border-gray-200 rounded-lg py-3 px-6'>{$empleado['DNI']} - {$empleado['Nombre']} {$empleado['Apellido1']} {$empleado['Apellido2']}</li>";
                    }
                } else {
                    echo "<li class='bg-gray-50 border-gray-200 rounded-lg py-3 px-6'>Error al cargar la lista de empleados</li>";
                }
                ?>
            </ul>
        </div>
        </div>
    <?php
    }
    public function showAllEmpleados($empleadosLista)
    {
    ?>
        <!-- Lista de empleados -->
        <div class="bg-white p-6 rounded shadow mb-4 overflow-x-auto">
            <h2 class="text-xl font-bold text-purple-600 mb-2">Nuestros Empleados</h2>
            <div class="flex justify-between items-center mb-4">
                <a href="http://localhost/gromer/front/index.php?controller=empleadosUso&action=showFormController">
                    <button class="bg-green-500 text-white px-4 py-2 rounded">Nuevo Empleado</button>
                </a>
                <div class="flex items-center">
                    <form method="GET" action="http://localhost/gromer/front/index.php">
                        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar Empleado</button>
                        <input type="hidden" name="controller" value="empleadosUso">
                        <input type="hidden" name="action" value="getEmpleado">
                        <input type="text" name="dni" class="border border-gray-300 rounded-md shadow-sm p-2" placeholder="DNI">
                    </form>
                </div>
            </div>
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DNI</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre Completo</th>
                        <!-- <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellido 1</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Apellido 2</th> -->
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dirección</th>
                        <!-- <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Número</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CP</th> -->
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Población</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Provincia</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Teléfono</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profesión</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody id="empleadosLista" class="bg-white divide-y divide-gray-200">
                    <?php
                    if (!empty($empleadosLista)) {
                        foreach ($empleadosLista as $empleado) {
                            echo "<tr>
                                    <td class='px-4 py-2 text-left whitespace-nowrap'>" . (isset($empleado['Dni']) ? $empleado['Dni'] : '') . "</td>
                                    <td class='px-4 py-2 text-left whitespace-nowrap'>" . (isset($empleado['Nombre']) ? $empleado['Nombre'] : '') . " " . (isset($empleado['Apellido1']) ? $empleado['Apellido1'] : '') . " " . (isset($empleado['Apellido2']) ? $empleado['Apellido2'] : '') . "</td>
                                    <td class='px-4 py-2 text-left whitespace-nowrap'>" . (isset($empleado['Email']) ? $empleado['Email'] : '') . "</td>
                                    <td class='px-4 py-2 text-left whitespace-nowrap'>" . (isset($empleado['Rol']) ? $empleado['Rol'] : '') . "</td>
<td class='px-4 py-2 text-left whitespace-nowrap'>" . (isset($empleado['Calle']) ? $empleado['Calle'] : '') . ", " . (isset($empleado['Numero']) ? $empleado['Numero'] : '') . ". " . (isset($empleado['Cp']) ? $empleado['Cp'] : '') . "</td>                                    <td class='px-4 py-2 text-left whitespace-nowrap'>" . (isset($empleado['Poblacion']) ? $empleado['Poblacion'] : '') . "</td>
                                    <td class='px-4 py-2 text-left whitespace-nowrap'>" . (isset($empleado['Provincia']) ? $empleado['Provincia'] : '') . "</td>
                                    <td class='px-4 py-2 text-left whitespace-nowrap'>" . (isset($empleado['Tlfno']) ? $empleado['Tlfno'] : '') . "</td>
                                    <td class='px-4 py-2 text-left whitespace-nowrap'>" . (isset($empleado['Profesion']) ? $empleado['Profesion'] : '') . "</td>
                                    <td class='px-4 py-2 text-left whitespace-nowrap'>
                                        <a href='http://localhost/gromer/front/index.php?controller=empleadosUso&action=editEmpleado&dni=" . (isset($empleado['DNI']) ? $empleado['DNI'] : '') . "' class='text-blue-600 hover:text-blue-800'>Editar</a>
                                        <a href='http://localhost/gromer/front/index.php?controller=empleadosUso&action=deleteEmpleado&dni=" . (isset($empleado['DNI']) ? $empleado['DNI'] : '') . "' class='text-red-600 hover:text-red-800'>Eliminar</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='14' class='text-center'>No hay empleados para mostrar</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
<?php
    }
}
?>