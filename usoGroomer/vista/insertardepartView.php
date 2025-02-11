<div class="centro" >
    <section style="height:400px;overflow-y:scroll; align:center">
        <form action="<?php echo $this->url("departamento", "crear"); ?>" method="post">
            <h3>Añadir Departamento</h3>
            <hr/>
            <br>Número de departamento: <input type="text" name="dept_no" />
            <br>Denominación: <input type="text" name="dnombre" />
            <br>Localidad: <input type="text" name="loc" />
            <br><input type="submit" value="Insertar registro" />
        </form>
    </section>
    <form action="<?php echo $this->url("departamento", "index"); ?>" method="post">
        <input type="submit" value="Volver al inicio." />
    </form>
    <footer>
        <hr/>
        Ejemplo PHP - POO MVC -<?php echo date("Y"); ?>
    </footer>
</div>