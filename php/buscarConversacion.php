<?php
  session_start();
  include 'contraseñas.php';
  $con = mysqli_connect($host, $usuario, $contraseña);
  mysqli_select_db($con, $bd);

  $query = "SELECT DISTINCT
    c.nombre, c.id_conversacion, MAX(fecha) as ultimaFecha
FROM
    conversacion c
        INNER JOIN
    mensaje m ON c.id_conversacion = m.id_conversacion
WHERE
    c.id_conversacion != 0
        AND c.nombre != '".$_SESSION['usuario']."'
        AND c.id_conversacion IN (SELECT 
            c.id_conversacion
        FROM
            conversacion c
        WHERE
            c.nombre = '".$_SESSION['usuario']."')
GROUP BY c.id_conversacion
ORDER BY ultimaFecha DESC;";

  $resul = mysqli_query($con, $query);
  $objJson = array();
  while($fila = mysqli_fetch_array($resul))
  {
    $objJson[] = array('nombre' => $fila['nombre'],
					  'idConversacion' => $fila['id_conversacion']);
  }
  mysqli_close($con);
  echo json_encode($objJson);
?>
