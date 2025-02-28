<?php

class PerrosView
{

    public function mostrarFormularioCrearPerro()
    {
?>
<div id="modal" class="fixed inset-0 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Crear un nuevo perro</h2>
            <form id="crearNuevoPerro" class="space-y-4" method="POST" action="http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=perrosUso&action=crearPerro">
                
                <input type="hidden" required value="<?php if (isset($_GET['clienteDni'])) echo $_GET['clienteDni']; ?>" id="dni" name="Dni_duenio">

                <div>
                    <label for="Nombre" class="block text-sm font-medium text-gray-700">Nombre:</label>
                    <input type="text" required id="Nombre" name="Nombre" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{2,50}" 
                        title="Solo letras, mínimo 2 y máximo 50 caracteres"
                        class="mt-1 block w-full border border-gray-300 text-black rounded-md shadow-sm p-2" placeholder="Ej: Max">
                </div>

                <div>
                    <label for="Fecha_Nto" class="block text-sm font-medium text-gray-700">Fecha de nacimiento:</label>
                    <input type="date" required id="Fecha_Nto" name="Fecha_Nto" max="<?= date('Y-m-d'); ?>" 
                        class="mt-1 block w-full border border-gray-300 text-black rounded-md shadow-sm p-2">
                </div>

                <div>
                    <label for="Raza" class="block text-sm font-medium text-gray-700">Raza:</label>
                    <input type="text" required id="Raza" name="Raza" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{2,50}" 
                        title="Solo letras, mínimo 2 y máximo 50 caracteres"
                        class="mt-1 block w-full border border-gray-300 text-black rounded-md shadow-sm p-2" placeholder="Ej: Labrador">
                </div>

                <div>
                    <label for="Peso" class="block text-sm font-medium text-gray-700">Peso (kg):</label>
                    <input type="number" required id="Peso" name="Peso" min="0.1" step="0.1" 
                        title="Debe ser un número positivo mayor a 0" 
                        class="mt-1 block w-full border border-gray-300 text-black rounded-md shadow-sm p-2" placeholder="Ej: 12.5">
                </div>

                <div>
                    <label for="Altura" class="block text-sm font-medium text-gray-700">Altura (cm):</label>
                    <input type="number" required id="Altura" name="Altura" min="1" step="0.1" 
                        title="Debe ser un número positivo mayor a 1 cm" 
                        class="mt-1 block w-full border border-gray-300 text-black rounded-md shadow-sm p-2" placeholder="Ej: 50">
                </div>

                <div>
                    <label for="Observaciones" class="block text-sm font-medium text-gray-700">Observaciones:</label>
                    <input type="text" id="Observaciones" name="Observaciones" maxlength="255" 
                        title="Máximo 255 caracteres" 
                        class="mt-1 block w-full border border-gray-300 text-black rounded-md shadow-sm p-2" placeholder="Ej: Muy juguetón">
                </div>

                <div>
                    <label for="Numero_Chip" class="block text-sm font-medium text-gray-700">Número de chip:</label>
                    <input type="text" required id="Numero_Chip" name="Numero_Chip" pattern="\d{5,15}" 
                        title="Solo números, entre 5 y 15 dígitos" 
                        class="mt-1 block w-full border border-gray-300 text-black rounded-md shadow-sm p-2" placeholder="Ej: 123456789">
                </div>

                <div>
                    <label for="Sexo" class="block text-sm font-medium text-gray-700">Sexo:</label>
                    <select name="Sexo" id="Sexo" required 
                        class="mt-1 block w-full border border-gray-300 text-black rounded-md shadow-sm p-2">
                        <option selected disabled value="">Seleccione una opción</option>
                        <option value="Macho">Macho</option>
                        <option value="Hembra">Hembra</option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <a href="http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=perrosUso&action=mostrarPerrosPorCliente&clienteDni=<?php if (isset($_GET['clienteDni'])) echo $_GET['clienteDni']; ?>">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancelar</button>
                    </a>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Registrar Nuevo Perro</button>
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
            <a href="http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=perrosUso&action=showFormController&clienteDni=<?php if (isset($_GET['clienteDni'])) echo $_GET['clienteDni']; ?>"><button class="bg-green-500 text-white px-4 py-2 rounded m-4 dark:bg-green-700">Insertar nuevo perro</button></a>
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
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
        </tr>
    </thead>
    <tbody id="listaPerros" class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
        <?php
        if (isset($perrosCliente[0]['Dni_duenio'])) {
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
                echo "<form method='POST' action='http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=perrosUso&action=deletePerro' style='display:inline;'>";
                echo "<input type='hidden' name='Numero_Chip' value='{$perro['Numero_Chip']}'>";
                echo "<input type='hidden' name='Dni_duenio' value='{$perro['Dni_duenio']}'>";
                echo "<button type='submit' class='bg-red-500 text-white px-4 py-2 rounded dark:bg-red-700'>Borrar</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            // Si no hay perros, mostrar mensaje de error dentro de la tabla
            echo "<tr><td colspan='10' class='px-4 py-2 text-red-500 text-lg font-bold text-center'>No hay perros registrados</td></tr>";
        }

        // Verificar si hay un error en la respuesta de la API
        if (isset($data["error"])) {
            // echo "<tr><td colspan='10' class='px-4 py-2 text-red-500 text-lg font-bold text-center'>{$data['error']}</td></tr>";
        }
        ?>
    </tbody>
</table>
        </div>
        </div>
<?php
                    
                }
            }
        