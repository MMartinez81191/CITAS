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
                else if(response == true)
                {
                    swal({
                        title: 'CORRECTO',
                        text: 'El corte se ha realizado correctamente',
                        type: 'success',
                        closeOnConfirm: true
                    },function(){
                        window.location.href = base_url + 'corte_parcial';
                    });
                }
            }
            console.log(data);
            //var response = cargar_ajax.run_server_ajax('corte_parcial/recuperar_cantidades', data);
            //$("#tabla_citas").load(base_url + "corte/obtener_citas/2/" + mes_fecha + "/" + anio_fecha + "/"); 

        });
    },


}
jQuery(document).ready(function() { 
   corte_parcial.recuperar_cantidades(this);
   corte_parcial.generar_corte(this);
});