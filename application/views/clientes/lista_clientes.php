<div class="content-wrapper">
	<section class="content-header">
      <h1 class="Display1">
        CLIENTES REGISTRADOS
      </h1>
      <ol class="breadcrumb">
        <li><u><a href="<?=base_url()?>index.php/main"><i class="fa fa-dashboard"></i> Inicio</a></u></li>
        <li><u><a href="<?=base_url()?>clientes">Clientes</a></u></li>
      </ol>
    </section>
	<section class="content">
		<div class="row">
	        <div class="col-xs-12">
	          	<div class="box">
		            <div class="box-header">
		            	<div class="col-lg-offset-10">
		              		<a type="button" class="btn btn-block btn-primary" href="<?=base_url()?>index.php/clientes/add_client"><i class="fa fa-plus"></i> Nuevo Cliente</a>
		              	</div>
			        </div>
			    </div>
		        <div class="box">
					<div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th><center>#</center></th>
									<th><center>Cliente</center></th>
									<th><center>Telefono</center></th>
									<th><center>Correo</center></th>
									<th class="no-sort"><center>Opciones</center></th>
								</tr>
							</thead>
							<tbody>
								<?php if($DATA_CLIENTES != FALSE) {
									foreach ($DATA_CLIENTES->result() as $row) {
								?>
									<tr id="tr_<?= $row->id_cliente;?>" name="tr_<?= $row->id_cliente; ?>" >
										<td><center><?= $row->id_cliente;?></center></td>
										<td><center>
											<?= $row->nombre_cliente;?>
										</center></td>
										<td><center>
											<?= $row->telefono_cliente;?>
										</center></td>
										<td><center>
											<?= $row->correo_cliente;?>
										</center></td>
										<td><center>
											<button data-id="<?= $row->id_cliente; ?>" class="btn btn-primary editar_user"  data-toggle="modal" data-target="#modal_cliente_editar" ><i class="fa fa-edit"></i><span data-toggle="tooltip" data-placement="top" title="Modificar Cliente" ></span></button>

											<button data-id="<?= $row->id_cliente; ?>" class="btn btn-danger eliminar_cliente" title="Eliminar Cliente" data-toggle="tooltip" data-placement="top">  <i class="fa fa-close"></i></button>
										</center></td>
									</tr>
								<?php
									}
								} ?>
							</tbody> 
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<!-- MODAL PARA EDITAR LOS USUARIOS -->
<div class="modal fade" id="modal_cliente_editar" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-header">
            	<center><h3 class="modal-title">Modificar Usuarios</h3></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <hr>    
            </div>
            <div class="modal-body">
	            <form  name="editar_usuarios" id="editar_usuarios">
	            	<input type="hidden" id="id_usuario_editar" name="id_usuario_editar" >
	            	<div class="row">
				 		<div class="form-group col-lg-4">	
				 			<label >Nombre:</label>
							<input type="text" class="form-control" required id="txt_nombre_editar" name="txt_nombre_editar" placeholder="NOMBRE" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
				 		</div>

				 		<div class="form-group col-lg-4">
				 			<label >Telefono</label>
							<input type="text" class="form-control" required id="txt_apellido_p_editar" name="txt_apellido_p_editar" placeholder="APELLIDO PATERNO" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
				 		</div>			 		
					</div>

			 		<div class="row" style="margin-top: 30px;">
			 			<div class="form-group col-lg-4">
				 			<label >Correo:</label>
							<input type="email" class="form-control" id=txt_user_editar name="txt_user_editar" placeholder="CORREO ELECTRONICO" maxlength="150" required>
				 		</div>
				 		<div class="form-group col-lg-4">
				 			<label >Fecha de nacimiento:</label>
							<input type="text" class="form-control" required id="txt_apellido_m_editar" name="txt_apellido_m_editar" placeholder="APELLIDO MATERNO" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
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
<!-- FIN DEL MODAL PARA EDITAR LOS USUARIOS -->