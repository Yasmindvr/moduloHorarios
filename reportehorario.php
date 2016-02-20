<?php 
    require_once('consulta/conexion.php');
    extract($_POST);
    

    if ($tipo=='profesor') {
         $ocultar='style="display:none"';
                    $query = "SELECT * FROM horario a 
                    INNER JOIN \"unidadCurricular\" b ON a.materia = b.id
                    INNER JOIN persona c ON c.cedula = a.profesor
                    INNER JOIN salones d ON d.id = a.salon
                    INNER JOIN edificio e ON e.id = d.cod_edi
                     WHERE a.profesor='$ide'";
                    $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL horario");
                    
                    
                    while ( $fila = pg_fetch_row($resultado)) {
                       

                       require "kuai/horasR.php";
                    }
                    
                }
    if ($tipo=='salon') {
        $query = "SELECT * FROM horario a 
                    INNER JOIN \"unidadCurricular\" b ON a.materia = b.id
                    INNER JOIN persona c ON c.cedula = a.profesor WHERE a.salon = '$ide'";
        $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL horario");
        
        while ( $fila = pg_fetch_row($resultado)) {
           

           require "kuai/horasR.php";
        }
        
    }
    if ($tipo=='seccion') {
        $ocultar='style="display:none"';
        $query = "SELECT * FROM horario a 
                    INNER JOIN \"unidadCurricular\" b ON a.materia = b.id
                    INNER JOIN persona c ON c.cedula = a.profesor WHERE a.seccion = '$ide'";
        $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL horario");
        
        while ( $fila = pg_fetch_row($resultado)) {
           

           require "kuai/horasR.php";
        }
        
    }
            
?>

