
<?php 
    require_once('consulta/conexion.php');
    $query1 = "SELECT * FROM \"carreraSede\" WHERE \"idCoordinador\"=$usu";
    $resultado1 = pg_query($conex, $query1) or die("No tiene acceso");
    $fil1 = pg_fetch_row($resultado1);
    $idCarrera= $fil1[1];
    $idSede=$fil1[3];
    if(!empty($fil1)){
        $ola="WHERE a.id_sede = ".$idSede;
        $query2 = "SELECT * FROM \"carrera\" WHERE \"id\" = '$idCarrera'";
        $resultado2 = pg_query($conex, $query2) or die("Error en la Consulta SQL B");
        $fila2 = pg_fetch_row($resultado2);
        $carrera=$fila2[0];
        $query3 = "SELECT * FROM \"estructuraCS\" WHERE \"idCS\" = '$idCarrera'";
        $resultado3 = pg_query($conex, $query3) or die("Error en la Consulta SQL C");
        $fila3 = pg_fetch_row($resultado3);
        $estru=$fila3[2];
        $query4 = "SELECT * FROM \"estructura\" WHERE \"id\" = '$estru'";
        $resultado4 = pg_query($conex, $query4) or die("Error en la Consulta SQL D");
        $fila4 = pg_fetch_row($resultado4);
        $estr=$fila4[1];
        $ocultar='style="display:none"';
       
    } 
   
?>
<div>
<div><img src="leyenda.png" id="leyenda"></div><br><br><br><br>
    <form id="seleccionarSalon" method="POST" name="seleccionarSalon">
        <?php 

            $query = "SELECT * FROM edificio a INNER JOIN sede b ON b.id = a.id_sede ".$ola." ORDER BY  a.id_sede, a.edificio ASC";
            $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");
            $q = "SELECT * FROM carrera ORDER BY nombre ASC";
            $res = pg_query($conex, $q) or die("Error en la Consulta SQL ");
        ?>
        <div id="oculto" <?php echo $ocultar;?> >
            <label>Carrera</label>
            <label id="labelse">
            <select id='carrera1' name='carrera1' >
                <option value='0'>Seleccione una opción</option> 
                <?php while ($row = pg_fetch_row($res)) { ?>
                    <option value='<?= $row[0]?>'><?= $row[1]?></option>
                <?php } ?>
            </select>
            </label>
        </div>
        <div>
            <label>Edificio</label>
            <label id="labelse">
            <select id='select1' name='select1' onChange='cargaContenido(this.id)'>
                <option value='0'>Seleccione una opción</option> 
                <?php while ($fila = pg_fetch_row($resultado)) { ?>
                    <option value='<?= $fila[0]?>'><?php echo $fila[4]." - ".$fila[1]?></option>
                <?php } ?>
            </select>
            </label>
        </div>
        <div>
            <label id="labelse">
            <label>Salon</label>
            <select id="salon"  name="select2" disabled="disabled">
                <option value="0">No se ha cargado</option>
            </select>
        </div>

        <hr>
    </form>

</div>
   
<?php 
    extract($_GET);
    extract($_POST);
  
    

    if ($carrera1>0) {
        $carrera=$carrera1;
        $query2 = "SELECT * FROM \"carrera\" WHERE \"id\" = '$carrera'";
        $resultado2 = pg_query($conex, $query2);
        $fila2 = pg_fetch_row($resultado2);
        $carrera=$fila2[0];
        $query3 = "SELECT * FROM \"estructuraCS\" WHERE \"idCS\" = $carrera";
        $resultado3 = pg_query($conex, $query3);
        $fila3 = pg_fetch_row($resultado3);
        $estru=$fila3[2];
        $query4 = "SELECT * FROM \"estructura\" WHERE \"id\" = '$estru'";
        $resultado4 = pg_query($conex, $query4);
        $fila4 = pg_fetch_row($resultado4);
        $estr=$fila4[1];
    }
   if (!empty($_GET) && empty($_POST)) {
    $idsalon=$_GET['idsalon'];
    $salon=$_GET['idsalon'];
    
    $query = "SELECT * FROM horario a 
                    INNER JOIN \"unidadCurricular\" b ON a.materia = b.id
                    INNER JOIN persona c ON c.cedula = a.profesor
                    
                    WHERE a.salon = $idsalon";
                    $valisalon="data-toggle='modal' href='#Edificio'";
                    
                    $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL horarioO");
                      while ( $fila = pg_fetch_row($resultado)) {
                       

                       require "horas.php";
                    }
                    
    
   }

    if (isset($select1) || !empty($_GET)) {
        //require_once ('../consulta/conexion.php');
        $query = "SELECT b.id, a.edificio, b.salon, b.tipo FROM edificio a INNER JOIN salones b ON  a.id = b.cod_edi WHERE  b.id = '$salon'";
        $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL Salon");
        $fila1 = pg_fetch_row($resultado);
        //print_r($fila);
    }
 ?>
