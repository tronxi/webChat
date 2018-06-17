<?php
  session_start();
  $con = mysqli_connect("192.168.0.5:3306", "tronxi", "tronxi97");
  mysqli_select_db($con, "chat");

  $query = "SELECT DISTINCT
    c.nombre, c.id_conversacion
FROM
    conversacion c
WHERE
    id_conversacion != 0
        AND c.nombre != '".$_SESSION['usuario']."'
        AND id_conversacion IN (SELECT
            c.id_conversacion
        FROM
            conversacion c
        WHERE
            c.nombre = '".$_SESSION['usuario']."')
ORDER BY c.id_conversacion";

  $resul = mysqli_query($con, $query);
  $objJson = array();
  while($fila = mysqli_fetch_array($resul))
  {
    $objJson[] = array('nombre' => $fila['nombre'],
					  'idConversacion' => $fila['id_conversacion']);
  }
  mysqli_close($con);
?>
