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
					                	<select id="select_cliente" name="select_cliente" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" >
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
							                <input type="text" class="form-control pull-right" id="fecha_txt" name="fecha_txt" required="true">
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
									<th><center>Folio</center></th>
									<th><center>Nombre Paciente</center></th>
									<th><center>Fecha Cita</center></th>
									<th class="no-sort"><center>Opciones</center></th>
								</tr>
							</thead>
							<tbody>
								<?php if($DATA_CITAS != FALSE) {
									foreach ($DATA_CITAS->result() as $row) {
								?>
									<tr id="tr_<?= $row->id_cita; ?>" name="tr_<?= $row->id_cita; ?>" >
										<td><center><?= $row->id_cita;?></center></td>
										<td><center><?= $row->nombre_cliente;?></center></td>
										<td><center><?= $row->fecha ?></center></td>
										<td>
											<center>
												<a type="button" href="" class="btn btn-success"><i class="fa fa-print" data-toggle="tooltip" data-placement="top" title="Imprimir" ></i><span></span></a>

												<button data-id="<?= $row->id_cita; ?>" class="btn btn-danger eliminar_cita" title="Eliminar Cita" data-toggle="tooltip" data-placement="top">  <i class="fa fa-close"></i></button>
											</center>
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



