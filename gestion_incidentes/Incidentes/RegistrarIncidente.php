<?php
session_start();
$permisos = array("6", "1");
$_SESSION['permisos'] = $permisos;
include_once '../verificarPermisos.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Incidentes - Registrar Nuevo Incidente</title>
        <script type="text/javascript" src="/incidentes/js/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="/incidentes/js/jquery-ui.js"></script>
        <script type="text/javascript" src="/incidentes/js/jquery.datetimepicker.js"></script>
        <script type="text/javascript" src="/incidentes/js/jquery.datepicker-es.js"></script>
        <script type="text/javascript" src="/incidentes/js/jquery.validate.js"></script>
        <link rel="stylesheet" type="text/css" href="/incidentes/css/estilo.css" />
        <link rel="stylesheet" type="text/css" href="/incidentes/css/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="/incidentes/css/jquery.datetimepicker.css" />
        <script>
            $(document).ready(function () {
                $("#sala").change(function (e) {
                    if ($("#sala").val() !== "Seleccione...") {
                        $.ajax({
                            url: "/incidentes/SistemaInformatico/cargarSI.php",
                            type: "POST",
                            data: "sala=" + $("#sala").val(),
                            success: function (opciones) {
                                $("#si").html(opciones).show("slow");
                            }
                        });
                    } else {
                        $("#si").html("<option>Seleccione...</option>");
                    }
                });

                $("#componenteAfectado").change(function (e) {
                    if ($("#componenteAfectado").val() !== "Seleccione...") {
                        $.ajax({
                            url: "/incidentes/Incidentes/ajax/cargarIndicioIncidentes.php",
                            type: "POST",
                            data: "componenteAfectado=" + $("#componenteAfectado").val(),
                            success: function (opciones) {
                                $("#indicio").html(opciones).show("slow");
                            }
                        });
                    } else {
                        $("#indicio").html("<option>Seleccione...</option>");
                    }
                });


                $("#preguntaAct").change(function (ev) {
                    if ($("#preguntaAct").val() !== "1") {
                        $("#actividad").attr("hidden", true);
                    } else {
                        $("#actividad").attr("hidden", false);
                    }
                });

                //Falta hacer que cuando se refresque la pagina quede seleccionado NO
                $("#preguntaAct").html('<option selected="true" value="0">No</option><option value="1">Si</option>');
                $("#actividad").attr("hidden", true);
                //$( "#fecha" ).datepicker();
                $("#fecha").datetimepicker({
                    lang: 'es',
                    format: 'd/m/Y H:i'
                            /* i18n:{
                             de:{
                             months:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                             'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                             dayOfWeek:['Dom', 'Lun', 'Mar', 'Mi&eacute;', 'Juv', 'Vie', 'S&aacute;b']
                             }
                             },
                             timepicker:true*/
                            //mask: true
                            //showSecond: true,
                            //timeFormat: "HH:mm",
                            //changeMonth: true,
                            //changeYear: true
                });
                $("#cancelar").click(function (mievento) {
                    mievento.preventDefault();
                    //history.back();
                    window.location = '/incidentes/Incidentes/InicioIncidentes.php';
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

                        <?php
                        require_once '../Conexion2.php';
                        ?>
                        <form id="formulario" name="formulario" method="post" action="registrarI.php" class="contact_form">
                            <li><h2>Registrar Nuevo Incidente</h2><span class="required_notification">Los campos con (*) son requeridos</span></li>
                            <div class="clearer">&nbsp;</div>
                            <h4>Datos incidentes</h4>
                            <div class="archive-separator"></div>
                            <div style="width: 500px;">
                                <table>
                                    <tr>
                                        <td>Nro:</td>
                                        <td>
                                            <?php
                                            $consultaNroInc = "SELECT MAX(I.id_incidente) AS id
                                            FROM incidente I";
                                            $resultado1 = $mysqli->query($consultaNroInc);
                                            if ($row = $resultado1->fetch_assoc()) {
                                                $id['id'] = $row["id"];
                                                //echo "Entro y Id vale: ".$id['id']."<br/>";
                                            } else {
                                                $id['id'] = 0;
                                            }
                                            //echo "Id vale: ".$id['id']."<br/>";
                                            ?>
                                            <input type="text" id="nroIncidente" name="nroIncidente" readonly="true" value="<?php echo $id['id'] + 1 ?>" size="4" required/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>*Fecha:</td>
                                        <td>
                                            <input type="datetime" id="fecha" name="fecha" placeholder="__/__/____ __:__" required/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>*Turno:</td>
                                        <td colspan="3">
                                            <select id="turno" name="turno" required>
                                                <option value="">Seleccione...</option>
                                                <?php
                                                $consultaTurno = "SELECT T.nombre_turno AS nombre, T.id_turno AS id
                                                FROM turno T";
                                                //$query2 = mysql_query($consultaTurno);
                                                $resultado2 = $mysqli->query($consultaTurno);
                                                // if (mysql_errno() == 0) {
                                                if ($resultado2) {

                                                    //while ($row = mysql_fetch_array($query2)) {
                                                    while ($row = $resultado2->fetch_assoc()) {
                                                        ?>
                                                        <option value ="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <h4>Sistema informatico afectado</h4>
                            <div class="archive-separator"></div>
                            <div style="width: 800px;">
                                <table>
                                    <tr>
                                        <td>*Institución:</td>
                                        <td>
                                            <select id="institucion" name="institucion" required>
                                                <option value="">Seleccione...</option>
                                                <?php
                                                $consultaInstitucion = "SELECT I.nombre, I.id_institucion AS id
                                                FROM institucion I";
                                                //$query3 = mysql_query($consultaInstitucion);
                                                $resultado3 = $mysqli->query($consultaInstitucion);
                                                if ($resultado3) {
                                                    //while ($row = mysql_fetch_array($query3)) {
                                                    while ($row = $resultado3->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?php echo $row['id'] ?>" selected="true"><?php echo $row['nombre'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>*Edificio:</td>
                                        <td>
                                            <select id="edificio" name="edificio" required>
                                                <option value="">Seleccione...</option>
                                                <?php
                                                $consultaEdificio = "SELECT E.nombre, E.id_edificio AS id
                                                FROM edificio E";
                                                //$query4 = mysql_query($consultaEdificio);
                                                $resultado4 = $mysqli->query($consultaEdificio);
                                                if ($resultado4) {
                                                    while ($row = $resultado4->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?php echo $row['id'] ?>" selected="true"><?php echo $row['nombre'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>*Sala:</td>
                                        <td>
                                            <select id="sala" name="sala" required>
                                                <option value="">Seleccione...</option>
                                                <?php
                                                $consultaSala = "SELECT S.nombre, S.id_sala AS id
                                                FROM sala S";
                                                //$query5 = mysql_query($consultaSala);
                                                $resultado5 = $mysqli->query($consultaSala);
                                                if ($resultado5) {
                                                    //while ($row = mysql_fetch_array($query5)) {
                                                    while ($row = $resultado5->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>*Sistema Informatico:</td>
                                        <td>
                                            <select id="si" name="si" required>
                                                <option value="">Seleccione...</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <h4>Detalle del incidente</h4>
                            <div class="archive-separator"></div>
                            <div style="width: 800px;">
                                <table>
                                    <tr>
                                        <td>*Probable Componete Afectado</td>
                                        <td colspan="3">
                                            <select id="componenteAfectado" name="componenteAfectado">
                                                <option value="">Seleccione...</option>
                                                <?php
                                                $consulta123 = "SELECT tc.id_tipo_componente AS id ,tc.descripcion FROM tipo_componente tc";
                                                //$query13 = mysql_query($consulta123);
                                                $resultado6 = $mysqli->query($consulta123);
                                                if ($resultado6) {
                                                    while ($row = $resultado6->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['descripcion'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>     
                                    </tr>
                                    <tr>
                                        <td>Indicio de incidente:</td>
                                        <td colspan="3">
                                            <select id="indicio" name="indicio" required>
                                                <option value="">Seleccione...</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>*Reportó:</td>
                                        <td>
                                            <select id="reporto" name="reporto" required>
                                                <?php
                                                $consultaReporto = "SELECT P.apellido, P.nombre, P.id_persona AS id
                                                FROM persona P INNER JOIN usuario U ON P.id_persona = U.id_persona 
                                                AND U.usuario = \"" . $_SESSION['usuario'] . "\"";
                                                // $query7 = mysql_query($consultaReporto);
                                                $resultado7 = $mysqli->query($consultaReporto);
                                                if ($resultado7) {
                                                    while ($row = $resultado7->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['apellido'] . ", " . $row['nombre'] ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>*Área:</td>
                                        <td>
                                            <select id="area" name="area" required>
                                                <option value="">Seleccione...</option>
                                                <?php
                                                $consultaArea = "SELECT R.nombre, R.id_rol AS id
                                                FROM rol R";
                                                //$query8 = mysql_query($consultaArea);
                                                $resultado8 = $mysqli->query($consultaArea);
                                                if ($resultado8) {
                                                    while ($row = $resultado8->fetch_assoc()) {
                                                        if ($row['nombre'] !== "Administrador" && $row['nombre'] !== "Admin" && $row['nombre'] !== "Administrator") {
                                                            ?>
                                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre'] ?></option>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Descripción del incidente:</td>
                                        <td colspan="3">
                                            <textarea id="descripcion" name="descripcion" cols="40" rows="4" required></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <h4>Actividad en desarrollo</h4>
                            <div class="archive-separator"></div>
                            <div style="width: 300px;">
                                <table>
                                    <tr>
                                        <td>¿Se realizaba una actividad?</td>
                                        <td>
                                            <select id="preguntaAct" name="preguntaAct">
                                                <option selected="true" value="0">No</option>
                                                <option value="1">Si</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div id="actividad" hidden="true" style="width: 500px;">
                                <table>
                                    <tr>
                                        <td>Nombre:</td>
                                        <td>
                                            <input type="text" placeholder="Actividad" id="nombreAct" name="nombreAct" value="" size="20"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nivel:</td>
                                        <td>
                                            <input type="text" placeholder="Ej: 1" id="nivel" name="nivel" value=""  size="2"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Responsable 1:</td>
                                        <td>
                                            <input type="text" placeholder="Apellido, Nombre" id="responsable1" name="responsable1" value=""  size="15"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Responsable 2:</td>
                                        <td>
                                            <input type="text" placeholder="Apellido, Nombre" id="responsable2" name="responsable2" value=""  size="15"/>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <button class="submit" type="submit" name="cancelar" id="cancelar">Cancelar</button>
                            <button class="submit" name="registrar" type="submit" id="registrar">Registrar</button>
                        </form>
                    </div>
                </div>
                <?php include_once './../foot.php'; ?>
            </div>
        </div>
    </body>
</html>