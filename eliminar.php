<?php
	require_once('consulta/conexion.php');
	extract($_POST);
	$horarioE = "SELECT salon FROM horario WHERE id_bloque = $ide";
	$reshorarioE = pg_query($conexion, $horarioE) or die("Error en la Consulta SQL ");
	$rowE = pg_fetch_row($reshorarioE);
	$salon = $rowE[0];
	$horarioEl = "DELETE FROM horario WHERE id_bloque = $ide";
	$reshorarioEl = pg_query($conexion, $horarioEl) or die("Error en la Consulta SQL ");

	
?>
?>
	<script type="text/javascript">alert('Datos eliminados correctamente'); window.location='principal.php?idsalon=<?php echo $salon; ?>'</script>
<?php 