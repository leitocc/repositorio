<?php
session_start();
$permisos = array("6", "1");
$_SESSION['permisos'] = $permisos;
include_once '../verificarPermisos.php';
include_once '../limpiarSesion.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistemas Informaticos</title>
        <link rel="stylesheet" type="text/css" href="/incidentes/css/estilo.css" />
    </head>
    <body id="top">
        <?php include_once '../master.php'; ?>
        <div id="site">
            <div class="center-wrapper">
                <?php include_once '../menu.php'; ?>

                <div class="main">
                    <div class="post">
                        <div style="clear: both">
                            <li class="no_lista"><h2>Reportes</h2></li>
                            <li class="no_lista"><h3><a href="ReporteIncidentesPorSI.php">Reporte Incidentes por Sistema Informático</a></h3></li>
                            <li class="no_lista"><h3><a href="PaginaConsultarSI.php"> Reporte Consultar Sistema Informático</a></h3></li>
                            <li class="no_lista"><h3><a href="PaginaConsultaHistorial.php?param=1">Reporte Consultar Historico Sistema Informático</a></h3></li>
                        </div>
                    </div>
                </div>
                <?php include_once '../foot.php'; ?>
            </div>
        </div>
    </body>
</html>
