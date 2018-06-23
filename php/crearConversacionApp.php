<?php
 	session_start();

	header('Content-Type: text/html; charset=utf-8');
	include 'datos.php';
  	$con = mysqli_connect($host, $usuario, $contraseña);
  	mysqli_select_db($con, $bd);

	$query = "SELECT DISTINCT
    c.nombre, c.id_conversacion as id
FROM
    conversacion c
WHERE
    c.id_conversacion != 0
        AND c.nombre != '".$_POST['usuario']."'
        AND c.id_conversacion IN (SELECT
            c.id_conversacion
        FROM
            conversacion c
        WHERE
            c.nombre = '".$_POST['usuario']."');";
	$resul = mysqli_query($con, $query);

	$objJson = array();

	$estado = "no";
	while($fila = mysqli_fetch_array($resul))
	{
		if($fila['nombre'] == $_POST['persona'])
		{
			$estado = $fila['id'];
		}
	}
	if($estado == "no")
	{
		$query = "SELECT MAX(id_conversacion) as id FROM conversacion;";
		$resul = mysqli_query($con, $query);
		while($fila = mysqli_fetch_array($resul))
		{
			$id = $fila['id'] + 1;
		}
		$query = "insert into conversacion values('".$_POST['usuario']."', ".$id.", 0);";
		mysqli_query($con, $query);

		$query = "insert into conversacion values('".$_POST['persona']."', ".$id.", 0);";
		mysqli_query($con, $query);

		$estado = $id;
	}
	$objJson[] = array('estado' => $estado);
	mysqli_close($con);

	echo json_encode($objJson);
?>
