<?php
session_start();
$permisos = array("6", "1");
$_SESSION['permisos'] = $permisos;
include_once '../verificarPermisos.php';
include_once '../limpiarSesion.php';
require_once '../Conexion2.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Componentes</title>
        <link rel="stylesheet" type="text/css" href="/incidentes/css/estilo.css" />
        <script type="text/javascript" src="/incidentes/js/jquery-1.11.1.js"></script>
        <script>
            $(document).ready(function () {
            });
        </script>
    </head>
    <body id="top">
        <?php include_once '../master.php'; ?>
        <div id="site">
            <div class="center-wrapper">
                <?php include_once '../menu.php'; ?>

                <div class="main">
                    <div class="post">
                        <li class="no_lista"><h2>Registrar nuevo componente general</h2></li>
                        <h4>Tipo de componente</h4>
                        <div class="archive-separator"></div>
                        <?php
                        print '<div><table><tr>';
                        print '<td>Marca:</td>';
                        $query = "select * from marca";
                        $resultado = $mysqli->query($query);
                        print '<td><select name="marca" id="marca" required>';
                        print '<option value="" >Seleccione...</option>';
                        while ($row = $resultado->fetch_assoc()) {
                            print "<option value =" . $row['id_tipo_componente'] . " >";
                            print $row['descripcion'] . "</option>";
                        }
                        print '</select></td>';
                        $resultado->free();
                        print '</tr><tr>';
                        print '<td>Modelo:</td>';
                        print '<td><input name="modelo" id="modelo"/><td/>';
                        print '</tr><tr>';
                        print '<td>Mes de adquisicion </td>';
                        print '<td><select name="mes" id="mes" required>';
                        print '<option value="">Seleccione...</option>';
                        print '<option value="1">Enero</option>';
                        print '<option value="2">Febrero</option>';
                        print '<option value="3">Marzo</option>';
                        print '<option value="4">Abril</option>';
                        print '<option value="5">Mayo</option>';
                        print '<option value="6">Junio</option>';
                        print '<option value="7">Julio</option>';
                        print '<option value="8">Agosto</option>';
                        print '<option value="9">Septiembre</option>';
                        print '<option value="10">Octubre</option>';
                        print '<option value="11">Noviembre</option>';
                        print '<option value="12">Diciembre</option>';
                        print '</select></td>';
                        print '</tr><tr>';
                        print '<td>Año adquisición</td>';
                        print '<td><input id="anio" name="año" required/></td>';
                        print '</tr><tr>';
                        print '<td>Proveedor</td>';
                        $query = "select * from proveedor";
                        $resultado = $mysqli->query($query);
                        print '<td><select name="proveedor" id="proveedor" required>';
                        print '<option value="" >Seleccione...</option>';
                        while ($row = $resultado->fetch_assoc()) {
                            print "<option value =" . $row['id_proveedor'] . " >";
                            print $row['nombre'] . "</option>";
                        }
                        print '</select></td>';
                        $resultado->free();
                        print '</tr></table>';
                        print '<h4>*** Aqui faltarian las caracteristicas segun tipo componente elegido</h4>';
                        print '<button class="submit" name="Registrar">Registrar</button><button class="submit" name="volver" id="Volver">Volver</button>';
                        print '</div>';
                        ?>
                    </div>
                </div>
                <?php include_once '../foot.php'; ?>
            </div>
        </div>
    </body>
</html>
