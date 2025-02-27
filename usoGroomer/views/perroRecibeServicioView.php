<?php

class PerroRecibeServicio
{
    public function showFormServ()
    {
?>
        <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-8 rounded-lg shadow-lg w-11/12 sm:w-3/4 lg:w-2/3 xl:w-1/2">
                <div class="flex justify-between items-center mb-6">
                    <button onclick="document.getElementById('modal').style.display='none'" class="text-gray-500 hover:text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form id="crearNuevoServicio" class="grid grid-cols-1 sm:grid-cols-2 gap-6" method="POST" action="http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=perroRecibeServicioUso&action=crearServicioRealizadoAPerro">
                    <div class="flex flex-col">
                        <label for="dni" class="text-sm font-medium text-gray-700">ID del perro:</label>
                        <input required type="text" id="dni" name="perro_id" class="mt-1 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="flex flex-col">
                        <label for="nombre" class="text-sm font-medium text-gray-700">ID del servicio:</label>
                        <input required type="text" id="nombre" name="servicio_id" class="mt-1 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="flex flex-col">
                        <label for="fecha_nto" class="text-sm font-medium text-gray-700">Fecha del Servicio:</label>
                        <input required type="date" id="fecha_nto" name="fecha" class="mt-1 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="flex flex-col">
                        <label for="raza" class="text-sm font-medium text-gray-700">ID del empleado:</label>
                        <input required type="text" id="raza" name="empleado_id" class="mt-1 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="flex flex-col">
                        <label for="peso" class="text-sm font-medium text-gray-700">Precio:</label>
                        <input required type="number" step="0.01" id="peso" name="precioFinal" class="mt-1 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="flex flex-col">
                        <label for="altura" class="text-sm font-medium text-gray-700">Incidencias:</label>
                        <input required type="text" id="altura" name="incidencias" class="mt-1 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="col-span-2 flex justify-end gap-4 mt-6">
                        <a href="http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=perroRecibeServicioUso&action=mostrarServiciosPorPerros">
                            <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-md">CANCELAR</button>
                        </a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-md">INSERTAR SERVICIO</button>
                    </div>
                </form>
            </div>
        </div>

<?php
    }

    public function mostrarServiciosPorPerro($servPorPerro)
    {
    ?>
        <div class="bg-white p-6 rounded-lg shadow-md mb-6 overflow-x-auto">
            <h2 class="text-2xl font-bold mb-6">Servicios de Perros</h2>
            <a href="http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=perroRecibeServicioUso&action=showFormServ">
                <button class="bg-blue-600 hover:bg-blue-800 text-white px-6 py-3 rounded-md mb-10">Insertar Nuevo Servicio</button>
            </a>
            <table class="min-w-full divide-y divide-gray-300 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Código</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ID Servicio</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ID Perro</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Fecha</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Incidencias</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Precio</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">DNI Cliente</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody id="listaServPorPerro" class="bg-white divide-y divide-gray-200">
                    <?php
                    if (is_array($servPorPerro) && count($servPorPerro) > 0) {
                        foreach ($servPorPerro as $serv) {
                            echo "<tr>";
                            echo "<td class='px-6 py-3'>{$serv['Sr_Cod']}</td>";
                            echo "<td class='px-6 py-3'>{$serv['Cod_Servicio']}</td>";
                            echo "<td class='px-6 py-3'>{$serv['ID_Perro']}</td>";
                            echo "<td class='px-6 py-3'>{$serv['Fecha']}</td>";
                            echo "<td class='px-6 py-3'>{$serv['Incidencias']}</td>";
                            echo "<td class='px-6 py-3'>{$serv['Precio_Final']}</td>";
                            echo "<td class='px-6 py-3'>{$serv['Dni']}</td>";
                            echo "<td class='px-6 py-3'>";
                            echo "<form method='POST' action='http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=perroRecibeServicioUso&action=borrarServicioRealizadoAPerro&Sr_Cod={$serv['Sr_Cod']}' style='display:inline;'>";
                            echo "<button type='submit' class='bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-md'>Borrar</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center font-bold text-sm text-blue-500'>No hay servicios realizados disponibles.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
<?php
    }
}
?>
