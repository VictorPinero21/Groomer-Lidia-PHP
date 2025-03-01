<?php
class ClientesView
{

    public function showForm()
    {
?>
        <!-- Modal para crear clientes -->
        <div id="modal" class="fixed inset-0 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Crear Cliente</h2>
        <form id="crearClienteForm" class="space-y-4 text-left" method="POST" action="http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=clientesApi&action=createCliente">
            <div>
                <label for="dni" class="block text-sm font-medium">DNI</label>
                <input required type="text" id="dni" name="dni" pattern="^\d{8}[A-Za-z]$" maxlength="9" class="mt-2 block w-full border-2 border-gray-300 rounded-md shadow-sm p-3 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Ej: 12345678A">
            </div>
            <div>
                <label for="nombre" class="block text-sm font-medium">Nombre</label>
                <input required type="text" id="nombre" name="nombre" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]{2,50}" class="mt-2 block w-full border-2 border-gray-300 rounded-md shadow-sm p-3 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Ingrese su nombre">
            </div>
            <div>
                <label for="apellido1" class="block text-sm font-medium">Apellido 1</label>
                <input required type="text" id="apellido1" name="apellido1" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]{2,50}" class="mt-2 block w-full border-2 border-gray-300 rounded-md shadow-sm p-3 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Primer apellido">
            </div>
            <div>
                <label for="apellido2" class="block text-sm font-medium">Apellido 2</label>
                <input required type="text" id="apellido2" name="apellido2" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ ]{2,50}" class="mt-2 block w-full border-2 border-gray-300 rounded-md shadow-sm p-3 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Segundo apellido">
            </div>
            <div>
                <label for="direccion" class="block text-sm font-medium">Dirección</label>
                <input required type="text" id="direccion" name="direccion" maxlength="100" class="mt-2 block w-full border-2 border-gray-300 rounded-md shadow-sm p-3 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Ingrese su dirección">
            </div>
            <div>
                <label for="telefono" class="block text-sm font-medium">Teléfono</label>
                <input required type="text" id="tlfno" name="tlfno" pattern="^\d{9}$" maxlength="9" class="mt-2 block w-full border-2 border-gray-300 rounded-md shadow-sm p-3 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Ej: 600123456">
            </div>
            <div class="flex justify-end mt-4">
                <button type="button" onclick="window.location.href='http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=clientesApi&action=showClientes'" class="bg-gray-600 text-white px-4 py-2 rounded-md">Cancelar</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md ml-2">Crear Cliente</button>
            </div>
        </form>
    </div>
</div>
<?php
    }

    public function getAllClientes($clientesLista)
    {
    ?>
        <!-- Lista de clientes -->
        <div class="bg-white p-8 rounded-lg shadow-xl mb-6 overflow-x-auto">
            <h2 class="text-2xl font-semibold text-black mb-4">Nuestros Clientes</h2>
            <div class="flex justify-between items-center mb-6">
                <a href="http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=clientesApi&action=showFormController">
                  <?php if($_SESSION['user']['rol']=='ADMIN') echo '<button class="bg-blue-600 text-white px-5 py-3 rounded-md">Nuevo Cliente</button>' ?>
                </a>
            </div>
            <table class="min-w-full divide-y divide-gray-300 text-sm">
                <thead class="">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase">DNI</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase">Nombre</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase">Apellido 1</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase">Apellido 2</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase">Dirección</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase">Teléfono</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase">Opciones</th>
                    </tr>
                </thead>
                <tbody id="clientesLista" class="bg-white divide-y divide-gray-200">
                    <?php
                    if (is_array($clientesLista) && count($clientesLista) > 0) {
                        foreach ($clientesLista as $cliente) {
                            echo "<tr>";
                            echo "<td class='px-4 py-2 text-left whitespace-nowrap text-black'>{$cliente['Dni']}</td>";
                            echo "<td class='px-4 py-2 text-left whitespace-nowrap text-black'>{$cliente['Nombre']}</td>";
                            echo "<td class='px-4 py-2 text-left whitespace-nowrap text-black'>{$cliente['Apellido1']}</td>";
                            echo "<td class='px-4 py-2 text-left whitespace-nowrap text-black'>{$cliente['Apellido2']}</td>";
                            echo "<td class='px-4 py-2 text-left whitespace-nowrap text-black'>{$cliente['Direccion']}</td>";
                            echo "<td class='px-4 py-2 text-left whitespace-nowrap text-black'>" . (isset($cliente['Tlfno']) ? $cliente['Tlfno'] : 'N/A') . "</td>";
                            echo "<td class='px-4 py-2 text-left whitespace-nowrap text-black'>";
                            echo "<button type='submit' class='bg-blue-600 text-white px-4 py-2 rounded-md mr-2 bg-blue-500' onclick='window.location.href=\"http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=perrosApi&action=mostrarPerrosPorCliente&clienteDni={$cliente['Dni']}\"'>Perros</button>";
                            echo "<form method='POST' action='http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=clientesApi&action=deleteCliente' style='display:inline;'>";
                            echo "<input type='hidden' name='dni' value='{$cliente['Dni']}'>";
                           if($_SESSION['user']['rol']=='ADMIN') echo "<button type='submit' class='bg-red-600 text-white px-4 py-2 rounded-md bg-red-700'>Borrar</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo '<tr><td colspan="7" class="text-center font-bold text-xl text-red-500 text-red-400">No hay resultados en tu búsqueda</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
<?php
    }
}
?>
