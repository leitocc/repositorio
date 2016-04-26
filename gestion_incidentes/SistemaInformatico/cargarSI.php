<?php
    require_once '../Conexion.php';

    $sala = $_POST['sala'];
    $consultaSI ="select id_sistema_informatico from sistema_informatico where baja=0 and id_sala=".$sala;
    $query1 =  mysql_query($consultaSI);
?>
    <option value="">Seleccione...</option>
<?php while ($row = mysql_fetch_array($query1)) { ?>
    <option value ="<?php echo $row['id_sistema_informatico'] ?>"><?php echo $row['id_sistema_informatico'] ?></option>
<?php } ?>