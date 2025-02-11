<?php ?>

<div class="pie">
    Ejemplo PHP - POO MVC -<?php echo date("Y"); ?>
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
</div>
<!-- Cerramos las etiquetas de la cabecera, div del conenedor -->
</div>
</body>
</html>