<?php

session_start();
try {
    require_once '../../Conexion2.php';
    $mensaje = "";
    $modo = filter_input(INPUT_POST, "modo");
    $nombre = filter_input(INPUT_POST, "nombre");
    if ($modo === "ins") {
        $consultamarca = "SELECT MAX(id_marca) AS id FROM marca";
        $resultadoMaxId = $mysqli->query($consultamarca);
        if ($row = $consulta->fetch_assoc()) {
            $idMarca['id'] = $row["id_marca"];
        } else {
            $idMarca['id'] = 0;
        }
        $idMarca['id'] ++;
        $queryMarca = "INSERT INTO marca (`id_marca`,`descripcion`) VALUES (" . $idMarca['id'] . ", '" . $nombre . "');";
        $consultaMarca = $mysqli->query($queryMarca);
        $mensaje = "Se registro correctamente";
    } elseif ($modo === "mod") {
        $idMarca = filter_input(INPUT_POST, "idMarca");
        $queryActualizar = "UPDATE marca SET descripcion = '" . $nombre . "' where id_marca = " . $idMarca . ";";
        $consulta = $mysqli->query($queryActualizar);
        $mensaje = "Se actualizo correctamente";
    } else {
        $mensaje = "Error, comuniquese con el administrador";
    }
} catch (mysqli_sql_exception $myE) {
    $mensaje = "Error al grabar en la BD: " . $myE;
} catch (Exception $e) {
    $mensaje = "Error general: " . $e;
}
echo $mensaje;
header('Location: /incidentes/Administracion/PrincipalAdministracion.php');
$_SESSION['mensaje'] = $mensaje;
