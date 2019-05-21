<?php
//Base de datos

$mysqli = new mysqli("localhost", "adretail_ivan", "Server2003", "adretail_quinde");

//fecha de la exportación
$fecha = date("d-m-Y");
$consulta= "SELECT * FROM quinde_ica_sorteo_album ORDER BY apellidos";
$resultado= $mysqli->query($consulta);

//Inicio de la instancia para la exportación en Excel
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=RegistrosQuindeIca_$fecha.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border=1> ";
echo "<tr> ";
echo "	<th style='background:#337ab7;color:#FFF;'>Apellidos</th>";
echo "	<th style='background:#337ab7;color:#FFF;'>Nombres</th>";
echo "	<th style='background:#337ab7;color:#FFF;'>Dirección</th>";
echo "	<th style='background:#337ab7;color:#FFF;'>Teléfono</th>";
echo "	<th style='background:#337ab7;color:#FFF;'>Correo</th>";
echo "	<th style='background:#337ab7;color:#FFF;'>Hijos</th>";
echo "	<th style='background:#337ab7;color:#FFF;'>Fecha de Registro</th>";
echo "</tr> ";
$a = 1;
while($row = mysqli_fetch_array($resultado)){

	$apellidos = $row["apellidos"];
	$nombres = $row["nombres"];
	$direccion = $row["direccion"];
	$telefono = $row["telefono"];
	$correo = $row["correo"];
	$hijos = $row["tienes_hijos"];
	$fecha_registro = $row["fecha_registro"];

	echo '<tr>
		<td>'.strtoupper($apellidos).'</td>
		<td>'.strtoupper($nombres).'</td>
		<td>'.strtoupper($direccion).'</td>
		<td>'.strtoupper($telefono).'</td>
		<td>'.strtolower($correo).'</td>
		<td>'.strtolower($hijos).'</td>
		<td>'.$fecha_registro.'</td>
	</tr>';
}
echo "</table> ";
?>
