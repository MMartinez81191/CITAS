<?php
$nivel_usuario = $this->session->userdata('nivel');
?>
<div class="content-wrapper">
	<section class="content-header">
      <h1 class="Display1">
        PACIENTES REGISTRADOS
      </h1>
      <ol class="breadcrumb">
        <li><u><a href="<?=base_url()?>index.php/main"><i class="fa fa-dashboard"></i> Inicio</a></u></li>
        <li><u><a href="<?=base_url()?>clientes">Pacientes</a></u></li>
      </ol>
    </section>
	<section class="content">
		<div class="row">
	        <div class="col-xs-12">
	          	<div class="box">
		            <div class="box-header">
		            	<div class="col-lg-offset-10">
		              		<a type="button" class="btn btn-block btn-primary" href="<?=base_url()?>index.php/clientes/add_client"><i class="fa fa-plus"></i> Nuevo Paciente</a>
		              	</div>
			        </div>
			    </div>
		        <div class="box">
					<div class="box-body table-responsive">
						<table id="example3" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th><center>ID</center></th>
									<th><center>Nombre del Paciente</center></th>
									<th class="no-sort"><center>Opciones</center></th>
								</tr>
							</thead>
							<tbody>
								<?php /*if($DATA_CLIENTES != FALSE) {
									/*foreach ($DATA_CLIENTES->result() as $row) {
								?>
									<tr id="tr_<?= $row->id_cliente;?>" name="tr_<?= $row->id_cliente; ?>" >
										<td><center><?= $row->id_cliente;?></center></td>
										<td><center>
											<?= $row->nombre_cliente;?>
										</center></td>
										
										<td><center>
											<button data-id="<?= $row->id_cliente; ?>" class="btn btn-primary editar_user"  data-toggle="modal" data-target="#modal_cliente_editar" ><i class="fa fa-edit"></i><span data-toggle="tooltip" data-placement="top" title="Modificar Paciente" ></span></button>
											
											<a type="button" href="<?=base_url()?>clientes/historial/<?=$row->id_cliente;?>" class="btn btn-primary"><i class="fa fa-file-text" data-toggle="tooltip" data-placement="top" title="Historial"  ></i><span></span></a>

											<a type="button" href="<?=base_url()?>clientes/imprimir_expediente/<?=$row->id_cliente;?>" class="btn btn-primary" target="_blanck"><i class="fa fa-print" data-toggle="tooltip" data-placement="top" title="Expediente"  ></i><span></span></a>

											<?php
											if($nivel_usuario < 3)
											{
											?>
											<button data-id="<?= $row->id_cliente; ?>" class="btn btn-danger eliminar_cliente" title="Eliminar Paciente" data-toggle="tooltip" data-placement="top">  <i class="fa fa-close"></i></button>
											<?php
											}
											?>
										</center></td>
									</tr>
								<?php
									}
								}*/ ?>
							</tbody> 
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<!-- MODAL PARA EDITAR LOS CLIENTES -->
<div class="modal fade" id="modal_cliente_editar" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-header">
            	<center><h3 class="modal-title">Modificar Informacion de Pacientes</h3></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <hr>    
            </div>
            <div class="modal-body">
	            <form  name="editar_clientes" id="editar_clientes">
	            	<input type="hidden" id="id_cliente_editar" name="id_cliente_editar" >
	            	<div class="row">
				 		<div class="form-group col-lg-4">	
				 			<label >Nombre:</label>
							<input type="text" class="form-control" required id="txt_nombre_editar" name="txt_nombre_editar" placeholder="Nombre del Paciente" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();" required="true">
				 		</div>

				 		<div class="form-group col-lg-4">
				 			<label >Telefono (Opcional):</label>
							<input type="text" class="form-control" id="txt_telefono_editar" name="txt_telefono_editar" placeholder="Escriba el telefono del paciente" maxlength="12" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required="true">
				 		</div>			 		
					</div>

			 		<div class="row" style="margin-top: 30px;">
			 			<div class="form-group col-lg-4">
				 			<label >Correo (Opcional):</label>
							<input type="email" class="form-control" id=txt_correo_editar name="txt_correo_editar" placeholder="CORREO ELECTRONICO" maxlength="100">
				 		</div>
				 		<div class="form-group col-lg-4">
				 			<label >Fecha de nacimiento (Opcional):</label>
				 			<div class="input-group">
			             		<span class="input-group-addon">
							        <i class="fa fa-calendar"></i>
							    </span>
							    <input type="date" class="form-control" id="txt_fecha_cliente_modificar" name="txt_fecha_cliente_modificar" >
							    
			             	</div>
							<!--<input type="text" class="form-control"  id="txt_fecha" name="txt_fecha" placeholder="yyyy-mm-dd" maxlength="150" autocomplete="off" required="true">-->
				 		</div>	
	 				</div>
	 				<hr>
				 	<div class="row modal-footer" style="margin-top: 10px;">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	                    <button type="submit" class="btn btn-primary">Guardar</button>
	                </div>
				</form> 
            </div>
        </div>
    </div>
</div>
<!-- FIN DEL MODAL PARA EDITAR LOS CLIENTES -->