<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de facturacion</title>

    <link rel="stylesheet" href="complementos/assets/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="complementos/assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="complementos/assets/css/style.css">

    <script src="complementos/assets/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="complementos/assets/js/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active text-white" aria-current="page" href="Facturacion.php">Generar
                            Factura</a>
                        <a class="nav-link text-white" href="Productos.php">Productos</a>
                        <a class="nav-link text-white" href="Facturas.php">Facturas</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>


    <div id="content" class="p-4 p-md-5">

        <h2 class="text-center mb-4" style="text-align: center; margin-top: 3%;" src="">GENERAR NUEVA FACTURA</h2>
        <div class="row">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Documento Cliente: 
                        <i class="asterisco" style="color:crimson;">*</i>
                    </label>
                    <input type="text" class="form-control" id="documentoCliente" value="1045486524" disabled>
                </div>
                <div class="col-md-4">
                    <label for="inputPassword4" class="form-label">Documento Asesor:
                        <i class="asterisco" style="color:crimson;">*</i>
                    </label>
                    <input type="text" class="form-control" id="documentoAsesor" value="1042850202" disabled>
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Forma de pago:
                        <i class="asterisco" style="color:crimson;">*</i>
                    </label>
                    <select id="formaPago" class="form-select">
                        <option value="Contado" selected>Contado</option>
                        <option value="Credito" >Crédito</option>
                    </select>
                </div>
                <div class="table-responsive p-2">
                    <table class="table table-striped" id="tableProductos" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">Código</th>
                                <th scope="col" class="text-center">Cantidad</th>
                                <th scope="col" class="text-center">Precio</th>
                                <th scope="col" class="text-center">Total</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;" id="trProductos">
                            
                        </tbody>
                    </table>
                </div>

                <div class="row my-3 align-items-center">
                    <div class="col-6 text-start">
                        <button class="btn btnAgregar me-2" data-bs-toggle="modal" data-bs-target="#agregarProductoFactura" onclick="">Agregar Producto</button>
                        <button type="submit" class="btn btnGenerar" id="generarFactura" >Generar Factura</button>
                    </div>
                    <div class="col-3 text-end">
                        <h5 class="text-black my-0">Subtotal:&nbsp;
                            $<span id="valorSubtotal">0</span>
                        </h5>
                    </div>
                    <div class="col-3 text-end">
                        <h5 class="text-black fw-bold my-0">Total:&nbsp;
                            $<span id="valorTotal">0</span>
                        </h5>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- AGREGAR PRODUCTO FACTURA -->
    
        <div class="modal fade" id="agregarProductoFactura" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center justify-content-between">
                        <h1 class="modal-title fs-5 text-center d-flex align-items-center gap-2">
                            <img id="imgModal" src="">
                            <span id="tituloModal" style="text-align: center">AGREGAR PRODUCTO</span>
                        </h1>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                    <form id="formularioFactura" autocomplete="off">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Código del producto: 
                                    <i class="asterisco" style="color:crimson;">*</i></label>
                                <input type="text" class="form-control" id="codigoProducto">
                            </div>
                            <div class="col-md-4">
                                <label  class="form-label">Precio: 
                                    <i class="asterisco" style="color:crimson;">*</i></label>
                                <input type="text" class="form-control" id="precioProducto" disabled>
                            </div>

                            <div class="col-md-4">
                                <label  class="form-label">Cantidad: 
                                    <i class="asterisco" style="color:crimson;">*</i></label>
                                <input type="number" class="form-control" id="cantidadProducto">
                                <span style="font-size: 15px;" id="numExistencias"></span>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer" id="modalFooter">
                        <label class="campObl" style="color: gray; margin-inline-end: auto;">(*) Campos
                            obligatorios.</label>
                        <button type="button" class="btn btnRedireccion" onclick=""
                            data-bs-dismiss="modal">Cerrar</button>
                        <button class="btn" onclick="guardarProducto()">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    

    <script src="complementos/assets/js/facturacion.js"></script>

</body>
</html>