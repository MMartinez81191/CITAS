<?php
	$nombre = $this->session->userdata('nombre').' '.$this->session->userdata('apellido_p').' '.$this->session->userdata('apellido_m');

	
?>

	
<div class="content-wrapper">
	<section class="content">
		<div class="row">
   			<div class="col-lg-12">
				<div class="col-lg-12 bg-info">
					<div class="box box-solid">
						<div class="box-header with-border">
							<center> 
								<h3 class="box-title display-3">Bienvenido a Control de Citas</h3> <h3 class="Display-3"><?= $nombre; ?></h3>	
							</center>
						</div>									
						<div class="box-body" id="caja">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
	        <div class="col-xs-12">
	          	<div class="box">
		            <div class="box-header">
		            	<div class="col-lg-offset-10">
		              		<button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal_citas_agregar"><i class="fa fa-plus"></i> Nueva Cita</button>
		              	</div>
			        </div>
			    </div>
		        <div class="box">
					<div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th><center>#</center></th>
									<th><center>Usuario</center></th>
									<th><center>Nombre</center></th>
									<th><center>Departamento</center></th>
									<th class="no-sort"><center>Opciones</center></th>
								</tr>
							</thead>
							<tbody>
								<?php if($DATA_USUARIOS != FALSE) {
									foreach ($DATA_USUARIOS as $row) {
								?>
									<tr id="tr_<?= $row->id_usuario; ?>" name="tr_<?= $row->id_usuario; ?>" >
										<td><center><?= $row->id_usuario;?></center></td>
										<td><center><?= $row->usuario_email;?></center></td>
										<td><center><?= $row->nombre.' '.$row->apellido_p.' '.$row->apellido_m; ?></center></td>
										<td>
											<center>
											<?php
											if($row->departamento != 'ROOT')
												echo $row->departamento;
											else
												echo 'SISTEMAS';
											?>
											</center>
										</td>

										<td>
										<?php
										if($row->id_nivel != 1)
										{
										?>
											<center>
												<button data-id="<?= $row->id_usuario; ?>" class="btn btn-primary editar_user"  data-toggle="modal" data-target="#modal_usuarios_editar" ><i class="fa fa-edit"></i><span data-toggle="tooltip" data-placement="top" title="Modificar Usuario" ></span></button>

												<button data-id="<?= $row->id_usuario; ?>" class="btn btn-danger eliminar_user" title="Eliminar Usuario" data-toggle="tooltip" data-placement="top">  <i class="fa fa-close"></i></button>
											</center>
										<?php
										}
										?>
										</td>
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
	<div class="modal fade" id="modal_citas_agregar" tabindex="-1" role="dialog" aria-hidden="true" >
	    <div class="modal-dialog modal-lg" role="document">
	        <div class="modal-content" >
	            <div class="modal-header">
	            	<center><h3 class="modal-title">Agregar Cita</h3></center>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                <hr>    
	            </div>
	            <div class="modal-body">
		            <form  name="agregar_cita" id="agregar_cita">
		            	<div class="row">
	            			<div class="form-group col-lg-12">
	                            <label class="">Nombre Cliente:</label>
	                            <select class="form-control select2" style="width: 100%;" id="select_cliente" name="select_cliente" required>
		                            <?php
		                                if($DATA_CLIENTES != FALSE)
			                            {		                                
			                                foreach ($DATA_CLIENTES->result() as $row)
			                                {
			                                    echo '<option value="'.$row->id_cliente.'">';
			                                        echo $row->nombre_cliente;
			                                    echo '</option>';                                
			                                }
			                            
			                            }                                      
		                            ?>
	                            </select>
	                        </div>
		            	</div>
		            	<div class="row">
					 		<div class="form-group col-lg-12">	
					 			<label >Fecha y Hora de la Cita:</label>
								<div class='col-sm-12'>
								            <div class="form-group">
								                <div class='input-group date' id='datetimepicker1'>
								                    <input type='text' class="form-control" />
								                    <span class="input-group-addon">
								                        <span class="glyphicon glyphicon-calendar"></span>
								                    </span>
								                </div>
								            </div>
								        </div>
								        <script type="text/javascript">
								            $(function () {
								                $('#datetimepicker1').datetimepicker();
								            });
								        </script>
					 		</div>				 		
						</div>
						
					 	<div class="row modal-footer" style="margin-top: 10px;">
		                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		                    <button type="submit" class="btn btn-primary">Guardar</button>
		                </div>
					</form> 
	            </div>
	        </div>
	    </div>
	</div>
</div>