<div id="imprimeme" >
<div id="oculto" <?php echo $ocultar;?> align="center" ></div>
    <table class="table table-bordered"  rules="all" border="1" style="font-size:11px" width="1200" >
        <caption> </caption> 
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
         <tr> 
                 <tr > 
                    <td class="hora" width="80" ALIGN="center" width="90" ALIGN="center">7:00 a 7:45</td>
                    <td id="d1h1" <?php  echo $C[1][1]; ?>  >
                        
                        <?php  echo $Hr[1][1];?>
                    </td>
                    <td id="d2h1" <?php  echo $C[2][1]; ?>  >
                        <?php  echo $Hr[2][1]; ?>
                    </td>
                    <td id="d3h1" <?php  echo $C[3][1]; ?>  >
                        <?php  echo $Hr[3][1];?>
                    </td>
                    <td id="d4h1" <?php  echo $C[4][1];  ?>  >
                        <?php  echo $Hr[4][1];?>
                    </td>
                    <td id="d5h1" <?php  echo $C[5][1]; ?>  >
                        <?php  echo $Hr[5][1];?>
                    </td>
                    <td id="d6h1" <?php  echo $C[6][1]; ?>  >
                        <?php  echo $Hr[6][1];?>
                    </td>
                    <td id="d7h1" <?php  echo $C[7][1];  ?>  >
                        <?php  echo $Hr[7][1];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora" width="80" ALIGN="center">7:45 a 8:30</td>
                    <td id="d1h2" <?php  echo $C[1][2]; ?>  >
                        <?php  echo $Hr[1][2];?>
                    </td>
                    <td id="d2h2" <?php  echo $C[2][2];  ?>  >
                         <?php  echo $Hr[2][2];?>
                    </td>
                    <td id="d3h2" <?php  echo $C[3][2]; ?>  >
                            <?php  echo $Hr[3][2];?>
                    </td>
                    <td id="d4h2" <?php  echo $C[4][2];  ?>  >
                         <?php  echo $Hr[4][2];?>
                    </td>
                    <td id="d5h2" <?php  echo $C[5][2];  ?>  >
                          <?php  echo $Hr[5][2];?>
                    </td>
                    <td id="d6h2" <?php  echo $C[6][2]; ?>  >
                         <?php  echo $Hr[6][2];?>
                    </td>
                    <td id="d7h2" <?php  echo $C[7][2]; ?>  >
                          <?php  echo $Hr[7][2];?>
                    </td></tr>
                <tr>
                    <td class="hora" width="80" ALIGN="center">8:40 a 9:25</td>
                    <td id="d1h3" <?php  echo $C[1][3]; ?>  >
                        <?php  echo $Hr[1][3];?>
                    </td>
                    <td id="d2h3" <?php  echo $C[2][3]; ?>  >
                        <?php  echo $Hr[2][3];?>
                    </td>
                    <td id="d3h3" <?php  echo $C[3][3]; ?>  >
                        <?php  echo $Hr[3][3];?>
                    </td>
                    <td id="d4h3" <?php  echo $C[4][3]; ?>  >
                        <?php  echo $Hr[4][3];?>
                    </td>
                    <td id="d5h3" <?php  echo $C[5][3]; ?>  >
                        <?php  echo $Hr[5][3];?>
                    </td>
                    <td id="d6h3" <?php  echo $C[6][3]; ?>  >
                        <?php  echo $Hr[6][3];?>
                    </td>
                    <td id="d7h3" <?php  echo $C[7][3]; ?>  >
                        <?php  echo $Hr[7][3];?>
                    </td></tr>
                <tr>
                    <td class="hora" width="80" ALIGN="center">9:25 a 10:10</td>
                    <td id="d1h4" <?php  echo $C[1][4];?>  >
                        <?php  echo $Hr[1][4];?>
                    </td>
                    <td id="d2h4" <?php  echo $C[2][4]; ?>  >
                        <?php  echo $Hr[2][4];?>
                    </td>
                    <td id="d3h4" <?php  echo $C[3][4]; ?>  >
                        <?php  echo $Hr[3][4];?>
                    </td>
                    <td id="d4h4" <?php  echo $C[4][4];?>  >
                        <?php  echo $Hr[4][4];?>
                    </td>
                    <td id="d5h4" <?php  echo $C[5][4];?>  >
                        <?php  echo $Hr[5][4];?>
                    </td>
                    <td id="d6h4" <?php  echo $C[6][4];?>  >
                        <?php  echo $Hr[6][4];?>
                    </td>
                    <td id="d7h24" <?php  echo $C[7][4]; ?>  >
                        <?php  echo $Hr[7][4];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora" width="80" ALIGN="center">10:20 a 11:05</td>
                    <td id="d1h5" <?php  echo $C[1][5]; ?>  >
                        <?php  echo $Hr[1][5];?>
                    </td>
                    <td id="d2h5" <?php  echo $C[2][5]; ?>  >
                        <?php  echo $Hr[2][5];?>
                    </td>
                    <td id="d3h5" <?php  echo $C[3][5]; ?>  >
                        <?php  echo $Hr[3][5];?>
                    </td>
                    <td id="d4h5" <?php  echo $C[4][5]; ?>  >
                        <?php  echo $Hr[4][5];?>
                    </td>
                    <td id="d5h5" <?php  echo $C[5][5]; ?>  >
                        <?php  echo $Hr[5][5];?>
                    </td>
                    <td id="d6h5" <?php  echo $C[6][5]; ?>  >
                        <?php  echo $Hr[6][5];?>
                    </td>
                    <td id="d6h5" <?php  echo $C[7][5]; ?>  >
                        <?php  echo $Hr[7][5];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora" width="80" ALIGN="center">11:05 a 11:50</td>
                    <td id="d1h6" <?php  echo $C[1][6]; ?>  >
                        <?php  echo $Hr[1][6];?>
                    </td>
                    <td id="d2h6" <?php  echo $C[2][6]; ?>  >
                        <?php  echo $Hr[2][6];?>
                    </td>
                    <td id="d3h6" <?php  echo $C[3][6]; ?>  >
                        <?php  echo $Hr[3][6];?>
                    </td>
                    <td id="d4h6" <?php  echo $C[4][6]; ?>  >
                        <?php  echo $Hr[4][6];?>
                    </td>
                    <td id="d5h6" <?php  echo $C[5][6]; ?>  >
                        <?php  echo $Hr[5][6];?>
                    </td>
                    <td id="d6h6" <?php  echo $C[6][6]; ?>  >
                        <?php  echo $Hr[6][6];?>
                    </td>
                    <td id="d6h6" <?php  echo $C[7][6]; ?>  >
                        <?php  echo $Hr[7][6];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora" width="80" ALIGN="center">12:00 a 12:45</td>
                   <td id="d1h7" <?php  echo $C[1][7]; ?>  >
                        <?php  echo $Hr[1][7];?>
                    </td>
                    <td id="d2h7" <?php  echo $C[2][7]; ?>  >
                        <?php  echo $Hr[2][7];?>
                    </td>
                    <td id="d3h7" <?php  echo $C[3][7]; ?>  >
                        <?php  echo $Hr[3][7];?>
                    </td>
                    <td id="d4h7" <?php  echo $C[4][7]; ?>  >
                        <?php  echo $Hr[4][7];?>
                    </td>
                    <td id="d5h7" <?php  echo $C[5][7]; ?>  >
                        <?php  echo $Hr[5][7];?>
                    </td>
                    <td id="d6h7" <?php  echo $C[6][7]; ?>  >
                        <?php  echo $Hr[6][7];?>
                    </td>
                    <td id="d6h7" <?php  echo $C[7][7]; ?>  >
                        <?php  echo $Hr[7][7];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora" width="80" ALIGN="center">12:45 a 13:30</td>
                   <td id="d1h8" <?php  echo $C[1][8]; ?>  >
                        <?php  echo $Hr[1][8];?>
                    </td>
                    <td id="d2h8" <?php  echo $C[2][8]; ?>  >
                        <?php  echo $Hr[2][8];?>
                    </td>
                    <td id="d3h8" <?php  echo $C[3][8]; ?>  >
                        <?php  echo $Hr[3][8];?>
                    </td>
                    <td id="d4h8" <?php  echo $C[4][8]; ?>  >
                        <?php  echo $Hr[4][8];?>
                    </td>
                    <td id="d5h8" <?php  echo $C[5][8]; ?>  >
                        <?php  echo $Hr[5][8];?>
                    </td>
                    <td id="d6h8" <?php  echo $C[6][8]; ?>  >
                        <?php  echo $Hr[6][8];?>
                    </td>
                    <td id="d6h8" <?php  echo $C[7][8]; ?>  >
                        <?php  echo $Hr[7][8];?>
                    </td>
                </tr>
                <tr>
                    <th class="medio active" colspan="8">TARDE</th>
                </tr>
                <tr>
                    <td class="hora" width="80" ALIGN="center">13:30 a 14:25</td>
                    <td id="d1h9" <?php  echo $C[1][9]; ?>  >
                        <?php  echo $Hr[1][9];?>
                    </td>
                    <td id="d2h9" <?php  echo $C[2][9]; ?>  >
                        <?php  echo $Hr[2][9];?>
                    </td>
                    <td id="d3h9" <?php  echo $C[3][9]; ?>  >
                        <?php  echo $Hr[3][9];?>
                    </td>
                    <td id="d4h9" <?php  echo $C[4][9]; ?>  >
                        <?php  echo $Hr[4][9];?>
                    </td>
                    <td id="d5h9" <?php  echo $C[5][9]; ?>  >
                        <?php  echo $Hr[5][9];?>
                    </td>
                    <td id="d6h9" <?php  echo $C[6][9]; ?>  >
                        <?php  echo $Hr[6][9];?>
                    </td>
                    <td id="d7h9" <?php  echo $C[7][9]; ?>  >
                        <?php  echo $Hr[7][9];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora" width="80" ALIGN="center">14:25 a 15:10</td>
                    <td id="d1h10" <?php  echo $C[1][10]; ?>  >
                        <?php  echo $Hr[1][10];?>
                    </td>
                    <td id="d2h10" <?php  echo $C[2][10]; ?>  >
                        <?php  echo $Hr[2][10];?>
                    </td>
                    <td id="d3h10" <?php  echo $C[3][10]; ?>  >
                        <?php  echo $Hr[3][10];?>
                    </td>
                    <td id="d4h10" <?php  echo $C[4][10]; ?>  >
                        <?php  echo $Hr[4][10];?>
                    </td>
                    <td id="d5h10" <?php  echo $C[5][10]; ?>  >
                        <?php  echo $Hr[5][10];?>
                    </td>
                    <td id="d6h10" <?php  echo $C[6][10]; ?>  >
                    <?php  echo $Hr[6][10];?>
                    </td>
                    <td id="d7h10" <?php  echo $C[7][10]; ?>  >
                        <?php  echo $Hr[7][10];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora" width="80" ALIGN="center">15:10 a 15:55</td>
                      <td id="d1h11" <?php  echo $C[1][11]; ?>  >
                        <?php  echo $Hr[1][11];?>
                    </td>
                    <td id="d2h11" <?php  echo $C[2][11]; ?>  >
                    <?php  echo $Hr[2][11];?>
                    </td>
                    <td id="d3h11" <?php  echo $C[3][11]; ?>  >
                        <?php  echo $Hr[3][11];?>
                    </td>
                    <td id="d4h11" <?php  echo $C[4][11]; ?>  >
                    <?php  echo $Hr[4][11];?>
                    </td>
                    <td id="d5h11" <?php  echo $C[5][11]; ?>  >
                        <?php  echo $Hr[5][11];?>
                    </td>
                    <td id="d6h11" <?php  echo $C[6][11]; ?>  >
                    <?php  echo $Hr[6][11];?>
                    </td>
                    <td id="d7h11" <?php  echo $C[7][11]; ?>  >
                        <?php  echo $Hr[7][11];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora" width="80" ALIGN="center">16:05 a 16:50</td>
                    <td id="d1h12" <?php  echo $C[1][12]; ?>  >
                        <?php  echo $Hr[1][12];?>
                    </td>
                    <td id="d2h12" <?php  echo $C[2][12]; ?>  >
                        <?php  echo $Hr[2][12];?>
                    </td>
                    <td id="d3h12" <?php  echo $C[3][12]; ?>  >
                        
                        <?php  echo $Hr[3][12];?>
                    </td>
                    <td id="d4h12" <?php  echo $C[4][12]; ?>  >
                        <?php  echo $Hr[4][12];?>
                    </td>
                    <td id="d5h12" <?php  echo $C[5][12]; ?>  >
                            <?php  echo $Hr[5][12];?>
                    </td>
                    <td id="d6h12" <?php  echo $C[6][12]; ?>  >
                        <?php  echo $Hr[6][12];?>
                    </td>
                    <td id="d7h12" <?php  echo $C[7][12]; ?>  >
                        <?php  echo $Hr[7][12];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora" width="80" ALIGN="center">16:50 a 17:35</td>
                    <td id="d1h13" <?php  echo $C[1][13]; ?>  >
                        <?php  echo $Hr[1][13];?>
                    </td>
                    <td id="d2h13" <?php  echo $C[2][13]; ?>  >
                        <?php  echo $Hr[2][13];?>
                    </td>
                    <td id="d3h13" <?php  echo $C[3][13]; ?>  >
                        
                        <?php  echo $Hr[3][13];?>
                    </td>
                    <td id="d4h13" <?php  echo $C[4][13]; ?>  >
                        <?php  echo $Hr[4][13];?>
                    </td>
                    <td id="d5h13" <?php  echo $C[5][13]; ?>  >
                        <?php  echo $Hr[5][13];?>
                    </td>
                    <td id="d6h13" <?php  echo $C[6][13]; ?>  >
                        <?php  echo $Hr[6][13];?>
                    </td>
                    <td id="d7h13" <?php  echo $C[7][13]; ?>  >
                        <?php  echo $Hr[7][13];?>
                    </td>
                </tr>
               
                <tr>
                    <th class="medio active" colspan="8">NOCHE</th>
                </tr>
                
                <tr>
                    <td class="hora" width="80" ALIGN="center">17:45 a 18:30</td>
                    <td id="d1h14" <?php  echo $C[1][14]; ?>  >
                        <?php  echo $Hr[1][14];?>
                    </td>
                    <td id="d2h14" <?php  echo $C[2][14]; ?>  >
                        <?php  echo $Hr[2][14];?>
                    </td>
                    <td id="d3h14" <?php  echo $C[3][14]; ?>  >
                        <?php  echo $Hr[3][14];?>
                    </td>
                    <td id="d4h14" <?php  echo $C[4][14]; ?>  >
                        <?php  echo $Hr[4][14];?>
                    </td>
                    <td id="d5h14" <?php  echo $C[5][14]; ?>  >
                        <?php  echo $Hr[5][14];?>
                    </td>
                    <td id="d6h14" <?php  echo $C[6][14]; ?>  >
                        <?php  echo $Hr[6][14];?>
                    </td>
                    <td id="d7h14" <?php  echo $C[7][14]; ?>  >
                        <?php  echo $Hr[7][14];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora" width="80" ALIGN="center">18:30 a 19:15</td>
                    <td id="d1h15" <?php  echo $C[1][15]; ?>  >
                        <?php  echo $Hr[1][15];?>
                    </td>
                    <td id="d2h15" <?php  echo $C[2][15]; ?>  >
                        <?php  echo $Hr[2][15];?>
                    </td>
                    <td id="d3h15" <?php  echo $C[3][15]; ?>  >
                        <?php  echo $Hr[3][15];?>
                    </td>
                    <td id="d4h15" <?php  echo $C[4][15]; ?>  >
                        <?php  echo $Hr[4][15];?>
                    </td>
                    <td id="d5h15" <?php  echo $C[5][15]; ?>  >
                        <?php  echo $Hr[5][15];?>
                    </td>
                    <td id="d6h15" <?php  echo $C[6][15]; ?>  >
                        <?php  echo $Hr[6][15];?>
                    </td>
                    <td id="d7h15" <?php  echo $C[7][15]; ?>  >
                        <?php  echo $Hr[7][15];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora" width="80" ALIGN="center">19:15 a 20:00</td>
                    <td id="d1h16" <?php  echo $C[1][16]; ?>  >
                        <?php  echo $Hr[1][16];?>
                    </td>
                    <td id="d2h16" <?php  echo $C[2][16]; ?>  >
                        <?php  echo $Hr[2][16];?>
                    </td>
                    <td id="d3h16" <?php  echo $C[3][16]; ?>  >
                        
                        <?php  echo $Hr[3][16];?>
                    </td>
                    <td id="d4h16" <?php  echo $C[4][16]; ?>  >
                        <?php  echo $Hr[4][16];?>
                    </td>
                    <td id="d5h16" <?php  echo $C[5][16]; ?>  >
                        <?php  echo $Hr[5][16];?>
                    </td>
                    <td id="d6h16" <?php  echo $C[6][16]; ?>  >
                        <?php  echo $Hr[6][16];?>
                    </td>
                    <td id="d7h16" <?php  echo $C[7][16]; ?>  >
                        <?php  echo $Hr[7][16];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora" width="80" ALIGN="center">20:00 a 20:45</td>
                   <td id="d1h17" <?php  echo $C[1][17]; ?>  >
                        <?php  echo $Hr[1][17];?>
                    </td>
                    <td id="d2h17" <?php  echo $C[2][17]; ?>  >
                        <?php  echo $Hr[2][17];?>
                    </td>
                    <td id="d3h17" <?php  echo $C[3][17]; ?>  >
                        
                        <?php  echo $Hr[3][17];?>
                    </td>
                    <td id="d4h17" <?php  echo $C[4][17]; ?>  >
                        <?php  echo $Hr[4][17];?>
                    </td>
                    <td id="d5h17" <?php  echo $C[5][17]; ?>  >
                        <?php  echo $Hr[5][17];?>
                    </td>
                    <td id="d6h17" <?php  echo $C[6][17]; ?>  >
                        <?php  echo $Hr[6][17];?>
                    </td>
                    <td id="d7h17" <?php  echo $C[7][17]; ?>  >
                        <?php  echo $Hr[7][17];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora" width="80" ALIGN="center">20:45 a 21:30</td>
                    <td id="d1h18" <?php  echo $C[1][18]; ?>  >
                        <?php  echo $Hr[1][18];?>
                    </td>
                    <td id="d2h18" <?php  echo $C[2][18]; ?>  >
                        <?php  echo $Hr[2][18];?>
                    </td>
                    <td id="d3h18" <?php  echo $C[3][18]; ?>  >
                        
                        <?php  echo $Hr[3][18];?>
                    </td>
                    <td id="d4h18" <?php  echo $C[4][18]; ?>  >
                        <?php  echo $Hr[4][18];?>
                    </td>
                    <td id="d5h18" <?php  echo $C[5][18]; ?>  >
                        <?php  echo $Hr[5][18];?>
                    </td>
                    <td id="d6h18" <?php  echo $C[6][18]; ?>  >
                        <?php  echo $Hr[6][18];?>
                    </td>
                    <td id="d7h18" <?php  echo $C[7][18]; ?>  >
                        <?php  echo $Hr[7][18];?>
                    </td>
                </tr>
                <tr>
                    <td class="hora" width="80" ALIGN="center">21:30 a 22:15</td>
                    <td id="d1h19" <?php  echo $C[1][19]; ?>  >
                        <?php  echo $Hr[1][19];?>
                    </td>
                    <td id="d2h19" <?php  echo $C[2][19]; ?>  >
                        <?php  echo $Hr[2][19];?>
                    </td>
                    <td id="d3h19" <?php  echo $C[3][19]; ?>  >
                        
                        <?php  echo $Hr[3][19];?>
                    </td>
                    <td id="d4h19" <?php  echo $C[4][19]; ?>  >
                        <?php  echo $Hr[4][19];?>
                    </td>
                    <td id="d5h19" <?php  echo $C[5][19]; ?>  >
                            <?php  echo $Hr[5][19];?>
                    </td>
                    <td id="d6h19" <?php  echo $C[6][19]; ?>  >
                        <?php  echo $Hr[6][19];?>
                    </td>
                    <td id="d7h19" <?php  echo $C[7][19]; ?>  >
                        <?php  echo $Hr[7][19];?>
                    </td>
                </tr>
        </tbody>
    </table>
</div>
<div> <button class="btn btn-primary btn-xs" onClick="Imp()">IMPRIMIR</button>
</div>