<?php
session_start();
$permisos = array("6", "1");
$_SESSION['permisos'] = $permisos;
include_once '../verificarPermisos.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistemas Informaticos - Consultar</title>
        <link rel="stylesheet" type="text/css" href="/incidentes/css/estilo.css" />
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
                        <form name="formulario" id="formulario" action="#" method="post" class="contact_form">
                            <?php
                            require_once '../Conexion2.php';
                            ?>
                            <li><h2>Reporte Incidentes por SI</h2></li>
                            <li><h3>Sistema Informatico: 606</h3></li>
                            <li><h4>Filtrar por:</h4></li>
                            <table>
                                <tr>
                                    <td>Componente:</td>
                                    <td>
                                        <select>
                                            <option value="">Seleccione...</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            
                            <table class="listado2">
                                <thead>
                                    <tr>
                                        <th>
                                            Nro. Incidente
                                        </th>
                                        <th>
                                            Fecha
                                        </th>
                                        <th>
                                            Hora
                                        </th>
                                        <th>
                                            Causa
                                        </th>
                                        <th>
                                            Estado
                                        </th>
                                        <th>
                                            Ir...
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                </tbody>
                            </table>
                            <li>
                                <button class="submit" name="Submit" id="Volver">Volver</button>
                            <li/>
                        </form>
                    </div>
                </div>
                <?php include_once '../foot.php'; ?>
            </div>
        </div>
    </body>
</html>