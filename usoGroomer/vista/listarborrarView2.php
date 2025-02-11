<div align="center" >
    <h2>Nombre de alumno: </h2>
    <h2>LISTAR PEDIDOS DE CLIENTES</h2>
     
    <form class = "form-inline my-2 my-lg-0" action = "<?php echo $this->url("web", "listarcliente"); ?>" method = "post">
        <?php
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
        echo "</select>";
        echo "<input type='submit'  value='Ver pedidos del cliente'></p>";
        ?>

    </form>


    <?php
    
    if (isset($mensaje)) {
        echo "<h3>" . $mensaje . "</h3>";
    }
  
    if (isset($pedidosclien)) {
        echo '<p><b>Número de pedidos del cliente: ' . count($pedidosclien) .
        ' </b></p>';
        if (count($pedidosclien) > 0) {
            echo '<table class="table" ><tr><th>Id pedido</th><th>Id menú</th>'
            . '<th>Nombre menú</th><th>Fecha pedido</th><th> Pvp </th><th> Operación </th></tr>';
            $total = 0;
            foreach ($pedidosclien as $reg) {
                echo "<tr>";
                echo "<td>" . $reg['IDPEDIDOMENU'] . "</td>";
                echo "<td>" . $reg['IDMENU'] . "</td>";
                echo "<td>" . $reg['NOMBREMENU'] . "</td>";
                echo "<td>" . $reg['FECHAPEDIDO'] . "</td>";
                echo "<td> " . $reg['PVP'] . " </td>";
                $total = $total + $reg['PVP'];
                echo "<td>";
                ?>
                <a href="<?php echo $this->url("web", "borrapedido", $reg['IDPEDIDOMENU']); ?>">Borrar</a>
                <?php
                echo "</td>";
                echo "</tr>";
            }
            echo '</table>';

            echo '<p><b>Total gasto del cliente: ' . $total . ' </b></p>';
        }
    }
    ?>
    <br>
    <p>
        <a href="<?php echo $this->url("web", "insertar"); ?>">Insertar pedidos de menús ||</a>
        <a href="<?php echo $this->url("web", "index"); ?>">Volver  </a>

    <br>  <hr>
</div>
