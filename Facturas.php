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
                    <a class="nav-link text-white" href="Productos.php">Productos</a>
                    <a class="nav-link active text-white" href="Facturas.php">Facturas</a>
                </div>
              </div>
            </div>
          </nav>
    </header>

    <div id="content" class="p-4 p-md-5" style="">
        <h2 class="text-center mb-4" style="text-align: center; margin-top: 3%;" src="" >GESTIONAR FACTURAS</h2>
        <div class="table-responsive p-2">
            <table class="table table-striped" id="tableProductos" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Código Asesor</th>
                        <th scope="col" class="text-center">Código Cliente</th>
                        <th scope="col" class="text-center">Fecha</th>
                        <th scope="col" class="text-center">Metodo de pago</th>
                        <th scope="col" class="text-center">Subtotal</th>
                        <th scope="col" class="text-center">Total</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tbody_factura" style="text-align: center;" >
                    
                </tbody>
            </table>
        </div>
    </div>    

    <!-- ELIMINAR FACTURA -->
    <form id="formularioEliminarFactura" autocomplete="off">
    <input type="text" name="id_facturaEliminar" id="id_productoEliminar" hidden>
        <div class="modal fade" id="eliminarFactura" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center justify-content-between">
                        <h1 class="modal-title fs-5 text-center d-flex align-items-center gap-2">
                            <img id="imgModal" src=""><span id="tituloModal" style="text-align: center">ELIMINAR
                                FACTURA</span>
                        </h1>
                        <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>

                    <div class="modal-body">
                        <p> ¿Desea eliminar la factura? <span id="idFacturaEliminar"></span> </p>
                    </div>

                    <div class="modal-footer" id="modalFooter">
                        <button type="button" class="btn btnRedireccion" onclick=""
                            data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btnAccionF" id="btnGuardar">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="complementos/assets/js/facturas.js"></script>

</body>
</html>