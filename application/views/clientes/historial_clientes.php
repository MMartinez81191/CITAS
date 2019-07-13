<?php
	if($DATA_HISTORIAL != FALSE)
	{
		foreach ($DATA_HISTORIAL->result() as $row) 
		{
			$nombre_cliente = $row->nombre_cliente;
			$peso = $row->peso;
			$fecha = $row->fecha;
		}
	} 

	$id_cliente = $this->uri->segment(3);
	var_dump($id_cliente);

?>

<div class="content-wrapper">
	<section class="content-header">
      <h1 class="Display1">
        Historial paciente
      </h1>
      <ol class="breadcrumb">
        <li><u><a href="<?=base_url()?>index.php/main"><i class="fa fa-dashboard"></i> Inicio</a></u></li>
        <li><u><a href="#">Historial</a></u></li>
      </ol>
    </section>
	<section class="content">
		<div class="row">
	        <div class="col-xs-12">
	          	<div class="box">
		            <div class="box-header">
		            	<div class="col-lg-offset-10">
		              		<a type="button" data-toggle="modal" data-target="#modal_agregar_peso"  class="btn btn-block btn-primary"><i class="fa fa-plus"></i> Nuevo registro</a>
		              	</div>
			        </div>
			    </div>
		        <div class="box">
					<div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th><center>Fecha</center></th>
									<th><center>Peso</center></th>
									<th class="no-sort"><center>Opciones</center></th>
								</tr>
							</thead>
							<tbody>
								<?php
									if($DATA_HISTORIAL != FALSE)
									{
										foreach ($DATA_HISTORIAL->result() as $row) {
											echo '<tr>';
												echo '<td>';
													echo $row->fecha;
												echo '</td>';
												echo '<td>';
													echo $row->peso;
												echo '</td>';
												echo '<td>';
													echo 'Opciones';
												echo '</td>';
											echo '</tr>';
										}
									}
								?>
							</tbody> 
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<!-- MODAL PARA AGREGAR PESO -->
<div class="modal fade" id="modal_agregar_peso" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" >
            <div class="modal-header">
            	<center><h3 class="modal-title">Actualizar peso</h3></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
	            <form  name="agregar_peso" id="agregar_peso">
	            	<input type="text" style="display: none;" id="id_cliente" name="id_cliente" value="<?=$id_cliente;?>">
	            	<input type="text" style="display: none;" class="form-control" name="fecha" id="fecha" value="<?php date_default_timezone_set('America/Los_Angeles');
					$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); 
					echo date('d')."/".$meses[date('n')-1]. "/".date('Y') ;	
					?>">
	 				<div class="row">
				 		<div class="form-group col-lg-12">
				 			<label >Peso:</label>
							<input type="text" required class="form-control" id="txt_peso_inicial_cita" name="txt_peso_inicial_cita" placeholder="PESO" maxlength="12" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
				 		</div>			 		
					</div>
	 				<hr>
				 	<div class="row modal-footer" style="margin-top: 10px;">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	                    <button type="submit"  class="btn btn-primary">Guardar</button>

	                </div>
				</form> 
            </div>
        </div>
    </div>
</div>
<!-- FIN DEL MODAL PARA AGREGAR PESO -->