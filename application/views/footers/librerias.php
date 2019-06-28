		<footer class="main-footer">
			<div class="row">
				<div class="col-md-1" style="text-align: right;">
					<img style="width: 60px;height: 60px;" src="<?=base_url()?>images/ps.png">
				</div>
				<div class="col-md-11">
					
					<strong><h4><b>Desarrollado por: PINGUINO SYSTEMS S.A DE C.V</b><br> para mas informacion visite <a href="http://www.pinguinosystems.com/PS/">www.pinguinosystems.com</a></h4></strong>
				</div>
			</div>
			
		</footer>
	 	 <div class="control-sidebar-bg"></div>
	</div>

	<!-- Select2 -->
	<script src="<?= base_url(); ?>template/bower_components/select2/dist/js/select2.full.min.js"></script>
	<!-- Slimscroll -->
	<script src="<?= base_url(); ?>template/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?= base_url(); ?>template/bower_components/fastclick/lib/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="<?= base_url(); ?>template/dist/js/adminlte.min.js"></script>
	<!-- Sweet alert -->
    <script src="<?= base_url(); ?>template/bower_components/sweetalert/sweetalert.min.js"></script>
    <!-- Toastr script -->
    <script src="<?= base_url(); ?>template/bower_components/toastr/toastr.min.js"></script>
	<!-- DataTables -->
	<script src="<?= base_url(); ?>template/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="<?= base_url(); ?>template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<!-- iCheck 1.0.1 -->
	<script src="<?= base_url(); ?>template/plugins/iCheck/icheck.min.js"></script>
	<script src="<?= base_url(); ?>template/plugins/bootstrap-slider/bootstrap-slider.js"></script>
	
	<script src="<?=base_url(); ?>template/bower_components/moment/min/moment.min.js"></script>
	<script src="<?=base_url(); ?>template/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

	<script src="<?=base_url(); ?>template/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

	<script src="<?= base_url(); ?>template/plugins/timepicker/bootstrap-timepicker.min.js"></script>

	<script src="<?=base_url(); ?>template/bower_components/moment/moment.js"></script>
	<script src="<?=base_url(); ?>template/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
	
	<!-- InputMask -->
	<script src="<?= base_url(); ?>template/plugins/input-mask/jquery.inputmask.js"></script>
	<script src="<?= base_url(); ?>template/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
	<script src="<?= base_url(); ?>template/plugins/input-mask/jquery.inputmask.extensions.js"></script>
	
	<!--Calendar-->
	<script type="text/javascript">

	    var date = new Date()
	    var d    = date.getDate(),
	        m    = date.getMonth(),
	        y    = date.getFullYear()
	    $('#calendar').fullCalendar({
			monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio','Augosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			dayNamesShort  : ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
			header    : {
				left  : 'prev,next',
				center: 'title',
				right : 'today'
			},
	      	buttonText: {
	        today: 'Hoy',
	        
	      },
      
      
	      selectable : true,
	      editable  : true,
	      droppable : false, // this allows things to be dropped onto the calendar !!!
	      drop      : function (date, allDay) { // this function is called when something is dropped

	        // retrieve the dropped element's stored Event Object
	        var originalEventObject = $(this).data('eventObject')

	        // we need to copy it, so that multiple events don't have a reference to the same object
	        var copiedEventObject = $.extend({}, originalEventObject)

	        // assign it the date that was reported
	        copiedEventObject.start           = date
	        copiedEventObject.allDay          = allDay
	        copiedEventObject.backgroundColor = $(this).css('background-color')
	        copiedEventObject.borderColor     = $(this).css('border-color')

	        // render the event on the calendar
	        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
	        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

	        // is the "remove after drop" checkbox checked?
	        if ($('#drop-remove').is(':checked')) {
	          // if so, remove the element from the "Draggable Events" list
	          $(this).remove()
	        }



	      	},
	      	select: function( startDate, endDate, allDay, jsEvent, view )
	      	{
	      		var fechaInicio = $.fullCalendar.formatDate( startDate, 'YYYY-MM-DD' );
	      		var fechaFinal = $.fullCalendar.formatDate( endDate, 'YYYY-MM-DD' );
	      		$("#tabla_citas").load("<?=base_url()?>citas/obtenerCitas/"+fechaInicio+"/"+fechaFinal+""); 
	    	},
	    })


	</script>

	<script type="text/javascript">
		 //Datemask dd/mm/yyyy
    	$('#txt_fecha').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
		//Date picker
	    $('#txt_fecha').datepicker({
	    	autoclose: true,
	    	format: 'yyyy-mm-dd'
	    })
	</script>
	<script type="text/javascript">
		 //Datemask dd/mm/yyyy
    	$('#txt_fecha2').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })
		//Date picker
	    $('#txt_fecha2').datepicker({
	    	autoclose: true,
	    	format: 'yyyy-mm-dd'
	    })
	</script>
	<script type="text/javascript">
		//Date picker
	    $('#txt_fecha_cliente').datepicker({
	    	autoclose: true,
	    	format: 'yyyy-mm-dd',
	    	language: 'es',
	    })
	</script>

	<script type="text/javascript">
		$(function () {	
			//Timepicker
		    $('.timepicker').timepicker({
		      defaultTime: 'current',
		      showInputs: false,
		      minuteStep: 5,
		    })
		})
	</script>



	<script type="text/javascript">
		
	    
	    //Date range picker
	    $('#reservation').daterangepicker()
	    //Date range picker with time picker
	    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
	    //Date range as a button
	    $('#daterange-btn').daterangepicker(
	      {
	        ranges   : {
	          'Today'       : [moment(), moment()],
	          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
	          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
	          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
	          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
	          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
	        },
	        startDate: moment().subtract(29, 'days'),
	        endDate  : moment()
	      },
	      function (start, end) {
	        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
	      }
	    )

    </script>

	

	<script type="text/javascript">

        $(function () {

        	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
		      	checkboxClass: 'icheckbox_flat-green',
				radioClass   : 'iradio_flat-green'
		    })
        	//Initialize Select2 Elements
    		$('.select2').select2()

            $('[data-toggle="tooltip"]').tooltip();
		    
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
			         "orderable": false,

			    }],

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
			         "orderable": false,

			    }],
			     "pageLength": 100,
			     "ordering": false

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

    	<?php
		$_curController = $this->router->fetch_class();
		$_curAction = $this->router->fetch_method();
		
		switch ($_curController) {

		    case 'usuarios':
			    echo '<script src="'.base_url().'js/usuarios/usuarios.js"></script>';
		    break;

		    case 'clientes':
			    echo '<script src="'.base_url().'js/clientes/clientes.js"></script>';
		    break;

		    case 'citas':
			    echo '<script src="'.base_url().'js/citas/citas.js"></script>';
		    break;

		    case 'corte':
			    echo '<script src="'.base_url().'js/corte/corte.js"></script>';
		    break;

		    case 'costos':
			    echo '<script src="'.base_url().'js/costos/costos.js"></script>';
		    break;
		    
		    case 'Corte_Parcial':
			    echo '<script src="'.base_url().'js/corte_parcial/corte_parcial.js"></script>';
		    break;

		    
	    }
	    echo '<script src="'.base_url().'js/main/main.js"></script>';
		?>
		<script>var base_url = '<?php echo base_url() ?>';</script>

	</body>
</html>