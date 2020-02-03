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
            //console.log(data);
            
            var response = cargar_ajax.run_server_ajax('Detalle_Cita/actualizar_informacion', data);
            if(response == 'TRUE')
            {
                swal({
                    title: 'CORRECTO',
                    text: 'Informacion actualizada correctamente',
                    type: 'success',
                    closeOnConfirm: false
                },function(){
                    window.location.assign(base_url + 'citas');
                });
            }
            else
            {
                swal({
                    title: 'ATENCION',
                    text: 'SOLO SE MODIFICARON ALGUNOS CAMPOS',
                    type: 'warning',
                    closeOnConfirm: false
                },function(){
                    window.location.assign(base_url + 'citas');
                });
            }
        });
    },
}
jQuery(document).ready(function() { 
    detalle_cita.update_info(this);
});