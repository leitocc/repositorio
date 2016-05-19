<?php
session_start();
$permisos = array("6", "1");
$_SESSION['permisos'] = $permisos;
include_once '../verificarPermisos.php';
require_once '../Conexion.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistemas Informaticos - Consultar Historial</title>
        <script type="text/javascript" src="/incidentes/js/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="/incidentes/js/jquery-ui.js"></script>
        <script type="text/javascript" src="/incidentes/js/jquery.validate.js"></script>
        <link rel="stylesheet" type="text/css" href="/incidentes/css/tabla.css" />
        <link rel="stylesheet" type="text/css" href="/incidentes/css/estilo.css" />
        <link rel="stylesheet" type="text/css" href="/incidentes/css/jquery-ui.css" />
        <script>
            function validarCampos() {
                if ($("#sala").val() !== "") {
                    if ($("#si").val() !== "") {
                        if ($("#tipo").val() !== "") {
                            return true;
                        } else {
                            alert("Seleccione un componente para realizar la busqueda");
                        }
                    } else {
                        alert("Seleccione un SI para realizar la busqueda");
                    }
                } else {
                    alert("Seleccione una sala para realizar la busqueda");
                }
                return false;
            }
            ;
            $(document).ready(function () {
                $("#sala").change(function (e) {
                    if ($("#sala").val() !== "") {
                        $.ajax({
                            url: "/incidentes/SistemaInformatico/cargarSI.php",
                            type: "POST",
                            data: "sala=" + $("#sala").val(),
                            success: function (opciones) {
                                $("#si").html(opciones).show("slow");
                            }
                        });
                    } else {
                        $("#si").html("<option>Seleccione...</option>")
                    }
                });
                /*$("#fechaD").datepicker({
                 dateFormat: 'dd/mm/yy',
                 maxDate: "+0D",
                 defaultDate: "-2w",
                 changeMonth: true,
                 changeYear: true,
                 numberOfMonths: 2,
                 onClose: function( selectedDate ) {
                 $( "#fechaH" ).datepicker( "option", "minDate", selectedDate );
                 }
                 });
                 $("#fechaH").datepicker({
                 dateFormat: 'dd/mm/yy',
                 maxDate: "+0D",
                 changeMonth: true,
                 changeYear: true,
                 numberOfMonths: 2,
                 onClose: function( selectedDate ) {
                 if(selectedDate !== ""){
                 $( "#fechaD" ).datepicker( "option", "maxDate", selectedDate );
                 }else{
                 $( "#fechaD" ).datepicker( "option", "maxDate", "+0D" );
                 }
                 }
                 });*/
                $("#Volver").click(function (mievento) {
                    mievento.preventDefault();
                    window.location = 'InicioReportes.php';
                });
                $("#buscar").click(function (e) {
                    e.preventDefault();
                    if (validarCampos()) {
                        $.ajax({
                            url: "/incidentes/SistemaInformatico/ajax/tablaHistoricoSI.php",
                            type: "POST",
                            data: "tipo=" + $("#tipo").val() + "&si=" + $("#si").val()
                                    + "&fechaD=" + $("#fechaD").val() + "&fechaH=" + $("#fechaH").val(),
                            success: function (opciones) {
                                $("#tablaHistorico").html(opciones).show("slow");
                            }
                        });
                    }
                });
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
                        <form name="formulario" id="formulario" action="PaginaConsultaHistorial.php?param=0" method="post" class="contact_form">
                            <li><h2>Buscar Sistema Informático</h2></li>
                            <div style="width: 600px;">
                                <table>
                                    <tr>
                                        <td>Sala:</td>
                                        <td>
                                            <?php $consultaSala = "select id_sala, nombre from sala" ?>
                                            <?php $query1 = mysql_query($consultaSala) ?>

                                            <?php #Primer combo de sala   ?>
                                            <select name="sala" id="sala" required>
                                                <option value="">Seleccione...</option>
                                                <?php while ($row = mysql_fetch_array($query1)) { ?>
                                                    <option value ="<?php echo $row['id_sala'] ?>"><?php echo $row['nombre'] ?></option>
                                                <?php } ?>
                                            </select>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Identificaci&oacute;n:</td>
                                        <td>
                                            <?php #Segundo combo, Sistema informatico  ?>
                                            <select name="si" id="si" required>
                                                <option value="">Seleccione...</option>
                                            </select>
                                        </td>
                                    </tr>

<!-- /**<td>Desde:</td>
  <td>
      <input type="date" name="fechaD" id="fechaD"/>
<td>Hasta:</td>
  <td>
      <input type="date" name="fechaH" id="fechaH"/>     
  </td>
<tr>  -->
                                    <td>Componente:</td>
                                    <td><?php $consulta = mysql_query("select * from tipo_componente"); ?>
                                        <select name='tipo' id="tipo" required>
                                            <option value="" >Seleccione...</option>
                                            <?php while ($row = mysql_fetch_array($consulta)) { ?>
                                                <option value ="<?php echo $row['id_tipo_componente']; ?>"><?php echo $row['descripcion'] ?> </option>
                                                }
                                            <?php } ?>
                                        </select>
                                    </td>
                                    </tr>  

                                </table>
                            </div>
                            <li>
                                <button class="submit" name="siguiente" id="buscar">Buscar</button>
                                <button class="submit" name="Submit" id="Volver">Volver</button>
                            </li>
                        </form>

                        <div id="tablaHistorico"></div>
                    </div>
                </div>
                <?php include_once './../foot.php'; ?>
            </div>
        </div>
    </body>
</html>
