<?php

session_start();
try {
    require_once '../../Conexion.php';
    if ($_REQUEST['modo'] == "del") {
        $consulta = mysql_query("SELECT id_componente AS id FROM componente where id_tipo_componente = 4 and baja=0 and id_sistema_informatico=" . $_SESSION['si']);
        while ($row = mysql_fetch_array($consulta)) {
            $idComponente = $row['id'];
        }

        $consulta = mysql_query("UPDATE componente SET baja=1, fecha_baja=Sysdate() WHERE id_componente=" . $idComponente);
        $actualizar = "UPDATE componente SET baja=1, fecha_baja=Sysdate() WHERE id_subcomponente=" . $idComponente;
        $consulta = mysql_query($actualizar);
        $mensaje = "Se borro correctamente el componente";
    } else {
        if ($_POST['SI'] === '') {
            $Sistema = null;
        } else {
            $Sistema = $_POST['SI'];
        }

        if ($_POST['modelo'] === '') {
            $modelo = null;
        } else {
            $modelo = $_POST['modelo'];
        }

        if ($_POST['nroSerie'] === '') {
            $nroSerie = 'null';
        } else {
            $nroSerie = "'" . $_POST['nroSerie'] . "'";
        }

        if ($_POST['marca'] === 'Ninguno') {
            $marca = null;
        } else {
            $marca = $_POST['marca'];
        }

        if ($_POST['mes'] === 'Ninguno') {
            $mes = null;
        } else {
            $mes = $_POST['mes'];
        }

        if ($_POST['año'] === '') {
            $año = null;
        } else {
            $año = $_POST['año'];
        }


        if ($_POST['proveedor'] === 'Ninguno') {
            $proveedor = null;
        } else {
            $proveedor = $_POST['proveedor'];
        }
        $nroInventario = 'null';
        $inventario = filter_input(INPUT_POST, "inventariado");
        if ($inventario === "si") {
            $nroInventario = "'" . filter_input(INPUT_POST, "NroInventario") . "'";
        }
//echo "inv: ".$inventario." - Nro: ".$nroInventario."<br/>";


        if ($_REQUEST['modo'] == "ins") {

            $consulta = mysql_query("SELECT MAX(id_componente) AS id FROM componente");
            if ($row = mysql_fetch_row($consulta)) {
                $id = trim($row[0]) + 1;
            }
            $consulta = mysql_query("Insert into componente (id_componente,id_tipo_componente, descripcion, id_marca,anio_adquisicion, mes_adquisicion,id_proveedor,nro_patrimonio,nro_serie,id_sistema_informatico,baja,fecha_instalacion,fecha_baja) values (" . $id . ", 4, '" . $modelo . "'," . $marca . "," . $año . "," . $mes . ",null," . $nroInventario . "," . $nroSerie . "," . $Sistema . ",0,sysdate(),null)");
            $_SESSION['CPU'] = $id;
            $mensaje = "Se grabo correctamente la CPU";
        }

        if ($_REQUEST['modo'] == "mod") {
            $consulta = mysql_query("SELECT id_componente AS id FROM componente where id_tipo_componente = 4 and baja=0 and id_sistema_informatico=" . $_SESSION['si']);
            while ($row = mysql_fetch_array($consulta)) {
                $idComponente = $row['id'];
            }
            $update = "UPDATE componente SET descripcion='" . $modelo . "' ,id_marca=" . $marca . " ,anio_adquisicion=" . $año . " ,mes_adquisicion=" . $mes . ",nro_serie=" . $nroSerie . ",nro_patrimonio=" . $nroInventario . " WHERE id_componente =" . $idComponente;
            $consulta = mysql_query($update);
            echo $update;
            $mensaje = "Se modificó correctamente la CPU";
        }
    }
} catch (Exception $e) {
    $mensaje = "Error al grabar en la BD";
}
header('Location: /incidentes/SistemaInformatico/ModificarComponentesSI.php');
$_SESSION['mensaje'] = $mensaje;
