<?php
class ClientesView
{
    /**
     * Muestra el formulario para crear un cliente
     * @return void
     */
    public function showForm()
    {
?>
        <!-- Modal para crear clientes -->
        <div id="modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center dark:bg-gray-900 dark:bg-opacity-80">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3 dark:bg-gray-800">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4 dark:text-white">Crear Cliente</h2>
                <form id="crearClienteForm" class="space-y-4 text-left" method="POST" action="http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=clientesUso&action=createCliente">
                    <div>
                        <label for="dni" class="block text-sm font-medium text-blue-500 dark:text-blue-300">DNI</label>
                        <input required type="text" id="dni" value="<?php echo isset($_POST['dni']) ? $_POST['dni'] : '' ?>" name="dni" class="mt-2 block w-full border-2 border-gray-300 rounded-md shadow-sm p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-blue-500 dark:text-blue-300">Nombre</label>
                        <input required type="text" id="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : '' ?>" name="nombre" class="mt-2 block w-full border-2 border-gray-300 rounded-md shadow-sm p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                    <div>
                        <label for="apellido1" class="block text-sm font-medium text-blue-500 dark:text-blue-300">Apellido 1</label>
                        <input required type="text" id="apellido1" value="<?php echo isset($_POST['apellido1']) ? $_POST['apellido1'] : '' ?>" name="apellido1" class="mt-2 block w-full border-2 border-gray-300 rounded-md shadow-sm p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                    <div>
                        <label for="apellido2" class="block text-sm font-medium text-blue-500 dark:text-blue-300">Apellido 2</label>
                        <input required type="text" id="apellido2" value="<?php echo isset($_POST['apellido2']) ? $_POST['apellido2'] : '' ?>" name="apellido2" class="mt-2 block w-full border-2 border-gray-300 rounded-md shadow-sm p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                    <div>
                        <label for="direccion" class="block text-sm font-medium text-blue-500 dark:text-blue-300">Dirección</label>
                        <input required type="text" id="direccion" value="<?php echo isset($_POST['direccion']) ? $_POST['direccion'] : '' ?>" name="direccion" class="mt-2 block w-full border-2 border-gray-300 rounded-md shadow-sm p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                    <div>
                        <label for="telefono" class="block text-sm font-medium text-blue-500 dark:text-blue-300">Teléfono</label>
                        <input required type="text" id="tlfno" value="<?php echo isset($_POST['tlfno']) ? $_POST['tlfno'] : '' ?>" name="tlfno" class="mt-2 block w-full border-2 border-gray-300 rounded-md shadow-sm p-3 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="button" onclick="window.location.href='http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=clientesUso&action=showClientes'" class="bg-gray-600 text-white px-4 py-2 rounded-md dark:bg-gray-700">Cancelar</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md ml-2 dark:bg-blue-700">Crear Cliente</button>
                    </div>
                </form>
            </div>
        </div>
<?php
    }

    /**
     * Muestra la lista de clientes
     * @param array $clientesLista
     * @return void
     * @access public
     */
    public function getAllClientes($clientesLista)
    {
    ?>
        <!-- Lista de clientes -->
        <div class="bg-white p-8 rounded-lg shadow-xl mb-6 overflow-x-auto dark:bg-gray-800">
            <h2 class="text-2xl font-semibold text-purple-600 mb-4 dark:text-purple-400">Nuestros Clientes</h2>
            <div class="flex justify-between items-center mb-6">
                <a href="http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=clientesUso&action=showFormController">
                    <button class="bg-green-600 text-white px-5 py-3 rounded-md dark:bg-green-700">Nuevo Cliente</button>
                </a>
            </div>
            <table class="min-w-full divide-y divide-gray-300 text-sm dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider dark:text-gray-300">DNI</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider dark:text-gray-300">Nombre</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider dark:text-gray-300">Apellido 1</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider dark:text-gray-300">Apellido 2</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider dark:text-gray-300">Dirección</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider dark:text-gray-300">Teléfono</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase tracking-wider dark:text-gray-300">Opciones</th>
                    </tr>
                </thead>
                <tbody id="clientesLista" class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    <?php
                    if (is_array($clientesLista) && count($clientesLista) > 0) {
                        foreach ($clientesLista as $cliente) {
                            echo "<tr>";
                            echo "<td class='px-4 py-2 text-left whitespace-nowrap dark:text-gray-300'>{$cliente['Dni']}</td>";
                            echo "<td class='px-4 py-2 text-left whitespace-nowrap dark:text-gray-300'>{$cliente['Nombre']}</td>";
                            echo "<td class='px-4 py-2 text-left whitespace-nowrap dark:text-gray-300'>{$cliente['Apellido1']}</td>";
                            echo "<td class='px-4 py-2 text-left whitespace-nowrap dark:text-gray-300'>{$cliente['Apellido2']}</td>";
                            echo "<td class='px-4 py-2 text-left whitespace-nowrap dark:text-gray-300'>{$cliente['Direccion']}</td>";
                            echo "<td class='px-4 py-2 text-left whitespace-nowrap dark:text-gray-300'>" . (isset($cliente['Tlfno']) ? $cliente['Tlfno'] : 'N/A') . "</td>";
                            echo "<td class='px-4 py-2 text-left whitespace-nowrap dark:text-gray-300'>";
                            echo "<button type='submit' class='bg-yellow-600 text-white px-4 py-2 rounded-md mr-2 dark:bg-yellow-500' onclick='window.location.href=\"http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=perrosUso&action=mostrarPerrosPorCliente&clienteDni={$cliente['Dni']}\"'>Perros</button>";
                            echo "<form method='POST' action='http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=clientesUso&action=deleteCliente' style='display:inline;'>";
                            echo "<input type='hidden' name='dni' value='{$cliente['Dni']}'>";
                            echo "<button type='submit' class='bg-red-600 text-white px-4 py-2 rounded-md dark:bg-red-700'>Borrar</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo '<tr><td colspan="7" class="text-center font-bold text-xl text-red-500 dark:text-red-400">No hay resultados en tu búsqueda</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
<?php
    }
}
?>
