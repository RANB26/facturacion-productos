<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles Factura</title>
    
    <link rel="stylesheet" href="complementos/assets/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="complementos/assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="complementos/assets/css/style.css">

    <script src="complementos/assets/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="complementos/assets/js/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

    <?php

        $id_factura = $_GET['idFactura'];

        $conexion = mysqli_connect('localhost','root','','facturacion');

        $select = mysqli_query($conexion, "SELECT * FROM factura WHERE id_factura=$id_factura");
        while($dat=mysqli_fetch_assoc($select)){
            $datos[]= $dat;
        }
        $js = json_encode($datos);
        $info_factura = json_decode($js, true);

        $id_factura = $info_factura[0]['id_factura'];
        $fecha_factura = $info_factura[0]['fecha_factura'];
        $subtotal_factura = $info_factura[0]['subtotal_factura'];
        $total_factura = $info_factura[0]['total_factura'];
        $forma_pago = $info_factura[0]['mpago_factura'];

        $id_cliente = $info_factura[0]['id_cliente'];
        $consulta_nombrecliente = mysqli_fetch_row(mysqli_query($conexion, "SELECT nombre_usuario, apellido_usuario FROM usuario WHERE id_usuario='$id_cliente'"));
        $nombre_cliente = $consulta_nombrecliente[0]." ".$consulta_nombrecliente[1];

        $id_asesor = $info_factura[0]['id_asesor'];
        $consulta_nombreasesor = mysqli_fetch_row(mysqli_query($conexion, "SELECT nombre_usuario, apellido_usuario FROM usuario WHERE id_usuario='$id_asesor'"));
        $nombre_asesor = $consulta_nombreasesor[0]." ".$consulta_nombrecliente[1];

        $info_detallesconsulta = mysqli_query($conexion, "SELECT * FROM detalle WHERE id_factura='$id_factura'");
        while($data=mysqli_fetch_assoc($info_detallesconsulta)){
            $datos_detalles[]= $data;
        }
        $js_detalles = json_encode($datos_detalles);
        $detalles = json_decode($js_detalles, true);

    ?>

    <div class="container">
        <div id="app" class="col-11">

            <div class="row my-4">
                <div class="col-10">
                    <h1>Factura de venta</h1>
                </div>
            </div>

            <hr />

            <div class="row fact-info mt-3">
                <div class="col-3">
                    <h5>Facturar a</h5>
                    <p id="detCliente"> <?php echo $nombre_cliente ?></p>
                </div>
                <div class="col-3">
                    <h5>Asesor</h5>
                    <p id="detAsesor"> <?php echo $nombre_asesor ?></p>
                </div>
                <div class="col-3">
                    <h5>N° de factura: &#160; <?php echo $id_factura ?></h5>
                    <br>
                    <h5>Fecha: &#160; <?php echo $fecha_factura ?></h5>
                </div>
                <div class="col-3">
                    <h5 id="detNumFactura"></h5>
                    <p id="detFecha" class="my-0"></p>
                    <p id="detFecha"></p>
                </div>
            </div>
            <br><br>
            <div class="row my-3">
                <table class="table table-borderless factura">
                    <thead>
                        <tr>
                            <th>Cant.</th>
                            <th>Descripción</th>
                            <th>Código</th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="trDetalleFactura">
                        <?php for ($i=0; $i < count($detalles); $i++) {
                            
                            $consulta_producto = mysqli_fetch_row(mysqli_query($conexion, "SELECT codigo_producto, descripcion_producto, precio_producto FROM producto WHERE id_producto=".$detalles[$i]["id_producto"]));
                            $codigo_producto = $consulta_producto[0];
                            $descripcion_producto = $consulta_producto[1];
                            $precio_producto = $consulta_producto[2];
                            echo "
                            <tr>
                                <td>".$detalles[$i]["cantidad_producto"]."</td>
                                <td>".$descripcion_producto."</td>
                                <td>".$codigo_producto."</td>
                                <td>".$precio_producto."</td>
                                <td>".$detalles[$i]["total_detalle"]."</td>
                            </tr>";
                        } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3"></th>
                            <th>Subtotal: </th>
                            <th>$<span id="detSubtotal"><?php echo $subtotal_factura ?></span></th>
                        </tr>
                        <tr>
                            <th colspan="3"></th>
                            <th>Total: </th>
                            <th>$<span id="detTotal"><?php echo $total_factura ?></span></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="cond row">
                <div class="col-12 mt-3">
                    <h4>Condiciones</h4>
                    <p>Forma de pago: <?php echo $forma_pago ?></p>
                    <p id="detFormaPago">  </p>
                </div>
            </div>
            </div>
    </div>
    
    <script src="complementos/assets/js/detallesFacturas.js"></script>
</body>
</html>

