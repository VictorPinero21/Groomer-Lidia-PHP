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
        $base_url = 'http://localhost/gromer/api/controllers/clientesController.php';

        if (!$dni) {
            echo "<script>alert('DNI del cliente no proporcionado');</script>";
            return;
        }

        // Construir la URL con los parámetros requeridos
        $get_url = $base_url . '?accion=perros&dni=' . $dni;

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
        $base_url = 'http://localhost/gromer/api/controllers/perrosController.php';

        // Petición POST
        $_SERVER["REQUEST_METHOD"] = "POST";

        $post_url = $base_url;
        $ch = curl_init($post_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
        $post_response = curl_exec($ch);

        if ($post_response === false) {
            echo 'Error en la petición POST: ' . curl_error($ch);
        } else {
            $data = json_decode($post_response, true);
            $perroInsertado = $data;
        }
        curl_close($ch);
        if (isset($perroInsertado['status'])) {
            if ($perroInsertado['status'] === "success") {
                $_GET['clienteDni'] = $_POST['dni_duenio'];
                $this->mostrarPerrosPorCliente();
                return;
            }
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
