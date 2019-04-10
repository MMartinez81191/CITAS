var clientes = {

    add_usuario: function(){
        $('#agregar_cliente').on('submit', function(form){
            form.preventDefault();
            //var base_url = '<?php echo base_url() ?>';
            var data = {
                correo_cliente : $('#txt_user').val(), 
                nombre : $('#txt_nombre').val(), 
                telefono_cliente : $('#txt_telefono').val(), 
                fecha_nacimiento : $('#txt_fecha').val(), 
            }
            console.log(base_url);

            cargar_ajax.run_server_ajax('clientes/crear_cliente', data);
            swal({
                title: 'CORRECTO',
                text: 'SE AGREGO CORRECTAMENTE EL CLIENTE',
                type: 'success',
                closeOnConfirm: false
            },function(){
                window.location.assign(base_url + 'clientes');
            });
        });
    },

	datos_editar_usuarios: function(){
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
    },

    eliminar_usuario: function(){
        $(document).on('click', 'button.eliminar_cliente', function () {
            id_cliente = $(this).data('id');
            var data = {id_cliente: id_cliente};

            swal({
                title: "¿Esta seguro de eliminar este cliente?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, eliminar",
                closeOnConfirm: false,
                allowEscapeKey: false,
                allowEnterKey: false
            }, function () {
                cargar_ajax.run_server_ajax('clientes/eliminar_cliente', data);
                swal('Eliminado!', 'Se elimino correctamente el cliente', 'success');
                var toDelete = '#tr_' + id_cliente;
                console.log(toDelete);
                $(toDelete).remove();
                
            });
        });
  },
}
jQuery(document).ready(function() { 
    clientes.add_usuario(this);
    clientes.datos_editar_usuarios(this);
    clientes.editar_editar_usuarios(this);
    clientes.eliminar_usuario(this);
});