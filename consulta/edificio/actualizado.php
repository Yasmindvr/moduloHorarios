
<?php
require_once('../conexion.php');

extract($_POST);


$id=$_POST['id'];
$edificio=$_POST['edificio'];
$sede=$_POST['sede'];


 
$sql = "UPDATE edificio  SET id = $id, edificio= '$edificio', id_sede = $sede WHERE id = '$id'";
 $resultado = pg_query($conexion, $sql) or die("Error en la Consulta SQL");
      
  ?>

          <script type="text/javascript"> alert ("Datos actualizados correctamente");</script>
                    <script type="text/javascript">
                        window.location='../../listaedificio.php';
                    </script>         