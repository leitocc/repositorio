<?php
session_start();
try{
    require_once '../../Conexion.php';
    $mensaje = "";
    $modo = filter_input(INPUT_POST, "modo");
    $nombre = filter_input(INPUT_POST, "nombre");
    if($modo === "ins"){
        $consultaMaxId = mysql_query("SELECT MAX(id_marca) AS id FROM marca");
        if(mysql_errno() == 0){
            $idMarca = mysql_fetch_array($consultaMaxId);
        }else{
            $idMarca['id'] = 0;
        }
        $idMarca['id']++;
        $queryMarca = "INSERT INTO marca (`id_marca`,`descripcion`) VALUES (".$idMarca['id'].", '".$nombre."');";
        $consultaMarca = mysql_query($queryMarca);
        $mensaje = "Se registro correctamente";
    }elseif($modo === "mod"){
        $idMarca = filter_input(INPUT_POST, "idMarca");
        $consulta = mysql_query("UPDATE marca SET descripcion = '".$nombre."' where id_marca = ".$idMarca.";" );
        $mensaje = "Se actualizo correctamente";
    }else{
        $mensaje = "Error, comuniquese con el administrador";
    }
}catch (mysqli_sql_exception $myE){
    $mensaje = "Error al grabar en la BD: ".$myE;
}catch (Exception $e){
    $mensaje = "Error general: ". $e;
}
echo $mensaje;
header('Location: /incidentes/Administracion/PrincipalAdministracion.php');
$_SESSION['mensaje'] = $mensaje;
