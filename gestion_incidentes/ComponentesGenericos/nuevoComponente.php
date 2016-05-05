<?php
require_once '../Conexion2.php';
$idTC = filter_input(INPUT_POST, "idTipoComponente");
print '<div><table><tr>';
print '<td>Marca:</td>';
$query = "select * from marca";
$resultado = $mysqli->query($query);
print '<td><select name="marca" id="marca" required>';
print '<option value="" >Seleccione...</option>';
while ($row = $resultado->fetch_assoc()) {
    print "<option value =" . $row['id_tipo_componente'] . " >";
    print $row['descripcion'] . "</option>";
}
print '</select></td>';
$resultado->free();
print '</tr><tr>';
print '<td>Modelo:</td>';
print '<td><input name="modelo" id="modelo"/><td/>';
print '</tr><tr>';
print '<td>Mes de adquisicion </td>';
print '<td><select name="mes" id="mes" required>';
print '<option value="">Seleccione...</option>';
print '<option value="1">Enero</option>';
print '<option value="2">Febrero</option>';
print '<option value="3">Marzo</option>';
print '<option value="4">Abril</option>';
print '<option value="5">Mayo</option>';
print '<option value="6">Junio</option>';
print '<option value="7">Julio</option>';
print '<option value="8">Agosto</option>';
print '<option value="9">Septiembre</option>';
print '<option value="10">Octubre</option>';
print '<option value="11">Noviembre</option>';
print '<option value="12">Diciembre</option>';
print '</select></td>';
print '</tr><tr>';
print '<td>Año adquisición</td>';
print '<td><input id="anio" name="año" required/></td>';
print '</tr><tr>';
print '<td>Proveedor</td>';
$query = "select * from proveedor";
$resultado = $mysqli->query($query);
print '<td><select name="proveedor" id="proveedor" required>';
print '<option value="" >Seleccione...</option>';
while ($row = $resultado->fetch_assoc()) {
    print "<option value =" . $row['id_proveedor'] . " >";
    print $row['nombre'] . "</option>";
}
print '</select></td>';
$resultado->free();
print '</tr>';

/*
 * Aqui se colocan los detalles especificos segun tipo componente
 */
switch ($idTC) {
    case 1:
        print '<tr><td>Tipo de conexion (*)</td><td>';
        $query = "select * from tipo_conexion";
        $resultado = $mysqli->query($query);
        print '<td><select name="conexion" id="conexion" required>';
        print '<option value="" >Seleccione...</option>';
        while ($row = $resultado->fetch_assoc()) {
            print "<option value =" . $row['id_tipo_conexion'] . " >";
            print strtoupper($row['nombre']) . "</option>";
        }
        print '</select></td></tr>';
        $resultado->free();
        print '<tr><td>Medida (*)</td>';
        print '<td><input type="text" id="medida" name="medida" required/> Pulgadas</td>';
        print '</tr>';
        break;

    default:
        break;
}

print '</table>';
print '<button class="submit" name="Registrar">Registrar</button><button class="submit" name="volver" id="Volver">Volver</button>';
print '</div>';

