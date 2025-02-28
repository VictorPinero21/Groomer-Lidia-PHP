<?php

require_once __DIR__ . '/../views/serviciosView.php';



class serviciosApi
{
    private $view;

    public function __construct()
    {
        $this->view = new ServiciosView();
    }

    public function showServicios()
    {
        $base_url = 'http://localhost:8000/api/servicios/';

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

    public function showForm()
    {
        $this->view->crearServicio();
    }

    public function createService()
{
    $base_url = 'http://localhost:8000/api/servicios/';

    // Datos recibidos por POST del formulario
    $data = [
        'Tipo' => $_POST['belleza'],        // Asegúrate de enviar 'Tipo' como 'belleza' o 'nutrición'
        'Nombre' => $_POST['nombre'],
        'Descripcion' => $_POST['descripcion'],
        'Precio' => $_POST['precio']
    ];

    // Convertir los datos a formato JSON
    $json_data = json_encode($data);

    // Inicializar cURL
    $ch = curl_init($base_url);

    // Configurar cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data); // Usar JSON en lugar de http_build_query
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json', // Asegurar que los datos se envíen como JSON
        'Content-Length: ' . strlen($json_data) // Establecer la longitud del contenido
    ]);

    // Ejecutar la solicitud
    $post_response = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Obtener el código de estado HTTP

    if ($post_response === false) {
        echo '<script>alert("Error en la petición POST: ' . curl_error($ch) . '");</script>';
    } else {
        // Decodificar la respuesta JSON
        $response_data = json_decode($post_response, true);

        // Verificar si hubo un error
        if ($http_status != 200 || isset($response_data['error'])) {
            $error_message = $response_data['error'] ?? 'Error desconocido';
            echo '<script>alert("Error: ' . $error_message . '");</script>';
        } else {
            // Si el servicio se creó correctamente
            echo '<script>
                alert("Servicio creado exitosamente.");
                window.location.href = "http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=serviciosApi&action=showServicios";
            </script>';
        }
    }

    curl_close($ch);
}


    public function editService()
    {
        // URL base de la API para editar el servicio
        $base_url = 'http://localhost:8000/api/servicios/' . $_POST['id'];
    
        // Datos que se van a actualizar
        $data = [
            'Codigo' => $_POST['id'] ?? null,  // ✅ Correcto
            'Precio' => $_POST['precio'] ?? null // ✅ Correcto
        ];
    
        // Inicializar cURL
        $ch = curl_init($base_url);
    
        // Configurar cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        
        // Enviar datos como JSON
        $json_data = json_encode($data);  // Codificar los datos a JSON
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',  // Asegurar que se envíen como JSON
            'Content-Length: ' . strlen($json_data)  // Establecer el tamaño del contenido
        ]);
    
        // Ejecutar la solicitud cURL
        $put_response = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);  // Obtener el código de estado HTTP
        curl_close($ch);
    
        // Manejar posibles errores de cURL
        if ($put_response === false) {
            echo '<script>alert("Error en la petición PUT: ' . curl_error($ch) . '");</script>';
        } else {
            // Decodificar la respuesta JSON
            $response_data = json_decode($put_response, true);
            
            // Verificar el código de estado HTTP
            if ($http_status != 200) {
                $error_message = isset($response_data['error']) ? $response_data['error'] : 'Error desconocido';
                echo '<script>alert("Error: ' . $error_message . '");</script>';
            } else {
                // Si la actualización fue exitosa
                echo '<script>alert("Servicio editado exitosamente."); 
                      window.location.href = "http://localhost/Groomer-Lidia-PHP/usoGroomer/views/home.php?controller=serviciosApi&action=showServicios"; 
                      </script>';
            }
        }
    }
    

    public function showEditForm()
    {
        $this->view->showEdit();
    }
}
