var citas = {

    //RELLENA LA HORA Y LA FECHA EN EL MODAL CUANDO SE VA A CREAR UNA CITA
    datos_add_cita: function(){
        $(document).on('click','button.btn_add_cita_modal', function () {
            var data = {
                fecha : $(this).data('fecha'),
                hora : $(this).data('hora')
            };  

            $('#txt_fecha_citas_modal').val(data.fecha);
            $('#txt_hora_citas_modal').val(data.hora);
        });
    },

    //AGREGA UNA NUEVA CITA A LA AGENDA DE CITAS
    add_cita: function(){
        $('#agregar_citas_modal').on('submit', function(form){
            form.preventDefault();
            var data = {
                id_cliente : $('#select_cliente_modal').val(), 
                txt_fecha : $('#txt_fecha_citas_modal').val(),
                txt_hora : $('#txt_hora_citas_modal').val(),
                id_tipo_cita : $('#select_tipo_cita_modal').val(),
            }
            var response = cargar_ajax.run_server_ajax('citas/crear_cita', data);
            console.log(response);
            if(response == 1){
                swal({
                    title: 'CORRECTO',
                    text: 'LA CITA SE AGREGO CORRECTAMENTE',
                    type: 'success',
                closeOnConfirm: false
                },function(){
                    window.location.reload();
                });
            }
            else if(response == 2){
                swal({
                    title: 'ATENCION!!',
                    text: 'LA HORA Y FECHA DE LA CITA YA ESTA OCUPADA',
                    type: 'warning',
                    closeOnConfirm: false
                },function(){
                    window.location.reload();
                });
            }else if(response == 3){
                swal({
                    title: 'ERROR!!',
                    text: 'OCURRIO UN ERROR AL GUARDAR LA CITA',
                    type: 'error',
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
                fecha_nacimiento : $('#txt_fecha_cliente_citas').val(), 
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
            var data = {
                id_cita: $(this).data('id'),
            };    
            var response = cargar_ajax.run_server_ajax('citas/datos_pagar_cita', data);

            if(response != "n/a")
            {
                var numero_turno = response.DATA_TURNO;

                $('#id_cita_pagar').val(response.DATA_CITA.id_cita);
                $('#fecha_cita').val(response.DATA_CITA.fecha);
                $('#txt_turno_cita').val(numero_turno);
                $('#txt_nombre_cita').val(response.DATA_CITA.nombre_cliente);
                $('#txt_tipo_cita').val(response.DATA_CITA.id_tipo_cita);
                $('#txt_id_cliente').val(response.DATA_CITA.id_cliente);

                var id_tipo_cita = response.DATA_CITA.id_tipo_cita;
                //var id_cliente = response.DATA_CITA.id_cliente;
                var membresia = response.DATA_CITA.membresia;

                //console.log(response);
                $("#sel_costo_cita").html(response.DATA_COSTOS);

            }
            else
            {
                swal({
                    title: 'ERROR!!',
                    text: 'OCURRIO UN ERROR AL COBRAR LA CITA',
                    type: 'error',
                    closeOnConfirm: false
                },function(){
                    window.location.reload();
                });
            }
            

        });
    },

    cobro_citas : function(){
        $("#pagar_citas").on("submit", function (form) {
            form.preventDefault();
            document.getElementById("btn_pago_cita").disabled = true;
            
            var id_cita = $('#id_cita_pagar').val();
            var data = 
            {
                id_cita: $('#id_cita_pagar').val(), 
                costo_consulta : $('#sel_costo_cita').val(),
                forma_pago : $("input[name='rd_forma_pago']:checked").val(),
            }
            var response = cargar_ajax.run_server_ajax('citas/pagar_cita', data);
            
            if (response == false) 
            {
                swal({
                    title: "ATENCION",
                    text: "Ocurrio un error al realizar el cobro",
                    type: "error",
                    closeOnConfirm: false
                }, function () {
                    location.reload();
                });
            } 
            else 
            {
                var ruta = base_url + "citas/imprimir_ticket/" + id_cita;
                window.open(ruta, 'Nombre Ventana');
                location.reload();
            }
        });
    },

    load_modal_peso: function(){
        $(document).on('click', 'button.cargar_modal_peso', function () {
            id_cita = $(this).data('id');
            var data = 
            {
                id_cita : id_cita,
            }
            var estatura = cargar_ajax.run_server_ajax('citas/get_estatura', data);
            $('#txt_id_cita_peso').val(id_cita);
            $('#txt_estatura').val(estatura);
            $("#modal_agregar_peso").modal("show");
        });
    },

    add_peso: function(){
       $("#agregar_peso_citas").on("submit", function (form) {
            form.preventDefault();

            var data = {
                id_cita : $('#txt_id_cita_peso').val(),
                estatura : $('#txt_estatura').val(),
                peso : $('#txt_peso_inicial_cita').val(),

            }
            console.log(data);
            cargar_ajax.run_server_ajax('citas/add_peso', data);
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

    consultar_citas: function(){
       $("#consultar_citas").on("submit", function (form) {
            form.preventDefault();
            var id_cliente = $('#select_cliente_consulta_citas').val();
            $("#consulta_citas_tabla").load(base_url + "citas/consultar_proximas_citas/"+id_cliente);
        });
    },

    get_tipo_cita_modal: function(){
        $("#select_cliente_modal").on("change", function (form) {
            $('#select_tipo_cita_modal').html('');
            var id_cliente = $('#select_cliente_modal').val();
            $("#select_tipo_cita_modal").load(base_url + "citas/set_select_tipo_cita/"+id_cliente);
        });
    },

    //LLENA DE INFORMACION EL SELECT DE CLIENTES EN LA CONSULTA DE CITAS
    get_clientes_consulta_citas : function(){
        $('#select_cliente_consulta_citas').select2({
            placeholder: "Seleccione un paciente",
            ajax: { 
                url: base_url + 'citas/obtener_clientes',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    },

    //LLENA EL SELECT DE CLIENTES EN LA CREACION DE CITAS NUEVAS
    get_clientes_modal_agregar_cita : function(){
        $('#select_cliente_modal').select2({
            placeholder: "Seleccione un paciente",
            ajax: { 
                url: base_url + 'citas/obtener_clientes',
                type: "post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        searchTerm: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    },

    //============================================================
    //MODIFICAR CITAS
    //============================================================

    //RELLENA LA HORA Y LA FECHA EN EL MODAL CUANDO SE VA A CREAR UNA CITA
    datos_update_cita: function(){
        $(document).on('click','button.btn_update_cita_modal', function () {
            var data = {
                id_cita : $(this).data('id'),
            };  
            var fecha = $(this).data('fecha');
            var hora = $(this).data('hora');

            var responseDatosCita = cargar_ajax.run_server_ajax('citas/datos_modificar_cita', data);
            var responseTipoCita = cargar_ajax.run_server_ajax('citas/get_tipo_citas/'+ responseDatosCita.id_tipo_cita);
            var respondeCostoConsulta = cargar_ajax.run_server_ajax('citas/get_costos_citas/'+ responseDatosCita.id_tipo_cita + '/' + responseDatosCita.numero_cita);

            $("#select_modificar_tipo_cita_modal").html(responseTipoCita);
            $('#txt_modificar_fecha_citas_modal').val(fecha);
            $('#txt_modificar_hora_citas_modal').val(hora);
            $('#txt_modificar_nombre_cliente').val(responseDatosCita.nombre_cliente);
            $("#sel_modificar_costo_cita").html(respondeCostoConsulta);
        });
    },

    //CAMBIA LOS COSTOS DISPONIBLES DE LA CONSULTA AL ACTUALIZAR EL TIPO DE CONSULTA
    



}
jQuery(document).ready(function() { 
   citas.add_cita(this);
   citas.datos_add_cita(this);
   citas.add_cliente(this);
   citas.eliminar_cita(this);
   citas.datos_cobro_citas(this);
   citas.cobro_citas(this);
   citas.load_modal_peso(this);
   citas.add_peso(this);
   citas.consultar_citas(this);
   citas.get_tipo_cita_modal(this);
   citas.get_clientes_consulta_citas(this);
   citas.get_clientes_modal_agregar_cita(this);

   citas.datos_update_cita(this);
});