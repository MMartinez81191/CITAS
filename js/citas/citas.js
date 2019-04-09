var citas = {

    add_cita: function(){
        $('#agregar_citas').on('submit', function(form){
            form.preventDefault();
            //var base_url = '<?php echo base_url() ?>';
            var data = {
                id_cliente : $('#select_cliente').val(), 
                fecha_txt : $('#fecha_txt').val(),
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

	/*datos_editar_usuarios: function(){
        $(document).on('click','button.editar_user', function () {
            var data = {id_usuario: $(this).data('id')};            
            var response = cargar_ajax.run_server_ajax('clientes/datos_editar_usuario', data);
            $('#id_usuario_editar').val(response.DATA_USUARIO.id_usuario);

            $('#txt_nombre_editar').val(response.DATA_USUARIO.nombre);
            $('#txt_apellido_p_editar').val(response.DATA_USUARIO.apellido_p);
            $('#txt_apellido_m_editar').val(response.DATA_USUARIO.apellido_m);
            $('#txt_user_editar').val(response.DATA_USUARIO.usuario_email);
            
            $('#select_nivel_editar').val(response.DATA_USUARIO.id_nivel);

        });
    },

    editar_editar_usuarios: function(){
        $("#editar_usuarios").on("submit", function (e) {
            e.preventDefault();
                var data = {
                	id_usuario: $('#id_usuario_editar').val(), 
                	nombre: $('#txt_nombre_editar').val(),
                	apellido_p: $('#txt_apellido_p_editar').val(), 
                	apellido_m: $('#txt_apellido_m_editar').val(),
                	usuario: $('#txt_user_editar').val(), 
                	id_nivel: $('#select_nivel_editar').val(),
                }
                
                

                 var response = cargar_ajax.run_server_ajax('clientes/editar_usuario', data);
                 if (response == 'false') {
                     title = "Error!";
                     icon = "error";
                     mensaje = "No se pudo realizar la actualicación";
                 } else {
                     icon = "success";
                     title = "Actualización de información";
                     mensaje = "Se actualizo la información correctamente";
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
    },*/

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
   // clientes.datos_editar_usuarios(this);
   // clientes.editar_editar_usuarios(this);
   citas.eliminar_cita(this);
});