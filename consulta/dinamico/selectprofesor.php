
<?php
$selectDestino		= $_GET["select"];
$opcionSeleccionada = $_GET["id"];
$materia = $_GET["materia"];
$secc = $_GET["seccion"];

require_once('../conexion.php');

	$sqlpr = "SELECT * FROM profesor a
INNER JOIN persona b ON a.cedula = b.cedula
INNER JOIN carga c ON a.cedula = c.\"idProfesor\"
WHERE c.\"idSeccion\"= $secc AND c.\"idUC\"='$materia'
";
	$consultapr= pg_query($conex,$sqlpr) or die("ERROR");	

?>
<select id="<?php echo $selectDestino;?>" name="<?php echo $selectDestino;?>" onChange='cargaContenidoHr(this.id)'>
		<option value='0'>Seleccione una opci&oacute;n</option>
<?php
	while($registropr=pg_fetch_array($consultapr)){
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		
		// Imprimo las opciones del select
		echo "<option value='".$registropr[0]."'>".$registropr[6]." ".$registropr[8]."  </option>";
	}			
	echo "</select> </label>";
	echo "";

?>

