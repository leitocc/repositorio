<?php

if(isset($_REQUEST['error'])){
    switch ($_REQUEST['error']){
    case 1:
        echo '<h4>Error al ingresar datos en formulario</h6>';
        break;
    default :
        echo '<h4>Error. Consulte con el Administrador</h6>';
    }
}