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
                        <a class="nav-link text-white" aria-current="page" href="Facturacion.php">Generar Factura</a>
                        <a class="nav-link active text-white" href="Productos.php">Productos</a>
                        <a class="nav-link text-white" href="Facturas.php">Facturas</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div id="content" class="p-4 p-md-5">
        <h2 class="text-center mb-4" style="text-align: center; margin-top: 3%;" src="">GESTIONAR PRODUCTOS</h2>
        <div class="table-responsive p-2">
            <table class="table table-striped" id="tableProductos" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Código</th>
                    <th scope="col" class="text-center">Descripcion</th>
                    <th scope="col" class="text-center">Precio</th>
                    <th scope="col" class="text-center">Existencias</th>
                    <th scope="col" class="text-center">Acciones </th>
                </tr>
            </thead>
            <tbody id="tbody_producto" style="text-align: center;" >
            </tbody>
        </table>
        </div>
        <div class="footer-page">
            <button class="btn btnAgregar" data-bs-toggle="modal" data-bs-target="#agregarProducto" onclick="">Nuevo Producto</button>
        </div>
    </div>

    <!-- AGREGAR PRODUCTO -->
    <form id="formularioProducto" autocomplete="off" method="POST">
        <div class="modal fade" id="agregarProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center justify-content-between">
                        <h1 class="modal-title fs-5 text-center d-flex align-items-center gap-2"><img id="imgModal" src=""><span style="text-align: center">INGRESAR PRODUCTO NUEVO</span> </h1>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>

                    <div class="modal-body">

                        <div class="row">
                            <div class="col">
                            <label class="col-form-label">Codigo: <i class="asterisco" style="color:crimson;">*</i></label>
                                <input class="form-control" type="number" id="codigo_producto" name="codigo_producto" >
                            </div>
                            <div class="col">
                                <label class="col-form-label">Descripción: <i class="asterisco" style="color:crimson;">*</i></label>
                                <input class="form-control" id="descripcion_producto" name="descripcion_producto" >
                            </div>
                            <div class="col">
                                <label class="col-form-label">Precio: <i class="asterisco" style="color:crimson;">*</i></label>
                                <input class="form-control" type="number" id="precio_producto" name="precio_producto" >
                            </div>
                            <div class="col">
                            <label class="col-form-label">Existencias: <i class="asterisco" style="color:crimson;">*</i></label>
                                <input class="form-control" type="number" id="existencias_producto" name="existencias_producto" maxlength="4" >
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="modalFooter">
                        <label class="campObl" style="color: gray; margin-inline-end: auto;">(*) Campos obligatorios.</label>
                        <button type="button" class="btn" onclick="" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btnAccionF" id="btnGuardarProducto">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- ELIMINAR PRODUCTO -->
    <form id="formularioEliminarProducto" autocomplete="off" method="POST">
        <input type="text" name="id_productoEliminar" id="id_productoEliminar" hidden>
        <div class="modal fade" id="eliminarProducto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center justify-content-between">
                        <h1 class="modal-title fs-5 text-center d-flex align-items-center gap-2">
                            <img id="imgModal" src=""><span id="tituloModal" style="text-align: center">ELIMINAR PRODUCTO</span>
                        </h1>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>

                    <div class="modal-body">
                        <p> ¿Desea eliminar el producto <span id="idProductoEliminar"></span> ? </p>
                    </div>

                    <div class="modal-footer" id="modalFooter">
                        <button type="button" class="btn btnRedireccion" onclick=""
                            data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btnAccionF" id="btnEliminarProducto">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="complementos/assets/js/productos.js"></script>
</body>

</html>