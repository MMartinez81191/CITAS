var detalle_cita = {

    update_info: function(){
        $('#actualizar_informacion').on('submit', function(form){
            form.preventDefault();

            var data = {
                id_cliente : $('#txt_id_cliente').val(),
                id_cita : $('#txt_id_cita').val(), 
                enfermedades : $('#txt_enfermedades_paciente').val(), 
                alimentos_no_consumidos : $('#txt_alimentos_no_consumidos').val(),
                estatura :  $('#txt_estatura').val(),
                peso : $('#txt_peso').val(), 
                dieta : $('#txt_dieta').val(), 
                indicaciones : $('#txt_idicaciones').val(),
                notas_relevantes : $('#txt_notas_relevantes').val(),
            }
            
            var response = cargar_ajax.run_server_ajax('Detalle_Cita/actualizar_informacion', data);
            window.location.assign(base_url + 'citas');

        });
    },
}
jQuery(document).ready(function() { 
    detalle_cita.update_info(this);
});