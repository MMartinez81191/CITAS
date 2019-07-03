<?php
	$nombre = $this->session->userdata('nombre').' '.$this->session->userdata('apellido_p').' '.$this->session->userdata('apellido_m');

	
?>
<div class="content-wrapper">
	<section class="content-header">
		<h1 class="Display1">
			CITAS
		</h1>
		<ol class="breadcrumb">
			<li><u><a href="<?=base_url()?>index.php/main"><i class="fa fa-dashboard"></i> Inicio</a></u></li>
			<li><u><a href="#"><i class="fa fa-calendar"></i> Citas</a></u></li>
		</ol>
    </section>
	<section class="content">
		<div class="row">
	        <div class="col-xs-8">
	        	<div class="row">
	        		<div class="box">
						<div class="box-header">
							<center>
								<h4>Agregar Citas</h4>
								
							</center>
							<hr/>
						</div>
			      		<div class="box-body">
			      			<form id="agregar_citas" name="agregar_citas" autocomplete="off">
			          			<div class="row">
			          				<div class="col-lg-4">
			      						<div class="form-group">
						                	<label>Nombre Paciente:</label>
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
								                <input type="text" class="form-control pull-right" id="txt_fecha" name="txt_fecha" required="true" placeholder="yyyy-mm-dd" autocomplete="off">
							                </div>
							            </div>
			          				</div>
			          				<div class="col-lg-3" >
			          					<div class="bootstrap-timepicker">
							                <div class="form-group">
								                <label>Hora de Cita:</label>
								                <div class="input-group">
													<div class="input-group-addon">
														<i class="fa fa-clock-o"></i>
													</div>
													<input id="txt_hora" name="txt_hora" type="text" class="form-control timepicker" autocomplete="off" readonly="true" required="true">
												</div>
							                </div>
				          				</div>
				          			</div>
				          			<div class="col-lg-2" style="margin-top:2%;">
			          					<button type="submit" class="btn btn-primary">Guardar Cita</button>
			          				</div>
			      				</div>
			          		</form>
			      		</div>
				    </div>
	        	</div>
	        	<div class="row">
			        <div class="box">
			        	<div class="box-header">
			        		<center>
			        			<h3>Citas Programadas</h3>
			        		</center>
			        	</div>
						<div class="box-body table-responsive">
							<div id="tabla_citas" name="tabla_citas">
								<table id="example2" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th><center>Hora Cita</center></th>
											<th><center># Paciente</center></th>
											<th><center>Nombre Paciente</center></th>
											<th><center>Fecha Cita</center></th>
											
											<th class="no-sort"><center>Opciones</center></th>
										</tr>
									</thead>
										<tbody>
											<?php
												$aumento = 5;
							    				for($i=0; $i<144; $i++)
							    				{
							    					$hora_inicial = '08:00:00';
							    					$hora1 = date('h:i a', strtotime($hora_inicial.' + '.$aumento.' minutes'));
													$hora2 = date('h:i a', strtotime('00:00:00'));
							    					if($DATA_CITAS != FALSE)
							    					{
							    						foreach ($DATA_CITAS->result() as $row) 
							    						{
							    							$hora1 = date('h:i a', strtotime($hora_inicial.' + '.$aumento.' minutes'));
							    							$hora2 = date('h:i a', strtotime($row->hora));
							    							//$hora2 = date('h:i a', $row->hora);
							    							
							    							if($hora1 == $hora2)
							    							{
							    								
															?>
							    								<tr class="" id="tr_<?= $row->id_cita; ?>" name="tr_<?= $row->id_cita; ?>" >
																	<td><center><?= date('h:i a', strtotime($row->hora))?></center></td>
																	<td><center><?= $row->numero_turno;?></center></td>
																	<td><center><?= $row->nombre_cliente;?></center></td>
																	<td><center><?= $row->fecha ?></center></td>
																	<td>
																		<center>
																			<?php
																			if($row->costo_consulta == '0'){
																			?>
																				<button data-id="<?= $row->id_cita; ?>" class="btn btn-success cobrar_cita"  data-toggle="modal" data-target="#modal_cobrar_cita" ><i class="fa fa-money"></i><span data-toggle="tooltip" data-placement="top" title="Cobrar Consulta" ></span></button>

																				<button data-id="<?= $row->id_cita; ?>" class="btn btn-danger eliminar_cita" title="Eliminar Cita" data-toggle="tooltip" data-placement="top">  <i class="fa fa-close"></i></button>
																			<?php
																			}
																			else
																			{
																			?>
																				<a type="button" href="<?=base_url()?>citas/imprimir_ticket/<?=$row->id_cita?>" class="btn btn-success" target="_blank" ><i class="fa fa-print" data-toggle="tooltip" data-placement="top" title="Imprimir Ticket"  ></i><span></span></a>
																			<?php
																			}
																			?>
																		</center>
																	</td>
																</tr>
															<?php
																$aumento = $aumento + 5;
							    								break;
							    							}

							    						}	
							    					}
							    					
							    					if($hora1 != $hora2)
													{
							    					?>
														<tr>
							    							<td><center><?=date('h:i a', strtotime($hora_inicial.' + '.$aumento.' minutes'));?></center></td>
															<td><center>-</center></td>
															<td><center>-</center></td>
															<td><center>-</center></td>
															<td><center>-</center></td>
							    						</tr>
													<?php
														
								    					$aumento = $aumento + 5;
								    				}
							    				}
							    			?>
										</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-4">
				<div class="box box-primary">
					<div class="box-body">
						<div id="calendar"></div>
					</div>
				</div>
			    <div class="box">
					<div class="box-header">
						<center>
							<h4>Agregar Pacientes</h4>
						</center>
						<hr/>
					</div>
	          		<div class="box-body">
	          			<form id="agregar_cliente" name="agregar_cliente" autocomplete="off">
		          			<div class="row">
		          				<div class="col-lg-12">
	          						<div class="form-group">
					                	<label>Nombre Cliente:</label>
					                	<input type="text" id="txt_nombre" name="txt_nombre" class="form-control" placeholder="Nombre del paciente" onKeyUp="this.value=this.value.toUpperCase();">
					              	</div>
		          				</div>
	          				</div>
	          				<div class="row">
		          				<div class="col-lg-12">
	          						<div class="form-group">
					                	<label>Telefono del Cliente:</label>
					                	<input type="text" id="txt_telefono" name="txt_telefono" class="form-control" placeholder="Telefono del paciente" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="12">
					              	</div>
		          				</div>
	          				</div>
	          				<div class="row">
		          				<div class="col-lg-12">
		          					<!-- Date -->
						            <div class="form-group">
						             	<label>Fecha de Nacimiento:</label>
						                <div class="input-group date">
							                <div class="input-group-addon">
							                	<i class="fa fa-calendar"></i>
							                </div>
							                <input type="text" class="form-control pull-right" id="txt_fecha_cliente" name="txt_fecha_cliente" required="true" placeholder="yyyy-mm-dd" autocomplete="off">
						                </div>
						            </div>
		          				</div>
	          				</div>
	          				<div class="row">
		          				<div class="col-lg-12">
		          					<div class="form-group">
					                	<label>Correo Electronico: (Opcional)</label>
					                	<input type="email" id="txt_correo" name="txt_correo" class="form-control" placeholder="example@example.com">
					              	</div>
		          				</div>
	          				</div>
	          				<div class="row">
		          				<div class="col-lg-3" style="margin-top:2%;">
		          					<button type="submit" class="btn btn-primary">Guardar Paciente</button>
		          				</div>
		          			</div>
		          		</form>
	          		</div>
			    </div>
			</div>
		</div>
	</section>
