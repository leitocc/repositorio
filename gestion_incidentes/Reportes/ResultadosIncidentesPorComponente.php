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
                            <li><h2>Reporte Incidentes por componente afectado</h2></li>
                            <li><h3>Incidentes que afectaron el Sistema Informatico: 605</h3></li>
                            <li><h4>Seleccione componente afectado:</h4></li>
                            <table>
                                <tr>
                                    <td>Componente:</td>
                                    <td>
                                        <select>
                                            <option value="">Seleccione...</option>
                                            <option value="1">Monitor</option>
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
                                            Indicio<br/>de origen
                                        </th>
                                        <th>
                                            Cantidad<br/>Intervenciones
                                        </th>
                                        <th>
                                            Tiempo total<br/>intervencion componente
                                        </th>
                                        <th>
                                            Estado<br/>Incidente
                                        </th>
                                        <th>
                                            Ver<br/>detalles
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>24/02/2015</td>
                                        <td>18:20</td>
                                        <td>No hay Imagen</td>
                                        <td>2</td>
                                        <td>2:00 hs</td>
                                        <td>Solucionado</td>
                                        <td><a href="../Incidentes/DetalleIncidente.php?id=1">Ir...</a></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>18/07/2015</td>
                                        <td>12:00</td>
                                        <td>No enciende</td>
                                        <td>1</td>
                                        <td>0:30 hs</td>
                                        <td>Vigente</td>
                                        <td><a href="../Incidentes/DetalleIncidente.php?id=4">Ir...</a></td>
                                    </tr>
                                </tbody>
                            </table>
                            <h4>Total: 2 registros</h4>
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