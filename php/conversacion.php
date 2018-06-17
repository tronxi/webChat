<?php
  session_start();
  $con = mysqli_connect("192.168.0.5:3306", "tronxi", "tronxi97");
  mysqli_select_db($con, "chat");

  /*$query = "select distinct
              c.nombre, c.id_conversacion
            from
              conversacion c
            where
              id_conversacion != 0
              and c.nombre != '".$_SESSION['usuario']."'
              and id_conversacion in (select
                c.id_conversacion
                from
                  conversacion c
                where
                  c.nombre = '".$_SESSION['usuario']."')
           ordery by c.id_conversacion";*/
           $query = "select * from conversacion";
  $resul = mysqli_query($con, $query);
  while($fila = mysqli_fetch_array($resul))
  {
    echo $fila['nombre']."\n";
  }
  mysqli_close($con);
?>
