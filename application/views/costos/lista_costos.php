<div class="content-wrapper">
	<section class="content-header">
      <h1 class="Display1">
        COSTOS DE CONSULTAS
      </h1>
      <ol class="breadcrumb">
        <li><u><a href="<?=base_url()?>index.php/main"><i class="fa fa-dashboard"></i> Inicio</a></u></li>
        <li><u><a href="<?=base_url()?>costos">Costos</a></u></li>
      </ol>
    </section>
	<section class="content">
		<div class="row">
	        <div class="col-xs-12">
	          	<div class="box">
		            <div class="box-header">
		            	<div class="col-lg-offset-10">
		              		<button class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal_costos_agregar"><i class="fa fa-plus"></i> Agregar Nuevo Costo</button>
		              	</div>
			        </div>
			    </div>
		        <div class="box">
					<div class="box-body">
						<div class="row">
							<div class="col-lg-3">
								
							</div>
							<div class="col-lg-6">
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th class="col-lg-8"><center>Costo</center></th>
												<th class="col-lg-4"><center>Opciones</center></th>
											</tr>
										</thead>
										<tbody>
											<?php if($DATA_COSTOS != FALSE) {
												foreach ($DATA_COSTOS->result() as $row) {
											?>
												<tr id="tr_<?= $row->id_costo;?>" name="tr_<?= $row->id_costo; ?>" >
													<td><center>
														<?='$'.number_format($row->costo,2,'.', ',')?>
													</center></td>
													<td><center>
														<button data-id="<?= $row->id_costo; ?>" class="btn btn-danger eliminar_costo" title="Eliminar Costo" data-toggle="tooltip" data-placement="top">  <i class="fa fa-close"></i></button>
													</center></td>
												</tr>
											<?php
												}
											} ?>
										</tbody> 
									</table>
								</div>
							</div>
							<div class="col-lg-3">
								
							</div>
						</div>
						
						
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<!-- MODAL PARA EDITAR LOS CLIENTES -->
<div class="modal fade" id="modal_costos_agregar" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" >
            <div class="modal-header">
            	<center><h3 class="modal-title">Agregar costos de consulta</h3></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <hr>    
            </div>
            <div class="modal-body">
	            <form  name="agregar_costos" id="agregar_costos">
			 		<div class="form-group">
			 			<label >Importe:</label>
						<input type="text" class="form-control validador_decimales" id="txt_costos_agregar" name="txt_costos_agregar" placeholder="Escriba el importe que desea agregar" maxlength="12" required="true">
			 		</div>			 		
				 	<div class="row modal-footer" style="margin-top: 10px;">
				 		<div class="form-group">
				 			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	                    	<button type="submit" class="btn btn-primary">Guardar</button>
				 		</div>
	                    
	                </div>
				</form> 
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
 	$('.validador_decimales').on('input', function () { this.value = this.value.match(/^\d+\.?\d{0,2}/); }); 
</script>
<!-- FIN DEL MODAL PARA EDITAR LOS CLIENTES -->