<div id="aqui2"></div>      
<div class="row">
    <div class="table-responsive">
        <table class="table table-bordered">
            <caption> <?php $edificio=$fila1[1];$idsalon=$fila1[2];$tipo=$fila1[3]; echo "Edificio: \"".$edificio."\" &nbsp; Salon: \"".$idsalon."\"&nbsp; Tipo: \"".$tipo."\""; ?></caption> 
            <thead>
                <tr class="active">
                    <th>HOR<span>A</span></th>
                    <th>Lun<span>es</span></th>
                    <th>Mar<span>tes</span></th>
                    <th>Mi&eacute;r<span>coles</span></th>
                    <th>Jue<span>ves</span></th>
                    <th>Vie<span>rnes</span></th>
                    <th>S&aacute;b<span>ado</span></th>
                    <th>Dom<span>ingo</span></th>
                </tr>
            </thead>
            <tbody>
            <?php 
                if (isset($select1)) {
                    $queryHo = "SELECT * FROM horario a 
                    INNER JOIN \"unidadCurricular\" b ON a.materia = b.id
                    INNER JOIN persona c ON c.cedula = a.profesor
                    
                    WHERE a.salon = $salon";
                    
                    $resultado = pg_query($conexion, $queryHo) or die("Error en la Consulta SQL horario");
                    
                    $valisalon="data-toggle='modal' href='#Edificio'";
                    while ( $fila = pg_fetch_row($resultado)) {
                       

                       require "horas.php";
                    }
                    
                }
             if (!isset($select1) && empty($_GET)) {
           
               
                    $valisalon="onclick='SeleccionaSalon()'";

                }
               if (isset($salon)&&empty($carrera)) {
               
               
                    $valisalon="onclick='SeleccionaCarrera()'";

                }
             
            
             ?>
                <tr> 
                    <td class="hora">7:00 a 7:45</td>
                    <td id="d1h1" <?php  echo $C[1][1]; if (empty($H[1][1])) { echo $valisalon;}?> id="$d1h1" onclick='tomarDatos("d11", "h11")'  >
                        <input id="d11" type="hidden" value="Lunes">
                        <input id="h11" type="hidden" value="1">
                        <?php  echo $H[1][1];?>
                    </td>
                    <td id="d2h1" <?php  echo $C[2][1];if (empty($H[2][1])) { echo $valisalon;}?> onclick='tomarDatos("d21", "h12")' >
                        <input id="d21" type="hidden" value="Martes">
                        <input id="h12" type="hidden" value="1">
                        <?php  echo $H[2][1]; ?>
                    </td>
                    <td id="d3h1" <?php  echo $C[3][1];if (empty($H[3][1])) { echo $valisalon;}?> onclick='tomarDatos("d31", "h13")' >
                        <input id="d31" type="hidden" value="Miercoles">
                        <input id="h13" type="hidden" value="1">
                        <?php  echo $H[3][1];?>
                    </td>
                    <td id="d4h1" <?php  echo $C[4][1]; if (empty($H[4][1])) { echo $valisalon;}?> onclick='tomarDatos("d41", "h14")' >
                        <input id="d41" type="hidden" value="Jueves">
                        <input id="h14" type="hidden" value="1">
                        <?php  echo $H[4][1];?>
                    </td>
                    <td id="d5h1" <?php  echo $C[5][1];if (empty($H[5][1])) { echo $valisalon;}?> onclick='tomarDatos("d51", "h15")' >
                        <input id="d51" type="hidden" value="Viernes">
                        <input id="h15" type="hidden" value="1">
                        <?php  echo $H[5][1];?>
                    </td>
                    <td id="d6h1" <?php  echo $C[6][1];if (empty($H[6][1])) {echo $valisalon;}?> onclick='tomarDatos("d61", "h16")' >
                        <input id="d61" type="hidden" value="Sabado">
                        <input id="h16" type="hidden" value="1">
                        <?php  echo $H[6][1];?>
                    </td>
                    <td id="d7h1" <?php  echo $C[7][1]; if (empty($H[7][1])) { echo $valisalon;}?> onclick='tomarDatos("d71", "h17")' >
                        <input id="d71" type="hidden" value="Domingo">
                        <input id="h17" type="hidden" value="1">
                        <?php  echo $H[7][1];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora">7:45 a 8:30</td>
                    <td id="d1h2" <?php  echo $C[1][2]; if (empty($H[1][2])) { echo $valisalon;}?> onclick='tomarDatos("d12", "h21")' >
                        <input id="d12" type="hidden" value="Lunes">
                        <input id="h21" type="hidden" value="2">
                        <?php  echo $H[1][2]; echo"<br>".$color[7];?>
                    </td>
                    <td id="d2h2" <?php  echo $C[2][2];  if (empty($H[2][2])) { echo $valisalon;}?> onclick='tomarDatos("d22", "h22")' >
                        <input id="d22" type="hidden" value="Martes">
                        <input id="h22" type="hidden" value="2">
                        <?php  echo $H[2][2];?>
                    </td>
                    <td id="d3h2" <?php  echo $C[3][2]; if (empty($H[3][2])) { echo $valisalon;}?> onclick='tomarDatos("d32", "h23")' >
                        <input id="d32" type="hidden" value="Miercoles">
                        <input id="h23" type="hidden" value="2">
                        <?php  echo $H[3][2];?>
                    </td>
                    <td id="d4h2" <?php  echo $C[4][2];  if (empty($H[4][2])) { echo $valisalon;}?> onclick='tomarDatos("d42", "h24")' >
                        <input id="d42" type="hidden" value="Jueves">
                        <input id="h24" type="hidden" value="2">
                        <?php  echo $H[4][2];?>
                    </td>
                    <td id="d5h2" <?php  echo $C[5][2];  if (empty($H[5][2])) { echo $valisalon;}?> onclick='tomarDatos("d52", "h25")' >
                        <input id="d52" type="hidden" value="Viernes">
                        <input id="h25" type="hidden" value="2">
                        <?php  echo $H[5][2];?>
                    </td>
                    <td id="d6h2" <?php  echo $C[6][2]; if (empty($H[6][2])) { echo $valisalon;}?> onclick='tomarDatos("d62", "h26")' >
                        <input id="d62" type="hidden" value="Sabado">
                        <input id="h26" type="hidden" value="2">
                        <?php  echo $H[6][2];?>
                    </td>
                    <td id="d7h2" <?php  echo $C[7][2]; if (empty($H[7][2])) { echo $valisalon;}?> onclick='tomarDatos("d72", "h27")' >
                        <input id="d72" type="hidden" value="Domingo">
                        <input id="h27" type="hidden" value="2">
                        <?php  echo $H[7][2];?>
                    </td></tr>
                <tr>
                    <td class="hora">8:40 a 9:25</td>
                    <td id="d1h3" <?php  echo $C[1][3]; if (empty($H[1][3])) { echo $valisalon;}?> onclick='tomarDatos("d13", "h31")' >
                        <input id="d13" type="hidden" value="Lunes">
                        <input id="h31" type="hidden" value="3">
                        <?php  echo $H[1][3];?>
                    </td>
                    <td id="d2h3" <?php  echo $C[2][3]; if (empty($H[2][3])) { echo $valisalon;}?> onclick='tomarDatos("d23", "h32")' >
                        <input id="d23" type="hidden" value="Martes">
                        <input id="h32" type="hidden" value="3">
                        <?php  echo $H[2][3];?>
                    </td>
                    <td id="d3h3" <?php  echo $C[3][3]; if (empty($H[3][3])) { echo $valisalon;}?> onclick='tomarDatos("d33", "h33")' >
                        <input id="d33" type="hidden" value="Miercoles">
                        <input id="h33" type="hidden" value="3">
                        <?php  echo $H[3][3];?>
                    </td>
                    <td id="d4h3" <?php  echo $C[4][3]; if (empty($H[4][3])) { echo $valisalon;}?> onclick='tomarDatos("d43", "h34")' >
                        <input id="d43" type="hidden" value="Jueves">
                        <input id="h34" type="hidden" value="3">
                        <?php  echo $H[4][3];?>
                    </td>
                    <td id="d5h3" <?php  echo $C[5][3]; if (empty($H[5][3])) { echo $valisalon;}?> onclick='tomarDatos("d53", "h35")' >
                        <input id="d53" type="hidden" value="Viernes">
                        <input id="h35" type="hidden" value="3">
                        <?php  echo $H[5][3];?>
                    </td>
                    <td id="d6h3" <?php  echo $C[6][3]; if (empty($H[6][3])) { echo $valisalon;}?> onclick='tomarDatos("d63", "h36")' >
                        <input id="d63" type="hidden" value="Sabado">
                        <input id="h36" type="hidden" value="3">
                        <?php  echo $H[6][3];?>
                    </td>
                    <td id="d7h3" <?php  echo $C[7][3]; if (empty($H[7][3])) { echo $valisalon;}?> onclick='tomarDatos("d73", "h37")' >
                        <input id="d73" type="hidden" value="Domingo">
                        <input id="h37" type="hidden" value="3">
                        <?php  echo $H[7][3];?>
                    </td></tr>
                <tr>
                    <td class="hora">9:25 a 10:10</td>
                    <td id="d1h4" <?php  echo $C[1][4];if (empty($H[1][4])) { echo $valisalon;}?> onclick='tomarDatos("d14", "h41")' >
                        <input id="d14" type="hidden" value="Lunes">
                        <input id="h41" type="hidden" value="4">
                        <?php  echo $H[1][4];?>
                    </td>
                    <td id="d2h4" <?php  echo $C[2][4]; if (empty($H[2][4])) { echo $valisalon;}?> onclick='tomarDatos("d24", "h42")' >
                        <input id="d24" type="hidden" value="Martes">
                        <input id="h42" type="hidden" value="4">
                        <?php  echo $H[2][4];?>
                    </td>
                    <td id="d3h4" <?php  echo $C[3][4]; if (empty($H[3][4])) { echo $valisalon;}?> onclick='tomarDatos("d34", "h43")' >
                        <input id="d34" type="hidden" value="Miercoles">
                        <input id="h43" type="hidden" value="4">
                        <?php  echo $H[3][4];?>
                    </td>
                    <td id="d4h4" <?php  echo $C[4][4];if (empty($H[4][4])) { echo $valisalon;}?> onclick='tomarDatos("d44", "h44")' >
                        <input id="d44" type="hidden" value="Jueves">
                        <input id="h44" type="hidden" value="4">
                        <?php  echo $H[4][4];?>
                    </td>
                    <td id="d5h4" <?php  echo $C[5][4];if (empty($H[5][4])) { echo $valisalon;}?> onclick='tomarDatos("d54", "h45")' >
                        <input id="d54" type="hidden" value="Viernes">
                        <input id="h45" type="hidden" value="4">
                        <?php  echo $H[5][4];?>
                    </td>
                    <td id="d6h4" <?php  echo $C[6][4];if (empty($H[6][4])) { echo $valisalon;}?> onclick='tomarDatos("d64", "h46")' >
                        <input id="d64" type="hidden" value="Sabado">
                        <input id="h46" type="hidden" value="4">
                        <?php  echo $H[6][4];?>
                    </td>
                    <td id="d7h24" <?php  echo $C[7][4]; if (empty($H[7][4])) { echo $valisalon;}?> onclick='tomarDatos("d74", "h47")' >
                        <input id="d74" type="hidden" value="Domingo">
                        <input id="h47" type="hidden" value="4">
                        <?php  echo $H[7][4];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora">10:20 a 11:05</td>
                    <td id="d1h5" <?php  echo $C[1][5]; if (empty($H[1][5])) { echo $valisalon;}?> onclick='tomarDatos("d15", "h51")' >
                        <input id="d15" type="hidden" value="Lunes">
                        <input id="h51" type="hidden" value="5">
                        <?php  echo $H[1][5];?>
                    </td>
                    <td id="d2h5" <?php  echo $C[2][5]; if (empty($H[2][5])) { echo $valisalon;}?> onclick='tomarDatos("d25", "h52")' >
                        <input id="d25" type="hidden" value="Martes">
                        <input id="h52" type="hidden" value="5">
                        <?php  echo $H[2][5];?>
                    </td>
                    <td id="d3h5" <?php  echo $C[3][5]; if (empty($H[3][5])) { echo $valisalon;}?> onclick='tomarDatos("d35", "h53")' >
                        <input id="d35" type="hidden" value="Miercoles">
                        <input id="h53" type="hidden" value="5">
                        <?php  echo $H[3][5];?>
                    </td>
                    <td id="d4h5" <?php  echo $C[4][5]; if (empty($H[4][5])) { echo $valisalon;}?> onclick='tomarDatos("d45", "h54")' >
                        <input id="d45" type="hidden" value="Jueves">
                        <input id="h54" type="hidden" value="5">
                        <?php  echo $H[4][5];?>
                    </td>
                    <td id="d5h5" <?php  echo $C[5][5]; if (empty($H[5][5])) { echo $valisalon;}?> onclick='tomarDatos("d55", "h55")' >
                        <input id="d55" type="hidden" value="Viernes">
                        <input id="h55" type="hidden" value="5">
                        <?php  echo $H[5][5];?>
                    </td>
                    <td id="d6h5" <?php  echo $C[6][5]; if (empty($H[6][5])) { echo $valisalon;}?> onclick='tomarDatos("d65", "h56")' >
                        <input id="d65" type="hidden" value="Sabado">
                        <input id="h56" type="hidden" value="5">
                        <?php  echo $H[6][5];?>
                    </td>
                    <td id="d6h5" <?php  echo $C[7][5]; if (empty($H[7][5])) { echo $valisalon;}?> onclick='tomarDatos("d75", "h57")' >
                        <input id="d75" type="hidden" value="Domingo">
                        <input id="h57" type="hidden" value="5">
                        <?php  echo $H[7][5];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora">11:05 a 11:50</td>
                    <td id="d1h6" <?php  echo $C[1][6]; if (empty($H[1][6])) { echo $valisalon;}?> onclick='tomarDatos("d16", "h61")' >
                        <input id="d16" type="hidden" value="Lunes">
                        <input id="h61" type="hidden" value="6">
                        <?php  echo $H[1][6];?>
                    </td>
                    <td id="d2h6" <?php  echo $C[2][6]; if (empty($H[2][6])) { echo $valisalon;}?> onclick='tomarDatos("d26", "h62")' >
                        <input id="d26" type="hidden" value="Martes">
                        <input id="h62" type="hidden" value="6">
                        <?php  echo $H[2][6];?>
                    </td>
                    <td id="d3h6" <?php  echo $C[3][6]; if (empty($H[3][6])) { echo $valisalon;}?> onclick='tomarDatos("d36", "h63")' >
                        <input id="d36" type="hidden" value="Miercoles">
                        <input id="h63" type="hidden" value="6">
                        <?php  echo $H[3][6];?>
                    </td>
                    <td id="d4h6" <?php  echo $C[4][6]; if (empty($H[4][6])) { echo $valisalon;}?> onclick='tomarDatos("d46", "h64")' >
                        <input id="d46" type="hidden" value="Jueves">
                        <input id="h64" type="hidden" value="6">
                        <?php  echo $H[4][6];?>
                    </td>
                    <td id="d5h6" <?php  echo $C[5][6]; if (empty($H[5][6])) { echo $valisalon;}?> onclick='tomarDatos("d56", "h65")' >
                        <input id="d56" type="hidden" value="Viernes">
                        <input id="h65" type="hidden" value="6">
                        <?php  echo $H[5][6];?>
                    </td>
                    <td id="d6h6" <?php  echo $C[6][6]; if (empty($H[6][6])) { echo $valisalon;}?> onclick='tomarDatos("d66", "h66")' >
                        <input id="d66" type="hidden" value="Sabado">
                        <input id="h66" type="hidden" value="6">
                        <?php  echo $H[6][6];?>
                    </td>
                    <td id="d6h6" <?php  echo $C[7][6]; if (empty($H[7][6])) { echo $valisalon;}?> onclick='tomarDatos("d76", "h67")' >
                        <input id="d76" type="hidden" value="Domingo">
                        <input id="h67" type="hidden" value="6">
                        <?php  echo $H[7][6];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora">12:00 a 12:45</td>
                   <td id="d1h7" <?php  echo $C[1][7]; if (empty($H[1][7])) { echo $valisalon;}?> onclick='tomarDatos("d17", "h71")' >
                        <input id="d17" type="hidden" value="Lunes">
                        <input id="h71" type="hidden" value="7">
                        <?php  echo $H[1][7];?>
                    </td>
                    <td id="d2h7" <?php  echo $C[2][7]; if (empty($H[2][7])) { echo $valisalon;}?> onclick='tomarDatos("d27", "h72")' >
                        <input id="d27" type="hidden" value="Martes">
                        <input id="h72" type="hidden" value="7">
                        <?php  echo $H[2][7];?>
                    </td>
                    <td id="d3h7" <?php  echo $C[3][7]; if (empty($H[3][7])) { echo $valisalon;}?> onclick='tomarDatos("d37", "h73")' >
                        <input id="d37" type="hidden" value="Miercoles">
                        <input id="h73" type="hidden" value="7">
                        <?php  echo $H[3][7];?>
                    </td>
                    <td id="d4h7" <?php  echo $C[4][7]; if (empty($H[4][7])) { echo $valisalon;}?> onclick='tomarDatos("d47", "h74")' >
                        <input id="d47" type="hidden" value="Jueves">
                        <input id="h74" type="hidden" value="7">
                        <?php  echo $H[4][7];?>
                    </td>
                    <td id="d5h7" <?php  echo $C[5][7]; if (empty($H[5][7])) { echo $valisalon;}?> onclick='tomarDatos("d57", "h75")' >
                        <input id="d57" type="hidden" value="Viernes">
                        <input id="h75" type="hidden" value="7">
                        <?php  echo $H[5][7];?>
                    </td>
                    <td id="d6h7" <?php  echo $C[6][7]; if (empty($H[6][7])) { echo $valisalon;}?> onclick='tomarDatos("d67", "h76")' >
                        <input id="d67" type="hidden" value="Sabado">
                        <input id="h76" type="hidden" value="7">
                        <?php  echo $H[6][7];?>
                    </td>
                    <td id="d6h7" <?php  echo $C[7][7]; if (empty($H[7][7])) { echo $valisalon;}?> onclick='tomarDatos("d75", "h77")' >
                        <input id="d77" type="hidden" value="Domingo">
                        <input id="h77" type="hidden" value="7">
                        <?php  echo $H[7][7];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora">12:45 a 13:30</td>
                   <td id="d1h8" <?php  echo $C[1][8]; if (empty($H[1][8])) { echo $valisalon;}?> onclick='tomarDatos("d18", "h81")' >
                        <input id="d18" type="hidden" value="Lunes">
                        <input id="h81" type="hidden" value="8">
                        <?php  echo $H[1][8];?>
                    </td>
                    <td id="d2h8" <?php  echo $C[2][8]; if (empty($H[2][8])) { echo $valisalon;}?> onclick='tomarDatos("d28", "h82")' >
                        <input id="d28" type="hidden" value="Martes">
                        <input id="h82" type="hidden" value="8">
                        <?php  echo $H[2][8];?>
                    </td>
                    <td id="d3h8" <?php  echo $C[3][8]; if (empty($H[3][8])) { echo $valisalon;}?> onclick='tomarDatos("d38", "h83")' >
                        <input id="d38" type="hidden" value="Miercoles">
                        <input id="h83" type="hidden" value="8">
                        <?php  echo $H[3][8];?>
                    </td>
                    <td id="d4h8" <?php  echo $C[4][8]; if (empty($H[4][8])) { echo $valisalon;}?> onclick='tomarDatos("d48", "h84")' >
                        <input id="d48" type="hidden" value="Jueves">
                        <input id="h84" type="hidden" value="8">
                        <?php  echo $H[4][8];?>
                    </td>
                    <td id="d5h8" <?php  echo $C[5][8]; if (empty($H[5][8])) { echo $valisalon;}?> onclick='tomarDatos("d58", "h85")' >
                        <input id="d58" type="hidden" value="Viernes">
                        <input id="h85" type="hidden" value="8">
                        <?php  echo $H[5][8];?>
                    </td>
                    <td id="d6h8" <?php  echo $C[6][8]; if (empty($H[6][8])) { echo $valisalon;}?> onclick='tomarDatos("d68", "h86")' >
                        <input id="d68" type="hidden" value="Sabado">
                        <input id="h86" type="hidden" value="8">
                        <?php  echo $H[6][8];?>
                    </td>
                    <td id="d6h8" <?php  echo $C[7][8]; if (empty($H[7][8])) { echo $valisalon;}?> onclick='tomarDatos("d78", "h87")' >
                        <input id="d78" type="hidden" value="Domingo">
                        <input id="h87" type="hidden" value="8">
                        <?php  echo $H[7][8].$C[7][8];?>
                    </td>
                </tr>
                <tr>
                    <th class="medio active" colspan="8">TARDE</th>
                </tr>
                <tr>
                    <td class="hora">13:30 a 14:25</td>
                    <td id="d1h9" <?php  echo $C[1][9]; if (empty($H[1][9])) { echo $valisalon;}?> onclick='tomarDatos("d19", "h91")' >
                        <input id="d19" type="hidden" value="Lunes">
                        <input id="h91" type="hidden" value="9">
                        <?php  echo $H[1][9];?>
                    </td>
                    <td id="d2h9" <?php  echo $C[2][9]; if (empty($H[2][9])) { echo $valisalon;}?> onclick='tomarDatos("d29", "h92")' >
                        <input id="d29" type="hidden" value="Martes">
                        <input id="h92" type="hidden" value="9">
                        <?php  echo $H[2][9];?>
                    </td>
                    <td id="d3h9" <?php  echo $C[3][9]; if (empty($H[3][9])) { echo $valisalon;}?> onclick='tomarDatos("d39", "h93")' >
                        <input id="d39" type="hidden" value="Miercoles">
                        <input id="h93" type="hidden" value="9">
                        <?php  echo $H[3][9];?>
                    </td>
                    <td id="d4h9" <?php  echo $C[4][9]; if (empty($H[4][9])) { echo $valisalon;}?> onclick='tomarDatos("d49", "h94")' >
                        <input id="d49" type="hidden" value="Jueves">
                        <input id="h94" type="hidden" value="9">
                        <?php  echo $H[4][9];?>
                    </td>
                    <td id="d5h9" <?php  echo $C[5][9]; if (empty($H[5][9])) { echo $valisalon;}?> onclick='tomarDatos("d59", "h95")' >
                        <input id="d59" type="hidden" value="Viernes">
                        <input id="h95" type="hidden" value="9">
                        <?php  echo $H[5][9];?>
                    </td>
                    <td id="d6h9" <?php  echo $C[6][9]; if (empty($H[6][9])) { echo $valisalon;}?> onclick='tomarDatos("d69", "h96")' >
                        <input id="d69" type="hidden" value="Sabado">
                        <input id="h96" type="hidden" value="9">
                        <?php  echo $H[6][9];?>
                    </td>
                    <td id="d7h9" <?php  echo $C[7][9]; if (empty($H[7][9])) { echo $valisalon;}?> onclick='tomarDatos("d79", "h97")' >
                        <input id="d79" type="hidden" value="Domingo">
                        <input id="h97" type="hidden" value="9">
                        <?php  echo $H[7][9];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora">14:25 a 15:10</td>
                    <td id="d1h10" <?php  echo $C[1][10]; if (empty($H[1][10])) { echo $valisalon;}?> onclick='tomarDatos("d110", "h101")' >
                        <input id="d110" type="hidden" value="Lunes">
                        <input id="h101" type="hidden" value="10">
                        <?php  echo $H[1][10];?>
                    </td>
                    <td id="d2h10" <?php  echo $C[2][10]; if (empty($H[2][10])) { echo $valisalon;}?> onclick='tomarDatos("d210", "h102")' >
                        <input id="d210" type="hidden" value="Martes">
                        <input id="h102" type="hidden" value="10">
                        <?php  echo $H[2][10];?>
                    </td>
                    <td id="d3h10" <?php  echo $C[3][10]; if (empty($H[3][10])) { echo $valisalon;}?> onclick='tomarDatos("d310", "h103")' >
                        <input id="d310" type="hidden" value="Miercoles">
                        <input id="h103" type="hidden" value="10">
                        <?php  echo $H[3][10];?>
                    </td>
                    <td id="d4h10" <?php  echo $C[4][10]; if (empty($H[4][10])) { echo $valisalon;}?> onclick='tomarDatos("d410", "h104")' >
                        <input id="d410" type="hidden" value="Jueves">
                        <input id="h104" type="hidden" value="10">
                        <?php  echo $H[4][10];?>
                    </td>
                    <td id="d5h10" <?php  echo $C[5][10]; if (empty($H[5][10])) { echo $valisalon;}?> onclick='tomarDatos("d510", "h105")' >
                        <input id="d510" type="hidden" value="Viernes">
                        <input id="h105" type="hidden" value="10">
                        <?php  echo $H[5][10];?>
                    </td>
                    <td id="d6h10" <?php  echo $C[6][10]; if (empty($H[6][10])) { echo $valisalon;}?> onclick='tomarDatos("d610", "h106")' >
                        <input id="d610" type="hidden" value="Sabado">
                        <input id="h106" type="hidden" value="10">
                        <?php  echo $H[6][10];?>
                    </td>
                    <td id="d7h10" <?php  echo $C[7][10]; if (empty($H[7][10])) { echo $valisalon;}?> onclick='tomarDatos("d710", "h107")' >
                        <input id="d710" type="hidden" value="Domingo">
                        <input id="h107" type="hidden" value="10">
                        <?php  echo $H[7][10];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora">15:10 a 15:55</td>
                      <td id="d1h11" <?php  echo $C[1][11]; if (empty($H[1][11])) { echo $valisalon;}?> onclick='tomarDatos("d111", "h111")' >
                        <input id="d111" type="hidden" value="Lunes">
                        <input id="h111" type="hidden" value="11">
                        <?php  echo $H[1][11];?>
                    </td>
                    <td id="d2h11" <?php  echo $C[2][11]; if (empty($H[2][11])) { echo $valisalon;}?> onclick='tomarDatos("d211", "h112")' >
                        <input id="d211" type="hidden" value="Martes">
                        <input id="h112" type="hidden" value="11">
                        <?php  echo $H[2][11];?>
                    </td>
                    <td id="d3h11" <?php  echo $C[3][11]; if (empty($H[3][11])) { echo $valisalon;}?> onclick='tomarDatos("d311", "h113")' >
                        <input id="d311" type="hidden" value="Miercoles">
                        <input id="h113" type="hidden" value="11">
                        <?php  echo $H[3][11];?>
                    </td>
                    <td id="d4h11" <?php  echo $C[4][11]; if (empty($H[4][11])) { echo $valisalon;}?> onclick='tomarDatos("d411", "h114")' >
                        <input id="d411" type="hidden" value="Jueves">
                        <input id="h114" type="hidden" value="11">
                        <?php  echo $H[4][11];?>
                    </td>
                    <td id="d5h11" <?php  echo $C[5][11]; if (empty($H[5][11])) { echo $valisalon;}?> onclick='tomarDatos("d511", "h115")' >
                        <input id="d511" type="hidden" value="Viernes">
                        <input id="h115" type="hidden" value="11">
                        <?php  echo $H[5][11];?>
                    </td>
                    <td id="d6h11" <?php  echo $C[6][11]; if (empty($H[6][11])) { echo $valisalon;}?> onclick='tomarDatos("d611", "h116")' >
                        <input id="d611" type="hidden" value="Sabado">
                        <input id="h116" type="hidden" value="11">
                        <?php  echo $H[6][11];?>
                    </td>
                    <td id="d7h11" <?php  echo $C[7][11]; if (empty($H[7][11])) { echo $valisalon;}?> onclick='tomarDatos("d711", "h117")' >
                        <input id="d711" type="hidden" value="Domingo">
                        <input id="h117" type="hidden" value="11">
                        <?php  echo $H[7][11];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora">16:05 a 16:50</td>
                    <td id="d1h12" <?php  echo $C[1][12]; if (empty($H[1][12])) { echo $valisalon;}?> onclick='tomarDatos("d112", "h121")' >
                        <input id="d112" type="hidden" value="Lunes">
                        <input id="h121" type="hidden" value="12">
                        <?php  echo $H[1][12];?>
                    </td>
                    <td id="d2h12" <?php  echo $C[2][12]; if (empty($H[2][12])) { echo $valisalon;}?> onclick='tomarDatos("d212", "h122")' >
                        <input id="d212" type="hidden" value="Martes">
                        <input id="h122" type="hidden" value="12">
                        <?php  echo $H[2][12];?>
                    </td>
                    <td id="d3h12" <?php  echo $C[3][12]; if (empty($H[3][12])) { echo $valisalon;}?> onclick='tomarDatos("d312", "h123")' >
                        <input id="d312" type="hidden" value="Miercoles">
                        <input id="h123" type="hidden" value="12">
                        <?php  echo $H[3][12];?>
                    </td>
                    <td id="d4h12" <?php  echo $C[4][12]; if (empty($H[4][12])) { echo $valisalon;}?> onclick='tomarDatos("d412", "h124")' >
                        <input id="d412" type="hidden" value="Jueves">
                        <input id="h124" type="hidden" value="12">
                        <?php  echo $H[4][12];?>
                    </td>
                    <td id="d5h12" <?php  echo $C[5][12]; if (empty($H[5][12])) { echo $valisalon;}?> onclick='tomarDatos("d512", "h125")' >
                        <input id="d512" type="hidden" value="Viernes">
                        <input id="h125" type="hidden" value="12">
                        <?php  echo $H[5][12];?>
                    </td>
                    <td id="d6h12" <?php  echo $C[6][12]; if (empty($H[6][12])) { echo $valisalon;}?> onclick='tomarDatos("d612", "h126")' >
                        <input id="d612" type="hidden" value="Sabado">
                        <input id="h126" type="hidden" value="12">
                        <?php  echo $H[6][12];?>
                    </td>
                    <td id="d7h12" <?php  echo $C[7][12]; if (empty($H[7][12])) { echo $valisalon;}?> onclick='tomarDatos("d712", "h127")' >
                        <input id="d712" type="hidden" value="Domingo">
                        <input id="h127" type="hidden" value="12">
                        <?php  echo $H[7][12];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora">16:50 a 17:35</td>
                    <td id="d1h13" <?php  echo $C[1][13]; if (empty($H[1][13])) { echo $valisalon;}?> onclick='tomarDatos("d113", "h131")' >
                        <input id="d113" type="hidden" value="Lunes">
                        <input id="h131" type="hidden" value="13">
                        <?php  echo $H[1][13];?>
                    </td>
                    <td id="d2h13" <?php  echo $C[2][13]; if (empty($H[2][13])) { echo $valisalon;}?> onclick='tomarDatos("d213", "h132")' >
                        <input id="d213" type="hidden" value="Martes">
                        <input id="h132" type="hidden" value="13">
                        <?php  echo $H[2][13];?>
                    </td>
                    <td id="d3h13" <?php  echo $C[3][13]; if (empty($H[3][13])) { echo $valisalon;}?> onclick='tomarDatos("d313", "h133")' >
                        <input id="d313" type="hidden" value="Miercoles">
                        <input id="h133" type="hidden" value="13">
                        <?php  echo $H[3][13];?>
                    </td>
                    <td id="d4h13" <?php  echo $C[4][13]; if (empty($H[4][13])) { echo $valisalon;}?> onclick='tomarDatos("d413", "h134")' >
                        <input id="d413" type="hidden" value="Jueves">
                        <input id="h134" type="hidden" value="13">
                        <?php  echo $H[4][13];?>
                    </td>
                    <td id="d5h13" <?php  echo $C[5][13]; if (empty($H[5][13])) { echo $valisalon;}?> onclick='tomarDatos("d513", "h135")' >
                        <input id="d513" type="hidden" value="Viernes">
                        <input id="h135" type="hidden" value="13">
                        <?php  echo $H[5][13];?>
                    </td>
                    <td id="d6h13" <?php  echo $C[6][13]; if (empty($H[6][13])) { echo $valisalon;}?> onclick='tomarDatos("d613", "h136")' >
                        <input id="d613" type="hidden" value="Sabado">
                        <input id="h136" type="hidden" value="13">
                        <?php  echo $H[6][13];?>
                    </td>
                    <td id="d7h13" <?php  echo $C[7][13]; if (empty($H[7][13])) { echo $valisalon;}?> onclick='tomarDatos("d713", "h137")' >
                        <input id="d713" type="hidden" value="Domingo">
                        <input id="h137" type="hidden" value="13">
                        <?php  echo $H[7][13];?>
                    </td>
                </tr>
               
                <tr>
                    <th class="medio active" colspan="8">NOCHE</th>
                </tr>
                
                <tr>
                    <td class="hora">17:45 a 18:30</td>
                    <td id="d1h14" <?php  echo $C[1][14]; if (empty($H[1][14])) { echo $valisalon;}?> onclick='tomarDatos("d114", "h141")' >
                        <input id="d114" type="hidden" value="Lunes">
                        <input id="h141" type="hidden" value="14">
                        <?php  echo $H[1][14];?>
                    </td>
                    <td id="d2h14" <?php  echo $C[2][14]; if (empty($H[2][14])) { echo $valisalon;}?> onclick='tomarDatos("d214", "h142")' >
                        <input id="d214" type="hidden" value="Martes">
                        <input id="h142" type="hidden" value="14">
                        <?php  echo $H[2][14];?>
                    </td>
                    <td id="d3h14" <?php  echo $C[3][14]; if (empty($H[3][14])) { echo $valisalon;}?> onclick='tomarDatos("d314", "h143")' >
                        <input id="d314" type="hidden" value="Miercoles">
                        <input id="h143" type="hidden" value="14">
                        <?php  echo $H[3][14];?>
                    </td>
                    <td id="d4h14" <?php  echo $C[4][14]; if (empty($H[4][14])) { echo $valisalon;}?> onclick='tomarDatos("d414", "h144")' >
                        <input id="d414" type="hidden" value="Jueves">
                        <input id="h144" type="hidden" value="14">
                        <?php  echo $H[4][14];?>
                    </td>
                    <td id="d5h14" <?php  echo $C[5][14]; if (empty($H[5][14])) { echo $valisalon;}?> onclick='tomarDatos("d514", "h145")' >
                        <input id="d514" type="hidden" value="Viernes">
                        <input id="h145" type="hidden" value="14">
                        <?php  echo $H[5][14];?>
                    </td>
                    <td id="d6h14" <?php  echo $C[6][14]; if (empty($H[6][14])) { echo $valisalon;}?> onclick='tomarDatos("d614", "h146")' >
                        <input id="d614" type="hidden" value="Sabado">
                        <input id="h146" type="hidden" value="14">
                        <?php  echo $H[6][14];?>
                    </td>
                    <td id="d7h14" <?php  echo $C[7][14]; if (empty($H[7][14])) { echo $valisalon;}?> onclick='tomarDatos("d714", "h147")' >
                        <input id="d714" type="hidden" value="Domingo">
                        <input id="h147" type="hidden" value="14">
                        <?php  echo $H[7][14];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora">18:30 a 19:15</td>
                    <td id="d1h15" <?php  echo $C[1][15]; if (empty($H[1][15])) { echo $valisalon;}?> onclick='tomarDatos("d115", "h151")' >
                        <input id="d115" type="hidden" value="Lunes">
                        <input id="h151" type="hidden" value="15">
                        <?php  echo $H[1][15];?>
                    </td>
                    <td id="d2h15" <?php  echo $C[2][15]; if (empty($H[2][15])) { echo $valisalon;}?> onclick='tomarDatos("d215", "h152")' >
                        <input id="d215" type="hidden" value="Martes">
                        <input id="h152" type="hidden" value="15">
                        <?php  echo $H[2][15];?>
                    </td>
                    <td id="d3h15" <?php  echo $C[3][15]; if (empty($H[3][15])) { echo $valisalon;}?> onclick='tomarDatos("d315", "h153")' >
                        <input id="d315" type="hidden" value="Miercoles">
                        <input id="h153" type="hidden" value="15">
                        <?php  echo $H[3][15];?>
                    </td>
                    <td id="d4h15" <?php  echo $C[4][15]; if (empty($H[4][15])) { echo $valisalon;}?> onclick='tomarDatos("d415", "h154")' >
                        <input id="d415" type="hidden" value="Jueves">
                        <input id="h154" type="hidden" value="15">
                        <?php  echo $H[4][15];?>
                    </td>
                    <td id="d5h15" <?php  echo $C[5][15]; if (empty($H[5][15])) { echo $valisalon;}?> onclick='tomarDatos("d515", "h155")' >
                        <input id="d515" type="hidden" value="Viernes">
                        <input id="h155" type="hidden" value="15">
                        <?php  echo $H[5][15];?>
                    </td>
                    <td id="d6h15" <?php  echo $C[6][15]; if (empty($H[6][15])) { echo $valisalon;}?> onclick='tomarDatos("d615", "h156")' >
                        <input id="d615" type="hidden" value="Sabado">
                        <input id="h156" type="hidden" value="15">
                        <?php  echo $H[6][15];?>
                    </td>
                    <td id="d7h15" <?php  echo $C[7][15]; if (empty($H[7][15])) { echo $valisalon;}?> onclick='tomarDatos("d715", "h157")' >
                        <input id="d715" type="hidden" value="Domingo">
                        <input id="h157" type="hidden" value="15">
                        <?php  echo $H[7][15];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora">19:15 a 20:00</td>
                    <td id="d1h16" <?php  echo $C[1][16]; if (empty($H[1][16])) { echo $valisalon;}?> onclick='tomarDatos("d116", "h161")' >
                        <input id="d116" type="hidden" value="Lunes">
                        <input id="h161" type="hidden" value="16">
                        <?php  echo $H[1][16];?>
                    </td>
                    <td id="d2h16" <?php  echo $C[2][16]; if (empty($H[2][16])) { echo $valisalon;}?> onclick='tomarDatos("d216", "h162")' >
                        <input id="d216" type="hidden" value="Martes">
                        <input id="h162" type="hidden" value="16">
                        <?php  echo $H[2][16];?>
                    </td>
                    <td id="d3h16" <?php  echo $C[3][16]; if (empty($H[3][16])) { echo $valisalon;}?> onclick='tomarDatos("d316", "h163")' >
                        <input id="d316" type="hidden" value="Miercoles">
                        <input id="h163" type="hidden" value="16">
                        <?php  echo $H[3][16];?>
                    </td>
                    <td id="d4h16" <?php  echo $C[4][16]; if (empty($H[4][16])) { echo $valisalon;}?> onclick='tomarDatos("d416", "h164")' >
                        <input id="d416" type="hidden" value="Jueves">
                        <input id="h164" type="hidden" value="16">
                        <?php  echo $H[4][16];?>
                    </td>
                    <td id="d5h16" <?php  echo $C[5][16]; if (empty($H[5][16])) { echo $valisalon;}?> onclick='tomarDatos("d516", "h165")' >
                        <input id="d516" type="hidden" value="Viernes">
                        <input id="h165" type="hidden" value="16">
                        <?php  echo $H[5][16];?>
                    </td>
                    <td id="d6h16" <?php  echo $C[6][16]; if (empty($H[6][16])) { echo $valisalon;}?> onclick='tomarDatos("d616", "h166")' >
                        <input id="d616" type="hidden" value="Sabado">
                        <input id="h166" type="hidden" value="16">
                        <?php  echo $H[6][16];?>
                    </td>
                    <td id="d7h16" <?php  echo $C[7][16]; if (empty($H[7][16])) { echo $valisalon;}?> onclick='tomarDatos("d716", "h167")' >
                        <input id="d716" type="hidden" value="Domingo">
                        <input id="h167" type="hidden" value="16">
                        <?php  echo $H[7][16];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora">20:00 a 20:45</td>
                   <td id="d1h17" <?php  echo $C[1][17]; if (empty($H[1][17])) { echo $valisalon;}?> onclick='tomarDatos("d117", "h171")' >
                        <input id="d117" type="hidden" value="Lunes">
                        <input id="h171" type="hidden" value="17">
                        <?php  echo $H[1][17];?>
                    </td>
                    <td id="d2h17" <?php  echo $C[2][17]; if (empty($H[2][17])) { echo $valisalon;}?> onclick='tomarDatos("d217", "h172")' >
                        <input id="d217" type="hidden" value="Martes">
                        <input id="h172" type="hidden" value="17">
                        <?php  echo $H[2][17];?>
                    </td>
                    <td id="d3h17" <?php  echo $C[3][17]; if (empty($H[3][17])) { echo $valisalon;}?> onclick='tomarDatos("d317", "h173")' >
                        <input id="d317" type="hidden" value="Miercoles">
                        <input id="h173" type="hidden" value="17">
                        <?php  echo $H[3][17];?>
                    </td>
                    <td id="d4h17" <?php  echo $C[4][17]; if (empty($H[4][17])) { echo $valisalon;}?> onclick='tomarDatos("d417", "h174")' >
                        <input id="d417" type="hidden" value="Jueves">
                        <input id="h174" type="hidden" value="17">
                        <?php  echo $H[4][17];?>
                    </td>
                    <td id="d5h17" <?php  echo $C[5][17]; if (empty($H[5][17])) { echo $valisalon;}?> onclick='tomarDatos("d517", "h175")' >
                        <input id="d517" type="hidden" value="Viernes">
                        <input id="h175" type="hidden" value="17">
                        <?php  echo $H[5][17];?>
                    </td>
                    <td id="d6h17" <?php  echo $C[6][17]; if (empty($H[6][17])) { echo $valisalon;}?> onclick='tomarDatos("d617", "h176")' >
                        <input id="d617" type="hidden" value="Sabado">
                        <input id="h176" type="hidden" value="17">
                        <?php  echo $H[6][17];?>
                    </td>
                    <td id="d7h17" <?php  echo $C[7][17]; if (empty($H[7][17])) { echo $valisalon;}?> onclick='tomarDatos("d717", "h177")' >
                        <input id="d717" type="hidden" value="Domingo">
                        <input id="h177" type="hidden" value="17">
                        <?php  echo $H[7][17];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora">20:45 a 21:30</td>
                    <td id="d1h18" <?php  echo $C[1][18]; if (empty($H[1][18])) { echo $valisalon;}?> onclick='tomarDatos("d118", "h181")' >
                        <input id="d118" type="hidden" value="Lunes">
                        <input id="h181" type="hidden" value="18">
                        <?php  echo $H[1][18];?>
                    </td>
                    <td id="d2h18" <?php  echo $C[2][18]; if (empty($H[2][18])) { echo $valisalon;}?> onclick='tomarDatos("d218", "h182")' >
                        <input id="d218" type="hidden" value="Martes">
                        <input id="h182" type="hidden" value="18">
                        <?php  echo $H[2][18];?>
                    </td>
                    <td id="d3h18" <?php  echo $C[3][18]; if (empty($H[3][18])) { echo $valisalon;}?> onclick='tomarDatos("d318", "h183")' >
                        <input id="d318" type="hidden" value="Miercoles">
                        <input id="h183" type="hidden" value="18">
                        <?php  echo $H[3][18];?>
                    </td>
                    <td id="d4h18" <?php  echo $C[4][18]; if (empty($H[4][18])) { echo $valisalon;}?> onclick='tomarDatos("d418", "h184")' >
                        <input id="d418" type="hidden" value="Jueves">
                        <input id="h184" type="hidden" value="18">
                        <?php  echo $H[4][18];?>
                    </td>
                    <td id="d5h18" <?php  echo $C[5][18]; if (empty($H[5][18])) { echo $valisalon;}?> onclick='tomarDatos("d518", "h185")' >
                        <input id="d518" type="hidden" value="Viernes">
                        <input id="h185" type="hidden" value="18">
                        <?php  echo $H[5][18];?>
                    </td>
                    <td id="d6h18" <?php  echo $C[6][18]; if (empty($H[6][18])) { echo $valisalon;}?> onclick='tomarDatos("d618", "h186")' >
                        <input id="d618" type="hidden" value="Sabado">
                        <input id="h186" type="hidden" value="18">
                        <?php  echo $H[6][18];?>
                    </td>
                    <td id="d7h18" <?php  echo $C[7][18]; if (empty($H[7][18])) { echo $valisalon;}?> onclick='tomarDatos("d718", "h187")' >
                        <input id="d718" type="hidden" value="Domingo">
                        <input id="h187" type="hidden" value="18">
                        <?php  echo $H[7][18];?>
                    </td>
                </tr>
                  <tr>
                    <td class="hora">21:30 a 22:15</td>
                    <td id="d1h19" <?php  echo $C[1][19]; if (empty($H[1][19])) { echo $valisalon;}?> onclick='tomarDatos("d119", "h191")' >
                        <input id="d119" type="hidden" value="Lunes">
                        <input id="h191" type="hidden" value="19">
                        <?php  echo $H[1][19];?>
                    </td>
                    <td id="d2h19" <?php  echo $C[2][19]; if (empty($H[2][19])) { echo $valisalon;}?> onclick='tomarDatos("d219", "h192")' >
                        <input id="d219" type="hidden" value="Martes">
                        <input id="h192" type="hidden" value="19">
                        <?php  echo $H[2][19];?>
                    </td>
                    <td id="d3h19" <?php  echo $C[3][19]; if (empty($H[3][19])) { echo $valisalon;}?> onclick='tomarDatos("d319", "h193")' >
                        <input id="d319" type="hidden" value="Miercoles">
                        <input id="h193" type="hidden" value="19">
                        <?php  echo $H[3][19];?>
                    </td>
                    <td id="d4h19" <?php  echo $C[4][19]; if (empty($H[4][19])) { echo $valisalon;}?> onclick='tomarDatos("d419", "h194")' >
                        <input id="d419" type="hidden" value="Jueves">
                        <input id="h194" type="hidden" value="19">
                        <?php  echo $H[4][19];?>
                    </td>
                    <td id="d5h19" <?php  echo $C[5][19]; if (empty($H[5][19])) { echo $valisalon;}?> onclick='tomarDatos("d519", "h195")' >
                        <input id="d519" type="hidden" value="Viernes">
                        <input id="h195" type="hidden" value="19">
                        <?php  echo $H[5][19];?>
                    </td>
                    <td id="d6h19" <?php  echo $C[6][19]; if (empty($H[6][19])) { echo $valisalon;}?> onclick='tomarDatos("d619", "h196")' >
                        <input id="d619" type="hidden" value="Sabado">
                        <input id="h196" type="hidden" value="19">
                        <?php  echo $H[6][19];?>
                    </td>
                    <td id="d7h19" <?php  echo $C[7][19]; if (empty($H[7][19])) { echo $valisalon;}?> onclick='tomarDatos("d719", "h197")' >
                        <input id="d719" type="hidden" value="Domingo">
                        <input id="h197" type="hidden" value="19">
                        <?php  echo $H[7][19];?>
                    </td>
                </tr>
                
            </tbody>
        </table>
   </div>
