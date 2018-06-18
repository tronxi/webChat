<?php
 	session_start();

	header('Content-Type: text/html; charset=utf-8');

	$con = mysqli_connect("192.168.0.5:3306", "tronxi", "tronxi97");
	mysqli_select_db($con, "chat");
	$query = "SELECT DISTINCT
    c.nombre
FROM
    conversacion c
WHERE
    c.id_conversacion != 0
        AND c.nombre != '".$_SESSION['usuario']."'
        AND c.id_conversacion IN (SELECT
            c.id_conversacion
        FROM
            conversacion c
        WHERE
            c.nombre = '".$_SESSION['usuario']."');";
	$resul = mysqli_query($con, $query);

	$objJson = array();

	$estado = "no";
	while($fila = mysqli_fetch_array($resul))
	{
		if($fila['nombre'] == $_POST['persona'])
		{
			$estado = "si";
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
		$query = "insert into conversacion values('".$_SESSION['usuario']."', ".id.");";
		mysqli_query($con, $query);

		$query = "insert into conversacion values('".$_POST['persona']."', ".id.");";
		mysqli_query($con, $query);

		$estado = $id;
	}
	$objJson[] = array('estado' => $estado);
	mysqli_close($con);

	echo json_encode($objJson);
?>
