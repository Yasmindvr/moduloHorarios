<?php
    require "kuai/head.php";
?>

            <div id="editar_edificio">
             <br>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <span id="cerrar" class="close" onClick="window.location='principal.php'" style="cursor: pointer">&times;</span>
                        <h3 class="panel-title">Lista de Edificios</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <th> Sede</th>
                            <th >Nombre</th>
                            <th >Opci&oacute;n</th>            
                            </thead>
                            <tbody>
                               <?php
                                    require_once('consulta/conexion.php');
                                    $query = "SELECT * FROM edificio a INNER JOIN sede b ON b.id = a.id_sede
                                    ORDER BY  a.id_sede, a.edificio ASC      ";
                                    $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");
                                    while ($filaa = pg_fetch_row($resultado)) { 
                                        echo "<tr>";
                                        echo "<td style='text-aling:center' >".$filaa[4]."</td>";
                                        echo '<td>' . $filaa[1] . '</td>';
                                        echo '<td><button class="btn btn-primary" onclick="editar(' . $filaa[0] . ')">Editar</button></td>';
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