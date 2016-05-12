<script>
    windows.onload = function () {
        document.getElementById("sala").onchange = function () {
            var nrosala = document.getElementById('sala').value;
            if (nrosala !== "") {
                valida2("http://localhost/incidentes/SistemaInformatico/mostrarSala.php");
            } else {
                document.getElementById('sistemaInformatico').innerHTML = "";
            }
        };
    }

    function inicializa_xhr2() {
        if (window.XMLHttpRequest) {
            return new XMLHttpRequest();
        }
        else if (window.ActiveXObject) {
            return new ActiveXObject("Microsoft.XMLHTTP");
        }
    }

    function valida2(url) {
        peticion_http = inicializa_xhr2();
        if (peticion_http) {
            peticion_http.onreadystatechange = procesaRespuesta2;
            peticion_http.open("POST", url, true);

            peticion_http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            var query_string = crea_query_string2();
            peticion_http.send(query_string);
        }
    }

    function procesaRespuesta() {
        if (peticion_http.readyState == READY_STATE_COMPLETE) {
            if (peticion_http.status == 200) {
                document.getElementById("sistemaInformatico").innerHTML = peticion_http.responseText;
            }
        }
    }
    function crea_query_string2() {
        var idSala = document.getElementById("sala");
        return "idSala=" + encodeURIComponent(idSala.value) +
                "&nocache=" + Math.random();
    }
</script>

<?php
require_once '../../Conexion2.php';
print '<table><tr>';
print '<td>Seleccione un aula:</td>';
$query = "select * from sala";
$resultado = $mysqli->query($query);
print '<td><select name="sala" id="sala" required>';
print '<option value="" >Seleccione...</option>';
while ($row = $resultado->fetch_assoc()) {
    print "<option value =\"" . $row['id_sala'] . "\" >";
    print $row['nombre'] . "</option>";
}
print '</select></td>';
$resultado->free();
print '</tabla>';
?>

<?php
print '<div id="sistemaInformatico" > ';
print '</div>';
print '<button class="submit" name="asignar" id="asignar">Asignar</button><button class="submit" name="volver3" id="Volver3">Volver</button>';
