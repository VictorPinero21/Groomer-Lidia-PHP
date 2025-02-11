<?php

class DepartamentoController extends ControladorBase
{

    private $depmodel;
    private $emplemodel;

    public function __construct()
    {
        parent::__construct();
        $this->depmodel = new DepartamentoModel();
        $this->emplemodel = new EmpleadosModel();
    }

    public function index()
    {
        $dat = array(
            "datos" => "Abro index.php ",
            "datos1" => "dato1"
        );
        $this->view("index", $dat);
    }

    public function crear()
    {
        if (isset($_POST["dept_no"])) {
            //Creamos un dep
            $dep = $_POST["dept_no"];
            $nom = $_POST["dnombre"];
            $loc = $_POST["loc"];
            $save = $this->depmodel->save($dep, $nom, $loc);
            if ($save > 0) {
                $dat = array("datos" => "DEPARTAMENTO INSERTADO: " . $save);
                $this->view("mensajes", $dat);
            } else {
                $dat = array("datos" => "DEPARTAMENTO NO INSERTADO, REVISA DATOS " . $save);
                $this->view("mensajes", $dat);
            }
        } else {
            $dat = array("datos" => "No hay DATOS en dept_no ");
            $this->view("mensajes", $dat);
        }
    }

    public function borrar()
    {
        if (isset($_GET["dept_no"])) {
            $id = (int) $_GET["dept_no"];

            $query = $this->depmodel->borrar($id);
            if ($query > 1) {
                $dat = array("datos" => "DEPARTAMENTO BORRADO: " . $id);
                $this->view("mensajes", $dat);
            } else {
                $dat = array("datos" => "DEPARTAMENTO NO BORRADO, REVISA DATOS. " . $query);
                $this->view("mensajes", $dat);
            }
        } else {
            $dat = array("datos" => "No hay DATOS en ese departamento ");
            $this->view("mensajes", $dat);
        }
    }

    public function insertar()
    {
        $this->view("insertardepart", array(
            "datos" => "Voy a abrir insertar"
        ));
    }

    public function listar()
    {
        //Conseguimos todos los dep
        $listadeps = $this->depmodel->getAll();

        //Cargamos la vista index y le pasamos dos variables
        if (is_array($listadeps)) {
            $this->view("listardepartamentos", array(
                "alldeps" => $listadeps,
                "datos" => "Listado de registros"
            ));
        } else
            echo "EROOOR: " . $listadeps;
    }

    /// EMPLEADOS 
    public function listaremple()
    {
        //echo 'listaremple';
        $lista = $this->emplemodel->getAll();
        $this->view("listarempleados", array(
            "lista" => $lista
        ));
    }

    public function borraremple()
    {
        $emp = $_GET['emple']; // empleado a borrar
        $res = $this->emplemodel->borrar($emp);
        if ($res > 1) {
            $dat = array("datos" => "EMPLEADO BORRADO: " . $emp);
        } else {
            $dat = array("datos" => "DEPARTAMENTO NO BORRADO, REVISA DATOS: " . $res);
        }
        $this->view("mensajes", $dat);
    }

    public function insertaremple()
    {
        // Mostrar la vista con el formulario de insertar emple
        //antes de llamar a la vista hay que cargar los empleados
        //para elegir un director y los dep
        //para elegir un dep
        $listajefes = $this->emplemodel->getAll();
        $listadeps = $this->depmodel->getAll();

        $this->view("insertaremple", array(
            "listajefes" => $listajefes,
            "listadeps" => $listadeps
        ));
    }

    public function crearemple()
    {
        //  echo 'crearemple';
        $emp_no = $_POST['emp_no'];
        $apellido = $_POST['apellido'];
        $oficio = $_POST['oficio'];
        $comision = $_POST['comision'];
        if (!filter_var($comision, FILTER_VALIDATE_FLOAT)) {
            $comision = 0;
        }
        $salario = $_POST['salario'];
        if (!filter_var($salario, FILTER_VALIDATE_FLOAT)) {
            $salario = 0;
        }
        $fecha_alt = $_POST['fecha_alt'];
        $dir = $_POST['dir'];
        $dept_no = $_POST['dept_no'];
        //  $mensaje = insertaemple($emp_no, $apellido, $oficio,
        //        $dir, $fecha_alt, $salario,
        //         $comision, $dept_no);

        $res = $this->emplemodel->insertaemple(
            $emp_no,
            $apellido,
            $oficio,
            $dir,
            $fecha_alt,
            $salario,
            $comision,
            $dept_no
        );

        //Ir a la vista mensajes, llevando el mensaje
        $this->view("mensajes", array(
            "datos" => $res
        ));
    }
}
