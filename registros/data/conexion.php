<?php
	$link = mysqli_connect("localhost", "phcwebad_navike", "Server2003", "phcwebad_registros");

	if (mysqli_connect_errno()) {
		printf("Error de conexión: %s\n", mysqli_connect_error());
		exit();
	}
?>
