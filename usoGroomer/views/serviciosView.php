<?php
class ServiciosView{
  
    // updatear crear y mostar Todos los servicios


    public function showServices($listaServices){
        ?>
        <div class="bg-white p-4 rounded shadow mb-4 overflow-x-auto">
            <h2 class="text-xl font-bold mb-2">Lista de Servicios</h2>
            <a href="http://localhost/gromer/front/index.php?controller=serviciosUso&action=showForm"><button>Crear Servicio</button></a>
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Codigo </th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripcion</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="serviciosLista" class="bg-white divide-y divide-gray-200">
                    <?php

                    if (is_array($listaServices)) {
                        foreach ($listaServices as $servicio) {
                            echo "<tr>";
                            echo "<td class='px-4 py-2 whitespace-nowrap'>{$servicio['Codigo']}</td>";
                            echo "<td class='px-4 py-2 whitespace-nowrap'>{$servicio['Nombre']}</td>";
                            echo "<td class='px-4 py-2 whitespace-nowrap'>{$servicio['Precio']}</td>";
                            echo "<td class='px-4 py-2 whitespace-nowrap'>{$servicio['Descripcion']}</td>";
                            // echo "<form method='POST' action='http://localhost/Proyecto_DWES/api/controllers/clientesController.php?accion=borrar' style='display:inline;'>";
                            // echo "<input type='hidden' name='dni' value='{$cliente['Dni']}'>";
                            echo "<td class='px-4 py-2 whitespace-nowrap'><a href='http://localhost/gromer/front/index.php?controller=serviciosUso&action=showEditForm&id=". $servicio['Codigo'] ."&precio=". $servicio['Precio'] ."' ><button class='bg-red-500 text-white px-4 py-2 rounded'>Editar</button></a></td>";
                            // echo "</form>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
<?php
    }
    

    public function showEdit(){
        ?>
        <div id="modal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
            <div class="bg-white p-6 rounded shadow-lg w-1/3">
                <h2 class="text-2xl font-bold mb-4 text-black">Editar Servicio</h2>
                <form id="editarServicioForm" class="space-y-4 text-left" method="POST" action="http://localhost/gromer/front/index.php?controller=serviciosUso&action=editService">
                    <div>
                        <input type="text" id="id" name="id" class="hidden" value=<?php echo $_GET['id'] ?>>
                        <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
                        <input type="number" step=0.01 id="precio" name="precio" value=<?php echo $_GET['precio'] ?> class="mt-1 block w-full border border-gray-300 dark:border-gray-700 rounded-md shadow-sm p-2 bg-white text-black">
                    </div>
                    <div class="flex justify-end">
                        <a href='http://localhost/gromer/front/index.php?controller=serviciosUso&action=showServicios'><button type="button" class="bg-gray-200 text-black px-4 py-2 rounded mr-2">Cancelar</button></a>
                        <button type="submit" class="bg-blue-500 dark:bg-blue-600 text-white px-4 py-2 rounded">Guardar Cambios</button>
                    </div>
                </form>
    <?php
    }

    public function crearServicio() {
        ?>
        <!-- Modal para crear servicios -->
        <div id="modal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
            <div class="bg-white p-6 rounded shadow-lg w-1/3">
            <h2 class="text-2xl font-bold mb-4 text-black ">Crear Servicio</h2>
            <form id="crearServicioForm" class="space-y-4 text-left" method="POST" action="http://localhost/gromer/front/index.php?controller=serviciosUso&action=createService">
                <div>
                <label for="belleza" class="block text-sm font-medium text-gray-700 ">Código</label>
                <select id="belleza" name="belleza" class="mt-1 block w-full border border-gray-300 dark:border-gray-700 rounded-md shadow-sm p-2 bg-white text-black ">
                    <option value="true">Belleza</option>
                    <option value="false">Nutrición</option>
                </select>
                </div>
                <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700 ">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="mt-1 block w-full border border-gray-300 dark:border-gray-700 rounded-md shadow-sm p-2 bg-white text-black" required>
                </div>
                <div>
                <label for="precio" class="block text-sm font-medium text-gray-700 ">Precio</label>
                <input type="number" step=0.01 id="precio" name="precio" class="mt-1 block w-full border border-gray-300 dark:border-gray-700 rounded-md shadow-sm p-2 bg-white text-black" required>
                </div>
                <div>
                <label for="descripcion" class="block text-sm font-medium text-gray-700 ">Descripción</label>
                <input type="text" id="descripcion" name="descripcion" class="mt-1 block w-full border border-gray-300 dark:border-gray-700 rounded-md shadow-sm p-2 bg-white text-black" required>
                </div>
                <div class="flex justify-end">
                <a href='http://localhost/gromer/front/index.php?controller=serviciosUso&action=showServicios'><button type="button" class="bg-gray-200 text-black  px-4 py-2 rounded mr-2">Cancelar</button></a>
                <button type="submit" class="bg-blue-500 dark:bg-blue-600 text-white px-4 py-2 rounded">Crear Servicio</button>
                </div>
            </form>
            </div>
        </div>
        <?php
    }
}