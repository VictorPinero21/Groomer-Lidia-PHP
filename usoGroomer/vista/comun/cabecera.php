<?php ?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <title>Ejemplo POO-MVC.</title>
        <link rel="stylesheet" href="../../recursos/css/estilos.css" />
    </head>
    <body>
        <div class="contenedor">
            <!-- Cabecera -->
            <div class="cabecera">
                <h1>Gestion empleados y departamentos</h1>
                <a href="index.php" class="inicio">home</a>
            </div>
            <!-- Menú -->
            <div class="menu">
                <br>
                <a href="<?php echo $this->url("departamento", "insertar"); ?>">
                    Insertar un Departamento | </a>
                <a href="<?php echo $this->url("departamento", "listar"); ?>" >
                    Listar los Departamentos | </a>
                <a href="<?php echo $this->url("departamento", "insertaremple"); ?>" >
                    Insertar un Empleado  | </a>
                <a href="<?php echo $this->url("departamento", "listaremple"); ?>" >
                    Listar los empleados | </a>
                  
            </div>     