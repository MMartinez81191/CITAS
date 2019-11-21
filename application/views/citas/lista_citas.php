<?php
	$nombre = $this->session->userdata('nombre').' '.$this->session->userdata('apellido_p').' '.$this->session->userdata('apellido_m');
	$id_nivel = $this->session->userdata('nivel');

	function set_color($id_tipo_cita)
	{
		
		switch ($id_tipo_cita) {
			case '1':
				$class = 'info'; //consulta
				break;
			case '2':
				$class = 'danger'; //membresia
				break;
			case '3':
				$class = 'success'; //paciente nuevo
				break;
			case '5':
				$class = 'warning'; //terapia
				break;
			default:
				# code...
				break;
		}

		return $class;
	}


	if($DATA_CITAS != FALSE)
	{
		foreach ($DATA_CITAS->result() as $row) 
		{
			$id_cliente = $row->id_cliente;
		}
	}
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
			        <div class="box box-primary" id="tabla_citas" name="tabla_citas">
			        	<div class="box-header">
			        		<center>
			        			<h3>Citas programadas del dia <?=date('d-m-Y',strtotime($DATA_FECHA))?></h3>
			        		</center>
			        	</div>
						<div class="box-body table-responsive">
							<div>
								<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th><center>#</center></th>
											<th><center>Hora Cita</center></th>
											<th><center>Turno</center></th>
											<th><center>Nombre Paciente</center></th>
											<th><center>Tipo Cita</center></th>
											<th><center>Costo</center></th>
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
							    								<tr class="<?=set_color($row->id_tipo_cita)?>" id="tr_<?= $row->id_cita; ?>" name="tr_<?= $row->id_cita; ?>" >
							    									<td><center><?=$i + 1?></center></td>
																	<td><center><?= date('h:i a', strtotime($row->hora))?></center></td>
																	<td><center><?= $row->numero_turno;?></center></td>
																	<td><center><?= $row->nombre_cliente;?></center></td>
																	<td><center><?= $row->tipo_cita ?></center></td>
																	<td><center><?php 
																					if($row->costo_consulta != -1)
																					{	
																						if(is_numeric($row->costo_consulta))
																						{
																							echo number_format($row->costo_consulta,2,'.', ',');
																						}
																						else
																						{
																							echo $row->costo_consulta;
																						}
																						
																					}
																					else
																					{
																						echo '-';
																					} 
																					?>
																	</center></td>
																	<td>
																		<center>
																			<?php
																			if($row->costo_consulta == '-1'){
																			?>
																				<button data-id="<?= $row->id_cita; ?>" class="btn btn-warning cobrar_cita"  data-toggle="modal" data-target="#modal_cobrar_cita" ><i class="fa fa-money"></i><span data-toggle="tooltip" data-placement="top" title="Cobrar Consulta" ></span></button>

																				<button data-id="<?= $row->id_cita; ?>" class="btn btn-danger eliminar_cita" title="Eliminar Cita" data-toggle="tooltip" data-placement="top">  <i class="fa fa-close"></i></button>
																			<?php
																			}
																			else
																			{
																			?>
																				<a type="button" href="<?=base_url()?>citas/imprimir_ticket/<?=$row->id_cita?>" class="btn btn-success" target="_blank" ><i class="fa fa-print" data-toggle="tooltip" data-placement="top" title="Imprimir Ticket"  ></i><span></span></a>
																				<button data-id="<?= $row->id_cita; ?>" class="btn btn-primary cargar_modal_peso" title="Actualizar Historial" data-toggle="tooltip" data-placement="top">  <i class="fa fa-file-text"></i></button>
																				<?php
																					if($row->id_tipo_cita != 2 AND $id_nivel < 5)
																					{
																						?>
																						<button data-id="<?= $row->id_cita; ?>" data-hora="<?=$hora1?>" data-fecha="<?=$DATA_FECHA?>" class="btn btn-warning btn_update_cita_modal"  data-toggle="modal" data-target="#modal_modificar_cita" ><i class="fa fa-edit"></i><span data-toggle="tooltip" data-placement="top" title="Modificar" ></span></button>
																						<button data-id="<?= $row->id_cita; ?>" class="btn btn-danger eliminar_cita"><i class="fa fa-close"></i><span data-toggle="tooltip" data-placement="top" title="Eliminar Cita" ></span></button>
																						<?php
																					}
																				?>
																				
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
															<td><center><?=$i + 1?></center></td>
							    							<td><center><?=date('h:i a', strtotime($hora_inicial.' + '.$aumento.' minutes'));?></center></td>
															<td><center>-</center></td>
															<td><center>-</center></td>
															<td><center>-</center></td>
															<td><center>-</center></td>
															<td><center><button class="btn btn-success btn_add_cita_modal" data-hora="<?=$hora1?>" data-fecha="<?=$DATA_FECHA?>" data-toggle="modal" data-target="#modal_agregar_citas"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Agregar Cita"  ></i><span></span></button></center></td>
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

<!-- AGREGAR PACIENTE -->			
			<div class="col-xs-4">
				<div class="box box-primary">
					<div class="box-body">
						<div id="calendar"></div>
					</div>
				</div>
			    <div class="box box-primary">
					<div class="box-header">
						<center>
							<h4>Consultar Citas</h4>
						</center>
						<hr/>
					</div>
	          		<div class="box-body">
	          			<form id="consultar_citas" name="consultar_citas" autocomplete="off">
		          			<div class="row">
		          				<div class="col-lg-12">
	          						<div class="form-group">
					                	<label>Seleccione Paciente:</label>
					                	<select id="select_cliente_consulta_citas" name="select_cliente_consulta_citas" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" >
							                  <option>seleccionar</option>
					                	</select>
						              	
					              	</div>
					              	<div class="form-group">
			          					<button class="btn btn-default"><i class="fa fa-search"></i> Consultar Citas</button>
			          				</div>
		          				</div>
	          				</div>
	          				
		          		</form>
		          		<div id="consulta_citas_tabla">
	          				
	          			</div>
	          		</div>
			    </div>
			    <div class="box box-primary">
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
					                	<label>Nombre Paciente:</label>
					                	<input type="text" id="txt_nombre" name="txt_nombre" class="form-control" placeholder="Nombre del paciente" onKeyUp="this.value=this.value.toUpperCase();">
					              	</div>
		          				</div>
	          				</div>
	          				<div class="row">
		          				<div class="col-lg-12">
	          						<div class="form-group">
					                	<label>Telefono del Paciente (Opcional):</label>
					                	<input type="text" id="txt_telefono" name="txt_telefono" class="form-control" placeholder="Telefono del paciente" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="12">
					              	</div>
		          				</div>
	          				</div>
	          				<div class="row">
		          				<div class="col-lg-12">
		          					<!-- Date -->
						            <div class="form-group">
						             	<label>Fecha de Nacimiento (Opcional):</label>
						                <div class="input-group">
						             		<span class="input-group-addon">
										        <i class="fa fa-calendar"></i>
										    </span>
										    <input type="date" class="form-control" id="txt_fecha_cliente_citas" name="txt_fecha_cliente_citas" >
										    
						             	</div>
						                <!--<div class="input-group date">
							                <div class="input-group-addon">
							                	<i class="fa fa-calendar"></i>
							                </div>

							                
							                <input type="text" class="form-control pull-right" id="txt_fecha_cliente" name="txt_fecha_cliente" placeholder="yyyy-mm-dd" autocomplete="off">
							            	
						                </div>-->
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

<!-- MODAL PARA COBRAR CITAS -->
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
	            	<input type="hidden" name="txt_tipo_cita" id="txt_tipo_cita">
	            	<input type="hidden" name="txt_membresia" id="txt_membresia"> 
	            	<input type="hidden" name="txt_id_cliente" id="txt_id_cliente">
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
				 			<select class="form-control" id=sel_costo_cita name="sel_costo_cita" style="width: 100%">
				 				
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
								<label class="form-check-label" for="" style="margin-right: 20px;">Cheque</label>

								<input class="form-check-input" type="radio" name="rd_forma_pago" value="3">
								<label class="form-check-label" for="">Transferencia</label>
				 			</div>
							
				 		</div>	
	 				</div>
				 	<div class="row modal-footer" style="margin-top: 10px;">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	                    <button type="submit" id="btn_pago_cita" name="btn_pago_cita"  class="btn btn-primary">Pagar</button>

	                </div>
				</form> 
            </div>
        </div>
    </div>
</div>
<!-- FIN DEL MODAL PARA COBRAR LAS CITAS -->

<!-- MODAL PARA AGREGAR PESO -->
<div class="modal fade" id="modal_agregar_peso" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" >
            <div class="modal-header">
            	<center><h3 class="modal-title">Actualizar peso</h3></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
	            <form  name="agregar_peso_citas" id="agregar_peso_citas">
	            	<input type="hidden" id="txt_id_cita_peso" name="txt_id_cita_peso">

	 				<div class="row">
				 		<div class="form-group col-lg-12">
				 			<label >Peso:</label>
							<input type="text" required class="form-control" id="txt_peso_inicial_cita" name="txt_peso_inicial_cita" placeholder="PESO" maxlength="12" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required = "true" autocomplete="off" >
				 		</div>			 		
					</div>
					<div class="row">
				 		<div class="form-group col-lg-12">
				 			<label >Estatura en metros:</label>
							<input type="text" required class="form-control" id="txt_estatura" name="txt_estatura" placeholder="ESTATURA" maxlength="4" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required = "true" autocomplete="off" >
				 		</div>			 		
					</div>
	 				<hr>
				 	<div class="row modal-footer" style="margin-top: 10px;">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	                    <button type="submit" class="btn btn-primary" class="btn btn-primary">Guardar</button>

	                </div>
				</form> 
            </div>
        </div>
    </div>
</div>
<!-- FIN DEL MODAL PARA AGREGAR PESO -->

<!-- MODAL PARA AGREGAR CITAS -->
<div class="modal fade" id="modal_agregar_citas"  role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" >
            <div class="modal-header">
            	<center><h3 class="modal-title">Agregar citas</h3></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
	            <form  name="agregar_citas_modal" id="agregar_citas_modal">
	            	
	            	<div class="form-group">
		                <label>Fecha de cita:</label>
		                <div class="input-group">
		                	<span class="input-group-addon">
						        <i class="fa fa-calendar"></i>
						    </span>
		                	<input type="text" class="form-control" id="txt_fecha_citas_modal" name="txt_fecha_citas_modal" required="true" readonly="true">
		                </div>
		            </div>

	            	<div class="form-group">
		                <label>Hora de Cita:</label>
		                <div class="input-group">
		                	<span class="input-group-addon">
						        <i class="fa fa-clock-o"></i>
						    </span>
		                	<input type="text" class="form-control" id="txt_hora_citas_modal" name="txt_hora_citas_modal" required="true" readonly="true">
		                </div>
		            </div>

	            	<div class="form-group">
	            		<label>Nombre Paciente:</label>
	                	<select id="select_cliente_modal" name="select_cliente_modal" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" required="true"> 
	                	</select>
	            	</div>
	            	
	            	<div class="form-group">
	                	<label>Tipo de cita:</label>
	                	<select id="select_tipo_cita_modal" name="select_tipo_cita_modal" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" >
			                  <?php
                                if($DATA_TIPO_CITAS != FALSE)
	                            {		                                
	                                foreach ($DATA_TIPO_CITAS->result() as $row)
	                                {
	                                    echo '<option value="'.$row->id_tipo_cita.'">';
	                                        echo $row->tipo_cita;
	                                    echo '</option>';                                
	                                }
	                            
	                            }                                      
                            ?>
	                	</select>
	              	</div>
	 				<hr>
				 	<div class="row modal-footer" style="margin-top: 10px;">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	                    <button type="submit" class="btn btn-primary" class="btn btn-primary">Guardar</button>

	                </div>
				</form> 
            </div>
        </div>
    </div>
</div>
<!-- FIN DEL MODAL PARA AGREGAR CITAS -->

<!-- MODAL PARA MODDIFICAR CITAS -->
<div class="modal fade" id="modal_modificar_cita"  role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" >
            <div class="modal-header">
            	<center><h3 class="modal-title">Modificar citas</h3></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
	            <form name="modificar_citas_modal" id="modificar_citas_modal">
	            	
	            	<div class="form-group">
		                <label>Fecha de cita:</label>
		                <div class="input-group">
		                	<span class="input-group-addon">
						        <i class="fa fa-calendar"></i>
						    </span>
		                	<input type="text" class="form-control" id="txt_modificar_fecha_citas_modal" name="txt_modificar_fecha_citas_modal" required="true" readonly="true">
		                </div>
		            </div>

	            	<div class="form-group">
		                <label>Hora de Cita:</label>
		                <div class="input-group">
		                	<span class="input-group-addon">
						        <i class="fa fa-clock-o"></i>
						    </span>
		                	<input type="text" class="form-control" id="txt_modificar_hora_citas_modal" name="txt_modificar_hora_citas_modal" required="true" readonly="true">
		                </div>
		            </div>

	            	<div class="form-group">
	            		<label>Nombre Paciente:</label>
	                	<input type="text" class="form-control" id="txt_modificar_nombre_cliente" name="txt_modificar_nombre_cliente" readonly="true">
	            	</div>
	            	
	            	<div class="form-group">
	                	<label>Tipo de cita:</label>
	                	<select id="select_modificar_tipo_cita_modal" name="select_modificar_tipo_cita_modal" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" >
			                  
	                	</select>
	              	</div>

	              	<div class="form-group">
	                	<label >Costo de la consulta:</label>
			 			<select class="form-control" id=sel_modificar_costo_cita name="sel_modificar_costo_cita" style="width: 100%">
			 				
			 			</select>
	              	</div>
	 				<hr>
				 	<div class="row modal-footer" style="margin-top: 10px;">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
	                    <button type="submit" class="btn btn-primary" class="btn btn-primary">Guardar</button>

	                </div>
				</form> 
            </div>
        </div>
    </div>
</div>
<!-- FIN DEL MODAL PARA MODDIFICAR CITAS -->

