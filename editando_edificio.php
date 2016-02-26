
<?php
$operacion = '';

  require_once('consulta/conexion.php');



if (!empty($_POST)) {


 $idr=$_POST['ide'];
    $operacion = $_POST['operacion'];
    if ($operacion == 'update') {

       
                      $query = "SELECT * FROM edificio WHERE id = '$idr' " ;
                       $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");
        while ($filaa = pg_fetch_row($resultado)) { 

                         
                            $id=$filaa[0];
                              $nombre=$filaa[1] ;
                              $sede=$filaa[2];
                            
                                
                            }
    }
    //$msg = '';
}
?>


<div class="div_usu">
    <form  class="form-horizontal" role="form" action="consulta/edificio/actualizado.php" method="POST">
        
        <?php if ($operacion == 'update') {
            ?>
            <label for="id_usuario" >ID Edificio:</label>
            <input id="id" name="id" type="text" class="form-control" readonly value="<?php echo $id ?>"/>
            <?php
        }
        ?>
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
                <option value='<?php echo $filaS[0];?>' <?php if ($filaS[0]==$sede){echo " selected";} ?>><?php echo $filaS[1];?></option>
                <?php } ?>
            </select>
            </label>
        </div>
        <label for="edificio" >Nombre:</label>
        <input id="edificio" name="edificio" type="text" class="form-control" placeholder="Nombre" required value="<?php echo $nombre; ?>"/>
        <br/>
        <input type="submit" value="Guardar" class="btn btn-primary"/>
    </form>
</div>