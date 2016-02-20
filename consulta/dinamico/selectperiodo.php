<?php
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects = array("materia" => "unidadCurricular", "periodo" => "ucuMalla", );



$selectDestino		= $_GET["select"];
$opcionSeleccionada = $_GET["id"];


	$tabla		 = $listadoSelects[$selectDestino];

	require_once('../conexion.php');
	
	$sqlperiodo         = "SELECT * FROM \"ucMalla\" WHERE \"idUC\"='$opcionSeleccionada' ";
	$consultamateria= pg_query($conex,$sqlperiodo) or die("ERROR");	
	
	// Comienzo a imprimir el select
	?>
		
		<select id="<?php echo $selectDestino;?>" name="<?php echo $selectDestino;?>" onChange='cargaContenidoSc(this.id)'>
		<option value='0'>Seleccione una opci&oacute;n</option>
	<?php
	while($registrom=pg_fetch_array($consultamateria)){
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		$registrom[1]=htmlentities($registro[1]);
		// Imprimo las opciones del select
		echo "<option value='".$registrom[0]."'>".$registrom[4]."  </option>";
	}			
	echo "</select> </label>";
	echo "";

?>

