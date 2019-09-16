var citas = {

    add_cita: function(){
        $('#agregar_citas').on('submit', function(form){
            form.preventDefault();
            var data = {
                id_cliente : $('#select_cliente').val(), 
                txt_fecha : $('#txt_fecha_citas').val(),
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

    add_cita_modal: function(){
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
            var data = {id_cita: $(this).data('id')};    
            var response = cargar_ajax.run_server_ajax('citas/datos_pagar_cita', data);
            var numero_turno = response.DATA_TURNO;
            
            //console.log(numero_turno);
            $('#id_cita_pagar').val(response.DATA_CITA.id_cita);
            $('#fecha_cita').val(response.DATA_CITA.fecha);
            $('#txt_turno_cita').val(numero_turno);
            $('#txt_nombre_cita').val(response.DATA_CITA.nombre_cliente);
            $('#txt_tipo_cita').val(response.DATA_CITA.id_tipo_cita);
            $('#txt_id_cliente').val(response.DATA_CITA.id_cliente);

            var id_tipo_cita = response.DATA_CITA.id_tipo_cita;
            //var id_cliente = response.DATA_CITA.id_cliente;
            var membresia = response.DATA_CITA.membresia;

            //Manda los datos para mostrar el costo y hacer el update
            $.post("Citas/get_co/"+id_tipo_cita + "/"+membresia, function(data)
            {
               $("#sel_costo_cita").html(data);
            });

            //resta la consulta actual y obtiene el nuevo numero de membresias
            if (id_tipo_cita == 2)  //cuando es membresia
            {
                if (membresia == 0)  //cuando compra la membresia
                {
                    membresia = 4;
                }
                else                //cuando ya tiene la membresia
                {
                    membresia -= 1;
                }
                $('#txt_membresia').val(membresia);
            }

        });
    },

    cobro_citas : function(){
        $("#pagar_citas").on("submit", function (form) {
            form.preventDefault();
            document.getElementById("btn_pago_cita").disabled = true;
            
            var id_cita = $('#id_cita_pagar').val();
            //var ruta = "http://pinguinosystems.com/CITAS/citas/imprimir_ticket/" + id_cita;
            var ruta = base_url + "citas/imprimir_ticket/" + id_cita;

            var data = 
            {
                id_cita: $('#id_cita_pagar').val(), 
                costo_consulta : $('#sel_costo_cita').val(),
                forma_pago : $("input[name='rd_forma_pago']:checked").val(),
                peso_actual : $('#txt_peso_inicial_cita').val(),
                id_tipo_cita : $('#txt_tipo_cita').val(),
            }
            //console.log(data);
            var response = cargar_ajax.run_server_ajax('citas/pagar_cita', data);

            
            //actualizar membresia
            var id_cliente = $('#txt_id_cliente').val();
            var data2 = 
            {
                id_cliente : id_cliente,
                membresia: $('#txt_membresia').val(),
            }

            cargar_ajax.run_server_ajax('citas/up_membresia', data2);
            //fin actualizar membresia
            
            if (response == 'false') 
            {
                 title = "Error!";
                 icon = "error";
                 mensaje = "No se pudo realizar la actualicación";
            } 
            else 
            {
                 icon = "success";
                 title = "Actualización de información";
                 mensaje = "Cobro Realizado Correctamente";
            }

            //document.getElementById("btn_pago_cita").disabled = false;
            window.open(ruta, 'Nombre Ventana');
            location.reload();

            /*swal({
                 title: title,
                 text: mensaje,
                 type: icon,
                 closeOnConfirm: false
             }, function () {
                window.open(ruta, 'Nombre Ventana');
                location.reload();
             });*/
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

    get_tipo_cita: function(){
        $("#select_cliente").on("change", function (form) {
            $('#select_tipo_cita').html('');
            var id_cliente = $('#select_cliente').val();
            $("#select_tipo_cita").load(base_url + "citas/set_select_tipo_cita/"+id_cliente);
        });
    },

    get_tipo_cita_modal: function(){
        $("#select_cliente_modal").on("change", function (form) {
            $('#select_tipo_cita_modal').html('');
            var id_cliente = $('#select_cliente_modal').val();
            $("#select_tipo_cita_modal").load(base_url + "citas/set_select_tipo_cita/"+id_cliente);
        });
    },
}
jQuery(document).ready(function() { 
   citas.add_cita(this);
   citas.datos_add_cita(this);
   citas.add_cita_modal(this);
   citas.add_cliente(this);
   citas.eliminar_cita(this);
   citas.datos_cobro_citas(this);
   citas.cobro_citas(this);
   citas.load_modal_peso(this);
   citas.add_peso(this);
   citas.consultar_citas(this);
   citas.get_tipo_cita(this);
   citas.get_tipo_cita_modal(this);
});