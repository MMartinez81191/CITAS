var corte_parcial = {

    recuperar_cantidades: function(){
        $('#recuperar_cantidades').on('submit', function(form){
            form.preventDefault();

            var fecha_1 = $('#txt_fecha').val();
            var fecha_2 = $('#txt_fecha2').val();

            var data = {
                fecha_1 : fecha_1,
                fecha_2 : fecha_2, 
            }
            //console.log(data);
            var response = cargar_ajax.run_server_ajax('corte_parcial/recuperar_cantidades', data);

            $('#cantidad_recaudada').val(response);
            //console.log(response);
            //$("#tabla_citas").load(base_url + "corte/obtener_citas/1/" + dia_fecha + "/"); 

        });
    },

    generar_corte: function(){
        $('#generar_corte').on('submit', function(form){
            form.preventDefault();

            var fecha_1 = $('#txt_fecha').val();
            var fecha_2 = $('#txt_fecha2').val();
            var cantidad_recaudada = $('#cantidad_recaudada').val();
            cantidad_recaudada = cantidad_recaudada.substring(1);
            cantidad_recaudada = cantidad_recaudada.replace(/,/g, "");
            cantidad_recaudada = parseFloat(cantidad_recaudada);

            var cantidad_fisica = $('#cantidad_fisica').val();
            cantidad_fisica = parseFloat(cantidad_fisica);

            var data = {
                fecha_1 : fecha_1,
                fecha_2 : fecha_2,
                cantidad_recaudada : cantidad_recaudada,
                cantidad_fisica : cantidad_fisica, 
            }
            console.log(cantidad_recaudada);
            console.log(cantidad_fisica);
            if(cantidad_fisica > cantidad_recaudada)
            {
                //cargar_ajax.run_server_ajax('clientes/crear_cliente', data);
                swal({
                    title: 'ATENCION',
                    text: 'La cantidad fisica no puede ser mayor a la cantidad registrada',
                    type: 'warning',
                    closeOnConfirm: true
                },function(){
                    //window.location.reload();
                });
            }
            else
            {
                var response = cargar_ajax.run_server_ajax('corte_parcial/generar_corte', data);
                if(response == false)
                {
                    swal({
                        title: 'ATENCION',
                        text: 'No existen Pagos en el perido especificado',
                        type: 'warning',
                        closeOnConfirm: true
                    },function(){
                        //window.location.reload();
                    });
                }
                else
                {
                    
                }
            }
            console.log(data);
            //var response = cargar_ajax.run_server_ajax('corte_parcial/recuperar_cantidades', data);
            //$("#tabla_citas").load(base_url + "corte/obtener_citas/2/" + mes_fecha + "/" + anio_fecha + "/"); 

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


}
jQuery(document).ready(function() { 
   corte_parcial.recuperar_cantidades(this);
   corte_parcial.generar_corte(this);
   /*corte_parcial.busqueda_anio(this);
   corte_parcial.busqueda_pendientes(this);
   corte_parcial.limpiar_div(this);
   corte_parcial.obtener_reporte_dia(this);
   corte_parcial.obtener_reporte_mes(this);
   corte_parcial.obtener_reporte_anio(this);
   corte_parcial.obtener_reporte_pendientes(this);*/
});