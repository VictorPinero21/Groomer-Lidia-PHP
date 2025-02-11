<?php

class ControladorBase {

    public function __construct() {
       //  require_once 'Basedatos.php';
        //Incluir todos los modelos
        foreach (glob("modelo/*.php") as $file) {
            require_once $file;
        }
    }

    public function url($controlador = CONTROLADOR_DEFECTO, $accion = ACCION_DEFECTO, $num = "") {

        if ($num == "") {
            $urlString = "index.php?controller=" . $controlador . "&action=" . $accion;
        } else {
            $urlString = "index.php?controller=" . $controlador . "&action=" . $accion . "&num=" . $num;
        }
        /*
          if ($num == "") {
          //RewriteRule  ^([A-zÀ-ú+]+)/([A-zÀ-ú+]+)/?$ index.php?controller=$1&action=$2 [L]
          $urlString = URL. $controlador . "/" . $accion;
          } else {
          //RewriteRule  ^([A-zÀ-ú+]+)/([A-zÀ-ú+]+)/([0-9]+)/?$ index.php?controller=$1&action=$2&num=$3 [L]
          $urlString = URL. $controlador . "/" . $accion . "/" . $num;
          }
         * *
         */
        return $urlString;

        /* CON TRES PARÁMETROS
          if ($num == "") {
          //RewriteRule  ^([A-zÀ-ú+]+)/([A-zÀ-ú+]+)/?$ index.php?controller=$1&action=$2 [L]
          $urlString = URL . $controlador . "/" . $accion;
          return $urlString;
          }
          if ($num2 == "") {
          //RewriteRule  ^([A-zÀ-ú+]+)/([A-zÀ-ú+]+)/([0-9]+)/?$ index.php?controller=$1&action=$2&num=$3 [L]
          $urlString = URL . $controlador . "/" . $accion . "/" . $num;
          return $urlString;
          }

          if ($num3 == "") {
          //RewriteRule  ^([A-zÀ-ú+]+)/([A-zÀ-ú+]+)/([0-9]+)/([0-9]+)/?$ index.php?controller=$1&action=$2&num=$3&num2=$4 [L]
          $urlString = URL . $controlador . "/" . $accion . "/" . $num . "/" . $num2;
          return $urlString;
          }

          //RewriteRule  ^([A-zÀ-ú+]+)/([A-zÀ-ú+]+)/([0-9]+)/([0-9]+)/([0-9]+)/?$ index.php?controller=$1&action=$2&num=$3&num2=$4&num3=$5 [L]
          $urlString = URL . $controlador . "/" . $accion . "/" . $num . "/" . $num2 . "/" . $num3;
          return $urlString;
         * */
    }

    public function view($vista, $data) {
        foreach ($data as $id_assoc => $value) {
            ${$id_assoc} = $value;
        }
     //   require_once 'vista/comun/cabecera.php';
        require_once 'vista/' . $vista . 'View.php';
      //  require_once 'vista/comun/pie.php';
    }

    public function redirect($controlador = CONTROLADOR_DEFECTO, $accion = ACCION_DEFECTO) {
        header("Location:index.php?controller=" . $controlador . "&action=" . $accion);
    }

}

?>