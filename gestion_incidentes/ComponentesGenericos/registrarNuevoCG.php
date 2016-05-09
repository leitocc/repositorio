<?php

session_start();
try {
    $mensaje = "";
    require_once '../Conexion2.php';
    $idTipoComponente = filter_input(INPUT_POST, "idTipoComponente");



    $marca = filter_input(INPUT_POST, "SI");
    $modelo = filter_input(INPUT_POST, "modelo");
    $mes = filter_input(INPUT_POST, "mes");
    $anio = filter_input(INPUT_POST, "anio");
    $proveedor = filter_input(INPUT_POST, "proveedor");

    $mysqli->autocommit(FALSE);
    $resultado = $mysqli->query("INSERT INTO `gestion_incidentes`.`componente_general`
                            (`id_tipo_componente_general`,
                            `descripcion`,
                            `id_marca`)
                             VALUES 
                            (" + $idTipoComponente + ",\"" + $modelo + "\",\"" + $marca + "\")");

    if ($row = $resultado->fetch_assoc()) {
        $idComponenteG = $row["id_componente_general"];
    }
    /*
     * Aqui colocaremos las caracteristicas especificas de cada tipo componente
     */

    $vectorDetalles = new ArrayObject();
    switch ($idTipoComponente) {
        case 1:
            $conexion = filter_input(INPUT_POST, "conexion");
            $medida = filter_input(INPUT_POST, "medida");
            
            

            break;
        default :
            break;
    }
    $mysqli->query("INSERT INTO `gestion_incidentes`.`detalle_componente_general`
                (`id_componente_general`,
                `id_descripcion`,
                `valor`,
                `valor_alfanumerico`,
                `id_unidad_medida`)
                VALUES
                (" + $idComponenteG + ",
                <{id_descripcion: }>,
                <{valor: }>,
                <{valor_alfanumerico: }>,
                <{id_unidad_medida: }>)");


    $mysqli->query("");

    /* Consignar la transacción */
    if (!$mysqli->commit()) {
        print("Falló la consignación de la transacción\n");
        exit();
    }
} catch (mysqli_sql_exception $myE) {
    $mensaje = "Error al grabar en la BD: " . $myE;
} catch (Exception $e) {
    $mensaje = "Error general: " . $e;
}
echo $mensaje;
header('Location: /incidentes/Componentes/CPU/PaginaCPUSegunda.php');
$_SESSION['mensaje'] = $mensaje;
