<?php
  header('Content-Type: text/html; charset=utf-8');
  $con = mysqli_connect("192.168.0.5:3306", "tronxi", "tronxi97");
  mysqli_select_db($con, "chat");
  $query = "select nombre, texto, fecha from mensaje";
  $resul = mysqli_query($con, $query);
  $objJson = array();
  while($fila = mysqli_fetch_array($resul))
  {
    //echo $fila['nombre']."- ".$fila['fecha'].": ".$fila['texto']."\n";
    $objJson[] = array('nombre' => $fila['nombre'],
                        'fecha' => $fila['fecha'],
                      'texto' => $fila['texto']);
    //$objJson[] ="nombre :" $fila['nombre']." ".$fila['fecha'].": ".$fila['texto']."\n";
  }
  mysqli_close($con);

  echo json_encode($objJson);
?>
