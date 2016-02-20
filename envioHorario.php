<?php 
require_once('consulta/conexion.php');
	extract($_POST);
	
	$id_bloque=1;
	$dia.$hora.$edificio.$salon.$estructura.$carrera.$materia.$periodo.$seccion.$thora.$profesor.$chora;
	$horario = "SELECT id_bloque FROM horario  ORDER BY id_bloque DESC LIMIT 1";
	$reshorario = pg_query($conexion, $horario) or die("Error en la Consulta SQL (envio horario");
	while ($rowHor = pg_fetch_row($reshorario)) 
	{
		$id_bloque=$id_bloque+$rowHor[0];	
	}
	if($dia=='Lunes'){$diaE='1';}
	if($dia=='Martes'){$diaE='2';}
	if($dia=='Miercoles'){$diaE='3';}
	if($dia=='Jueves'){$diaE='4';}
	if($dia=='Viernes'){$diaE='5';}
	if($dia=='Sabado'){$diaE='6';}
	if($dia=='Domingo'){$diaE='7';}
	if (empty($materia)) {
		?>
			<script type="text/javascript">alert('Debe seleccionar una Materia ')</script>
		<?php 
		exit();
	}
	if (empty($periodo)) {
		?>
			<script type="text/javascript">alert('Debe seleccionar un perdiodo ')</script>
		<?php 
		exit();
	}
	if (empty($seccion)) {
		?>
			<script type="text/javascript">alert('Debe seleccionar una Seccion')</script>
		<?php 
		exit();
	}
	if (empty($profesor)) {
		?>
			<script type="text/javascript">alert('Debe seleccionar un Profesor')</script>
		<?php 
		exit();
	}
	if (empty($chora)) {
		?>
			<script type="text/javascript">alert('Debe seleccionar la cantidad de horas a asignar ')</script>
		<?php 
		exit();
	}
	if ($chora > $horasD) {
		?>
			<script type="text/javascript">alert('La cantidad de horas a asignar excede las horas disponibles ')</script>
		<?php 
		exit();
	}

	
	
$qBloq = "SELECT hora FROM horario WHERE salon='$salon' AND id_enlace='$diaE' ORDER BY hora ASC";
$resBloq = pg_query($conexion, $qBloq) or die("Error en la Consulta SQL (envio horario");
$a = array();
$c = 0;
while ($rowc = pg_fetch_row($resBloq)) 
{
	$a[$c] = $rowc;
	$c++;
}
if ($hora+$chora > 20) {
	?>
		<script type="text/javascript">alert('La cantidad de horas a asignar excede el espacio disponible ')</script>
	<?php 
	exit();
	
}
	# code...
for ($i=$hora; $i <= $hora+$chora-1 ; $i++)
{ 
	foreach ($a as $key) {
		if ($key[0]==$i) {
			?>
				<script type="text/javascript">alert('La cantidad de horas a asignar excede el espacio disponible ')</script>
			<?php 
			exit();
		}
			
	}
}
$b=0;
for ($j=1;$j <= $chora; $j++){
	$hor=$hora+$b;	
	$qBloq = "INSERT INTO horario VALUES ('$diaE','$periodo', '$thora', '$chora', '$seccion', '$materia', '$profesor', '$carrera', '$salon', '$hor', '$id_bloque', DEFAULT)";
	$pe = pg_query($conexion, $qBloq) or die("Error en la Consulta SQL");
	$b++;
}
if ($pe) {
		?>
			<script type="text/javascript">alert('Datos agregados correctamente'); window.location='principal.php?idsalon=<?php echo $salon; ?>'</script>
		<?php 
	}
?>