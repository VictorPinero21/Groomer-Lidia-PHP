<div align="center" >
    <h2>Nombre de alumno: </h2>
    <h2>INSERTAR PEDIDOS DE CLIENTES</h2>
    <?php
    if (isset($mensaje)) {
        echo "<h3>" . $mensaje . "</h3>";
    }
    ?>     
    <form class = "form-inline my-2 my-lg-0" action = "<?php echo $this->url("web", "insertaya"); ?>" method = "post">

        <?php
        if (!isset($idpedido))
            $idpedido = "";
        echo "<p>Teclea id de pedido: <input type='number' required name='idpedido' "
        . " value='" . $idpedido . "'> ";
        echo '<p>Selecciona el cliente: ';
        echo '<select  name="idcliente"> ';
        foreach ($clientes as $reg) {
            $selec = "";
            if ($idcliente == $reg['IDCLIENTE']) {
                $selec = "selected";
            }

            echo '<option  ' . $selec . ' value="' .
            $reg['IDCLIENTE'] . '"> ' .
            $reg['IDCLIENTE'] . ' - ' .
            $reg['NOMBRE'] .
            ' </option><br>';
        }
        echo "</select></p>";
        echo '<p>Selecciona el menu: ';
        echo '<select  name="idmenu"> ';
        foreach ($menus as $reg) {
            $selec = "";
            if ($idmenu == $reg['IDMENU']) {
                $selec = "selected";
            }

            echo '<option  ' . $selec . ' value="' .
            $reg['IDMENU'] . '"> ' .
            $reg['IDMENU'] . ' - ' .
            $reg['NOMBRE'] .
            ' </option><br>';
        }
        echo "</select></p>";
        echo "<p>Fecha de pedido: <input type='text' readonly name='fecha' value='" . date("Y-m-d") . "'></p>";
        echo "<p> <input type='submit'  value='Insertar registro'></p>";
        ?>

    </form>
        <p>
            <a href="<?php echo $this->url("web", "index"); ?>">Volver || </a>
            <a href="<?php echo $this->url("web", "listar"); ?>"> Listar/Borrar Pedidos de un cliente</a>
        </p>
    <br> <hr>
</div>