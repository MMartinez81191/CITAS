var main = {
    update_usuario: function(){
        $('#modificar_contrasena').on('submit', function(form){
            form.preventDefault();
            var nueva = $('#nueva').val();
            var confirmacion = $('#confirmacion').val();

            if(nueva != confirmacion)
            {
                swal({
                    title: 'ERROR',
                    text: 'Las contraseñas no coinciden',
                    type: 'error',
                    closeOnConfirm: false
                },function(){
                    window.location.reload();
                });
            }
            else if(nueva == confirmacion)
            {
                var data = {
                    id_usuario : $('#id_usuario').val(),
                    contrasena : $('#confirmacion').val(), 
                }
                cargar_ajax.run_server_ajax('usuarios/cambiar_contrasena', data);
                swal({
                    title: 'CORRECTO',
                    text: 'Se Actualizo Correctamente la Informacion',
                    type: 'success',
                    closeOnConfirm: true
                },function(){
                    window.location.assign(base_url + 'usuarios');
                });
            }
        });
    },
}
jQuery(document).ready(function() { 
    main.update_usuario(this);
});