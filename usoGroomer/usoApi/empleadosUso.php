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
        $base_url = 'http://localhost/gromer/api/controllers/empleadosController.php';

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
    //Funcion para mostrar el formulario de creacion de clientes
    // public function showFormController($empleadosLista)
    // {
    //     $this->view->showAllEmpleados($empleadosLista);
    // }
}
