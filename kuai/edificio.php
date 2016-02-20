<div class="modal-header">
	<h4 class="modal-title">Agregar Edificio</h4>
</div>
<div>
	<form name="edificio" method="POST" action="consulta/edificio/insercion.php" class="contact_form" role="form">
		<div>	
			<?php 
			 require_once('consulta/conexion.php');
                $querySede = "SELECT * FROM sede ORDER BY nombre ASC";
   			    $resultadoSede = pg_query($conexion, $querySede) or die("Error en la Consulta SQL");
    		?>
    		<label>Sede</label>
    		<label id="labelse">
    		<select id='sede' name='sede' required>
    			<option value='0'>Seleccione una Sede</option> 
        		<?php while ($filaS = pg_fetch_row($resultadoSede)) { ?>
                <option value='<?= $filaS[0] ?>'><?= $filaS[1]?></option>
        		<?php } ?>
    		</select>
    		</label>
    	</div>
		<div class="form-group">
			<label class="sr-only" for="exampleInputAmount"></label>
		    <div class="input-group">
		    	<div class="input-group-addon">Nombre</div>
		    	<input type="text" required pattern="[a-zA-Z]*"  class="form-control" id="exampleInputAmount" placeholder="Ingrese un nombre de edificio" name="nombre" required>
		    </div>
		</div>
		<div class="modal-footer">
			<span class="btn btn-primary btn-xs a" onClick="window.location='listaedificio.php'" style="cursor: pointer">Ver lista de Edificios</span>
			<input  type="reset" class="btn btn-primary btn-xs" >
			<input  type="submit" class="btn btn-primary btn-xs" >
		</div>
	</form>
	<div class="modal-header">
		<h4 class="modal-title">Agregar Salon</h4>
	</div>
	<form name="salon" class="contact_form" method="POST" action="consulta/salon/insercion.php" role="form">
		<div>	
			<?php 
			 require_once('consulta/conexion.php');
                $query3 = "SELECT * FROM edificio a INNER JOIN sede b ON b.id = a.id_sede ".$ola." ORDER BY  a.id_sede, a.edificio ASC ";
   			    $resultado1 = pg_query($conexion, $query3) or die("Error en la Consulta SQL");
    		?>
    		<label>Edificio</label>
    		<label id="labelse">
    		<select id='edi' name='edificio' required>
    			<option value='0'>Seleccione un Edificio</option> 
        		<?php while ($fila = pg_fetch_row($resultado1)) { ?>
                <option value='<?= $fila[0] ?>'><?php echo $fila[4]." - ".$fila[1]?></option>
        		<?php } ?>
    		</select>
    		</label>
    	</div>
    	<div class="form-group">
			<label>Tipo de Salon</label>
    		<label id="labelse">
        		<select id='select1' name='tipo' required>
        			<option value='0'>Seleccione un tipo</option> 
            		<option value='Salon'>Salon</option>
            		<option value='Laboratorio'>Laboratorio</option>
            		<option value='Usos Multiples'>Usos multiples</option>
            		<option value='Canchas'>Canchas</option>
            	</select>
    		</label>
		</div>
		<div class="form-group">
			<label class="sr-only" for="exampleInputAmount"></label>
		    <div id="sal" class="input-group">
		    	<div class="input-group-addon">Nombre/N&uacute;mero</div>
		    	<input type="text" class="form-control" id="exampleInputAmount" placeholder="Ingrese un nombre o n&uacute;mero del Salon" name="nombre" required>
		    </div>
		</div>
		
		<div class="modal-footer">
		<span class="btn btn-primary btn-xs a" onClick="window.location='listasalones.php'" style="cursor: pointer">Ver lista de Salones</span>
			<input  type="reset" class="btn btn-primary btn-xs" >
			<input  type="submit" class="btn btn-primary btn-xs" >
		</div>
	</form>
</div>