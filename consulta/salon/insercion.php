<?php 
	require_once('../conexion.php');
	extract($_POST);

$query = "SELECT * FROM salones";
$resultado = pg_query($conexion, $query) or die("Error en la Consulta SQL");

while($registro=pg_fetch_array($resultado))
{
	if ($registro[1]==$nombre && $registro[2]==$edificio && $registro[3]==$tipo) 
	{ 
		echo "Ya existe";
		exit();
	}
}

$query1 = "INSERT INTO salones VALUES (nextval('salones_id_seq'::regclass), '$nombre','$edificio','$tipo')";
$resultado = pg_query($conexion, $query1);
echo "Datos agregados correctamente&&success";

?>