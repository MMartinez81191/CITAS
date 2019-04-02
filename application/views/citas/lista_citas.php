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
	          			<form id="agregar_citas" name="agregar_citas">
		          			<div class="row">
		          				<div class="col-lg-3">
	          						<div class="form-group">
					                	<label>Nombre Cliente:</label>
					                	<select id="select_cliente" name="select_cliente" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
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
		          				<div class="col-lg-3">
		          					<!-- Date -->
						            <div class="form-group">
						             	<label>Fecha:</label>
						                <div class="input-group date">
							                <div class="input-group-addon">
							                	<i class="fa fa-calendar"></i>
							                </div>
							                <input type="text" class="form-control pull-right" id="datepicker">
						                </div>
						                <!-- /.input group -->
						            </div>
						              <!-- /.form group -->
		          				</div>
		          				<div class="col-lg-3" style="margin-top:2%;">
		          					<button type="submit" class="btn btn-primary">Guardar Cita</button>
		          					<!--<div class="bootstrap-timepicker">
					                <div class="form-group">
					                  <label>Time picker:</label>

					                  <div class="input-group">
					                    <input type="text" class="form-control timepicker">

					                    <div class="input-group-addon">
					                      <i class="fa fa-clock-o"></i>
					                    </div>
					                  </div>
					                  <!-- /.input group --
					                </div>-->
		          				</div>
		          				<div class="col-lg-3">
		          					
		          				</div>
		          			</div>
		          		</form>
	          		</div>
			    </div>
		        <div class="box">
					<div class="box-body table-responsive">
						<div class="form-group">
                <label>Date range:</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="reservation">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
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
</div>



