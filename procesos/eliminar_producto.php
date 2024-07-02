<?php

$conexion = mysqli_connect('localhost','root','','facturacion');

$id_producto = $_POST['id_productoEliminar'];



$sql="DELETE FROM producto WHERE id_producto= $id_producto";

echo mysqli_query($conexion, $sql);

?>