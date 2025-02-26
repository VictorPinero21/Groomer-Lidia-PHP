<?php

require_once __DIR__ . '/../views/perrosView.php';



class PerrosUso
{
    private $view;
    private $clientes;

    // Constructor de la clase . Inicializa los objetos model y view.
    public function __construct()
    {
        $this->view = new PerrosView();
        // $this->clientes = new Clientes();
    }

    //Función mostrar perros por cliente
    public function mostrarPerrosPorCliente()
    {
        $dni = $_GET['clienteDni'];

        // URL de la API
        $base_url = 'http://localhost:8000/api/perros/';

        if (!$dni) {
            echo "<script>alert('DNI del cliente no proporcionado');</script>";
            return;
        }

        // Construir la URL con los parámetros requeridos
        $get_url = $base_url  . $dni;

        // Iniciar cURL
        $ch = curl_init($get_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Ejecutar la solicitud
        $get_response = curl_exec($ch);

        if ($get_response === false) {
            echo 'Error en la petición GET: ' . curl_error($ch);
        } else {
            $data = json_decode($get_response, true);

            // Verificar si la respuesta es válida y contiene datos
            if ($data) {
                $this->view->mostrarPerrosPorCliente($data);
            } else {
                echo "<script>alert('No se encontraron perros para este cliente o hubo un error en la respuesta');</script>";
            }
        }

        // Cerrar cURL
        curl_close($ch);
    }

    //Funcióon para crear un nuevo perro
    public function crearPerro()
    {
        // URL de la API
        $base_url = 'http://localhost:8000/api/perros/';
    
        // Verificar si hay datos en $_POST
        if (empty($_POST)) {
            echo "Error: No se recibieron datos para crear el perro.";
            return;
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
    
        // Ejecutar petición y obtener respuesta
        $post_response = curl_exec($ch);
    
        // Manejar errores de cURL
        if ($post_response === false) {
            echo 'Error en la petición POST: ' . curl_error($ch);
            curl_close($ch);
            return;
        }
    
        // Obtener código de respuesta HTTP
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        // Decodificar respuesta JSON
        $data = json_decode($post_response, true);
    
        // Verificar si la API respondió correctamente
        if ($http_code !== 201 && $http_code !== 200) {
            echo "Error en la API: " . ($data['message'] ?? 'Respuesta inesperada.');
            return;
        }
    
        // Verificar si la API devolvió éxito
        if (isset($data['mensaje'])) {
            if (is_array($data['mensaje'])) {
                // Si el mensaje es un array, significa que se insertó correctamente
                echo $data['mensaje'][0]; // Muestra el mensaje de éxito
                if (!empty($_POST['Dni'])) {
                    $_GET['clienteDni'] = $_POST['Dni_duenio'];
                    $this->mostrarPerrosPorCliente();
                } else {
                    echo "Perro creado, pero no se proporcionó DNI del dueño.";
                }
            } elseif (isset($data['mensaje']['error'])) {
                // Si existe un mensaje de error
                echo "Error: " . $data['mensaje']['error'];
            } else {
                echo "Respuesta inesperada de la API.";
            }
        } else {
            echo "Error en la creación del perro.";
        }
        
    }
    

    public function deletePerro()
    {
        if (!isset($_POST['chip'])) {
            echo "<script>alert('Error: No se recibió el número de chip');</script>";
            return;
        }

        $chip = $_POST['chip'];
        $dni_duenio = $_POST['dni_duenio']; // Para recargar la lista después

        // URL de la API
        $base_url = 'http://localhost/gromer/api/controllers/perrosController.php';

        // Configurar cURL para una petición DELETE
        $ch = curl_init($base_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); // Especificamos DELETE
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['chip' => $chip])); // Enviamos JSON
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']); // Encabezados

        // Ejecutar la solicitud
        $response = curl_exec($ch);

        if ($response === false) {
            echo 'Error en la petición DELETE: ' . curl_error($ch);
        } else {
            $data = json_decode($response, true);

            if (isset($data['status']) && $data['status'] === "success") {
                echo "<script>alert('Perro eliminado correctamente');</script>";
            } else {
                echo "<script>alert('Error al eliminar el perro: " . ($data['error'] ?? 'Desconocido') . "');</script>";
            }
        }

        // Cerrar cURL
        curl_close($ch);

        // Volver a cargar la lista de perros del cliente
        $_GET['clienteDni'] = $dni_duenio;
        $this->mostrarPerrosPorCliente();
    }



    //Funcion para mostrar el formulario de creacion de clientes
    public function showFormController()
    {
        $this->view->mostrarFormularioCrearPerro();
    }
}
