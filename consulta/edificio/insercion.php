<?php 
	require_once('../conexion.php');
	extract($_POST);

	$querySede = "SELECT * FROM edificio ";
	$resultadoSede = pg_query($conexion, $querySede) or die("Error en la Consulta SQL Edificio");
	
	while ($registroSede=pg_fetch_array($resultadoSede)){
		
		
		if ($registroSede[1]==$nombre && $registroSede[2]==$sede){
			echo "El edificio ya existe";
			exit();
		}
		

	}
	$query1 = "INSERT INTO edificio VALUES (DEFAULT,'$nombre','$sede')";
			$resultado = pg_query($conexion, $query1);
			echo "Datos agregados correctamente&&success";
			
 ?>