<?php
session_start();
$permisos = array("6", "1");
$_SESSION['permisos'] = $permisos;
include_once '../../verificarPermisos.php';
require_once '../../Componente.class.php';
require_once '../../DetalleComponente.class.php';
require_once '../../Conexion.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Sistema de Gestion de Incidentes</title>
        <script type="text/javascript" src="/incidentes/js/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="/incidentes/js/jquery-ui.js"></script>
        <link rel="stylesheet" type="text/css" href="/incidentes/css/estilo.css" />
        <?php
        if ($_REQUEST['modo'] == "ins") {
            $titulo = "Registrar Fuente";
            $pagina = "Fuente.php?modo=ins";
            $Fuente = new Componente();
            $DetPotencia = new DetalleComponente();
        } else {
            $titulo = "Modificar Fuente";
            $pagina = "Fuente.php?modo=mod";
            $consulta = mysql_query("SELECT c.id_componente as id ,c.descripcion as modelo, c.id_marca AS marca, "
                    . "c.nro_patrimonio as patrimonio, c.nro_serie as serie, c.anio_adquisicion as anio, "
                    . "c.mes_adquisicion as mes FROM componente c WHERE c.id_sistema_informatico =" . $_SESSION['si'] . " "
                    . "and c.id_tipo_componente = 14 AND c.baja = 0 ");
            if (mysql_num_rows($consulta) == 0) {
                $Fuente = new Componente();
                $DetPotencia = new DetalleComponente();
            } else {
                while ($row = mysql_fetch_array($consulta)) {
                    $Fuente = new Componente();
                    $Fuente->setId_componente($row['id']);
                    $Fuente->setDescripcion($row['modelo']);
                    $Fuente->setId_marca($row['marca']);
                    $Fuente->setAño($row['anio']);
                    $Fuente->setMes($row['mes']);
                    $Fuente->setNro_patrimonio($row['patrimonio']);
                    $Fuente->setNro_serie($row['serie']);
                    $queryBuscarDetalle = "SELECT  D.valor as valor "
                            . "FROM detalle_componente D inner join componente C on (D.id_componente=C.id_componente) "
                            . "WHERE C.id_sistema_informatico = " . $_SESSION['si'] . " "
                            . "AND D.id_descipcion = 11 AND C.baja = 0 AND C.id_tipo_componente = 14";
                    $buscarDetalle = mysql_query($queryBuscarDetalle);
                    //echo $queryBuscarDetalle."<br/>";
                    if (mysql_num_rows($buscarDetalle) == 0) {
                        $DetPotencia = new DetalleComponente();
                    } else {
                        while ($row = mysql_fetch_array($buscarDetalle)) {
                            $DetPotencia = new DetalleComponente();
                            $DetPotencia->setValor($row['valor']);
                        }
                    }
                }
            }
        }
        ?>
        <script>
            $(document).ready(function () {
                $("#anio").spinner();
                $("#Volver").click(function (mievento) {
                    mievento.preventDefault();
                    window.location = '/incidentes/Componentes/CPU/PaginaCPUSegunda.php';
                });
            });
        </script>
    </head>

    <body id="top">
<?php include_once '../../master.php'; ?>
        <div id="site">
            <div class="center-wrapper">
<?php include_once '../../menu.php'; ?>

                <div class="main">
                    <div class="post">


                        <form action="<?php echo $pagina ?>" method="post" name="formulario" class="contact_form">
                            <li><h2><?php echo $titulo ?></h2><span class="required_notification">Los campos con (*) son obligatorios</span></li>
                            <div style="width: 600px;">
                                <table>
                                    <tr>
                                        <td> Sistema Informatico</td>
                                        <td><input name="SI" type="text" maxlength="20" readonly="true" value="<?php echo $_SESSION['si'] ?>" required/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Marca</td>
                                        <td>
