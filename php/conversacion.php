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
    and c.nombre != . $_SESSION['usuario'].
        AND id_conversacion IN (SELECT
            c.id_conversacion
        FROM
            conversacion c
        WHERE
            c.nombre = . $_SESSION['usuario'].)
ORDER BY c.id_conversacion";
  $resul = mysqli_query($con, $query);

  while($fila = mysqli_fetch_array($resul))
  {
    echo $fila['nombre']."\n";
  }
  mysqli_close($con);
?>
