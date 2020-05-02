var costos = {

    add_costo: function(){
        $('#agregar_costos').on('submit', function(form){
            form.preventDefault();
            
            var data = {
                costo : $('#txt_costos_agregar').val(), 
            }

            var response = cargar_ajax.run_server_ajax('costos/crear_costos', data);
            if(response == false)
            {
            	swal({
	                title: 'CORRECTO',
	                text: 'SE AGREGO CORRECTAMENTE EL COSTO',
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
	                text: 'EL VALOR QUE DESEA AGREGAR YA EXISTE',
	                type: 'warning',
                	closeOnConfirm: false
	            },function(){
	            	window.location.reload();
	            });
            }
        });
    },

    eliminar_costo: function(){
        $(document).on('click', 'button.eliminar_costo', function () {
            id_costo = $(this).data('id');
            var data = {id_costo: id_costo};

            swal({
                title: "¿Esta seguro de eliminar este costo de consulta?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, eliminar",
                closeOnConfirm: false,
                allowEscapeKey: false,
                allowEnterKey: false
            }, function () {
                cargar_ajax.run_server_ajax('costos/eliminar_costos', data);
                swal('Eliminado!', 'Se elimino correctamente el costo de consulta', 'success');
                var toDelete = '#tr_' + id_costo;
                console.log(toDelete);
                $(toDelete).remove();
                
            });
        });
  },
}
jQuery(document).ready(function() { 
    costos.add_costo(this);
    costos.eliminar_costo(this);
});