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
                            <li class="no_lista"><h2>Registrar nuevo componente general</h2></li>
                            <h4>Tipo de componente</h4>
                            <div class="archive-separator"></div>
                            <div style="width: 400px">
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
                                            ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <button name="siguiente" class="submit">Siguiente</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
<?php include_once '../foot.php'; ?>
            </div>
        </div>
    </body>
</html>
