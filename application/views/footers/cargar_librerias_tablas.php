	<script type="text/javascript">

        $(function () {		    
		    // DataTables
		    $('#example1').dataTable( {
		    	
		    	language: {
				        "decimal": "",
				        "emptyTable": "No hay información",
				        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
				        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
				        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
				        "infoPostFix": "",
				        "thousands": ",",
				        "lengthMenu": "Mostrar _MENU_ Entradas",
				        "loadingRecords": "Cargando...",
				        "processing": "Procesando...",
				        "search": "Buscar:",
				        "zeroRecords": "Sin resultados encontrados",
				        "paginate": {
				            "first": "Primero",
				            "last": "Ultimo",
				            "next": "Siguiente",
				            "previous": "Anterior"
				        }
				},
			        "columnDefs": [ {
			         "targets": 'no-sort',
			         "orderable": true,

			    }],
			    "pageLength": 200,
			    "ordering": true,
			} );

			$('#example2').dataTable( {
		    	
		    	language: {
				        "decimal": "",
				        "emptyTable": "No hay información",
				        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
				        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
				        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
				        "infoPostFix": "",
				        "thousands": ",",
				        "lengthMenu": "Mostrar _MENU_ Entradas",
				        "loadingRecords": "Cargando...",
				        "processing": "Procesando...",
				        "search": "Buscar:",
				        "zeroRecords": "Sin resultados encontrados",
				        "paginate": {
				            "first": "Primero",
				            "last": "Ultimo",
				            "next": "Siguiente",
				            "previous": "Anterior"
				        }
				},
			        "columnDefs": [ {
			         "targets": 'no-sort',
			         "orderable": true,

			    }],
			     "pageLength": 100,
			     "ordering": true,
			     "order" : [0,'desc'],
  				 

			} );

			$('#example3').dataTable( {
		    	
		    	language: {
				        "decimal": "",
				        "emptyTable": "No hay información",
				        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
				        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
				        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
				        "infoPostFix": "",
				        "thousands": ",",
				        "lengthMenu": "Mostrar _MENU_ Entradas",
				        "loadingRecords": "Cargando...",
				        "processing": "Procesando...",
				        "search": "Buscar:",
				        "zeroRecords": "Sin resultados encontrados",
				        "paginate": {
				            "first": "Primero",
				            "last": "Ultimo",
				            "next": "Siguiente",
				            "previous": "Anterior"
				        }
				},
			    // Processing indicator
		        "processing": true,
		        // DataTables server-side processing mode
		        "serverSide": true,
		        // Initial no order.
		        "order": [],
		        // Load data from an Ajax source
		        "ajax": {
		            "url": "<?php echo base_url('Clientes/getLists/'); ?>",
		            "type": "POST"
		        },
		        //Set column definition initialisation properties
		        "columnDefs": [
		        	{ 
		            	"targets": [2],
		            	"orderable": false,
		            	
		        	}
		        ]

			} );

        });

        $(".numbersOnly").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });

        $(".lettersOnly").keypress(function (key) {
        if ((key.charCode < 97 || key.charCode > 122)//letras mayusculas
            && (key.charCode < 65 || key.charCode > 90) //letras minusculas
            && (key.charCode != 45) //retroceso
            && (key.charCode != 241) //ñ
            && (key.charCode != 209) //Ñ
            && (key.charCode != 32) //espacio
            && (key.charCode != 225) //á
            && (key.charCode != 233) //é
            && (key.charCode != 237) //í
            && (key.charCode != 243) //ó
            && (key.charCode != 250) //ú
            && (key.charCode != 193) //Á
            && (key.charCode != 201) //É
            && (key.charCode != 205) //Í
            && (key.charCode != 211) //Ó
            && (key.charCode != 218) //Ú
            && (key.charCode != 44) //,
            && (key.charCode != 46) //.

            )
            return false;

        	
    	});
        // FUNCION PARA CARGAR AJAX DESDE CUALQUIER ARCHIVO JS o <script> DEL SISTEMA
        var cargar_ajax = {

        	run_server_ajax: function(_url, _data = null){
	        	var json_result = $.ajax({
	            url: '<?= base_url(); ?>' + _url,
	            dataType: "json",
	            method: "post",
	            async: false,
	            type: 'post',
	            data: _data, 
	            done: function(response) {
	                return response;
	            }
	        	}).responseJSON;
	        
		       	return json_result;
		    }
        }
        // FUNCION PARA CARGAR MENSAJES SWAL DESDE LOS CONTROLADORES
        <?php if(isset($mensajes_swal)){ echo  $mensajes_swal;}?>
    </script>