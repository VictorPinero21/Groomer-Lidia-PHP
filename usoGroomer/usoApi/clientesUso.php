<?php

require_once __DIR__ . '/../views/clientesView.php';
//Incluir el archivo de servicios
// require_once __DIR__ . '../../../api/services/Clientes.php';



class ClientesUso
{
    private $view;
    // private $clientes;

    // Constructor de la clase . Inicializa los objetos model y view.
    public function __construct()
    {
        $this->view = new ClientesView();
        // $this->clientes = new Clientes();
    }
    //Funcion para obtener un cliente
    public function getCliente()
    {          
        // URL base de la API local
        $base_url = 'http://localhost:8000/api/clientes';

        // Petición GET
        $get_url = $base_url . '?accion=obtener&dni=' . $_POST['dni'];
        $ch = curl_init($get_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        $get_response = curl_exec($ch);
        if ($get_response === false) {
            echo 'Error en la petición GET: ' . curl_error($ch);
        } else {
            $data = json_decode($get_response, true);
            $cliente = $data;
        }
        curl_close($ch);
        if(isset($_GET['dni'])){
            // echo "<script>alert('El cliente no existe');</script>";
            $this->view->getAllClientes($cliente);
        }else{
            $this->showClientes();
        }
        
    }

    // Función que muestra la vista de clientes
    public function showClientes()
    {
        $dni = isset($_POST['dniInfo']) ? $_POST['dniInfo'] : '';
        // URL base de la API local
        $base_url = 'http://localhost:8000/api/clientes';

        // Petición GET
        $get_url = $base_url . '?accion=listar&dniInfo='.$dni;
        $ch = curl_init($get_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        $get_response = curl_exec($ch);
        if ($get_response === false) {
            echo 'Error en la petición GET: ' . curl_error($ch);
        } else {
            $data = json_decode($get_response, true);
            $clientesLista = $data;
        }
        curl_close($ch);

        $this->view->getAllClientes($clientesLista);
    }
    //Funcion para mostrar el formulario de creacion de clientes
    public function showFormController()
    {
        $this->view->showForm();
    }
   //funcion para crear un cliente
   public function createCliente()
{
    // URL base de la API local
    $base_url = 'http://localhost:8000/api/clientes/';
    
    // Datos recibidos del formulario
    $data = [
        'dni' => $_POST['dni'],
        'nombre' => $_POST['nombre'],
        'apellido1' => $_POST['apellido1'],
        'apellido2' => $_POST['apellido2'],
        'direccion' => $_POST['direccion'],
        'tlfno' => $_POST['tlfno']
    ];

    // Convertir los datos a formato JSON
    $json_data = json_encode($data);

    // Petición POST
    $post_url = $base_url . '?accion=crear';
    $ch = curl_init($post_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data); // Enviar datos como JSON
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json', // Especificamos que estamos enviando JSON
        'Content-Length: ' . strlen($json_data) // Establecer longitud del contenido
    ]);
    
    // Ejecutar la petición y capturar la respuesta
    $post_response = curl_exec($ch);
    
    // Verificar si hubo un error en la petición CURL
    if ($post_response === false) {
        echo 'Error en la petición POST: ' . curl_error($ch);
    } else {
        // Verificar el código de respuesta HTTP
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code != 200) {
            echo 'Error: Código HTTP inesperado ' . $http_code;
            echo 'Respuesta completa: ' . $post_response;
        } else {
            // Decodificar la respuesta JSON
            $data = json_decode($post_response, true);
        }
    }
    curl_close($ch);

    // Manejar la respuesta de la API
    if (isset($data['mensaje'])) {
        // Si el cliente ya está registrado
        if ($data['mensaje'] == 'El Cliente ya está dado de alta') {
            echo "<script>alert('" . $data['mensaje'] . "');</script>";
            $this->showFormController(); // Mostrar el formulario si el cliente ya existe
            return;
        } 
        // Si la inserción fue exitosa
        else {
            echo "<script>alert('" . $data['mensaje'] . "');</script>";
            $this->showClientes(); // Mostrar la lista de clientes
        }
    } 
    // Si hay un error en la respuesta
    elseif (isset($data['error'])) {
        echo "<script>alert('Error: " . $data['error'] . "');</script>";
    } 
    // Si la respuesta no tiene ni mensaje ni error, es un error inesperado
    else {
        echo "<script>alert('Error inesperado');</script>";
    }
}

   

    //funcion para borrar un cliente
    public function deleteCliente()
{
    // Verificar si se ha enviado el dni
    if (!isset($_POST['dni']) || empty($_POST['dni'])) {
        echo "<script>alert('El DNI es necesario para realizar la eliminación');</script>";
        $this->showClientes();  // Mostrar la lista de clientes
        return;
    }

    // Verificar si se ha confirmado la eliminación
    if (isset($_POST['confirmar'])) {
        if ($_POST['confirmar'] == 'sí') {
            // URL base de la API local
            $base_url = 'http://localhost:8000/api/clientes/';

            // El id de cliente es el DNI en este caso
            $dni = $_POST['dni'];

            // Construir la URL completa para la eliminación
            $delete_url = $base_url . $dni;

            // Inicializar cURL
            $ch = curl_init($delete_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");  // Usamos el método DELETE
            $post_response = curl_exec($ch);
            
            // Verificar si hubo un error en la petición CURL
            if ($post_response === false) {
                echo 'Error en la petición DELETE: ' . curl_error($ch);
            } else {
                // Decodificar la respuesta JSON de la API
                $data = json_decode($post_response, true);
            }

            curl_close($ch);

            // Manejar la respuesta de la API
            if (isset($data['error'])) {
                // Si la API devuelve un error (por ejemplo, cliente no encontrado)
                echo "<script>alert('" . $data['error'] . "');</script>";
                $this->showFormController(); // Mostrar el formulario de confirmación nuevamente
                return;
            } else {
                // Si la eliminación fue exitosa
                echo "<script>alert('" . $data['mensaje'] . "');</script>";
                $this->showClientes(); // Volver a mostrar la lista de clientes después de eliminar
            }
        } else {
            // Si el usuario dice "No", regresar a la vista de clientes
            $this->showClientes();
        }
    } else {
        // Mostrar formulario de confirmación de eliminación
        echo "<form method='POST' action='http://localhost/Groomer-Lidia-PHP/usoGroomer/home.php?controller=clientesUso&action=deleteCliente'>";
        echo "<input type='hidden' name='dni' value='" . $_POST['dni'] . "'>";
        echo "<p class='p-10'>¿Está seguro de eliminar el cliente?</p>";
        echo "<button type='submit' class='bg-green-500 text-white mx-2 px-4 py-2 rounded' name='confirmar' value='sí'>Sí</button>";
        echo "<button type='submit' class='bg-red-500 text-white mx-2 px-4 py-2 rounded' name='confirmar' value='no'>No</button>";
        echo "</form>";
    }
}


}
