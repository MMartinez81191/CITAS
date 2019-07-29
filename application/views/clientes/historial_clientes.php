<?php
	if($DATA_HISTORIAL != FALSE)
	{
		foreach ($DATA_HISTORIAL->result() as $row) 
		{
			$id_peso = $row->id_peso;
			$nombre_cliente = $row->nombre_cliente;
			$peso = $row->peso;
			$fecha = $row->fecha;
		}
	} 

	$id_cliente = $this->uri->segment(3);


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
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header">
						<form id="estatura_form" name="estatura_form">
							<input type="hidden" name="id_cliente_estatura" name="id_cliente_estatura" value="<?=$DATA_ESTATURA->id_cliente?>">
							<div class="form-group">
								<h3>Actualizar Estatura</h3>
							</div>
							<div class="form-group col-lg-3">
								<label>Estatura en metros:</label>
								<input type="text" class="form-control" id="txt_estatura" name="txt_estatura" placeholder="Estatura" required="true" value="<?=$DATA_ESTATURA->estatura?>" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="4">
							</div>
							<div class="form-group col-lg-2" style="margin-top: 2%;">
								<button  type="submit" class="btn btn-primary"><i class="fa fa-refresh"></i> Actualizar Estatura</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
	        <div class="col-xs-12">
	          	<div class="box">
		            <div class="box-header">
		            	<div class="row">
		            		<div class="col-lg-2">
			            		<a type="button" href="<?=base_url()?>clientes/imprmir_historial/<?=$id_cliente?>" class="btn btn-block btn-primary" target="_blanck"><i class="fa fa-print"></i> Imprimir</a>
		            		</div>
			            	<div class="col-lg-offset-10">
		              			<a type="button" data-toggle="modal" data-target="#modal_agregar_peso"  class="btn btn-block btn-primary"><i class="fa fa-plus"></i> Agregar Peso</a>
			              	</div>
		            	</div>
			        </div>
			    </div>
		        <div class="box">
					<div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th><center>Fecha</center></th>
									<th><center>Peso en Kg</center></th>
									<th class="no-sort"><center>Opciones</center></th>
								</tr>
							</thead>
							<tbody>
								<?php
									if($DATA_HISTORIAL != FALSE)
									{
										foreach ($DATA_HISTORIAL->result() as $row) 
										{
											echo '<tr id="tr_'.$row->id_peso.'" name="tr_'.$row->id_peso.'">';
												
												echo '<td><center>';
													echo $row->fecha;
												echo '</center></td>';

												echo '<td><center>';
													echo $row->peso.' Kg';
												echo '</center></td>';

												echo '<td><center>';
								?>
													<button data-id="<?= $row->id_peso; ?>" class="btn btn-primary editar_peso"  data-toggle="modal" data-target="#modal_editar_peso" ><i class="fa fa-edit"></i><span data-toggle="tooltip" data-placement="top" title="Modificar" ></span></button>
													
													<button data-id="<?= $row->id_peso; ?>" class="btn btn-danger eliminar_peso" title="Eliminar" data-toggle="tooltip" data-placement="top">  <i class="fa fa-close"></i></button>
												<center></td>
											</tr>
								<?php
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
            	<center><h3 class="modal-title">Agregar peso</h3></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
	            <form  name="agregar_peso" id="agregar_peso">
	            	<input type="text" style="display: none;" id="id_cliente" name="id_cliente" value="<?=$id_cliente;?>">
	            	<input type="text" style="display: none;" class="form-control" name="fecha" id="fecha" value="<?=date("Y-m-d");?>">
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


<!-- MODAL PARA EDITAR PESO -->
<div class="modal fade" id="modal_editar_peso" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" >
            <div class="modal-header">
            	<center><h3 class="modal-title">Editar peso</h3></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
	            <form  name="editar_peso" id="editar_peso">
	 				<div class="row">
				 		<div class="form-group col-lg-12">
				 			<input type="hidden" id="txt_id_peso" name="txt_id_peso">
				 			<label >Peso:</label>
							<input type="text" required class="form-control" id="txt_peso_editar" name="txt_peso_editar" placeholder="PESO" maxlength="12" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
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
<!-- FIN DEL MODAL PARA EDITAR PESO -->