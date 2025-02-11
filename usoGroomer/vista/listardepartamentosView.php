<div class="centro" >
        <h3>Listado de departamentos</h3>
        <hr/>
        <section style="height:400px;overflow-y:scroll;">
            <?php
            foreach ($alldeps as $depp) {
                //recorremos el array de objetos y obtenemos el valor de las propiedades 
                echo $depp->getDept_no() . "-";
                echo $depp->getDnombre() . "-";
                echo $depp->getDloc();
                ?>
                <div class="right">
                    <a href="<?php echo $this->url("departamento", "borrar"); ?>&dept_no=<?php echo $depp->getDept_no(); ?>" >Borrar</a>
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
