$(document).ready(function(){

    mostrarFacturas();

});

function mostrarFacturas(){
    $.ajax({
        type: "POST",
        url: "procesos/datos_facturas.php",
        success: function(res){
            var js= JSON.parse(res);
            var tabla;
            for (var i = 0; i < js.length; i++) {
                tabla +=  `
                <tr> 
                    <td>${js[i].id_factura}</td>
                    <td>${js[i].id_asesor}</td>
                    <td>${js[i].id_cliente}</td>
                    <td>${js[i].fecha_factura}</td>
                    <td>${js[i].mpago_factura} </td>
                    <td>$${js[i].subtotal_factura} </td>
                    <td>$${js[i].total_factura} </td>
                    <td>
                        <a href="DetallesFactura.php?idFactura=${js[i].id_factura}" title="Detalles de factura" target="_blank">
                            <img  width="30" src="complementos/assets/img/detalles.png"> 
                        </a>
                    </td>
                </tr>';
                `
                $('#tbody_factura').html(tabla);
                
            }
        }
    });
}