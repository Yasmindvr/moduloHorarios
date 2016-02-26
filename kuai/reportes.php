<?php 
	$sqlP="SELECT profesor FROM HORARIO GROUP BY profesor";
	$resultadoP= pg_query($conexion, $sqlP) or die("Error en la Consulta SQL poi");
	$query = "SELECT * FROM edificio a INNER JOIN sede b ON b.id = a.id_sede  ORDER BY  a.id_sede, a.edificio ASC";
            $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");
                            $q111 = "SELECT * FROM persona a 
                            INNER JOIN profesor b ON a.cedula = b.cedula ORDER BY a.nombre ASC";
                            $res11 = pg_query($conexion, $q111) ;
        

?>
<div id="reportes">
	<span>Consultar Horario por:</span>
	<button onClick="mostrar()" class="btn btn-primary btn-xs">Salon</button>
	<button onClick="mostrar2()" class="btn btn-primary btn-xs">Docente</button>
	<button onClick="mostrar3()" class="btn btn-primary btn-xs">Seccion</button>

	<div id='oculto2' style='display:none;'>
		<br><hr>
		
		<div>
            <label>Profesor</label><br>
            <select id="prof"  name="prof">
                                <option value=""        >-------------------------</option>
                                <?php while ($row11 = pg_fetch_row($res11)) { ?>
                                <option value='<?= $row11[0]?>' > <?= $row11[1]." ".$row11[3]?> </option>
                            <?php } ?>
                             </select>
            <!--<input id="profA" name="profA" value= "<?php echo $yasmin;?>">-->

            
            <button class="btn btn-primary btn-xs" onclick="consultaProfesor('profesor','prof')">consultar</button>

        </div>
	    
	</div>
	<br><hr>
	<div id='oculto1' style='display:none;'>
		<div>
            <label>Edificio</label>
            <label id="labelse">
            <select id='edificioR' name='edificioR' onChange='cargaContenidoP(this.id)'>
                <option value='0'>Seleccione una opción</option> 
                <?php while ($fila = pg_fetch_row($resultado)) { ?>
                    <option value='<?= $fila[0]?>'><?php echo $fila[4]." - ".$fila[1]?></option>
                <?php } ?>
            </select>
            </label>
        </div>
        <div>
            <label id="labelse">
            <label>Salon&nbsp&nbsp&nbsp</label>
            <select id="salon1"  name="salon1" disabled="disabled">
                <option value="0">No se ha cargado...</option>
            </select>
        </div>
    </div>
<div  id='oculto3' style='display:none;'>
    <?php 
        $q = "SELECT * FROM carrera ORDER BY nombre ASC";
        $res = pg_query($conex, $q) or die("Error en la Consulta SQL ");
    ?>
    <label>Carrera</label>
    <label id="labelse">
    <select id='carreraRep' name='carreraRep' onchange="cargaContenidoPerR(this.id)">
        <option value='0'>Seleccione una opción</option> 
        <?php while ($row = pg_fetch_row($res)) { ?>
            <option value='<?= $row[0]?>'><?= $row[1]?></option>
        <?php } ?>
    </select>
    </label>
    <div>
        <label id="labelse">
        <label>Periodo</label>
        <select id="periodoR"  name="periodoR" disabled="disabled">
            <option value="0">No se ha cargado</option>
        </select>
    </div>
    <div>
        <label id="labelse">
        <label>Seccion</label>
        <select id="seccionRe"  name="seccionRe" disabled="disabled">
            <option value="0">No se ha cargado</option>
        </select>
    </div>
</div>


<div id="impreporte"></div>
