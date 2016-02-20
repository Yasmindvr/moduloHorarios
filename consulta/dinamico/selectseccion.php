
<?php
$selectDestino		= $_GET["select"];
$opcionSeleccionada = $_GET["id"];
$carrera = $_GET["carrera"];

require_once('../conexion.php');
//WHERE \"periodoEstructura\" = '$opcionSeleccionada'
	
	$sqlsecc         = "SELECT * FROM \"seccion\" a 
INNER JOIN \"mallaECS\" b ON a.\"idMECS\" = b.id
INNER JOIN \"estructuraCS\" c ON  b.\"idECS\" =c.id
INNER JOIN \"carreraSede\" d ON  c.\"idCS\" = d.id
INNER JOIN \"malla\" e ON  e.\"id\" = b.\"idMalla\"
INNER JOIN \"ucMalla\" f ON  f.\"idMalla\" = e.id

WHERE  f.id =$opcionSeleccionada AND a.\"periodoEstructura\"=f.periodo


";
	$consultasecc= pg_query($conex,$sqlsecc) or die("ERROR");	

?>
<select id="<?php echo $selectDestino;?>" name="<?php echo $selectDestino;?>" onChange='cargaContenidoPr(this.id)'>
		<option value='0'>Seleccione una opci&oacute;n</option>
		<option value='0'><?php echo $sqlsecc; ?></option>
<?php
	while($registrosecc=pg_fetch_array($consultasecc)){
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		
		// Imprimo las opciones del select
		echo "<option value='".$registrosecc[0]."'>".$registrosecc[1]."  </option>";
	}			
	echo "</select> </label>";
	echo "";

?>

