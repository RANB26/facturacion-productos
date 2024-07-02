<?php

$conexion = mysqli_connect('localhost','root','','facturacion');

$documento_cliente = $_POST['documento_cliente'];
$consulta_idcliente = mysqli_fetch_row(mysqli_query($conexion, "SELECT id_usuario FROM usuario WHERE documento_usuario='$documento_cliente'"));
$id_cliente = $consulta_idcliente[0];

$documento_asesor = $_POST['documento_asesor'];
$consulta_idasesor = mysqli_fetch_row(mysqli_query($conexion, "SELECT id_usuario FROM usuario WHERE documento_usuario='$documento_asesor'"));
$id_asesor = $consulta_idasesor[0];

$mpago_factura = $_POST['forma_pago'];
$fecha_factura = $_POST['fecha_factura'];

$subtotal_factura = $_POST['subtotal_factura'];
$total_factura = $_POST['total_factura'];

$sql1="INSERT INTO factura (id_factura, id_asesor, id_cliente, fecha_factura, mpago_factura, subtotal_factura, total_factura) 
VALUES (null,'$id_asesor','$id_cliente','$fecha_factura','$mpago_factura','$subtotal_factura','$total_factura')";

mysqli_query($conexion, $sql1);

$resultado_detalles = $_POST['detalles'];
$detalles = json_decode($resultado_detalles, true);

for ($i=0; $i < count($detalles); $i++) { 
    
    $sql2="INSERT INTO detalle (id_detalle, id_producto, cantidad_producto, total_detalle, id_factura) 
    VALUES (null, (SELECT id_producto FROM producto WHERE codigo_producto=".$detalles[$i]["cod"]."),'".$detalles[$i]["can"]."','".$detalles[$i]["total"]."',(SELECT MAX(id_factura) from factura))";

    mysqli_query($conexion, $sql2);

}

echo "finalizado";

?>