<?php

$conexion = mysqli_connect('localhost','root','','facturacion');

$codigo_producto = $_POST['codigo_producto'];
$descripcion_producto = $_POST['descripcion_producto'];
$precio_producto = $_POST['precio_producto'];
$existencias_producto = $_POST['existencias_producto'];


if ($codigo_producto=="" or $descripcion_producto=="" or $precio_producto=="" or $existencias_producto==""){
    echo "vacio";
}else{
    $sql="INSERT INTO producto (id_producto, codigo_producto, descripcion_producto, precio_producto, existencias_producto) 
    VALUES (null,'$codigo_producto','$descripcion_producto','$precio_producto', $existencias_producto)";

    echo mysqli_query($conexion, $sql);
}

?>