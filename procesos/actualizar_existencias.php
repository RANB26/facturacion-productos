<?php

$conexion = mysqli_connect('localhost','root','','facturacion');

$codigo_producto = $_POST['codProducto'];
$cantidad= $_POST['cantidad'];

if($cantidad>0){
    $cantidad= "+".$cantidad;
}


$sql = mysqli_query($conexion, "UPDATE producto SET existencias_producto=(SELECT existencias_producto FROM producto WHERE codigo_producto='$codigo_producto')$cantidad WHERE codigo_producto='$codigo_producto'");
    

echo mysqli_query($conexion, $sql);


?>