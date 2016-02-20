<?php
    require "kuai/head.php";
?>
        <div id="salones" >
         <br>
            <div class="panel panel-primary">
                <div class="panel-heading">
                 <span id="cerrar" class="close" onClick="window.location='principal.php'" style="cursor: pointer">&times;</span>
                    <h3 class="panel-title">Lista de Salones</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">

                        <thead>
                        
                        <th>ID Salon</th>
                        <th>Edificio</th>
                        <th>Salon</th>
                        <th>Tipo</th>
                       
                        <th colspan="2">Opci&oacute;n</th>            
                        </thead>
                        <tbody>
                           <?php
                           require_once('consulta/conexion.php');
                        $query = "SELECT  a.id, b.edificio, a.salon, a.tipo FROM salones AS a INNER JOIN edificio AS b ON (b.id=a.cod_edi) ORDER BY b.edificio,a.tipo,a.salon ASC";
                        $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");
                        while ($filaa = pg_fetch_row($resultado)) { 

                                echo "<tr>";
                                echo "<td>".$filaa[0]."</td>";
                                echo '<td>' . $filaa[1] . '</td>';
                                echo '<td>' . $filaa[2] . '</td>';
                                echo '<td>' . $filaa[3] . '</td>';
                            
                                echo '<td><button class="btn btn-primary" onclick="editarS(' . $filaa[0] . ')">Editar</button></td>';
                                 echo '</tr>';
                            }
                          
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    <?php
    require "kuai/foot.php";
?>