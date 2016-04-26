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
                        <form action="nuevoComponente.php" method="post" name="formulario" class="contact_form">
                            <li class="no_lista"><h2>Buscar componente general</h2></li>
                            <h4>Seleccione caracteristicas</h4>
                            <div class="archive-separator"></div>
                            <table>
                                <tr>
                                    <td>Tipo de componente</td>
                                    <td>
                                        <?php
                                        $query = "select * from tipo_componente";
                                        $resultado = $mysqli->query($query);
                                        $aux = "<select name='tipoComponente' id='tipoComponente' required>";
                                        $aux.= "<option value=''>Seleccione...</option>";
                                        print($aux);
                                        while ($row = $resultado->fetch_assoc()) {
                                            $aux = "<option value =" . $row['id_tipo_componente'] . " >";
                                            $aux.= $row['descripcion'] . "</option>";
                                            print($aux);
                                            $aux = "";
                                        }
                                        $resultado->free();
                                        print '</select>'
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Marca</td>
                                    <td>
                                        <?php
                                        $query = "select * from marca";
                                        $resultado = $mysqli->query($query);
                                        $aux = "<select name='marca' id='marca' required>";
                                        $aux.= "<option value=''>Seleccione...</option>";
                                        print($aux);
                                        while ($row = $resultado->fetch_assoc()) {
                                            $aux = "<option value =" . $row['id_marca'] . " >";
                                            $aux.= $row['descripcion'] . "</option>";
                                            print($aux);
                                            $aux = "";
                                        }
                                        $resultado->free();
                                        print '</select>'
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Modelo</td>
                                    <td>
                                        <input name="modelo" id="modelo" type="text"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <button name="buscar" class="submit">Buscar</button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                <?php include_once '../foot.php'; ?>
            </div>
        </div>
    </body>
</html>
