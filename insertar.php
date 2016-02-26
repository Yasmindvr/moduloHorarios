<?php 
	require_once('../conexion.php');
	extract($_POST);
	//$query = "SELECT * FROM horario WHERE id_enlace = '$id_enlace[$i]' AND salon = '$edificio[$i]'";
	//$resultado = pg_query($query);
	//$fila  = pg_fetch_row($resultado);
	//if ($fila) { 
		$query = "UPDATE  horario SET id_enlace = '$id_enlace[$i]', periodo = '$periodo[$i]', trayecto = '$trayecto[$i]', trimestre = '$trimestre[$i]', seccion = '$seccion[$i]', materia = '$materia[$i]', profesor = '$profesor[$i]', carrera = '$carrera[$i]' WHERE id_enlace =  '$id_enlace[$i]'";
		$resultado = pg_query($query);			
	//}

	//elseif (isset($fila)) { 
		//$query = "INSERT INTO horario (id_enlace, periodo, trayecto, trimestre, seccion, materia, profesor, carrera, salon) VALUES ('$id_enlace[$i]', '$periodo[$i]', '$trayecto[$i]', '$trimestre[$i]', '$seccion[$i]', '$materia[$i]', '$profesor[$i]', '$carrera[$i]', '$edificio[$i]')";
		//$resultado = pg_query($query);	
	//}

	//echo($query)."<br />";
	//echo($i);
?>
<!--
<script type="text/javascript">
	window.location='../../index.php';
</script>
-->