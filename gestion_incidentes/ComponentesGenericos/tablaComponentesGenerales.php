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
        <link rel="stylesheet" type="text/css" href="/incidentes/css/tabla.css" />
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
                        <li class="no_lista"><h2>Buscar componente</h2></li>
                        <h4>Listado de componentes</h4>
                        <div class="archive-separator"></div>

                        <?php
                        /**
                         * Aqui hay que colocar tomar los datos y hacer la busqueda del componente
                         */
                        if (true) {
                            ?>

                            <table class="listado">
                                <caption>Componentes Generales: Placa Madre</caption>
                                <thead>
                                    <tr>
                                        <th>
                                            Marca
                                        </th>
                                        <th>
                                            Modelo
                                        </th>
                                        <th>
                                            Año
                                        </th>
                                        <th>
                                            Mes
                                        </th>
                                        <th>
                                            Proveedor
                                        </th>
                                        <th>
                                            Selec.
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            Asus
                                        </td>
                                        <td>
                                            RX-580
                                        </td>
                                        <td>
                                            2013
                                        </td>
                                        <td>
                                            Febrero
                                        </td>
                                        <td>
                                            Bangho SA
                                        </td>
                                        <td>
                                            <input type="radio" name="seleccion"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Asus
                                        </td>
                                        <td>
                                            M81W-H
                                        </td>
                                        <td>
                                            2012
                                        </td>
                                        <td>
                                            Junio
                                        </td>
                                        <td>
                                            Compumundo
                                        </td>
                                        <td>
                                            <input type="radio" name="seleccion"/>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <h4>*** Aqui faltarian las caracteristicas (columnas) segun tipo componente elegido</h4>
                            <br/>

                                        <?php /**
                                          while ($row = mysql_fetch_array($query1)) {
                                          ?>
                                          <tr onclick="irDetalle(<?php echo $row['id']?>)">
                                          <td>
                                          <?php echo $row['id']?>
                                          </td>
                                          <td>
                                          <?php echo formatoFecha::convertirAFechaSolaWeb(substr($row['fecha'],0,10))?>
                                          </td>
                                          <td>
                                          <?php echo substr($row['fecha'], 11, 5) ?>
                                          </td>
                                          <td>
                                          <?php echo $row['si']?>
                                          </td>
                                          <td>
                                          <?php echo $row['sala']?>
                                          </td>
                                          <td>
                                          <?php echo $row['causa']?>
                                          </td>
                                          <td>
                                          <?php echo $row['estado']?>
                                          </td>
                                          </tr>
                                          <?php
                                          }  * */
                                        ?>
                            <?php
                        } else {
                            ?>
                            <h4>No se encontraron componentes</h4>
                            <?php
                        }
                        ?>
                        <h4>Asignacion a sistemas informaticos</h4>
                        <div class="archive-separator"></div>
                        <div style="width: 200px">
                        <table>
                            <tr>
                                <td>
                                    <label for="sala">Sala:</label>
                                </td>
                                <td>
                                    <?php $consulta = mysql_query("select * from sala"); ?>
                                    <select name="sala" id="sala">
                                       <option value="">A1</option>
                                       <?php while ($row = mysql_fetch_array($consulta)) { ?>
                                       <option value ="<?php echo $row['id_sala'] ?>"><?php echo $row['nombre'] ?></option>
                                       <?php } ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        </div>
                        <br/>
                        <br/>
                        <h5>Seleccione los SI que desee asignar el componente general:</h5>
                        <br/>
                        <br/>
                        <div style="height: 50px; width: 750px; font-size: 2em;">
                            <div style="float: left; height: 30px"><input type="checkbox" name="si101" id="si101" value="101" class="componentes"/>
                          <label for="si101">101</label><br/></div>
                            <div style="float: left; height: 30px"><input type="checkbox" name="si102" id="si102" value="102" class="componentes"/>
                          <label for="si102">102</label><br/></div>
                            <div style="float: left; height: 30px"><input type="checkbox" name="si103" id="si103" value="103" class="componentes"/>
                          <label for="si103">103</label><br/></div>
                            <div style="float: left; height: 30px"><input type="checkbox" name="si104" id="si104" value="104" class="componentes"/>
                          <label for="si104">104</label><br/></div>
                            <div style="float: left; height: 30px"><input type="checkbox" name="si105" id="si105" value="105" class="componentes"/>
                          <label for="si105">105</label><br/></div>
                            <div style="float: left; height: 30px"><input type="checkbox" name="si101" id="si101" value="106" class="componentes"/>
                          <label for="si101">106</label><br/></div>
                            <div style="float: left; height: 30px"><input type="checkbox" name="si102" id="si102" value="107" class="componentes"/>
                          <label for="si102">107</label><br/></div>
                            <div style="float: left; height: 30px"><input type="checkbox" name="si103" id="si103" value="108" class="componentes"/>
                          <label for="si103">108</label><br/></div>
                            <div style="float: left; height: 30px"><input type="checkbox" name="si104" id="si104" value="109" class="componentes"/>
                          <label for="si104">109</label><br/></div>
                            <div style="float: left; height: 30px"><input type="checkbox" name="si105" id="si105" value="110" class="componentes"/>
                          <label for="si105">110</label><br/></div>
                        </div>
                            <input type="checkbox" name="todos" id="todos" value="Seleccionar todos"/>
                              <label for="todos">Seleccionar todos</label><br/><br/><br/>
                        <button class="submit" name="asignar" type="submit" id="asignar">Asignar</button>
                        
                    </div>
                </div>
                <?php include_once '../foot.php'; ?>
            </div>
        </div>
    </body>
</html>
