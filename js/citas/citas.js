var citas = {

    add_cita: function(){
        $('#agregar_citas').on('submit', function(form){
            form.preventDefault();
            var data = {
                id_cliente : $('#select_cliente').val(), 
                txt_fecha : $('#txt_fecha').val(),
                txt_hora : $('#txt_hora').val(),
                id_tipo_cita : $('#select_tipo_cita').val(),
            }
            var response = cargar_ajax.run_server_ajax('citas/crear_cita', data);
            console.log(response);
            if(response == false)
            {
                swal({
                    title: 'CORRECTO',
                    text: 'LA CITA SE AGREGO CORRECTAMENTE',
                    type: 'success',
                closeOnConfirm: false
                },function(){
                    window.location.reload();
                });
            }
            else if(response == true)
            {
                swal({
                    title: 'ATENCION!!',
                    text: 'LA HORA Y FECHA DE LA CITA YA ESTA OCUPADA',
                    type: 'warning',
                    closeOnConfirm: false
                },function(){
                    window.location.reload();
                });
            }
        });
    },

    eliminar_cita: function(){
        $(document).on('click', 'button.eliminar_cita', function () {
            
            id_cita = $(this).data('id');
            var data = {id_cita: id_cita};
            cargar_ajax.run_server_ajax('citas/eliminar_cita', data);
            console.log(data);
            swal({
                title: "¿Esta seguro de eliminar esta cita?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, eliminar",
                closeOnConfirm: false,
                allowEscapeKey: false,
                allowEnterKey: false
            }, function () {
                swal({
                    title: 'ELIMINADO',
                    text: 'Se elimino correctamente la cita',
                    type: 'success',
                    closeOnConfirm: false
                },function(){
                    cargar_ajax.run_server_ajax('citas/eliminar_cita', data);
                    var toDelete = '#tr_' + id_cita;
                    $(toDelete).remove();
                    window.location.reload();
                }); 
            });
        });
    },

    add_cliente: function()
    {
        $('#agregar_cliente').on('submit', function(form){
            form.preventDefault();
            var data = {
                 
                nombre : $('#txt_nombre').val(), 
                telefono_cliente : $('#txt_telefono').val(), 
                fecha_nacimiento : $('#txt_fecha_cliente').val(), 
                correo_cliente : $('#txt_correo').val(),
            }
            
            cargar_ajax.run_server_ajax('clientes/crear_cliente', data);
            swal({
                title: 'CORRECTO',
                text: 'SE AGREGO CORRECTAMENTE EL CLIENTE',
                type: 'success',
                closeOnConfirm: false
            },function(){
                window.location.reload();
            });
        });
    },

    datos_cobro_citas: function(){
        $(document).on('click','button.cobrar_cita', function () {
            var data = {id_cita: $(this).data('id')};    
            var response = cargar_ajax.run_server_ajax('citas/datos_pagar_cita', data);
            var numero_turno = response.DATA_TURNO;
            
            //console.log(numero_turno);
            $('#id_cita_pagar').val(response.DATA_CITA.id_cita);
            $('#fecha_cita').val(response.DATA_CITA.fecha);
            $('#txt_turno_cita').val(numero_turno);
            $('#txt_nombre_cita').val(response.DATA_CITA.nombre_cliente);
            $('#txt_tipo_cita').val(response.DATA_CITA.id_tipo_cita);

            var id_tipo_cita = response.DATA_CITA.id_tipo_cita;
            var id_cliente = response.DATA_CITA.id_cliente;

            if (id_tipo_cita == 2) 
            {
            /*consulta
                --busca * datos cliente
                if (CampoMemebresiabd == 0) 
                {
                    mensaje(¿Comprar membresia?)
                    if (ok) 
                    {
                        update membresia == 4;
                        costo =  400
                    }
                    else
                    {
                        mensaje(¿cambiar solo a consulta?)
                        if(ok)
                        {
                            costo = 100;
                            tipo_cita = 1;
                        }
                        else
                        {
                            eliminar?
                        }
                    }
                }
                else
                {
                    membresia =- 1;
                    costo = 0; 
                }

            */
            }
 
            $.post("Citas/get_co/"+id_tipo_cita + "/"+id_cliente, function(data)
            {
               $("#sel_costo_cita").html(data);
            }); 

        });
    },

    cobro_citas : function(){
        $("#pagar_citas").on("submit", function (form) {
            form.preventDefault();
            var id_cita = $('#id_cita_pagar').val();
            //var ruta = "http://pinguinosystems.com/CITAS/citas/imprimir_ticket/" + id_cita;
            var ruta = base_url + "/citas/imprimir_ticket/" + id_cita;

            var data = 
            {
                id_cita: $('#id_cita_pagar').val(), 
                costo_consulta : $('#sel_costo_cita').val(),
                forma_pago : $("input[name='rd_forma_pago']:checked").val(),
                peso_actual : $('#txt_peso_inicial_cita').val(),
            }
            console.log(data);
            var response = cargar_ajax.run_server_ajax('citas/pagar_cita', data);
             
            if (response == 'false') {
                 title = "Error!";
                 icon = "error";
                 mensaje = "No se pudo realizar la actualicación";
             } else {
                 icon = "success";
                 title = "Actualización de información";
                 mensaje = "Cobro Realizado Correctamente";
             }

             swal({
                 title: title,
                 text: mensaje,
                 type: icon,
                 closeOnConfirm: false
             }, function () {
                window.open(ruta, 'Nombre Ventana');
                location.reload();
             });
        });
    },

}
jQuery(document).ready(function() { 
   citas.add_cita(this);
   citas.add_cliente(this);
   citas.eliminar_cita(this);
   citas.datos_cobro_citas(this);
   citas.cobro_citas(this);
});