<?php



for ($d=1; $d < 8; $d++) {
	for ($h=1; $h <20 ; $h++) { 
		 if ($fila[0]==$d && $fila[9]==$h ) {
		   $sqlperiodo1         = "SELECT * FROM \"ucMalla\" WHERE \"id\"=$fila[1] ";
			$consultamateria1= pg_query($conex,$sqlperiodo1) or die("ERROR");	
			$registrom1=pg_fetch_array($consultamateria1);
			$sqlseccion         = "SELECT * FROM \"seccion\" WHERE \"ID\"=$fila[4] ";
			$consultaseccion= pg_query($conex,$sqlseccion) or die("ERROR seccion");	
			$registroseccion=pg_fetch_array($consultaseccion);
						
		    $Hr[$d][$h]="".$fila[13]."  - Seccion ".$registroseccion[1]."  -  ".$fila[18]." ".$fila[20]." - ".$registrom1[4]."   ".$ed[$d][$h]."  	  ".$fila[32]."-".$fila[28];
		    
			if ($fila[7]==01) {
				
				
				 $C[$d][$h]="style='background:#01AE01'";

			}
			if ($fila[7]==02) {
				
				
				 $C[$d][$h]="style='background:#ABABA1'";

			}
			if ($fila[7]==03) {
				
				
				 $C[$d][$h]="style='background:#9966CC'";

			}	
			if ($fila[7]==04) {
				
				
				 $C[$d][$h]="style='background:#FFCC99'";

			}
			if ($fila[7]==05) {
				
				
				 $C[$d][$h]="style='background:##99CCFF'";

			}
			if ($fila[7]==06) {
				
				
				 $C[$d][$h]="style='background:#B3B301'";

			}
			if ($fila[7]==07) {
				
				
				 $C[$d][$h]="style='background:#FF8080'";

			}
			if ($fila[7]==08) {
				
				
				 $C[$d][$h]="style='background:#996633'";

			}
			if ($fila[7]==09) {
				
				
				 $C[$d][$h]="style='background:'";

			}
			if ($fila[7]==10) {
				
				
				 $C[$d][$h]="style='background:'";

			}
			if ($fila[7]==11) {
				
				
				 $C[$d][$h]="style='background:#CBCBCB'";

			}
		}	
	}
}

#---- inicio lunes a viernes, primer bloque---
?>