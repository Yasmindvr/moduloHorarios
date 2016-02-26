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

$query1 = "INSERT INTO salones (id, salon , cod_edif, tipo) VALUES (nextval('salones_id_seq'::regclass), '$nombre','$edificio','$tipo')";

print_r ($query1);
$resultado = pg_query($conexion, $query1);
print_r($resultado);
echo "Datos agregados correctamente&&success";

?>