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
       $base_url = 'http://localhost/gromer/api/controllers/clientesController.php';

       // Petición POST
       $post_url = $base_url . '?accion=crear';
       $ch = curl_init($post_url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
       $post_response = curl_exec($ch);
       if ($post_response === false) {
           echo 'Error en la petición POST: ' . curl_error($ch);
       } else {
           $data = json_decode($post_response, true);
           $clientesLista = $data;
       }
       curl_close($ch);
        if (isset($clientesLista['mensaje']) && $clientesLista['mensaje'] == 'El Cliente ya está dado de alta') {
            echo "<script>alert('" . $clientesLista['mensaje'] . "');</script>";
            $this->showFormController();            
            return;
        }
        echo "<script>alert('" . $clientesLista['mensaje'] . "');</script>";
        $this->showClientes();
   }
    //funcion para borrar un cliente
    public function deleteCliente()
{
    // Verificar si se ha confirmado la eliminación
    if (isset($_POST['confirmar'])) {
        if ($_POST['confirmar'] == 'sí') {
            // URL base de la API local
            $base_url = 'http://localhost:8000/api/clientes/';

            // Petición POST
            $post_url = $base_url . '?accion=borrar';
            $ch = curl_init($post_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
            $post_response = curl_exec($ch);
            if ($post_response === false) {
                echo 'Error en la petición POST: ' . curl_error($ch);
            } else {
                $data = json_decode($post_response, true);
                $clientesLista = $data;
            }
            curl_close($ch);
            if (isset($clientesLista['mensaje']) && $clientesLista['mensaje'] == 'El cliente no existe') {
                echo "<script>alert('" . $clientesLista['mensaje'] . "');</script>";
                $this->showFormController();
                return;
            } else {
                echo "<script>alert('Cliente DNI: " . $_POST['dni'] . " borrado correctamente');</script>";
            }
            $this->showClientes();
        } else {
            // Si el usuario dice "No", regresar a la vista de clientes
            $this->showClientes();
        }
    } else {
        // Mostrar formulario de confirmación
        echo "<form method='POST' action='http://localhost/grommer/Groomer-Lidia-PHP/usoGroomer/index.php?controller=clientesUso&action=deleteCliente'>";
        echo "<input type='hidden' name='dni' value='" . $_POST['dni'] . "'>";
        echo "<p class='p-10'>¿Está seguro de eliminar el cliente?</p>";
        echo "<button type='submit' class='bg-green-500 text-white mx-2 px-4 py-2 rounded' name='confirmar' value='sí'>Sí</button>";
        echo "<button type='submit' class='bg-red-500 text-white mx-2 px-4 py-2 rounded' name='confirmar' value='no'>No</button>";
        echo "</form>";
    }
}
}
