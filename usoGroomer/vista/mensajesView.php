<div class="centro" >
        <h3>Mensaje: <?php echo $datos; ?></h3>
        <hr>
        <form action="<?php echo $this->url("departamento", "index"); ?>" method="post">
            <input type="submit" value="Volver al inicio." />
        </form>
        <footer>
            <hr>
            Ejemplo PHP POO MVC - <?php echo date("Y"); ?>
        </footer>
</div>