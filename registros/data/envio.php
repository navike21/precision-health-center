<?php
	include_once("conexion.php");

	$nombres = htmlspecialchars($_POST["nombres"]);
	$apellidos = htmlspecialchars($_POST["apellidos"]);
	$direccion = htmlspecialchars($_POST["direccion"]);
	$telefono = $_POST["telefono"];
	$correo = $_POST["correo"];
	$check = htmlspecialchars($_POST["check"]);

	$fecha_registro = date("Y-m-d");
	
	$sql = "SELECT * FROM registros_quinde_ica_visa WHERE nombres = '$nombres' AND apellidos = '$apellidos' AND correo = '$correo'";

	$result = $link -> query($sql);

	$row_cnt = $result->num_rows;

	$sql2 = "SELECT * FROM registros_quinde_ica_visa WHERE correo = '$correo'";
	$result2 = $link -> query($sql2);

	$row_cnt2 = $result2->num_rows;

	if ($row_cnt < 1 ) {
	
		$consulta = "INSERT INTO registros_quinde_ica_visa VALUES('', '$nombres', '$apellidos', '$telefono', '$correo', '$check', '$fecha_registro')";
	}
	elseif ($row_cnt2 < 1 ) {
	
		$consulta = "INSERT INTO registros_quinde_ica_visa VALUES('', '$nombres', '$apellidos', '$telefono', '$correo', '$check', '$fecha_registro')";
	}

	$link -> query($consulta);
?>
