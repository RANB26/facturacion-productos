<?php

$conexion = mysqli_connect('localhost','root','','facturacion');

$codigo_producto = $_POST['codProducto'];


if ($codigo_producto==""){
    echo "0";
}else{
    $respuesta = mysqli_query($conexion, "SELECT existencias_producto FROM producto WHERE codigo_producto='$codigo_producto'");

    $fila = mysqli_fetch_row($respuesta);
    echo $fila[0];
    

}


?>