<?php $consulta = mysql_query("select * from marca"); ?>
                                            <select name='marca' id="marca" required>
                                                <option value="" >Seleccione...</option>
                                                        <?php while ($row = mysql_fetch_array($consulta)) { ?>
                                                    <option value ="<?php echo $row['id_marca']; ?>" <?php if ($row['id_marca'] == $Fuente->getId_marca()) {
                                                            echo 'selected="true"';
                                                        }
                                                        ?>> <?php echo $row['descripcion'] ?> </option>
<?php } ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td> Modelo</td>
                                        <td><input name="modelo" id="modelo" type="text" maxlength="20" value="<?php echo $Fuente->getDescripcion() ?>" required/></td>
                                    </tr>

                                    <tr>
                                        <td>Numero de serie</td>
                                        <td><input name="nroSerie" id="nroSerie" type="text" size="50" maxlength="100" value="<?php echo $Fuente->getNro_serie() ?>"/></td>
                                    </tr>

                                    <tr>
                                        <td>Mes de adquisicion </td>
                                        <td>  
                                            <select name="mes" id="mes" required>
                                                <option value="" >Seleccione...</option>
                                                        <?php $mes = $Fuente->getMes() ?>
                                                <option value="1" <?php if (1 == $mes) {
                                                            echo 'selected="true"';
                                                        }
                                                        ?>> Enero</option>
                                                <option value="2" <?php if (2 == $mes) {
                                                            echo 'selected="true"';
                                                        }
                                                        ?>> Febrero</option>
                                                <option value="3" <?php if (3 == $mes) {
                                                            echo 'selected="true"';
                                                        }
                                                        ?>> Marzo</option>
                                                <option value="4" <?php if (4 == $mes) {
                                                            echo 'selected="true"';
                                                        }
                                                        ?>> Abril</option>
                                                <option value="5" <?php if (5 == $mes) {
                                                            echo 'selected="true"';
                                                        }
                                                        ?>> Mayo</option>
                                                <option value="6" <?php if (6 == $mes) {
                                                            echo 'selected="true"';
                                                        }
                                                        ?>> Junio</option>
                                                <option value="7" <?php if (7 == $mes) {
                                                            echo 'selected="true"';
                                                        }
                                                        ?>> Julio</option>
                                                <option value="8" <?php if (8 == $mes) {
                                                            echo 'selected="true"';
                                                        }
                                                        ?>> Agosto</option>
                                                <option value="9" <?php if (9 == $mes) {
                                                            echo 'selected="true"';
                                                        }
                                                        ?>> Septiembre</option>
                                                <option value="10" <?php if (10 == $mes) {
                                                            echo 'selected="true"';
                                                        }
                                                        ?>> Octubre</option>
                                                <option value="11" <?php if (11 == $mes) {
                                                    echo 'selected="true"';
                                                }
                                                        ?>> Noviembre</option>
                                                <option value="12" <?php if (12 == $mes) {
                                                    echo 'selected="true"';
                                                }
                                                        ?>> Diciembre</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Año adquisición</td>
                                        <td><input id="anio" name="año" value="<?php echo $Fuente->getAño() ?>" required/></td>
                                    </tr>


                                    <tr>
                                        <td>Proveedor</td>
                                        <td>    <?php $consulta = mysql_query("select * from proveedor"); ?>
                                            <select name='proveedor' id="proveedor"> 
                                                <option value="" >Seleccione...</option>
<?php while ($row = mysql_fetch_array($consulta)) { ?>
                                                    <option value ="<?php echo $row['id_proveedor'] ?>"><?php echo $row['nombre'] ?> </option>
<?php } ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Potencia</td>
                                        <td>
                                            <input type="text" name="potencia" value="<?php echo $DetPotencia->getValor() ?>" required/> Watts
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <button class="submit" name="volver" id="Volver">Volver</button>
                            <button class="submit" name="Registrar">Registrar</button>
<?php
$idSub = filter_input(INPUT_GET, "idSub");
if ($idSub != NULL) {
    ?>
                                <input  type="hidden" name="idSub" value="<?php echo $idSub ?>"/>
<?php } ?>
                        </form>
                    </div>
                </div>
<?php include_once '../../foot.php'; ?>
            </div>
        </div>
    </body>
</html>