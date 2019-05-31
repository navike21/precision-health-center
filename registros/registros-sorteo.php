<?php
	include_once("data/conexion.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Registros de Formulario de registro actual</title>
		<link rel="stylesheet" href="css/registros.css" />
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css" />

		<script src="//code.jquery.com/jquery-1.12.4.js" charset="utf-8"></script>
		<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js" charset="utf-8"></script>
		<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js" charset="utf-8"></script>
		<style media="screen">
			td{
				font-size: 1.1rem;
			}
			#example_wrapper{
				width: 95%;
			}
		</style>
		<script type="text/javascript">
			$(document).ready(function() {
				var selected = [];
					$('#example').DataTable({
						"language": {
							"lengthMenu" 	: "Registros _MENU_",
							"zeroRecords"	: "No se encontraron registros",
							"info"			: "Página _PAGE_ de _PAGES_",
							"infoEmpty"		: "No hay registros disponibles",
							"infoFiltered"	: "(filtrados de _MAX_ registros totales)",
							"decimal"		: ",",
							"thousands"		: ".",
							"search"		: "Buscar: ",
							"paginate" : {
								"first"		: "Primero",
								"last"		: "Último",
								"next"		: "Siguiente",
								"previous"	: "Anterior"
							},
						},
						// "order": [[ 1, "asc" ]],
						"scrollY"			: 307,
						"scrollCollapse"	: true,
						"paging"			: true,
						"lengthMenu"		: [[7, 25, 50, -1], [7, 25, 50, "All"]],
						"columnDefs": [{
								"orderable"	: false,
								"targets"	: -1
						}] //NO ORDENAMOS LA ULTIMA FILA DE LA TABLA
					});
			});
		</script>
	</head>
	<body>
		<div class="w_100 section_middle_center" style="height:100vh;">
			<div class="active w_90 section_top_center">
				<a class="btn_default" href="excel2.php" target="_parent" style="width:200px;">Exportar a Excel Windows</a>
				<a class="btn_default" href="excel.php" target="_parent" style="width:200px;">Exportar a Excel Mac</a>
			</div>
			<table id="example" data-seccion="distrito" class="hover table table-striped table-bordered display compact" cellspacing="0" width="100%" align="center">
				<thead>
					<tr>
						<th width="20">#</th>
						<th>Full name</th>
						<th>Email</th>
						<th>Select a Service</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$consulta = "SELECT * FROM registros ORDER BY fechaRegistro ASC";
						$sql = mysqli_query($link, $consulta);
						$row = mysqli_num_rows($sql);
						$a = 1;
						for ($i=0; $i < $row; $i++) {
							$col = mysqli_fetch_array($sql, MYSQLI_ASSOC);
							$apellidos = $col["apellidos"];
							$nombres = $col["nombres"];
							$direccion = $col["direccion"];
							$telefono = $col["telefono"];
							$correo = $col["correo"];
							//$fecha_nac = $col["fecha_nac"];
							$hijos = $col["tienes_hijos"];
							$fecha_registro = $col["fecha_registro"];
							echo '<tr>
								<td style="text-align:center;">'.$a.'</td>
								<td>'.strtoupper($apellidos).' '.strtoupper($nombres).'</td>
								<td>'.strtoupper($direccion).'</td>
								<td>'.$telefono.'</td>
								<td>'.strtolower($correo).'</td>
								
								<td style="text-align:center;">'.strtolower($hijos).'</td>
								<td style="text-align:center;">'.$fecha_registro.'</td>
							</tr>';
							$a++;
						}
					?>
				</tbody>
				<tfoot>
					<tr>
						<th width="20">#</th>
						<th>Apellidos y Nombres</th>
						<th>Dirección</th>
						<th>Teléfono</th>
						<th>Correo</th>
						<th>Hijos</th>
						<th>Fecha de Registro</th>
					</tr>
				</tfoot>
			</table>
		</div>
	</body>
</html>
