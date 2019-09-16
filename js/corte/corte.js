var corte = {

    busqueda_dia: function(){
        $('#busqueda_dia').on('click', function(form){
            form.preventDefault();

            document.getElementById('imprimir_dia').style.display = '';
            var dia_fecha = $('#txt_fecha').val();
            $("#tabla_citas").load(base_url + "corte/obtener_citas/1/" + dia_fecha + "/"); 

        });
    },

    busqueda_mes: function(){
        $('#busqueda_mes').on('click', function(form){
            form.preventDefault();

            document.getElementById('imprimir_mes').style.display = '';
            var mes_fecha = $('#select_mes_mes').val();
            var anio_fecha = $('#select_mes_anio').val();
            $("#tabla_citas").load(base_url + "corte/obtener_citas/2/" + mes_fecha + "/" + anio_fecha + "/"); 

        });
    },

    busqueda_anio: function(){
        $('#busqueda_anio').on('click', function(form){
            form.preventDefault();

            document.getElementById('imprimir_anio').style.display = '';
            var anio_fecha = $('#select_anio_anio').val();
            $("#tabla_citas").load(base_url + "corte/obtener_citas/3/" + anio_fecha + "/"); 

        });
    },

    busqueda_pendientes: function(){
        $('#busqueda_pendientes').on('click', function(form){
            form.preventDefault();

            document.getElementById('imprimir_pendientes').style.display = '';
            var mes_fecha = $('#select_pendientes_mes').val();
            var anio_fecha = $('#select_pendientes_anio').val();
            $("#tabla_citas").load(base_url + "corte/obtener_citas/4/" + mes_fecha + "/" + anio_fecha + "/"); 

        });
    },

    limpiar_div: function(){
        $('#pestania_1').on('click', function(form){
            document.getElementById("tabla_citas").innerHTML = "<div></div>";

            document.getElementById('imprimir_dia').style.display = 'none';
            document.getElementById('imprimir_mes').style.display = 'none';
            document.getElementById('imprimir_anio').style.display = 'none';
            document.getElementById('imprimir_pendientes').style.display = 'none';

        });
        $('#pestania_2').on('click', function(form){
            document.getElementById("tabla_citas").innerHTML = "<div></div>";

            document.getElementById('imprimir_dia').style.display = 'none';
            document.getElementById('imprimir_mes').style.display = 'none';
            document.getElementById('imprimir_anio').style.display = 'none';
            document.getElementById('imprimir_pendientes').style.display = 'none';
        });
        $('#pestania_3').on('click', function(form){
            document.getElementById("tabla_citas").innerHTML = "<div></div>";
            
            document.getElementById('imprimir_dia').style.display = 'none';
            document.getElementById('imprimir_mes').style.display = 'none';
            document.getElementById('imprimir_anio').style.display = 'none';
            document.getElementById('imprimir_pendientes').style.display = 'none';

        });
        $('#pestania_4').on('click', function(form){
            document.getElementById("tabla_citas").innerHTML = "<div></div>";
            
            document.getElementById('imprimir_dia').style.display = 'none';
            document.getElementById('imprimir_mes').style.display = 'none';
            document.getElementById('imprimir_anio').style.display = 'none';
            document.getElementById('imprimir_pendientes').style.display = 'none';
        });
    },

    obtener_reporte_dia: function(){
        $('#imprimir_dia').on('click', function(form){
            form.preventDefault();
            var dia_fecha = $('#txt_fecha').val();
            
            window.open(base_url + "corte/imprimir_reporte_citas/1/" + dia_fecha + "/");

        });
    },

    obtener_reporte_mes: function(){
        $('#imprimir_mes').on('click', function(form){
            form.preventDefault();
            
            var mes_fecha = $('#select_mes_mes').val();
            var anio_fecha = $('#select_mes_anio').val();

            window.open(base_url + "corte/imprimir_reporte_citas/2/" + mes_fecha + "/" + anio_fecha + "/");

        });
    },

    obtener_reporte_anio: function(){
        $('#imprimir_anio').on('click', function(form){
            form.preventDefault();

            var anio_fecha = $('#select_anio_anio').val();
            window.open(base_url + "corte/imprimir_reporte_citas/3/" + anio_fecha + "/");

        });
    },

    obtener_reporte_pendientes: function(){
        $('#imprimir_pendientes').on('click', function(form){
            form.preventDefault();
            
            var mes_fecha = $('#select_pendientes_mes').val();
            var anio_fecha = $('#select_pendientes_anio').val();
            window.open(base_url + "corte/imprimir_reporte_citas/4/" + mes_fecha + "/" + anio_fecha + "/");

        });
    },

    //====================================
    //GASTOS
    //====================================
    add_gastos: function(){
        $('#agregar_gasto').on('submit', function(form){
            form.preventDefault();
            
            var data = {
                txt_fecha : $('#txt_fecha_gasto').val(),
                txt_concepto : $('#txt_concepto_gasto').val(), 
                txt_importe : $('#txt_importe_gasto').val(), 
            }

            cargar_ajax.run_server_ajax('corte/crear_gasto', data);
            swal({
                title: 'CORRECTO',
                text: 'SE AGREGO CORRECTAMENTE EL GASTO',
                type: 'success',
                closeOnConfirm: false
            },function(){
                window.location.assign(base_url + 'corte');
            });
        });
    },

     eliminar_gasto: function(){
        $(document).on('click', 'button.eliminar_gasto', function () {
            
            id_gasto = $(this).data('id');
            var data = {id_gasto: id_gasto};
            swal({
                title: "¿Esta seguro de eliminar este gasto?",
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
                    cargar_ajax.run_server_ajax('corte/eliminar_gasto', data);
                    var toDelete = '#tr_' + id_gasto;
                    $(toDelete).remove();
                    window.location.reload();
                }); 
            });
        });
    },

    //====================================
    //DEVOLUCIONES
    //====================================
    add_devoluciones: function(){
        $('#agregar_devolucion').on('submit', function(form){
            form.preventDefault();
            
            var data = {
                txt_fecha : $('#txt_fecha_devolucion').val(),
                select_cliente : $('#select_cliente_devolucion').val(), 
                txt_importe : $('#txt_importe_devolucion').val(), 
            }

            cargar_ajax.run_server_ajax('corte/crear_devolucion', data);
            swal({
                title: 'CORRECTO',
                text: 'SE AGREGO CORRECTAMENTE LA DEVOLUCION',
                type: 'success',
                closeOnConfirm: false
            },function(){
                window.location.assign(base_url + 'corte');
            });
        });
    },

    eliminar_devolucion: function(){
        $(document).on('click', 'button.eliminar_devolucion', function () {
            
            id_devolucion = $(this).data('id');
            var data = {id_devolucion : id_devolucion};
            swal({
                title: "¿Esta seguro de eliminar esta devolucion?",
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
                    cargar_ajax.run_server_ajax('corte/eliminar_devolucion', data);
                    var toDelete = '#tr_' + id_devolucion;
                    $(toDelete).remove();
                    window.location.reload();
                }); 
            });
        });
    },

}
jQuery(document).ready(function() { 
   corte.busqueda_dia(this);
   corte.busqueda_mes(this);
   corte.busqueda_anio(this);
   corte.busqueda_pendientes(this);
   corte.limpiar_div(this);
   corte.obtener_reporte_dia(this);
   corte.obtener_reporte_mes(this);
   corte.obtener_reporte_anio(this);
   corte.obtener_reporte_pendientes(this);
   
   corte.add_gastos(this);
   corte.eliminar_gasto(this);

   corte.add_devoluciones(this);
   corte.eliminar_devolucion(this);

   
});