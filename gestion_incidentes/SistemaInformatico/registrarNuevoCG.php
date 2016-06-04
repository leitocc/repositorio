<?php

require_once '../Conexion2.php';
require_once '../DetalleComponente.class.php';
session_start();
$vectorComponente = $_SESSION['Componente'];
$vectorDetalles = $_SESSION['Detalles'];

$vectorMaquinas = $_POST["SI"];

foreach ($vectorMaquinas as $maquina) {
    try {
        $mysqli->autocommit(FALSE);
        $query11 = "select max(id_componente)as maximo from componente";
        $resultado = $mysqli->query($query11);
        if ($row = $resultado->fetch_assoc()) {
            $numero = $row["maximo"] + 1;
        }
        echo $numero . "</br>";
        $query10 = "INSERT INTO Componente(id_componente,id_tipo_componente,id_marca,anio_adquisicion,mes_adquisicion,id_proveedor,id_sistema_informatico,baja) values(" . $numero . ", " . $vectorComponente["idTipoComponente"] . ", " . $vectorComponente["marca"] . ", " . $vectorComponente["anio"] . ", " . $vectorComponente["mes"] . ",null, " . $maquina . ", 0)";
        echo $query10 . "</br></br></br>";

        if ($mysqli->query($query10) === TRUE) {
            echo "nuevo maquina insertada " . $mysqli->insert_id;
        } else {
            throw new Exception ();
            $mysqli->rollback();
            die();
        }
        if ($vectorDetalles != NULL) {
            foreach ($vectorDetalles as $detalle) {
                $query12 = "select max(id_detalle_componente)as maximo from detalle_Componente";
                $resultado = $mysqli->query($query12);
                if ($row = $resultado->fetch_assoc()) {
                    $numerodetalle = $row["maximo"] + 1;
                }
                echo $numerodetalle . "</br>";
                $valor = "null";
                $valorAlfa = "null";

                    $valor = $detalle->getValor();
                if ($detalle->getValor() != "") {
                }
                if ($detalle->getValor_alfanumerico() != "") {
                    $valorAlfa = $detalle->getValor_alfanumerico();
                }


                $query11 = "INSERT INTO detalle_Componente(id_Detalle_componente,"
                        . "id_componente,id_descipcion,valor,valor_alfanumerico,id_unidad_medida) "
                        . "values (" . $numerodetalle . ", " . $numero . ", " . $detalle->getId_descripcion()
                        . "," . $valor . ", " . $valorAlfa . ", "
                        . $detalle->getId_unidad_medida() . ")";
                echo $query11 . "</br>";
                if ($mysqli->query($query11) === TRUE) {
                    echo "detalle de la  maquina insertada " . $mysqli->insert_id;
                } else {
                    throw new Exception ();
                    $mysqli->rollback();
                    die();
                }
            }
        }
        $mysqli->commit();
    } catch (exception $e) {
        echo "todo mal " . $e;
        $mysqli->rollback();
        die();
    }
}
$mysqli->close();

//Falta recuperar la variable de sesion del componente

//try {
//    $mensaje = "";
//    require_once '../Conexion2.php';
//    
//
//    //Aqui realizar los input de la pagina asignarcomponente.php
//    //Serian las maquinas y el aula a asignar el componente
//    //$idTipoComponente = filter_input(INPUT_POST, "tipoComponente");
// 
//    
///*
//    $marca = filter_input(INPUT_POST, "marca");
//    $modelo = filter_input(INPUT_POST, "modelo");
//    $mes = filter_input(INPUT_POST, "mes");
//    $anio = filter_input(INPUT_POST, "anio");
//    $proveedor = filter_input(INPUT_POST, "proveedor");
//*/
//    //Esto es para una transaccion
//    $mysqli->autocommit(FALSE);
//
//    //Aqui primero tenes que guardar
//    $query1 = "INSERT INTO `gestion_incidentes`.`componente` (`id_tipo_componente_general`,`descripcion`,`id_marca`) VALUES (" + $idTipoComponente + ",\"" + $modelo + "\"," + $marca + ")";
//    echo "consulta:" . $query1 . "<br/>";
//    if ($mysqli->query($query1) === TRUE) {
//        echo "ID comp:" . $mysqli->insert_id . "<br/>";
//        $idComponenteG = $mysqli->insert_id;
//    } else {
//        echo 'todo mallllllllll';
//        exit();
//    }
//
//    /* $resultado = $mysqli->query("INSERT INTO `gestion_incidentes`.`componente_general`
//      (`id_tipo_componente_general`,
//      `descripcion`,
//      `id_marca`)
//      VALUES
//      (" + $idTipoComponente + ",\"" + $modelo + "\",\"" + $marca + "\")"); */
//
//
//    echo "ID tipo comp:" . $idTipoComponente . "<br/>";
//    echo "modelo:" . $modelo . "<br/>";
//    echo "marca:" . $marca . "<br/>";
//
//    /*
//     * Aqui colocaremos las caracteristicas especificas de cada tipo componente
//     */
//
//    //Por cada Detalle de componente se debe realizar un insert a la tabla detalle_componente
//    foreach ($vectorDetalles as $det) {
//        $mysqli->query("INSERT INTO `gestion_incidentes`.`detalle_componente`
//                    (`id_componente`,
//                    `id_descripcion`,
//                    `valor`,
//                    `valor_alfanumerico`,
//                    `id_unidad_medida`)
//                    VALUES
//                    (" + $idComponenteG + ",
//                    " + $det->getId_descripcion() + ",
//                    " + $det->getValor() + ",
//                    " + $det->getValor_alfanumerico() + ",
//                    " + $det->getId_unidad_medida() + ")");
//    }
//
//    /* Consignar la transacción */
//    if (!$mysqli->commit()) {
//        print("Falló la consignación de la transacción\n");
//        echo "todo mal1";
//        exit();
//    } else {
//        echo "todo bien";
//    }
//} catch (mysqli_sql_exception $myE) {
//    print ("Error al grabar en la BD: " . $myE);
//    echo "todo mal2";
//} catch (Exception $e) {
//    print ("Error general: " . $e);
//    echo "todo mal3";
//}
//
////echo $mensaje;
////header('Location: /incidentes/Componentes/CPU/PaginaCPUSegunda.php');
////$_SESSION['mensaje'] = $mensaje;
