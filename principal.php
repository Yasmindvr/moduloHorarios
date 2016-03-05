<?php
	require "../script/verifSesion.php";
	require "kuai/head.php";
	$yasmin="soy yo";
?>
<div >

	<!--inicio de pestañas-->
	<?php 
		$usu=$_SESSION["cedula"]; 
		require_once('consulta/conexion.php');
		$sql= "SELECT * FROM \"carreraSede\"";
		$consult= pg_query($conex,$sql) or die ("error");
		while($reg=pg_fetch_array($consult)){
			if ($reg[2]==$usu){ $edi="style='display:none;'";break;}
			else{$edi="style='display:'";}
		}			
	?>
	<div class="col-lg-12">
		<h1 class="page-header">Horarios</h1><br>
	</div>

	<div id ="tabs">
<!-- pestaña pestaña 1 activa por defecto-->
		<div id ="tab">
		    <input type="radio" id="tab-2" name="group-1"checked>
		    <label id="label"  for="tab-2">Horarios</label>
		    <div id="contenido">
		    <!--contenido de la pestaña 2-->
			    <div >
					<?php
						require_once("kuai/section.php");
					?>
				</div>
			</div>
		</div>
    
	    <!-- pestaña 2-->
		<div id="layer" <?php  echo $edi; ?>>
		    <div id ="tab">
		        <input type="radio" id="tab-1" name="group-1" >
		        <label id="label" for="tab-1">Edificio/Salon</label>
		        <!--contenido de la pestaña 1-->
		        <div id="contenido">
		        	<div >
						<?php
							require_once("kuai/edificio.php");
						?>
					</div>
			   </div>
	    	</div>
	    </div>
	    
	    
	    <!--pestaña 3-->
	    
		
		 <!-- pestaña 4-->
	    <div id ="tab">
		    <input type="radio" id="tab-4" name="group-1">
		    <label id="label"  for="tab-4">Reportes</label>
		    <div id="contenido">
		    <!--contenido de la pestaña 4-->
			 <?php
				require_once("kuai/reportes.php");
			?>
			</div>
		</div>
	</div>
</div>

<?php
	require "kuai/foot.php";
?>
