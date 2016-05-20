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
        <script type="text/javascript" src="/incidentes/js/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="/incidentes/js/jquery-ui.js"></script>
        <script type="text/javascript" src="/incidentes/js/jquery.validate.js"></script>
        <link rel="stylesheet" type="text/css" href="/incidentes/css/estilo.css" />
        <link rel="stylesheet" type="text/css" href="/incidentes/css/jquery-ui.css" />
        <script>
            $(document).ready(function () {
                $("#sala").change(function (e) {
                    if ($("#sala").val() !== "") {
                        $.ajax({
                            url: "/incidentes/SistemaInformatico/cargarSI.php",
                            type: "POST",
                            data: "sala=" + $("#sala").val(),
                            success: function (opciones) {
                                $("#si").html(opciones).show("slow");
                                //$("#agregarProvincia").attr("hidden", false);
                                //$("#boton").attr("disabled", true);
                            }
                        });
                    } else {
                        $("#si").html("<option value=\"\">Seleccione...</option>")
                        //$("#selectLocalidad").html("<option>Seleccione...</option>")
                        //$("#agregarProvincia").attr("hidden", true);
                        //$("#boton").attr("disabled", true);
                    }
                });
                $("#formulario").validate({
                    submitHandler: function (form) {
                        if ($("#si").val() != "Seleccione...") {
                            $(form).submit();
                        } else {
                            alert("Seleccione un SI valido");
                        }
                    }
                });
                $("#Volver").click(function (mievento) {
                    mievento.preventDefault();
                    window.location = 'PrincipalSistemaInformatico.php';
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
                        <form name="formulario" id="formulario" action="ResultadosIncidentesPorComponente.php" method="post" class="contact_form">
                            <?php
                            require_once '../Conexion2.php';
                            ?>
                            <li><h2>Buscar Sistema Informático</h2></li>
                            <div style="width: 400px">
                                <table>
                                    <tr>
                                        <td><label for="sala">Sala:</label></td>
                                        <td>
                                            <?php
                                            $query = "select * from sala";
                                            $resultado = $mysqli->query($query);
                                            $aux = "<select name='sala' id='sala' required>";
                                            $aux.= "<option value=''>Seleccione...</option>";
                                            print($aux);
                                            while ($row = $resultado->fetch_assoc()) {
                                                $aux = "<option value =" . $row['id_sala'] . " >";
                                                $aux.= $row['nombre'] . "</option>";
                                                print($aux);
                                                $aux = "";
                                            }
                                            print '</select>';
                                            $resultado->free();
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label for="si">Identificaci&oacute;n:</label></td>
                                        <td>
                                            <?php #Segundo combo, Sistema informatico ?>
                                            <select name="si" id="si" required>
                                                <option value="">Seleccione...</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <li>
                                <button class="submit" name="Submit" id="Volver">Volver</button>
                                <button class="submit" name="siguiente" id="siguiente">Enviar</button>
                            <li/>
                        </form>
                    </div>
                </div>
                <?php include_once '../foot.php'; ?>
            </div>
        </div>
    </body>
</html>