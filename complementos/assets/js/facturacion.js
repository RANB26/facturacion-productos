$(document).ready(function(){

    cargarProductos();

    $('#codigoProducto').keyup(function(){
        let cod = $("#codigoProducto").val();
        let ruta= "codProducto="+cod;
        $.ajax({
            type: "POST",
            url: "procesos/buscarprecio_producto.php",
            data: ruta,
            success: function(res){
                if(parseInt(res)>0){
                    $("#precioProducto").val(res);
                    $.ajax({
                        type: "POST",
                        url: "procesos/buscar_existencias.php",
                        data: ruta,
                        success: function(res){
                            if(parseInt(res)>0){
                                $('#numExistencias').text('Existencias: '+res);
                                $('#cantidadProducto').prop('disabled', false);
                            }else{
                                $('#cantidadProducto').prop('disabled', true);
                                $('#numExistencias').text('Existencias no disponibles');
                            }
                        }
                    });
                }else{
                    $("#precioProducto").val('No se encontró el producto');
                    $('#numExistencias').empty();
                    $('#cantidadProducto').prop('disabled', true);
                }
                $("#cantidadProducto").val('');
            }
        });
    });

    $('#cantidadProducto').keyup(function(){
        let cod = $("#codigoProducto").val();
        
        if(cod){
            let ruta= "codProducto="+cod;
            $.ajax({
                type: "POST",
                url: "procesos/buscar_existencias.php",
                data: ruta,
                success: function(res){
                    let can = $("#cantidadProducto").val();
                    if(parseInt(res)<can){
                        $('#cantidadProducto').addClass("border-danger");
                    }else{
                        $('#cantidadProducto').removeClass("border-danger");
                    }
                }
            });
        }
    });

    $('#generarFactura').click(function(){
        let documentoCliente = document.querySelector("#documentoCliente").value;
        let documentoAsesor = document.querySelector("#documentoAsesor").value;
        let formaPago = document.querySelector("#formaPago").value;
        let hoy = new Date();
        let dia= hoy.getDate();
        let mes = hoy.getMonth() + 1;
        let year = hoy.getFullYear();
        let fechaFactura = `${year}-${mes}-${dia}`;
        let subTotalFactura = $('#valorSubtotal').text();
        let totalFactura = $('#valorTotal').text();

        let listProductos = localStorage.getItem('listProductos');
        
        datosFactura = {
            documento_cliente: documentoCliente, 
            documento_asesor: documentoAsesor, 
            forma_pago: formaPago, 
            fecha_factura:fechaFactura, 
            subtotal_factura:subTotalFactura, 
            total_factura:totalFactura,
            detalles: listProductos
        };
        
        $.ajax({
            type: "POST",
            url: "procesos/generar_factura.php",
            data: datosFactura,
            success: function(res){
                console.log(res);
                if(res=="finalizado"){
                    Swal.fire('¡Factura Guardada!','La factura se ha guardado con exito','success');
                    localStorage.clear();
                    cargarProductos();
                }else{
                    alert("Falló el servidor");
                }
            }
        });
        return false;
    });

});

function guardarProducto() {
    let cod = document.querySelector("#codigoProducto").value;
    let can = document.querySelector("#cantidadProducto").value;
    let precio = document.querySelector("#precioProducto").value;
    let total = precio*can;

    if(cod && can){
        
        let rt= "codProducto="+cod;
        $.ajax({
            type: "POST",
            url: "procesos/buscar_existencias.php",
            data: rt,
            success: function(res){
                if(parseInt(res)>=can){
                    const datosProductos = { cod, can, precio, total}

                    if (localStorage.getItem('listProductos') === null) {
                        let listProductos = []
                        listProductos.push(datosProductos);
                        localStorage.setItem('listProductos', JSON.stringify(listProductos));
                    } else {
                        let listProductos = JSON.parse(localStorage.getItem('listProductos'));
                        listProductos.push(datosProductos);
                        localStorage.setItem('listProductos', JSON.stringify(listProductos));
                    }
                    cargarProductos();
                    $("#formularioFactura")[0].reset();
                    $('#numExistencias').empty();

                    let ruta= "codProducto="+cod+"&cantidad=-"+can;
                    $.ajax({
                        type: "POST",
                        url: "procesos/actualizar_existencias.php",
                        data: ruta,
                        success: function(){}
                    });
                }else{
                    Swal.fire('¡Error!','Cantidad de existencias superadas','error');
                }
            }
        });

    }else{
        Swal.fire('¡Error!','Complete todos los campos','error');
    }


}

function eliminarProducto(i) {

    cod = $("#eliminarProducto"+i).attr("title");
    can = $("#eliminarProducto"+i).attr("value");

    let listProductos = JSON.parse(localStorage.getItem('listProductos'));
    listProductos.splice(i, 1);
    localStorage.setItem('listProductos', JSON.stringify(listProductos));
    cargarProductos();

    let ruta= "codProducto="+cod+"&cantidad=+"+can;
    $.ajax({
        type: "POST",
        url: "procesos/actualizar_existencias.php",
        data: ruta,
        success: function(){}
    });
}

function cargarProductos() {

    let productos = document.querySelector("#trProductos");
    productos.innerHTML = "";
    let listProductos = JSON.parse(localStorage.getItem('listProductos'));

    let sumSubtotal = 0;
    let sumTotal = 0;

    if (listProductos != null && listProductos.length != 0) {
        for (let i = 0; i < listProductos.length; i++) {
            productos.innerHTML += `
            <tr>
                <td>${i}</td>
                <td id="codProducto${i}">${listProductos[i].cod}</td>
                <td id="canProducto${i}">${listProductos[i].can}</td>
                <td id="canProducto${i}">${listProductos[i].precio}</td>
                <td id="canProducto${i}">${listProductos[i].total}</td>
                <td>
                    <button style="border: none" type="button" href="#" title="${listProductos[i].cod}" value="${listProductos[i].can}" id="eliminarProducto${i}" 
                        onclick="eliminarProducto(${i})">
                        <img width="30" src="complementos/assets/img/eliminar.png">
                    </button>
                </td>
            </tr>
            `;
            sumSubtotal += listProductos[i].total;
        }

        sumTotal = Math.round(sumSubtotal + sumSubtotal*0.19);
        document.querySelector("#valorSubtotal").innerHTML = `${sumSubtotal}`;
        document.querySelector("#valorTotal").innerHTML = `${sumTotal}`;
        $('#generarFactura').prop('disabled', false);

    }else{
        productos.innerHTML += `
        <tr>
            <td colspan="6"> No existen productos </td>
        </tr>
        `;
        $('#generarFactura').prop('disabled', true);
        $('#valorSubtotal').empty();
        $('#valorTotal').empty();
    }
};