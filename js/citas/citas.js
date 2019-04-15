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
            console.log(data);

            cargar_ajax.run_server_ajax('citas/crear_cita', data);
            swal({
                title: 'CORRECTO',
                text: 'Cita Agregada Correctamente',
                type: 'success',
                closeOnConfirm: false
            },function(){
                window.location.reload();
            });
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
}
jQuery(document).ready(function() { 
   citas.add_cita(this);
   citas.eliminar_cita(this);
});