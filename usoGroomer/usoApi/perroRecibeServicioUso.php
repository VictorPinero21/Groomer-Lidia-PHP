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
        $base_url = 'http://localhost/gromer/api/controllers/perrorecibeservicioController.php?action=listarPerroRecibeServicio';

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
        $base_url = 'http://localhost/gromer/api/controllers/perrorecibeservicioController.php';


        // Datos del formulario
        $data = [
            'perro_id' => $_POST['perro_id'] ?? null,
            'servicio_id' => $_POST['servicio_id'] ?? null,
            'fecha' => $_POST['fecha'] ?? null,
            'empleado_id' => $_POST['empleado_id'] ?? null,
            'precioFinal' => $_POST['precioFinal'] ?? null,
            'incidencias' => $_POST['incidencias'] ?? null,
        ];

        // Convertir los datos a JSON
        $json_data = json_encode($data);

        // Petición POST
        $_SERVER["REQUEST_METHOD"] = "POST";

        $post_url = $base_url;
        $ch = curl_init($post_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',  // Asegura que el servidor reciba los datos como JSON
            'Content-Length: ' . strlen($json_data)  // Longitud del contenido
        ]);
        $post_response = curl_exec($ch);

        if ($post_response === false) {
            echo 'Error en la petición POST: ' . curl_error($ch);
        } else {
            $data = json_decode($post_response, true);
            $servicioHechoInsertado = $data;
        }
        curl_close($ch);
        if (isset($servicioHechoInsertado['status'])) {
            if ($servicioHechoInsertado['status'] === "success") {
                echo "<script>alert('" . $servicioHechoInsertado['message'] . "');</script>";
                $this->mostrarServiciosPorPerros();
                return;
            }
        }
    }

    // Función para realizar un servicio realizado

    public function borrarServicioRealizadoAPerro()
    {

        // Verifica si Sr_Cod está presente
        $Sr_Cod = $_GET['Sr_Cod'] ?? null;
        if (!$Sr_Cod) {
            echo "Error: Sr_Cod no está definido.\n";
            return;
        }


        // Crea la URL de la solicitud DELETE
        $base_url = 'http://localhost/gromer/api/controllers/perrorecibeservicioController.php';
        $data = ['id' => $Sr_Cod];
        $json_data = json_encode($data);

        // Configuración de cURL
        $ch = curl_init($base_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json_data)
        ]);

        $delete_response = curl_exec($ch);

        // Verificar si hubo error en la ejecución de cURL
        if ($delete_response === false) {
            echo 'Error en la petición DELETE: ' . curl_error($ch) . "\n";
        } else {
            $data = json_decode($delete_response, true);
            $this->mostrarServiciosPorPerros();
        }

        curl_close($ch);
    }



    //Funcion para mostrar el formulario de creacion de servicios realizados a perros
    public function showFormServ()
    {
        $this->view->showFormServ();
    }
}
