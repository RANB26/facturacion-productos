<?php

$conexion = mysqli_connect('localhost','root','','facturacion');

$select = mysqli_query($conexion, "SELECT * FROM producto");

while($dat=mysqli_fetch_assoc($select)){
    $datos[]= $dat;
}

echo json_encode($datos);

?>