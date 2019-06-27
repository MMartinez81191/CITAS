var citas = {

    add_cita: function(){
        $('#agregar_citas').on('submit', function(form){
            form.preventDefault();
            //var base_url = '<?php echo base_url() ?>';
            var data = {
                id_cliente : $('#select_cliente').val(), 
                txt_fecha : $('#txt_fecha').val(),
                txt_hora : $('#txt_hora').val(),

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
            else
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
                cargar_ajax.run_server_ajax('citas/eliminar_cita', data);
                swal('Eliminado!', 'Se elimino correctamente la cita', 'success');
                var toDelete = '#tr_' + id_cita;
                console.log(toDelete);
                $(toDelete).remove();
                
            });
        });
    },

    add_cliente: function(){
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

            $('#id_cita_pagar').val(response.DATA_CITA.id_cita);
            $('#txt_turno_cita').val(response.DATA_CITA.numero_turno);
            $('#txt_nombre_cita').val(response.DATA_CITA.nombre_cliente);
           
        });
    },

    cobro_citas : function(){
        $("#pagar_citas").on("submit", function (e) {
            e.preventDefault();
            var data = 
            {
                id_cita: $('#id_cita_pagar').val(), 
                costo_consulta : $('#sel_costo_cita').val(),
                forma_pago : $("input[name='rd_forma_pago']:checked").val(),
                peso_actual : $('#txt_peso_inicial_cita').val(),
            }
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