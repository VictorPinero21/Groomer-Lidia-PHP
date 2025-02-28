<?php

require_once __DIR__ . '/../views/perrosView.php';



class perrosApi
{
    private $view;
    private $clientes;

    // Constructor de la clase . Inicializa los objetos model y view.
    public function __construct()
    {
        $this->view = new PerrosView();
        // $this->clientes = new Clientes();
    }

    public function mostrarPerrosPorCliente()
    {
        $dni = $_GET['clienteDni'];
    
        // URL de la API
        $base_url = 'http://localhost:8000/api/perros/';
    
        // Construir la URL con los parámetros requeridos
        $get_url = $base_url . $dni;
    
        // Iniciar cURL
        $ch = curl_init($get_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        // Ejecutar la solicitud
        $get_response = curl_exec($ch);
        curl_close($ch); // Cerramos la conexión cURL después de la ejecución
    
        // Si la respuesta está vacía o hay un error
        if ($get_response === false || empty($get_response)) {
            echo "<script>
                    alert('Error al conectar con la API.');
                    window.location.href = 'http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php';
                  </script>";
            return;
        }
    
        // Intentar decodificar JSON
        $data = json_decode($get_response, true);
    
        // Verificar si hay un error en la respuesta
        // if (isset($data["error"])) {
        //     echo "<p class='text-red-500 text-lg font-bold'>{$data['error']}</p>";
        // } else {
        //     // Llamar a la vista para mostrar los perros
        //     $this->view->mostrarPerrosPorCliente($data);
        // }
        $this->view->mostrarPerrosPorCliente($data);
    }
    
    
    
    

    public function crearPerro()
    {
        // URL de la API
        $base_url = 'http://localhost:8000/api/perros/';
        
        // Verificar si hay datos en $_POST
        if (empty($_POST)) {
            echo "<script>alert('Error: No se recibieron datos para crear el perro.'); window.location.href='http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php';</script>";
            die();
        }
    
        // Convertir $_POST a JSON
        $post_data = json_encode($_POST);
    
        // Inicializar cURL
        $ch = curl_init($base_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json'
        ]);
    
        // Ejecutar la petición y obtener la respuesta
        $post_response = curl_exec($ch);
    
        // Manejar errores de cURL
        if ($post_response === false) {
            echo "<script>alert('Error en la petición POST: " . curl_error($ch) . "'); window.location.href='http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php';</script>";
            curl_close($ch);
            die();
        }
    
        // Obtener código de respuesta HTTP
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        // Decodificar la respuesta JSON
        $data = json_decode($post_response, true);
    
        // Si la API devuelve un error
        if (isset($data['error'])) {
            echo "<script>alert('Error: " . $data['error'] . "'); window.location.href='http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php';</script>";
            die();
        }
    
        // Si la API devuelve un mensaje de éxito
        if (isset($data['mensaje'])) {
            if (is_array($data['mensaje'])) {
                $mensaje = implode("\\n", $data['mensaje']);
            } else {
                $mensaje = $data['mensaje'];
            }
    
            // Obtener el DNI del dueño para la redirección
            $dni_duenio = isset($_POST['Dni_duenio']) ? $_POST['Dni_duenio'] : '';
    
            echo "<script>
                alert('" . $mensaje . "');
                window.location.href='http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=perrosApi&action=mostrarPerrosPorCliente&clienteDni=" . $dni_duenio . "';
            </script>";
            die();
        } else {
            echo "<script>alert('Error inesperado: La API no devolvió una respuesta válida.'); window.location.href='http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php';</script>";
            die();
        }
    }
    

    
    
    

    

    public function deletePerro()
    {
        if (!isset($_POST['Numero_Chip']) || !isset($_POST['Dni_duenio'])) {
            echo "<script>alert('Error: Datos incompletos para eliminar el perro.'); window.history.back();</script>";
            return;
        }
    
        $chip = $_POST['Numero_Chip'];
        $dni_duenio = $_POST['Dni_duenio']; // Para redirección tras eliminar
    
        // URL de la API con el número de chip
        $base_url = "http://localhost:8000/api/perros/$chip";
    
        // Configurar cURL para una petición DELETE
        $ch = curl_init($base_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); // Método DELETE
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']); // Encabezados
    
        // Ejecutar la solicitud
        $response = curl_exec($ch);
    
        // Manejo de errores de cURL
        if ($response === false) {
            echo "<script>alert('Error en la petición DELETE: " . curl_error($ch) . "'); window.history.back();</script>";
            curl_close($ch); // Asegurarse de cerrar el recurso cURL
            return;
        }
    
        // Cerrar cURL después de recibir la respuesta
        curl_close($ch);
    
        // Decodificar la respuesta JSON
        $data = json_decode($response, true);
    
        // Validar respuesta y manejar errores
        if (isset($data[0]['mensaje'])) {
            // Si la respuesta contiene el mensaje esperado
            $mensaje = $data[0]['mensaje'];
            echo "<script>
                alert('" . addslashes($mensaje) . "');
                window.location.href='http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=perrosApi&action=mostrarPerrosPorCliente&clienteDni=" . urlencode($dni_duenio) . "';
            </script>";
        } else {
            // Si no se recibió el mensaje esperado, es posible que haya un error
            echo "<script>alert('Error desconocido al eliminar el perro.'); window.history.back();</script>";
        }
    }
    
    

    



    //Funcion para mostrar el formulario de creacion de clientes
    public function showFormController()
    {
        $this->view->mostrarFormularioCrearPerro();
    }
}
