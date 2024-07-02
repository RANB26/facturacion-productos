$(document).ready(function(){

    mostrarProductos();
    

    const mostrarAlerta = (icono, titulo) =>{
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        
        Toast.fire({
            icon: icono,
            title: titulo
        })
    }

    $('#btnGuardarProducto').click(function(){
        let datosProducto = $('#formularioProducto').serialize();
        $.ajax({
            type: "POST",
            url: "procesos/insertar_producto.php",
            data: datosProducto,
            success: function(res){
                if(res==1){
                    mostrarAlerta("success", "Producto agregado");
                    mostrarProductos();
                    $("#formularioProducto")[0].reset();
                    $('#agregarProducto').modal('hide');
                }else if (res=="vacio"){
                    Swal.fire('¡Error!','Los campos no pueden estar vacios','error');
                }else{
                    alert(res);
                }
            }
        });
        return false;
    });

    $('#btnEliminarProducto').click(function(){
        let datosProducto = $('#formularioEliminarProducto').serialize();
        $.ajax({
            type: "POST",
            url: "procesos/eliminar_producto.php",
            data: datosProducto,
            success: function(res){
                if(res==1){
                    mostrarAlerta("success", "Producto eliminado");
                    mostrarProductos();
                    $('#eliminarProducto').modal('hide');
                }else{
                    alert("Falló el servidor");
                }
            }
        });
        return false;
    });


});

function mostrarProductos(){
    $.ajax({
        type: "POST",
        url: "procesos/datos_productos.php",
        success: function(res){
            var js= JSON.parse(res);
            var tabla;
            for (var i = 0; i < js.length; i++) {
                tabla +=  `
                <tr> 
                    <td>${js[i].id_producto}</td>
                    <td>${js[i].codigo_producto}</td>
                    <td>${js[i].descripcion_producto}</td>
                    <td>${js[i].precio_producto}</td>
                    <td>${js[i].existencias_producto} </td>
                    <td>
                        <button style="border: none" type="button" data-href="" data-bs-toggle="modal" onclick="mostarModal(${js[i].id_producto})">
                            <img  width="30" src="complementos/assets/img/eliminar.png"> 
                            <spam style="Display:none;">${js[i].id_producto}</spam>
                        </button>
                    </td>
                </tr>';
                `
                $('#tbody_producto').html(tabla);
                
            }
        }
    });
}

function mostarModal(codProducto) {
    document.querySelector("#idProductoEliminar").innerHTML = codProducto;
    document.querySelector("#id_productoEliminar").value = codProducto;
    $('#eliminarProducto').modal('show');
}