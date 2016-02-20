<?php
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects = array("profesor" => "profesor", "materia" => "unidadCurricular", );

function validaSelect($selectDestino){
	// Se valida que el select enviado via GET exista
	global $listadoSelects;
	if(isset($listadoSelects[$selectDestino])) return true;
	else return false;
}

function validaOpcion($opcionSeleccionada){
	// Se valida que la opcion seleccionada por el usuario en el select tenga un valor numerico
	if(is_numeric($opcionSeleccionada)) return true;
	else return false;
}

$selectDestino		= $_GET["select"];
$opcionSeleccionada = $_GET["cedula"];

if(validaSelect($selectDestino) && validaOpcion($opcionSeleccionada)){
	$tabla		 = $listadoSelects[$selectDestino];

	require_once('../conexion.php');
	$sql         = "SELECT * FROM \"unidadCurricular\"";
	$consultamateria= pg_query($conexion,$sql);	
	
	// Comienzo a imprimir el select
	?>
		
		<select id="<?php echo $selectDestino;?>" name="<?php echo $selectDestino;?>" onChange=''>
		<option value='0'>Seleccione una opci&oacute;n</option>
	<?php
	while($registrom=pg_fetch_array($consultamateria)){
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		$registrom[1]=htmlentities($registro[1]);
		// Imprimo las opciones del select
		echo "<option value='".$registrom['id']."'>".$registrom['nombre']." </option>";
	}			
	echo "</select> </label>";
	echo "";
}
?>

