var clientes = {

    add_cliente: function(){
        $('#agregar_cliente').on('submit', function(form){
            form.preventDefault();
            
            var data = {
                correo_cliente : $('#txt_user').val(), 
                nombre : $('#txt_nombre').val(), 
                telefono_cliente : $('#txt_telefono').val(), 
                fecha_nacimiento : $('#txt_fecha_cliente_agregar').val(), 
            }

            cargar_ajax.run_server_ajax('clientes/crear_cliente', data);
            swal({
                title: 'CORRECTO',
                text: 'SE AGREGO CORRECTAMENTE EL PACIENTE',
                type: 'success',
                closeOnConfirm: false
            },function(){
                window.location.assign(base_url + 'clientes');
            });
        });
    },

	datos_editar_clientes: function(){
        $(document).on('click','button.editar_user', function () {
            
            var data = {id_cliente: $(this).data('id')};    
            var response = cargar_ajax.run_server_ajax('clientes/datos_editar_cliente', data);

            $('#id_cliente_editar').val(response.DATA_CLIENTE.id_cliente);
            $('#txt_nombre_editar').val(response.DATA_CLIENTE.nombre_cliente);
            $('#txt_telefono_editar').val(response.DATA_CLIENTE.telefono_cliente);
            $('#txt_correo_editar').val(response.DATA_CLIENTE.correo_cliente);
            $('#txt_fecha_cliente_modificar').val(response.DATA_CLIENTE.fecha_nacimiento);
            

        });
    },

    datos_editar_peso: function(){
        $(document).on('click','button.editar_peso', function () {
            
            var data = {id_peso: $(this).data('id')};    
            var response = cargar_ajax.run_server_ajax('clientes/datos_editar_peso', data);

            $('#txt_peso_editar').val(response.DATA_PESO.peso);
            $('#txt_id_peso').val(response.DATA_PESO.id_peso);
        });
    },

    editar_editar_peso: function(){
        $("#editar_peso").on("submit", function (e) {
            e.preventDefault();
                var data = 
                {
                    peso: $('#txt_peso_editar').val(), 
                    id_peso: $('#txt_id_peso').val(),                    
                }
                
                 var response = cargar_ajax.run_server_ajax('clientes/editar_peso', data);
                 
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

    editar_editar_clientes: function(){
        $("#editar_clientes").on("submit", function (e) {
            e.preventDefault();
                var data = 
                {
                	id_cliente: $('#id_cliente_editar').val(), 
                	nombre_cliente : $('#txt_nombre_editar').val(),
                	telefono_cliente : $('#txt_telefono_editar').val(), 
                	correo_cliente : $('#txt_correo_editar').val(),
                	fecha_nacimiento : $('#txt_fecha_cliente_modificar').val(), 
                	
                }
                
                

                 var response = cargar_ajax.run_server_ajax('clientes/editar_cliente', data);
                 
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

    eliminar_cliente: function(){
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

    eliminar_peso: function(){
        $(document).on('click', 'button.eliminar_peso', function () {
            id_peso = $(this).data('id');
            var data = {id_peso: id_peso};

            swal({
                title: "¿Esta seguro de eliminar?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si, eliminar",
                closeOnConfirm: false,
                allowEscapeKey: false,
                allowEnterKey: false
            }, function () {
                cargar_ajax.run_server_ajax('clientes/eliminar_peso', data);
                swal('Eliminado!', 'Se elimino correctamente', 'success');
                var toDelete = '#tr_' + id_peso;
                console.log(toDelete);
                $(toDelete).remove();
                
            });
        });
    },

    add_peso: function(){
        $('#agregar_peso').on('submit', function(form){
            form.preventDefault();

            var data = {
                id_cliente : $('#id_cliente').val(),
                fecha : $('#fecha').val(),
                peso : $('#txt_peso_inicial_cita').val(),
            }

            cargar_ajax.run_server_ajax('clientes/add_peso', data);
            swal({
                title: 'CORRECTO',
                text: 'SE AGREGO CORRECTAMENTE',
                type: 'success',
                closeOnConfirm: false
            },function(){
                window.location.reload();
            });
        });
    },

    actualizar_estatura: function(){
        $('#estatura_form').on('submit', function(form){
            form.preventDefault();
            var data = {
                id_cliente : $('#id_cliente').val(),
                estatura : $('#txt_estatura').val(),
            }

            console.log(data);
            cargar_ajax.run_server_ajax('clientes/editar_estatura', data);
            swal({
                title: 'CORRECTO',
                text: 'Estatura actualizada correctamente',
                type: 'success',
                closeOnConfirm: false
            },function(){
                window.location.reload();
            });
        });
    },
}
jQuery(document).ready(function() { 
    clientes.add_cliente(this);
    clientes.datos_editar_clientes(this);
    clientes.editar_editar_clientes(this);
    clientes.eliminar_cliente(this);
    clientes.add_peso(this);
    clientes.datos_editar_peso(this);
    clientes.editar_editar_peso(this);
    clientes.eliminar_peso(this);
    clientes.actualizar_estatura(this);
});