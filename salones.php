
<?php
$operacion = '';

  require_once('consulta/conexion.php');


if (!empty($_POST)) {


 $idr=$_POST['ide'];
    $operacion = $_POST['operacion'];
    if ($operacion == 'update') {

       
                      $query = "SELECT * FROM salones WHERE id = '$idr' " ;
                       $resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");
        while ($filaa = pg_fetch_row($resultado)) { 

                         
                            $id=$filaa[0];
                              $nombre=$filaa[1] ;
                              $tipo=$filaa[3] ;
                              $edi=$filaa[2] ;
                            
                                
                            }
    }
    //$msg = '';
}
?>

<div class="div_usu">
    <form  class="form-horizontal" role="form" action="consulta/salon/actualizado.php" method="POST">
       
        <?php if ($operacion == 'update') {
            ?>
            <label for="id_usuario" >ID Salon:</label>
            <input id="id" name="id" type="text" class="form-control" readonly value="<?php echo $id ?>"/>
            <?php
        }
        ?>
        <div>   
            <?php 
                $query3 = "SELECT id, edificio FROM edificio";
                $resultado1 = pg_query($conexion, $query3) or die("Error en la Consulta SQL");
            ?>
            <label>Edificio</label>
            <label id="labelse">
            <select id='select1' name='cod_edi' required>
                <option value='0'>Seleccione un Edificio</option> 
                <?php while ($fila = pg_fetch_row($resultado1)) { ?>
                <option value='<?= $fila[0];?>'<?php  if($fila[0]==$edi){echo "selected";} ?> > <?= $fila[1]?></option>
                <?php } ?>
            </select>
            </label>
        </div>
      <div>   
           
            <label>Tipo</label>
            <label id="labelse">
            <select id='tiposalon' name='tipo' required>
                <option <?php  if($tipo=='Salon'){echo "selected";} ?> value='Salon'>Salon </option>
                <option <?php  if($tipo=='Laboratorio'){echo "selected";} ?> value='Laboratorio'>Laboratorio  </option>
                <option <?php  if($tipo=='Usos Multiples'){echo "selected";} ?> value='Usos Multiples'>Usos Multiples </option>
               
            </select>
            </label>
        </div>
        <label for="edificio" >Salon:</label>
        <input id="edificio" name="salon" type="text" class="form-control" placeholder="Nombre" required value="<?php echo $nombre; ?>"/>
        
        <br/>
        <input type="submit" value="Guardar" class="btn btn-primary"/>
    </form>
</div>