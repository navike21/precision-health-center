<?php
//Base de datos

$mysqli = new mysqli("localhost", "phcwebad_navike", "Server2003", "phcwebad_registros");

//fecha de la exportación
$fecha = date("d-m-Y");
$consulta= "SELECT * FROM registros ORDER BY idregistro";
$resultado= $mysqli->query($consulta);

//Inicio de la instancia para la exportación en Excel
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=data_PHC-$fecha.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border=1> ";
echo "<tr> ";
echo "	<th style='background:#337ab7;color:#FFF;'>Fullname</th>";
echo "	<th style='background:#337ab7;color:#FFF;'>Email</th>";
echo "	<th style='background:#337ab7;color:#FFF;'>Services</th>";
echo "	<th style='background:#337ab7;color:#FFF;'>Date TIme</th>";
echo "</tr> ";
$a = 1;
while($row = mysqli_fetch_array($resultado)){

	$fullname = $row["fullname"];
	$email = $row["email"];
	$services = $row["services"];
	$fechaRegistro = $row["fechaRegistro"];

	echo '<tr>
		<td>'.strtoupper($fullname).'</td>
		<td>'.strtolower($email).'</td>
		<td>'.strtoupper($services).'</td>
		<td>'.$fechaRegistro.'</td>
	</tr>';
}
echo "</table> ";
?>
