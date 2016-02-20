<?php 
require_once('consulta/conexion.php');
if (!empty($_POST)) {
	$idr=$_POST['ide'];
	$query = "SELECT * FROM horario WHERE id = '$idr' " ;
	$resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");
	while ($filaa = pg_fetch_row($resultado)) { 
		if($filaa[0]=='1'){$dia='Lunes';}
		if($filaa[0]=='2'){$dia='Martes';}
		if($filaa[0]=='3'){$dia='Miercoles';}
		if($filaa[0]=='5'){$dia='Jueves';}
		if($filaa[0]=='6'){$dia='Viernes';}
		if($filaa[0]=='7'){$dia='Sabado';}
		if($filaa[0]=='8'){$dia='Domingo';}
		$querySalon = "SELECT * FROM edificio a INNER JOIN salones b ON  a.id = b.cod_edi WHERE b.id='$filaa[8]'";
		$resSalon = pg_query($conexion, $querySalon) or die("Error en la Consulta SQL");
		$resEdif = pg_fetch_row($resSalon);
		$Edif=$resEdif[1];
		$tipSal=$resEdif[5];
		$Salon=$resEdif[3];
		$Carre=$filaa[7];
		$Mate=$filaa[5];
		$period=$filaa[1];
		$thora=$filaa[2];
		$chora=$filaa[3];
		$hora=$filaa[9];
	}
}		

?>
<form id="horario" action="insertar.php" method="POST">
    <div class="input-group" >
        <span class='input-group-addon'>Día</span>
        <input type="text" name="tipo" required class="form-control"readonly value="<?php echo $dia; ?>" >
    </div>
    <div class="input-group" >
        <span class='input-group-addon'>Bloque</span>
        <input type="text" name="tipo" required class="form-control"readonly value="<?php echo $hora; ?>" >
    </div>
    <div class="input-group" >
        <span class='input-group-addon'>Edificio</span>
        <input type="text" name="tipo" required class="form-control"readonly value="<?php echo $Edif; ?>" >
    </div>
    <div class="input-group" >
        <span class='input-group-addon'><?php echo $tipSal; ?></span>
        <input type="text" name="tipo" required class="form-control"readonly value="<?php echo $Salon; ?>" >
    </div>
    <div class="input-group">
	    <span class="input-group-addon">Carrera</span>
	    <?php 
	        require_once('consulta/conexion.php');
	        $q1 = "SELECT * FROM carrera ORDER BY nombre ASC";
	        $res1 = pg_query($conex, $q1) or die("Error en la Consulta SQL poi");
	    ?>
      	<div>
        	<label id="labelse">
		        <select id='carrer' name='carrer' >
			        <option  value='0'>Seleccione una opción</option> 
			        <?php while ($row1 = pg_fetch_row($res1)) { ?>
		                <option value='<?= $row1[0]?>'<?php if ($row1[0]==$Carre) {echo "selected";}?>><?= $row1[1]?></option>
		            <?php } ?>
	        	</select>
        	</label>
        </div>
    </div>
    <div class="input-group">
	    <span class="input-group-addon">Materia</span>
	    <?php 
	        require_once('consulta/conexion.php');
	        $q2 = "SELECT * FROM \"unidadCurricular\" WHERE \"idCarrera\" ='$Carre' ORDER BY nombre ASC";
	        $res1 = pg_query($conex, $q2) or die("Error en la Consulta SQL poi");
	    ?>
      	<div>
        	<label id="labelse">
		        <select id='carrer' name='carrer' >
			        <option  value='0'>Seleccione una opción</option> 
			        <?php while ($row = pg_fetch_row($res1)) { ?>
		                <option value='<?= $row[0]?>'<?php if ($row[0]==$Mate) {echo "selected";}?>><?= $row[1]?></option>
		            <?php } ?>
	        	</select>
        	</label>
        </div>
    </div>
    <div class="input-group">
	    <span class="input-group-addon">Periodo</span>
	    <?php 
	        require_once('consulta/conexion.php');
	        $q3 = "SELECT * FROM \"ucMalla\" WHERE \"idUC\" ='$Mate' ";
	        $res1 = pg_query($conex, $q3) or die("Error en la Consulta SQL poi");
	    ?>
      	<div>
        	<label id="labelse">
		        <select id='carrer' name='carrer' >
			        <option  value='0'>Seleccione una opción</option> 
			        <?php while ($rowP = pg_fetch_row($res1)) { ?>
		                <option value='<?= $row[4]?>'<?php if ($rowP[4]==$period) {echo "selected";}?>><?= $rowP[4]?></option>
		            <?php } ?>
	        	</select>
        	</label>
        </div>
    </div>
    <div class="input-group" >
        <span class='input-group-addon'>Tipo de Hora</span>
        <input type="text" name="tipo" required class="form-control"readonly value="<?php echo $thora; ?>" >
    </div>
    <div class="input-group" >
        <span class='input-group-addon'>Cantidad de Horas</span>
        <input type="text" name="tipo" required class="form-control"readonly value="<?php echo $chora; ?>" >
    </div>
</form>