<?php

require_once '../DetalleComponente.class.php';
session_start();
try {
    $mensaje = "";
    require_once '../Conexion2.php';
    $idTipoComponente = filter_input(INPUT_POST, "tipoComponente");

    $marca = filter_input(INPUT_POST, "marca");
    $modelo = filter_input(INPUT_POST, "modelo");
    $mes = filter_input(INPUT_POST, "mes");
    $anio = filter_input(INPUT_POST, "anio");
    $proveedor = filter_input(INPUT_POST, "proveedor");

    //$mysqli->autocommit(TRUE);
    $query1 = "INSERT INTO `gestion_incidentes`.`componente_general` (`id_tipo_componente_general`,`descripcion`,`id_marca`) VALUES (" + $idTipoComponente + ",\"" + $modelo + "\"," + $marca + ")";
    echo "consulta:" . $query1 . "<br/>";
    if($mysqli->query($query1) === TRUE){
        echo "ID comp:" . $mysqli->insert_id . "<br/>";
        $idComponenteG = $mysqli->insert_id;
    }else{
        echo 'todo mallllllllll';
        exit();
    }
        
    /*$resultado = $mysqli->query("INSERT INTO `gestion_incidentes`.`componente_general`
                            (`id_tipo_componente_general`,
                            `descripcion`,
                            `id_marca`)
                             VALUES 
                            (" + $idTipoComponente + ",\"" + $modelo + "\",\"" + $marca + "\")");*/
    
    
    echo "ID tipo comp:" . $idTipoComponente. "<br/>";
    echo "modelo:" . $modelo. "<br/>";
    echo "marca:" . $marca. "<br/>";

    /*
     * Aqui colocaremos las caracteristicas especificas de cada tipo componente
     */

    $vectorDetalles = new ArrayObject();
    $detalle = new DetalleComponente();
    switch ($idTipoComponente) {
        case 1:
            echo 'entre!!';
            $conexion = filter_input(INPUT_POST, "conexion");
            $detalle->__constructor();
            $detalle->setId_descripcion(3);
            $detalle->setValor(NULL);
            $detalle->setValor_alfanumerico($conexion);
            $detalle->setId_unidad_medida(NULL);
            $vectorDetalles[] = $detalle;

            $medida = filter_input(INPUT_POST, "medida");
            $detalle->__constructor();
            $detalle->setId_descripcion(5);
            $detalle->setValor($medida);
            $detalle->setValor_alfanumerico(NULL);
            $detalle->setId_unidad_medida(7);
            $vectorDetalles[] = $detalle;

            break;
        default :
            break;
    }
    print sizeof($vectorDetalles, TRUE)."\n";
    
    foreach ($vectorDetalles as $det) {
        $mysqli->query("INSERT INTO `gestion_incidentes`.`detalle_componente_general`
                    (`id_componente_general`,
                    `id_descripcion`,
                    `valor`,
                    `valor_alfanumerico`,
                    `id_unidad_medida`)
                    VALUES
                    (" + $idComponenteG + ",
                    " + $det->getId_descripcion() + ",
                    " + $det->getValor() + ",
                    " + $det->getValor_alfanumerico() + ",
                    " + $det->getId_unidad_medida() + ")");
    }

    /* Consignar la transacción */
    if (!$mysqli->commit()) {
        print("Falló la consignación de la transacción\n");
        echo "todo mal1";
        exit();
    }else{
        echo "todo bien";
    }
} catch (mysqli_sql_exception $myE) {
    print ("Error al grabar en la BD: " . $myE);
    echo "todo mal2";
} catch (Exception $e) {
    print ("Error general: " . $e);
    echo "todo mal3";
}
//echo $mensaje;
//header('Location: /incidentes/Componentes/CPU/PaginaCPUSegunda.php');
//$_SESSION['mensaje'] = $mensaje;
