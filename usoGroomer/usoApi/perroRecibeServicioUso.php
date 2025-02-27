<?php

require_once __DIR__ . '/../views/perroRecibeServicioView.php';

class PerroRecibeServicioUso
{
    private $view;

    // Constructor de la clase . Inicializa los objetos model y view.
    public function __construct()
    {
        $this->view = new PerroRecibeServicio();
    }

    //Función mostrar servicios realizados a perros
    public function mostrarServiciosPorPerros()
    {

        // URL de la API
        $base_url = 'http://localhost:8000/api/perroservicios/';

        // Construir la URL con los parámetros requeridos
        $get_url = $base_url;

        // Iniciar cURL
        $ch = curl_init($get_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Ejecutar la solicitud
        $get_response = curl_exec($ch);

        if ($get_response === false) {
            echo 'Error en la petición GET: ' . curl_error($ch);
        }
        $data = json_decode($get_response, true);


        // Verificar si la respuesta es válida y contiene datos
        // if ($data) {
        // }
        //  else {
        //     echo "<script>alert('No se han encontrado servicios');</script>";
        // }

        // Cerrar cURL
        curl_close($ch);
        $this->view->mostrarServiciosPorPerro($data);
    }

    //Funcióon para crear un nuevo servicio realizado
    public function crearServicioRealizadoAPerro()
    {
        // URL de la API
        $base_url = 'http://localhost:8000/api/perroservicios/';

        // Asegurar que se está recibiendo una petición POST
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            echo "<script>alert('Método no permitido');</script>";
            return;
        }

        // Capturar los datos del formulario
        $data = [
            'ID_Perro' => $_POST['perro_id'] ?? null,
            'Cod_Servicio' => $_POST['servicio_id'] ?? null,
            'Fecha' => $_POST['fecha'] ?? null,
            'Dni' => $_POST['empleado_id'] ?? null,
            'Precio_Final' => $_POST['precioFinal'] ?? null,
            'Incidencias' => $_POST['incidencias'] ?? null
        ];

        // Validar que no haya valores vacíos antes de enviar a la API
        foreach ($data as $key => $value) {
            if (empty($value)) {
                echo "<script>alert('Falta el campo: $key');</script>";
                return;
            }
        }

        // Convertir los datos a JSON
        $json_data = json_encode($data);

        // Inicializar cURL
        $ch = curl_init($base_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        // Ejecutar la petición y obtener la respuesta
        $post_response = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);

        // Manejo de errores en la solicitud cURL
        if ($post_response === false) {
            echo "<script>alert('Error en la conexión con la API: $curl_error');</script>";
            return;
        }

        // Decodificar la respuesta de la API
        $response_data = json_decode($post_response, true);

        // Comprobar el estado HTTP y la respuesta
        if ($http_status == 200 && isset($response_data['mensaje'])) {
            echo "<script>alert('Servicio registrado con exito');</script>";
            echo "<script>window.location.href='http://localhost/Groomer-Lidia-PHP/usoGroomer/home.php?controller=perroRecibeServicioUso&action=mostrarServiciosPorPerros';</script>";
        } else {
            // Mostrar error detallado si la API devuelve un error
            $error_message = isset($response_data['error']) ? $response_data['error'] : "Error desconocido";
            echo "<script>alert('Error: $error_message');</script>";
            echo "<script>window.location.href='http://localhost/Groomer-Lidia-PHP/usoGroomer/home.php?controller=perroRecibeServicioUso&action=mostrarServiciosPorPerros';</script>";
        }
    }


    // Función para realizar un servicio realizado

    public function borrarServicioRealizadoAPerro()
    {
        // Verifica si Sr_Cod está presente
        $Sr_Cod = $_GET['Sr_Cod'] ?? null;
        if (!$Sr_Cod) {
            echo json_encode(["error" => "Sr_Cod no está definido."]);
            return;
        }

        // Crea la URL de la solicitud DELETE con el ID incluido
        $base_url = "http://localhost:8000/api/perroservicios/$Sr_Cod";

        // Configuración de cURL
        $ch = curl_init($base_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);

        $delete_response = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Verificar si hubo error en la ejecución de cURL
        if ($delete_response === false) {
            echo json_encode(["error" => 'Error en la petición DELETE: ' . curl_error($ch)]);
        } else {
            if ($http_status == 200) {
                echo "<script>alert('Servicio eliminado con exito');</script>";
                echo "<script> 
                    window.location.href = 'http://localhost/Groomer-Lidia-PHP/usoGroomer/home.php?controller=perroRecibeServicioUso&action=mostrarServiciosPorPerros'; 
                    </script>";
                exit;
            } else {
                echo json_encode(["error" => "Error HTTP $http_status: " . $delete_response]);
            }
        }

        curl_close($ch);
    }




    //Funcion para mostrar el formulario de creacion de servicios realizados a perros
    public function showFormServ()
    {
        $this->view->showFormServ();
    }
}
