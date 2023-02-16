var membresias = {
    cancelar_membresia: function(){
        $(document).on('click', 'button.cancelar_membresia', function () {
            numero_membresia = $(this).data('id');
            var data = {numero_membresia: numero_membresia};

            swal({
                title: "¿Esta seguro de cancelar esta membresia? una vez cancelada no se podra deshacer este paso",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, cancelar",
                closeOnConfirm: false,
                allowEscapeKey: false,
                allowEnterKey: false
            }, function () {
                var response = cargar_ajax.run_server_ajax('membresias/cancelar_membresia', data);
                console.log(response);
                if(response)
                {
                    swal('Eliminado!', 'Se cancelo correctamente la membresia', 'success');
                    var toDelete = '#tr_' + numero_membresia;
                    $(toDelete).remove();
                }
                else
                {
                    swal('Error!', 'Ocurrio un error al procesar la peticion', 'warning');    
                }
                
                
            });
        });
  },
}
jQuery(document).ready(function() { 
    membresias.cancelar_membresia(this);
});