</div>
<!-- MODAL PARA EDITAR LOS CLIENTES -->
<div class="modal fade" id="modal_cobrar_cita" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" >
            <div class="modal-header">
            	<center><h3 class="modal-title">Cobro de la consulta</h3></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <hr>    
            </div>
            <div class="modal-body">
	            <form  name="pagar_citas" id="pagar_citas">
	            	<input type="hidden" id="id_cita_pagar" name="id_cita_pagar" >
	            	<input type="hidden" name="fecha_cita" name="fecha_cita">
	            	<div class="row">
				 		<div class="form-group col-lg-12">	
				 			<label >Numero de turno:</label>
							<input type="text" class="form-control" required id="txt_turno_cita" name="txt_turno_cita" placeholder="" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();" required="true" readonly="true">
				 		</div>
				 	</div>
				 	<div class="row">
				 		<div class="form-group col-lg-12">
				 			<label >Nombre del paciente:</label>
							<input type="text" class="form-control" id="txt_nombre_cita" name="txt_nombre_cita" placeholder="TELEFONO" maxlength="12"  required="true" readonly="true">
				 		</div>			 		
					</div>

			 		<div class="row">
			 			<div class="form-group col-lg-12">
				 			<label >Costo de la consulta:</label>
				 			<select class="select2" id=sel_costo_cita name="sel_costo_cita" style="width: 100%">
				 				<?php
				 				if($DATA_COSTOS != FALSE)
				 				{
				 					foreach ($DATA_COSTOS->result() as $row) {
					 					echo '<option value="'.$row->costo.'">';
					 						echo '$'.number_format($row->costo,2,'.', ',');
					 					echo '</option>';
					 				}
				 				}
				 				?>
				 			</select>
				 		</div>	
	 				</div>
	 				<div class="row">
			 			<div class="form-group col-lg-12">
				 			<label >Forma de Pago:</label>
				 			<div class="form-check form-check-inline">
				 				<input class="form-check-input" type="radio" name="rd_forma_pago" value="1" checked="true">
				 				<label class="form-check-label" for="" style="margin-right: 20px;">Efectivo</label>

								<input class="form-check-input" type="radio" name="rd_forma_pago" value="2">
								<label class="form-check-label" for="">Cheque</label>
				 			</div>
							
				 		</div>	
	 				</div>
	 				<!--<div class="row">
				 		<div class="form-group col-lg-12">
				 			<label >Peso (Opcional):</label>
							<input type="text" class="form-control" id="txt_peso_inicial_cita" name="txt_peso_inicial_cita" placeholder="PESO" maxlength="12" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
				 		</div>			 		
					</div>-->
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





