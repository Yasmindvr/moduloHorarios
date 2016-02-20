<?php
$mater	= $_GET["select"];
$per = $_GET["id"];
$tiposal = $_GET["carrera"];
$seccion = $_GET["secc"];

	require_once('../conexion.php');
	if ($tiposal=='Salon') {
		$sqlHr = "SELECT \"horasTeoricas\" FROM \"ucMalla\" WHERE \"idUC\" = '$mater' AND id = '$per'";
		$consultaHr= pg_query($conex,$sqlHr) or die("ERROR");
		$registroHr=pg_fetch_array($consultaHr);
		$Chora=$registroHr[0];
		
	}
	if ($tiposal=='Laboratorio') {
		$sqlHr = "SELECT \"horasPracicas\" FROM \"ucMalla\" WHERE \"idUC\" = '$mater' AND periodo = '$per'";
		$consultaHr= pg_query($conex,$sqlHr) or die("ERROR");
		$registroHr=pg_fetch_array($consultaHr);
		$Chora=$registroHr[0];
		
	}
	$sqlHrr = "SELECT  chora, id_bloque FROM horario  WHERE materia = '$mater' AND seccion = $seccion GROUP BY id_bloque,chora";
	$consultaHrr= pg_query($conex,$sqlHrr) or die("ERROR");
	while($registropr=pg_fetch_array($consultaHrr)){
		$sumH=$registropr[0]+$sumH;
	}
	$horasDis=$Chora-$sumH;
	
	


$hora="ola";

?>
<div class="input-group">
<span class="input-group-addon">Horas Semanales</span>
<input type="text" id="horasS" name="horasS" required class="form-control"readonly value="<?php echo $Chora; ?>" >
</div>
</div>
<div class="input-group">
<span class="input-group-addon">N° de horas disponibles</span>
<input type="text" id="horasD"  name="horasD" required class="form-control"readonly value="<?php echo $horasDis; ?>" >
</div>