</div>

   

<div id="Edificio" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
    		<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            	<h4 class="modal-title"><?php echo "Edificio: \"".$edificio."\" &nbsp; Salon: \"".$salon."\"&nbsp; Tipo: \"".$tipo."\""; ?></h4>
            </div>
    		<div class="modal-body" >
            <div id="validHorario" ></div>
    			<form id="horario1"  method="POST" >
                    <div class="input-group" id="DivContenedor" >
                        <span class='input-group-addon'>Día</span>
                    </div>
                    <div class="input-group" id="DivContenedor2" >
                        <span class='input-group-addon'>Hora</span>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">Edificio</span>
                        <input type="text" id="edificio" name="edificio" required class="form-control"readonly value="<?php echo $edificio; ?>" >
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo $tipo; ?></span>
                        <input type="text" required class="form-control"readonly value="<?php echo $salon; ?>" >
                        <input type="hidden" id="sal" name="salon" required class="form-control"readonly value="<?php echo $fila1[0]; ?>" >
                        <input type="hidden" id="tsalon" name="tsalon"  value="<?php echo $tipo; ?>" >
                        </div>
                    <div class="input-group">
                        <span class="input-group-addon">Estuctura</span>
                        <input type="text" id="estructura" name="estructura" required class="form-control"readonly value="<?php echo $estr ?>" >
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">Carrera</span>
                        <?php 
                            require_once('consulta/conexion.php');
                            $q1 = "SELECT * FROM carrera ORDER BY nombre ASC";
                            $res1 = pg_query($conex, $q1) or die("Error en la Consulta SQL poi");
                        ?>
                        <label id="labelse1">
                        <select id='carrer' name='carrer' >
                            <option  value='0' disabled="">Seleccione una opción</option> 
                            <?php while ($row1 = pg_fetch_row($res1)) { ?>
                                <option value='<?= $row1[0]?>' <?php if ($row1[0]!=$carrera) {echo "disabled='disabled'";}?><?php if ($row1[0]==$carrera) {echo "selected";}?>><?= $row1[1]?></option>
                            <?php } ?>
                        </select>
                        </label>
                    </div>
                    <?php 
                        $queryM = "SELECT * FROM \"unidadCurricular\" WHERE \"idCarrera\"='$carrera' ORDER BY nombre ASC";
                        $resultadoM = pg_query($conexion, $queryM) or die("Error en la Consulta SQL");
                    ?>
                    <div class="input-group">
                        <span class="input-group-addon">Materia</span>
                        <label id="labelse1">
                            <select id='materia'  name='materia' onChange='cargaContenidoM(this.id)'>
                                <option value=''>Seleccione una opción</option> 
                                <?php while ($fil = pg_fetch_row($resultadoM)) { ?>
                                <option value='<?= $fil[0] ?>'><?= $fil[1]." ";?></option>
                                <?php } ?>
                            </select>
                        </label>
                    </div>
        			<div class="input-group">
                    	<span class="input-group-addon">Periodo Malla</span>
                        <label id="labelse1">
                    		<select id="periodo"  name="periodo" onChange="cargaContenidoSc(this.id)">
                    			<option value="" disabled="">-------------------------</option>
                    			
                    		</select>
                        </label>
                	</div>
                    <div class="input-group">
                       <span class="input-group-addon">Seccion</span>
                        <label id="labelse1">
                            <select id="secc"  name="seccion">
                                <option value=""  disabled>-------------------------</option>
                                
                             </select>
                        </label>
                    </div>  
                    <div class="input-group">
                       <span class="input-group-addon">Profesor</span>
                        <?php 
                            $q111 = "SELECT * FROM persona a 
                            INNER JOIN profesor b ON a.cedula = b.cedula ORDER BY a.nombre ASC";
                            $res11 = pg_query($conexion, $q111) ;
                        ?>
                        <label id="labelse1">
                            <select id="profesor"  name="profesor">
                                <option value=""        >-------------------------</option>
                                <?php while ($row11 = pg_fetch_row($res11)) { ?>
                                <option value='<?= $row11[0]?>' > <?= $row11[1]." ".$row11[3]?> </option>
                            <?php } ?>
                             </select>
                        </label>
                    </div>  
                    <div class="input-group">
                        <span class="input-group-addon">Tipo de horas</span>
                        <input type="text" id="thora" name="thora" required class="form-control"readonly value="<?php if ($tipo=='Laboratorio') {echo $thora="Pacticas";  }  if ($tipo=='Salon') {echo $thora="Teoricas";  }?>" >
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">N° de horas disponibles</span>
                        <input type="text" id="horasd" name="horasd" required class="form-control"readonly  >
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">N° de horas a asignar</span>
                        <label id="labelse1">
                            <select id="chora"  name="chora">
                                <option value="" >-------------------------</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </label>
                    </div>
                        <br />
           			<div>
        				<label>&nbsp;</label>
                        <button type="button" class="btn btn-primary btn-xs" onclick="validaHorario()">ENVIAR</button>
        			
						              </div>
                </form>
            </div>
    	</div>
    </div>
</div>
<div id="editarEdificio" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Edicion de Registro de horario</h3>
            </div>
            <div class="modal-body" >
                <div id="aqui"></div>
            </div>
        </div>
    </div>
</div>

