<?php

require_once __DIR__ . '/../views/serviciosView.php';



class ServiciosUso
{
    private $view;

    public function __construct()
    {
        $this->view = new ServiciosView();
    }

    public function showServicios()
    {
        $base_url = 'http://localhost/gromer/api/controllers/servicioController.php';

        // Petición GET
        $get_url = $base_url;
        $ch = curl_init($get_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        $get_response = curl_exec($ch);
        if ($get_response === false) {
            echo 'Error en la petición GET: ' . curl_error($ch);
        } else {
            $data = json_decode($get_response, true);
            $serviciosLista = $data;
        }
        curl_close($ch);

        $this->view->showServices($serviciosLista);
    }
    
    public function showForm() {
        $this->view->crearServicio();
    }

    public function createService(){
        $base_url = 'http://localhost/gromer/api/controllers/servicioController.php';

        // Datos recibidos por POST del formulario
        $data = [
            'belleza' => $_POST['belleza'],
            'nombre' => $_POST['nombre'],
            'descripcion' => $_POST['descripcion'],
            'precio' => $_POST['precio']
        ];

        // Petición POST
        $ch = curl_init($base_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $post_response = curl_exec($ch);
        if ($post_response === false) {
            echo '<script>alert("Error en la petición POST: ' . curl_error($ch) . '");</script>';
        } else {
            $response_data = json_decode($post_response, true);
            if (isset($response_data['error'])) {
            echo '<script>alert("Error: ' . $response_data['error'] . '");</script>';
            } else {
            echo '<script>
            alert("Servicio creado exitosamente.");
            window.location.href = "http://localhost/gromer/front/index.php?controller=serviciosUso&action=showServicios";
            </script>';
            }
        }
        curl_close($ch);
        
    }

    public function editService()
    {
        $base_url = 'http://localhost/gromer/api/controllers/servicioController.php';

        // Datos recibidos por POST del formulario
        $data = [
            'id' => $_POST['id'],
            'precio' => $_POST['precio']
        ];

        // Petición PUT
        $ch = curl_init($base_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        $put_response = curl_exec($ch);
        if ($put_response === false) {
            echo '<script>alert("Error en la petición PUT: ' . curl_error($ch) . '");</script>';
        } else {
            $response_data = json_decode($put_response, true);
            if (isset($response_data['error'])) {
                echo '<script>alert("Error: ' . $response_data['error'] . '");</script>';
            } else {
                echo '<script>alert("Servicio editado exitosamente."); 
                window.location.href = "http://localhost/gromer/front/index.php?controller=serviciosUso&action=showServicios";
            </script>';
            }
        }
        curl_close($ch);
    }

    public function showEditForm()
    {
        $this->view->showEdit();
    }

}
