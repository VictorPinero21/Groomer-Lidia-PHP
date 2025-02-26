<?php

class PerrosView
{

    public function mostrarFormularioCrearPerro()
    {
?>
        <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center dark:bg-gray-900 dark:bg-opacity-80">
            <div class="bg-white dark:bg-black p-4 rounded shadow-lg w-1/2 dark:bg-gray-800">
                <h2 class="text-xl font-bold mb-2 dark:text-white">Crear un nuevo perro</h2>
                <form id="crearNuevoPerro" class="space-y-4" method="POST" action="http://localhost/gromer/front/index.php?controller=perrosUso&action=crearPerro">
                    <div>
                        <label for="dni" class="block text-sm font-medium text-gray-700 dark:text-gray-300">DNI del dueño:</label>
                        <input type="text" required value="<?php if (isset($_GET['clienteDni'])) echo $_GET['clienteDni']; ?>" id="dni" name="dni_duenio" class="mt-1 block w-full border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-md shadow-sm p-2">
                    </div>
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre:</label>
                        <input type="text" required id="nombre" name="nombre" class="mt-1 block w-full border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-md shadow-sm p-2">
                    </div>
                    <div>
                        <label for="fecha_nto" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha de nacimiento:</label>
                        <input type="date" required id="fecha_nto" name="fecha_nto" class="mt-1 block w-full border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-md shadow-sm p-2">
                    </div>
                    <div>
                        <label for="raza" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Raza:</label>
                        <input type="text" required id="raza" name="raza" class="mt-1 block w-full border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-md shadow-sm p-2">
                    </div>
                    <div>
                        <label for="peso" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Peso:</label>
                        <input type="text" required id="peso" name="peso" class="mt-1 block w-full border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-md shadow-sm p-2">
                    </div>
                    <div>
                        <label for="altura" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Altura:</label>
                        <input type="text" required id="altura" name="altura" class="mt-1 block w-full border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-md shadow-sm p-2">
                    </div>
                    <div>
                        <label for="observaciones" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Observaciones:</label>
                        <input type="text" required id="observaciones" name="observaciones" class="mt-1 block w-full border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-md shadow-sm p-2">
                    </div>
                    <div>
                        <label for="numero_chip" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Numero de chip:</label>
                        <input type="text" required id="numero_chip" name="numero_chip" class="mt-1 block w-full border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-md shadow-sm p-2">
                    </div>
                    <div>
                        <label for="sexo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sexo:</label>
                        <select name="sexo" id="sexo" class="mt-1 block w-full border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white rounded-md shadow-sm p-2">
                            <option value=""> --- </option>
                            <option value="Macho">Macho</option>
                            <option value="Hembra">Hembra</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <a href="http://localhost/gromer/front/index.php?controller=perrosUso&action=mostrarPerrosPorCliente&clienteDni=<?php if (isset($_GET['clienteDni'])) echo $_GET['clienteDni']; ?>"><button type="button" class="bg-gray-500 text-white px-4 py-2 rounded mr-2 dark:bg-gray-700">Cancelar</button></a>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded dark:bg-blue-700">Registrar Nuevo Perro</button>
                    </div>
                </form>
            </div>
        </div>

    <?php
    }

    public function mostrarPerrosPorCliente($perrosCliente)
    {
    ?>

        <!-- Lista de clientes -->
        <div class="bg-white p-4 rounded shadow mb-4 overflow-x-auto dark:bg-gray-800">
            <h2 class="text-xl font-bold mb-2 dark:text-purple-400">Lista de Perros</h2>
            <a href="http://localhost/gromer/front/index.php?controller=perrosUso&action=showFormController&clienteDni=<?php if (isset($_GET['clienteDni'])) echo $_GET['clienteDni']; ?>"><button class="bg-green-500 text-white px-4 py-2 rounded m-4 dark:bg-green-700">Insertar nuevo perro</button></a>
            <table class="min-w-full divide-y divide-gray-200 text-sm dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">DNI del dueño</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha de nacimiento</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Raza</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Peso</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Altura</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Observaciones</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Número de chip</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Sexo</th>
                    </tr>
                </thead>
                <tbody id="listaPerros" class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    <?php

                    if (is_array($perrosCliente)) {
                        foreach ($perrosCliente as $perro) {
                            echo "<tr>";
                            echo "<td class='px-4 py-2 whitespace-nowrap dark:text-gray-300'>{$perro['Dni_duenio']}</td>";
                            echo "<td class='px-4 py-2 whitespace-nowrap dark:text-gray-300'>{$perro['Nombre']}</td>";
                            echo "<td class='px-4 py-2 whitespace-nowrap dark:text-gray-300'>{$perro['Fecha_Nto']}</td>";
                            echo "<td class='px-4 py-2 whitespace-nowrap dark:text-gray-300'>{$perro['Raza']}</td>";
                            echo "<td class='px-4 py-2 whitespace-nowrap dark:text-gray-300'>{$perro['Peso']}</td>";
                            echo "<td class='px-4 py-2 whitespace-nowrap dark:text-gray-300'>{$perro['Altura']}</td>";
                            echo "<td class='px-4 py-2 whitespace-nowrap dark:text-gray-300'>{$perro['Observaciones']}</td>";
                            echo "<td class='px-4 py-2 whitespace-nowrap dark:text-gray-300'>{$perro['Numero_Chip']}</td>";
                            echo "<td class='px-4 py-2 whitespace-nowrap dark:text-gray-300'>{$perro['Sexo']}</td>";
                            echo "<td class='px-4 py-2 whitespace-nowrap'>";
                            echo "<form method='POST' action='http://localhost/gromer/front/index.php?controller=perrosUso&action=deletePerro' style='display:inline;'>";
                            echo "<input type='hidden' name='chip' value='{$perro['Numero_Chip']}'>";
                            echo "<input type='hidden' name='dni_duenio' value='{$perro['Dni_duenio']}'>";
                            echo "<button type='submit' class='bg-red-500 text-white px-4 py-2 rounded dark:bg-red-700'>Borrar</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        </div>
<?php
                    }
                }
            }
