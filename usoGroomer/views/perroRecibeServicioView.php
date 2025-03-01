<?php

class PerroRecibeServicio
{
    public function showFormServ($servicios)
    {
?>
<div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-8 rounded-lg shadow-lg w-11/12 sm:w-3/4 lg:w-2/3 xl:w-1/2">
        <form id="crearNuevoServicio" class="grid grid-cols-1 sm:grid-cols-2 gap-6" method="POST" action="http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=perroServicioApi&action=crearServicioRealizadoAPerro">
            <div class="flex flex-col">
                <label for="dni" class="text-sm font-medium text-gray-700">ID del perro:</label>
                <input required type="text" id="dni" name="perro_id" class="mt-1 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex flex-col">
                <label for="nombre" class="text-sm font-medium text-gray-700">ID del servicio:</label>
                <select required id="servicio" name="servicio_id" class="mt-1 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500">
                    <option disabled selected value="">Seleccione un servicio</option>
                    <?php
                    if (!empty($servicios) && is_array($servicios)) {
                        foreach ($servicios as $servicio) {
                            echo "<option value='" . htmlspecialchars($servicio['Codigo']) . "' data-precio='" . htmlspecialchars($servicio['Precio']) . "'>" . htmlspecialchars($servicio['Codigo']) . "</option>";
                        }
                    } else {
                        echo "<option value='' disabled>No hay servicios disponibles</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="flex flex-col">
                <label for="fecha_nto" class="text-sm font-medium text-gray-700">Fecha del Servicio:</label>
                <input required type="date" id="fecha_nto" name="fecha" class="mt-1 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex flex-col">
                <label for="raza" class="text-sm font-medium text-gray-700">DNI del empleado:</label>
                <input required type="text" id="raza" name="empleado_id" class="mt-1 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500"required pattern="^\d{8}[A-Za-z]$" maxlength="9" title="El DNI debe contener 8 números seguidos de una letra.">
            </div>
            <div class="flex flex-col">
                <label for="Precio_Final" class="text-sm font-medium text-gray-700">Precio:</label>
                <input type="number" step="0.01" id="Precio_Final" name="Precio_Final" class="mt-1 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="flex flex-col">
                <label for="altura" class="text-sm font-medium text-gray-700">Incidencias:</label>
                <input required type="text" id="altura" name="incidencias" class="mt-1 p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="col-span-2 flex justify-end gap-4 mt-6">
                <a href="http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=perroServicioApi&action=mostrarServiciosPorPerros">
                    <button type="button" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-md">CANCELAR</button>
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-md">INSERTAR SERVICIO</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('servicio').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var precio = selectedOption.getAttribute('data-precio');
        document.getElementById('Precio_Final').value = precio;
        console.log(document.getElementById('Precio_Final'));
    });
</script>


<?php
    }

    public function mostrarServiciosPorPerro($servPorPerro)
    {
    ?>
        <div class="bg-white p-6 rounded-lg shadow-md mb-6 overflow-x-auto">
            <h2 class="text-2xl font-bold mb-6">Servicios de Perros</h2>
            <a href="http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=perroServicioApi&action=showFormServ">
            <?php if($_SESSION['user']['rol']=='ADMIN') echo  ' <button class="bg-blue-600 hover:bg-blue-800 text-white px-6 py-3 rounded-md mb-10">Insertar Nuevo Servicio</button>' ?>
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
                       <?php if($_SESSION['user']['rol']=='ADMIN') echo ' <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Acciones</th> ' ?>
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
                            echo "<form method='POST' action='http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=perroServicioApi&action=borrarServicioRealizadoAPerro&Sr_Cod={$serv['Sr_Cod']}' style='display:inline;'>";
                                if($_SESSION['user']['rol']=='ADMIN')   echo "<button type='submit' class='bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-md'>Borrar</button>";
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
