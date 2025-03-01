<?php


require_once __DIR__ . '/../views/empleadosView.php';

class empleadosApi
{
    private $view;
    private $empleados;


    // Constructor de la clase empleadosController. Inicializa el view.
    public function __construct()
    {
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
        }
        curl_close($ch);

        $this->view->showAllEmpleados($empleadosLista);
    }
    public function showFormController()
    {
        $view = new EmpleadosView();
        $view->showAddEmpleadoForm();
    }
    public function deleteEmpleado()
    {
        if (!isset($_GET['dni']) || empty(trim($_GET['dni']))) {
            echo "<script>alert('Error: Se requiere el DNI para eliminar el empleado.');</script>";
            $this->showClientes();
            return;
        }
    
        $dni = $_GET['dni'];
        $base_url = "http://localhost:8000/api/empleados/{$dni}"; // URL de la API con el DNI
    
        // Iniciar la solicitud cURL
        $ch = curl_init($base_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); // Método DELETE
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    
        // Ejecutar la petición
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        // Manejo de errores
        if ($response === false) {
            echo "<script>alert('Error en la solicitud: " . curl_error($ch) . "');</script>";
            curl_close($ch);
            return;
        }
    
        curl_close($ch);
    
        // Verificar código de respuesta HTTP
        if ($http_code !== 200) {
            echo "<script>alert('Error: La API devolvió un código de estado HTTP {$http_code}. Respuesta: {$response}');</script>";
            return;
        }
    
        // Mostrar alerta de eliminación y redireccionar
        echo "<script>
                alert('Usuario con DNI " . $dni . " eliminado');
                window.location.href='http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=empleadosApi&action=showEmpleados';
              </script>";
        exit();
    }
    
    


    public function addEmpleado()
    {
        $base_url = 'http://localhost:8000/api/empleados/'; 
    
        // Recopilar datos del formulario
        $post_data = array(
            'Dni' => $_POST['dni'],
            'Email' => $_POST['email'],
            'Password' => $_POST['password'],
            'Rol' => $_POST['rol'],
            'Nombre' => $_POST['nombre'],
            'Apellido1' => $_POST['apellido1'],
            'Apellido2' => $_POST['apellido2'],
            'Calle' => $_POST['calle'],
            'Numero' => $_POST['numero'],
            'Cp' => $_POST['cp'],
            'Poblacion' => $_POST['poblacion'],
            'Provincia' => $_POST['provincia'],
            'Tlfno' => $_POST['tlfno'],
            'Profesion' => $_POST['profesion'],
        );
    
        // Iniciar la solicitud cURL
        $ch = curl_init($base_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    
        // Ejecutar la petición
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        // Manejo de errores
        if ($response === false || $http_code !== 200) {
            echo "<script>alert('Error en la solicitud: " . curl_error($ch) . "');</script>";
            curl_close($ch);
            return;
        }
    
        curl_close($ch);
    
        // Decodificar la respuesta JSON
        $data = json_decode($response, true);
    
        // Verificar el mensaje de la respuesta
        if (isset($data['mensaje']['error'])) {
            echo "<script>alert('" . $data['mensaje']['error'] . "');</script>";
            echo "<script>window.location.href='http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=empleadosApi&action=showEmpleados';</script>";
        } elseif (isset($data['mensaje']['mensaje'])) {
            echo "<script>alert('" . $data['mensaje']['mensaje'] . "');</script>";
            echo "<script>window.location.href='http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=empleadosApi&action=showEmpleados';</script>";
        } else {
            echo "<script>alert('Error inesperado: respuesta no válida.');</script>";
            echo "<script>window.location.href='http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=empleadosApi&action=showEmpleados';</script>";
        }
        exit();
    }
    
    

    
    public function editEmpleado()
    {
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
    
        // Verificar si la respuesta contiene un error
        if (!$empleado || isset($empleado['error'])) {
            echo "<script>
            alert('Empleado no encontrado.');
            window.location.href = 'http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=empleadosApi&action=showEmpleados';
          </script>";
    
            return;
        }
    
        // Muestra la vista con los datos del empleado
        $view = new EmpleadosView();
        $view->showEmpleado($empleado);  
    }
    
    function obtenerEmpleadoDesdeAPI($url)
    {
        // Iniciar la sesión cURL
        $ch = curl_init();
    
        // Configurar las opciones de cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
    
        // Ejecutar la consulta
        $response = curl_exec($ch);
    
        // Verificar si hubo errores en la consulta
        if (curl_errno($ch)) {
            echo 'Error de cURL: ' . curl_error($ch);
            curl_close($ch);
            return null;
        }
    
        curl_close($ch);
    
        // Verificar si la respuesta es vacía o nula
        if (!$response) {
            echo "Error: La API no devolvió una respuesta válida.";
            return null;
        }
    
        // Decodificar la respuesta JSON
        $empleadoData = json_decode($response, true);
    
        // Verificar si la decodificación fue exitosa
        if ($empleadoData === null) {
            echo "Error al decodificar la respuesta JSON.";
            return null;
        }
    
        // Verificar si la API devolvió un error
        if (isset($empleadoData['error'])) {
            return null;
        }
    
        return $empleadoData;
    }
    
    
    
    
    
    
    
}

