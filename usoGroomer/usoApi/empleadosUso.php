<?php


require_once __DIR__ . '/../views/empleadosView.php';
//Incluir el archivo
//  require_once __DIR__ . './../../api/controllers/empleadosController.php';

class EmpleadosUso
{
    private $view;
    private $empleados;


    // Constructor de la clase empleadosController. Inicializa el view.
    public function __construct()
    {
        //QUITAR COMENTARIO
        $this->view = new EmpleadosView();
    }

    // Función para crear un nuevo empleado
    public function showEmpleados()
    {
        // URL base de la API local
        $base_url = 'http://localhost:8000/api/empleados/';

        // Petición GET
        $get_url = $base_url . '?accion=listarEmpleados';
        $ch = curl_init($get_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        $get_response = curl_exec($ch);
        if ($get_response === false) {
            echo 'Error en la petición GET: ' . curl_error($ch);
        } else {
            $data = json_decode($get_response, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $empleadosLista = $data;
            } else {
                echo 'Error al decodificar la respuesta JSON: ' . json_last_error_msg();
                $empleadosLista = [];
            }
            // $empleadosLista = $data;
        }
        curl_close($ch);
        // print_r($clientesLista);

        $this->view->showAllEmpleados($empleadosLista);
    }
    public function showFormController()
    {
        $view = new EmpleadosView();
        $view->showAddEmpleadoForm(); // Asegúrate de que esta función existe en la vista
    }
    public function editEmpleado()
    {
        // Aquí deberías obtener el ID del empleado desde la URL
        $dni = $_GET['dni'] ?? null;

        if ($dni) {
            $empleadoModel = new EmpleadoModel();
            $empleado = $empleadoModel->getEmpleadoById($dni);

            if ($empleado) {
                $view = new EmpleadosView();
                $view->showEditEmpleadoForm($empleado);
            } else {
                echo "Empleado no encontrado.";
            }
        } else {
            echo "ID de empleado no proporcionado.";
        }
    }



  
    public function getEmpleado() {
        // Verifica si se ha proporcionado el DNI
        if (!isset($_GET["dni"]) || empty($_GET["dni"])) {
            echo "No se ha proporcionado un DNI";
            return;
        }
    
        $dni = $_GET["dni"];
 
    
        // Construir la URL para la API externa utilizando el DNI
        $url = "http://localhost:8000/api/empleados/" . urlencode($dni);
    
        // Obtener los datos del empleado
        $empleado = $this->obtenerEmpleadoDesdeAPI($url);
    
        if ($empleado) {
            // Muestra la vista con los datos del empleado
            $view = new EmpleadosView();
            $view->showEmpleado($empleado);  // Mostrar solo un empleado
        } else {
            echo "Empleado no encontrado.";
        }
    }
    
    function obtenerEmpleadoDesdeAPI($url)
    {
        // Iniciar la sesión cURL
        $ch = curl_init();
    
        // Configurar las opciones de cURL
        curl_setopt($ch, CURLOPT_URL, $url); // URL de la API
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retornar el resultado como string
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Seguir redirecciones
        curl_setopt($ch, CURLOPT_HEADER, false); // No incluir cabeceras en la respuesta
    
        // Ejecutar la consulta
        $response = curl_exec($ch);
    
        // Verificar si hubo errores en la consulta
        if(curl_errno($ch)) {
            echo 'Error de cURL: ' . curl_error($ch);
            curl_close($ch);
            return null;
        }
    
        // Cerrar la sesión cURL
        curl_close($ch);
    
        // Decodificar la respuesta JSON
        $empleadoData = json_decode($response, true);
    
        // Verificar si la decodificación fue exitosa
        if ($empleadoData === null) {
            echo "Error al decodificar la respuesta JSON.";
            return null;
        }
    
        return $empleadoData;
    }
    
    
    
    
    
    
    
    
}

