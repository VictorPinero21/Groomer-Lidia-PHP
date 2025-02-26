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
        <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center dark:bg-gray-900 dark:bg-opacity-80">
            <div class="bg-white p-4 rounded shadow-lg w-1/3 dark:bg-gray-800">
                <h2 class="text-xl font-bold mb-2 dark:text-white">Crear Cliente</h2>
                <form id="crearClienteForm" class="space-y-2 text-left" method="POST" action="http://localhost/gromer/front/index.php?controller=clientesUso&action=createCliente">
                    <div>
                       
                            
                        <label for="dni" class="block text-sm font-medium text-blue-400 dark:text-blue-300">DNI</label>
                        <input required type="text" id="dni" value="<?php echo isset($_POST['dni']) ? $_POST['dni'] : '' ?>" name="dni" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-blue-400 dark:text-blue-300">Nombre</label>
                        <input required type="text" id="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : '' ?>" name="nombre" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label for="apellido1" class="block text-sm font-medium text-blue-400 dark:text-blue-300">Apellido 1</label>
                        <input required type="text" id="apellido1" value="<?php echo isset($_POST['apellido1']) ? $_POST['apellido1'] : '' ?>" name="apellido1" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label for="apellido2" class="block text-sm font-medium text-blue-400 dark:text-blue-300">Apellido 2</label>
                        <input required type="text" id="apellido2" value="<?php echo isset($_POST['apellido2']) ? $_POST['apellido2'] : '' ?>" name="apellido2" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label for="direccion" class="block text-sm font-medium text-blue-400 dark:text-blue-300">Dirección</label>
                        <input required type="text" id="direccion" value="<?php echo isset($_POST['direccion']) ? $_POST['direccion'] : '' ?>" name="direccion" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div>
                        <label for="telefono" class="block text-sm font-medium text-blue-400 dark:text-blue-300">Teléfono</label>
                        <input required type="text" id="telefono" value="<?php echo isset($_POST['telefono']) ? $_POST['telefono'] : '' ?>" name="telefono" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="window.location.href='http://localhost/gromer/front/index.php?controller=clientesUso&action=createCliente'" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 dark:bg-gray-700">Cancelar</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded dark:bg-blue-700">Crear Cliente</button>
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
        <div class="bg-white p-6 rounded shadow mb-4 overflow-x-auto dark:bg-gray-800">
            <h2 class="text-xl font-bold text-purple-600 mb-2 dark:text-purple-400">Nuestros Clientes</h2>
            <div class="flex justify-between items-center mb-4">
                <a href="http://localhost/gromer/front/index.php?controller=clientesUso&action=showFormController">
                    <button class="bg-green-500 text-white px-4 py-2 rounded dark:bg-green-700">Nuevo Cliente</button>
                </a>
                <div class="flex items-center">
                    <form id='busqueda' method="POST" action="http://localhost/gromer/front/index.php?controller=clientesUso&action=showClientes">
                        <input oninput="this.form.submit();" type="search" id="default-search" name="dniInfo" class="w-[200px] p-2 text-sm text-gray-900 border border-gray-300 rounded bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mr-2" value='<?php echo $_POST['dniInfo'] ?>' placeholder="Introduce DNI" autofocus />
                    </form>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const input = document.getElementById('default-search');
                        const dniValue = "<?php echo isset($_POST['dniInfo']) ? addslashes($_POST['dniInfo']) : '' ?>";
                        input.focus();
                        input.setSelectionRange(input.value.length, input.value.length);
                    });
                </script>
            </div>
            <table class="min-w-full divide-y divide-gray-200 text-sm dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">DNI</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Nombre</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Apellido 1</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Apellido 2</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Dirección</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Teléfono</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">Opciones</th>
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
                            echo "<td class='px-4 py-2 text-left whitespace-nowrap dark:text-gray-300'>" . (isset($cliente['telefono']) ? $cliente['telefono'] : 'N/A') . "</td>";
                            echo "<td class='px-4 py-2 text-left whitespace-nowrap dark:text-gray-300'>";
                            echo "<button type='submit' class='bg-yellow-700 text-white px-4 py-2 rounded mr-2 dark:bg-yellow-600' onclick='window.location.href=\"http://localhost/gromer/front/index.php?controller=perrosUso&action=mostrarPerrosPorCliente&clienteDni={$cliente['Dni']}\"'>Perros</button>";
                            echo "<form method='POST' action='http://localhost/grommer/Groomer-Lidia-PHP/usoGroomer/index.php?controller=clientesUso&action=deleteCliente' style='display:inline;'>";
                            echo "<input type='hidden' name='dni' value='{$cliente['Dni']}'>";
                            echo "<button type='submit' class='bg-red-500 text-white px-4 py-2 rounded dark:bg-red-700'>Borrar</button>";
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
        </div>
<?php
    }
}
?>