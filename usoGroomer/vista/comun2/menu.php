
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="#">EXAMEN</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $this->url("web", "index"); ?>">Index <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <span class="nav-link"> Selecciona un equipo y una competición</span>
            </li>

            <form class="form-inline my-2 my-lg-0" action="<?php echo $this->url("web", "detalleequipos"); ?>" method="post">

                <?php
                echo '<select class="bg-light text-dark" name="equipo"> ';
                foreach ($equipos as $reg) {
                    $selec = "";
                    if (isset($idequipo) and ($idequipo == $reg->getCod_equipo())) {
                        $selec = "selected";
                    }
                    echo '<option  ' . $selec . ' value="' .
                    $reg->getCod_equipo() . '"> ' .
                    $reg->getCod_equipo() . ' - ' .
                    $reg->getNom_equipo() .
                    ' </option><br>';
                }
                echo "</select> ";
                ?>

                <?php
                echo '&nbsp; &nbsp;<select class="bg-light text-dark" name="competicion"> ';
                foreach ($competiciones as $reg) {
                    $selec = "";
                    if (isset($competicion) and ($competicion == $reg['COMPETICION'])) {
                        $selec = "selected";
                    }
                    echo '<option  ' . $selec . ' value="' .
                    $reg['COMPETICION'] . '"> ' .
                    $reg['COMPETICION'] .
                    ' </option><br>';
                }
                echo "</select>&nbsp;&nbsp;";
                ?>

                <button class="btn btn-primary" type="submit">Ver datos .</button>
            </form>
        </ul>
    </div>
</nav>
