<?php
require_once '../../Conexion.php';
require_once '../../formatoFecha.class.php';
$tipoCom = filter_input(INPUT_POST, "tipo");
$si = filter_input(INPUT_POST, "si");
$fechaH = filter_input(INPUT_POST, "fechaH");
$fechaD = filter_input(INPUT_POST, "fechaD");
$select = "SELECT TC.descripcion as componente, M.descripcion as marca, C.descripcion as modelo, "
        . "C.mes_adquisicion as mes, C.anio_adquisicion as anio, C.nro_patrimonio as patrimonio, "
        . "C.nro_Serie as serie, C.fecha_instalacion as fechaI, C.baja as baja, C.Fecha_baja as fechaB "
        . "FROM componente C inner join tipo_componente TC on (C.id_tipo_componente=TC.id_tipo_componente) "
        . "INNER JOIN marca M on (C.id_marca=M.id_marca) where C.id_sistema_informatico = ".$si;
/*echo $tipoCom."<br/>";
echo $si."<br/>";
echo $fechaD."-".$fechaH."<br/>";*/
if ($tipoCom != ""){
    $select = $select." AND C.id_tipo_componente = ".$tipoCom;
}
if ($fechaD != "" && $fechaH != ""){
    
    $select = $select." AND ((C.fecha_baja between '".formatoFecha::convertirAFechaSolaBD($fechaD)."' and "
            . "'".formatoFecha::convertirAFechaSolaBD($fechaH)."') OR ISNULL(C.fecha_baja))";
}elseif($fechaD != ""){
    $select = $select." AND (C.fecha_baja > '".formatoFecha::convertirAFechaSolaBD($fechaD)."' OR ISNULL(C.fecha_baja))";
}elseif($fechaH != ""){
    $select = $select." AND (C.fecha_baja < '".formatoFecha::convertirAFechaSolaBD($fechaH)."' OR ISNULL(C.fecha_baja))";
}

//echo $select."<br/>";
$consulta = mysql_query($select);
if (mysql_errno()){
    printf("Error en la consulta %s\n", mysql_error());
    exit();
}else{

            if(mysql_affected_rows() <= 0) {
            ?>
                <h4>No tiene este tipo de componente</h4>
            <?php
            }else{?>
    <table class="listado2">
        <thead>
            <tr>
                <th>Tipo de componente</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Mes de adquisición</th>
                <th>Nro. de patrimonio</th>
                <th>Nro. de serie</th>
                <th>Fecha de alta</th>
                <th>Baja</th>
                <th>Fecha Baja</th>
            </tr>
        </thead>
        <tbody>
                <?php 
                while($row = mysql_fetch_array($consulta)){
                $componente=$row['componente'];
                if ($row['marca']== "") {
                                $marca = "-";
                            }else{
                                $marca = $row['marca']; 
                            }
                if(empty($row['modelo'])){
                                $descripcion = "-";
                            }else{
                                $descripcion = $row['modelo'];
                            }
                /*if(empty($row['mes']) and empty($row['anio'])){
                                $fecha='-';
                            }else{
                                if(empty($row['mes']) and !empty($row['anio'])){
                                    $fecha = "01/01/".$row['anio'];
                                }
                                    else { if(empty($anio) and !empty($row['mes'])){
                                    $fecha= "01/".$row['mes']."/"."1990"; 
                                        }else{
                                        $fecha = "01/".$row['mes']."/".$row['anio'];
                                        }
                                    }
                                }  */
                            $fecha = formatoFecha::nombreMes($row['mes'])." - ".$row['anio'];
                               
                             if(empty($row['patrimonio']) or $row['patrimonio']=== 'null'){
                                 $patrimonio = "-";
                             }else{
                                 $patrimonio = $row['patrimonio'];
                             }
                             
                             if(empty($row['serie'])){
                                 $serie = "-";
                             } else{
                                 $serie = $row['serie'];
                             }
                if(empty($row['fechaI'])){
                                $fechaI = "-";
                            }else{
                                $fechaI = formatoFecha::convertirAFechaSolaWeb($row['fechaI']);
                            }
                if($row['baja']==0){
                    $baja="No";
                }else{
                    $baja="Si";
                }            
                if(empty($row['fechaB'])){
                                $fechaB = "-";
                            }else{
                                $fechaB = formatoFecha::convertirAFechaWeb($row['fechaB']);
                            } ?>
                <tr>
                    <td><?php echo $componente ?></td>
                    <td><?php echo $marca?></td>
                    <td><?php echo $descripcion?></td>
                    <td><?php echo $fecha?></td>
                    <td><?php echo $patrimonio?></td>
                    <td><?php echo $serie?></td>
                    <td><?php echo $fechaI?></td>
                    <td><?php echo $baja?></td>
                    <td><?php echo $fechaB?></td> 
                </tr><?php          
            }?>
                <tr>
                    
                </tr><?php
            }
            ?>
        </tbody>
    </table>
<?php } 