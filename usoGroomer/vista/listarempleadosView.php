<div class="centro" >

    <h3>Listado de empleados</h3>
    <hr/>
    <section style="height:400px;overflow-y:scroll;">
        <?php
        foreach ($lista as $emp) {
            //recorremos el array de objetos y obtenemos el valor de las propiedades 
            echo $emp->getEmp_no() . "-";
            echo $emp->getApellido() . "-";
            echo $emp->getOficio() . "-";
            echo $emp->getSalario() . "-";
            echo $emp->getDir() . "-";
            ?>
            <div class="right">
                <a href="<?php echo $this->url("departamento", "borraremple"); ?>&emple=<?php echo $emp->getEmp_no(); ?>" >Borrar</a>
            </div>
            <hr>
        <?php } ?>
    </section>
    <form action="<?php echo $this->url("departamento", "index"); ?>" method="post" >
        <input type="submit" value="Volver al inicio." />
    </form>
    <footer>
        <hr/>
        Ejemplo PHP - POO MVC - <?php echo date("Y"); ?>
    </footer>
</div>