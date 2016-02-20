
<?php
require_once('../conexion.php');

extract($_POST);


$id=$_POST['id'];
$salon=$_POST['salon'];
$cod_edi=$_POST['cod_edi'];
$tipo=$_POST['tipo'];


 
$sql = "UPDATE salones  SET id = $id, salon= '$salon', cod_edi = '$cod_edi', tipo = '$tipo' WHERE id = '$id'";
 $resultado = pg_query($conexion, $sql) or die("Error en la Consulta SQL");
      
  ?>

          <script type="text/javascript"> alert ("Datos actualizados correctamente");</script>
                    <script type="text/javascript">
                        window.location='../../listasalones.php';
                    </script>         