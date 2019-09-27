<?php
	$nivel = $this->session->userdata('nivel');
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1 class="Display1">
			CORTE DE CAJA
		</h1>
		<ol class="breadcrumb">
			<li><u><a href="<?=base_url()?>index.php/main"><i class="fa fa-dashboard"></i> Inicio</a></u></li>
			<li><u><a href="#">Corte</a></u></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
			  	<div class="box">
				    <div class="box-header">
				    	<div class="row">
				    		<div class="col-xs-12">
								<div class="nav-tabs-custom">
									<ul class="nav nav-tabs">
										<li class="active" id="pestania_1" name="pestania_1"><a href="#tab_1" data-toggle="tab">Filtro por dia</a></li>
										
										<?php
										if($nivel == 1)
										{
										?>

										<li id="pestania_2" name="pestania_2"><a href="#tab_2" data-toggle="tab">Filtro por mes</a></li>
										<li id="pestania_3" name="pestania_3"><a href="#tab_3" data-toggle="tab">Filtro por año</a></li>
										<li id="pestania_4" name="pestania_4"><a href="#tab_4" data-toggle="tab">Citas pendientes de registrar</a></li>
										
										<?php
										}
										?>
										<li id="pestania_5" name="pestania_5"><a href="#tab_5" data-toggle="tab">Gastos, devoluciones y carnets</a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane  active" id="tab_1">
											<div class="row">
												<div class="col-xs-4">
													<div class="form-group">
														<label>Seleccionar Fecha:</label>
														<div class="input-group date">
															<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
															</div>
															<input type="date" class="form-control" id="txt_fecha_corte" name="txt_fecha_corte" required="true" value="<?=date('Y-m-d')?>" >
															<!--<input type="text" class="form-control pull-right" id="txt_fecha" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask placeholder="yyyy-mm-dd">-->
														</div>
													</div>
													<div class="form-group">
														<button id="busqueda_dia" name="busqueda_dia" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
														<button style="display: none;" id="imprimir_dia" name="imprimir_dia" class="btn btn-default" ><i class="fa fa-print"></i> Imprimir</button>
													</div>

												</div>
											</div>
										</div>

										<?php
										if($nivel < 5)
										{
										?>
										<div class="tab-pane" id="tab_2">
											<div class="row">
												<div class="col-xs-4">
													<div class="form-group">
														<label>Seleccione el Mes:</label>
														<select id="select_mes_mes" name="select_mes_mes" class="select2" style="width: 100%;">
															<option value="1">Enero</option>
															<option value="2">Febrero</option>
															<option value="3">Marzo</option>
															<option value="4">Abril</option>
															<option value="5">Mayo</option>
															<option value="6">Junio</option>
															<option value="7">Julio</option>
															<option value="8">Agosto</option>
															<option value="9">Septiembre</option>
															<option value="10">Octubre</option>
															<option value="11">Noviembre</option>
															<option value="12">Diciembre</option>
														</select>
													</div>
													<div class="form-group">
														<label>Seleccione el Año</label>
														<select class="select2" id="select_mes_anio" name="select_mes_anio" style="width: 100%;">
															<?php
															if($DATA_ANIOS != FALSE)
															{
																foreach ($DATA_ANIOS->result() as $row) 
																{
																	echo '<option value="'.$row->anio.'">'.$row->anio.'</option>';
																}
															}
															?>
														</select>
													</div>
													<div class="form-group">
														<button id="busqueda_mes" name="busqueda_mes" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
														<button id="imprimir_mes" name="imprimir_mes" class="btn btn-default" ><i class="fa fa-print"></i> Imprimir</button>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab_3">
											<div class="row">
												<div class="col-xs-4">
													<div class="form-group">
														<label>Seleccione el Año:</label>
														<select id="select_anio_anio" name="select_anio_anio" class="select2" style="width: 100%;">
															<?php
															if($DATA_ANIOS != FALSE)
															{
																foreach ($DATA_ANIOS->result() as $row) 
																{
																	echo '<option value="'.$row->anio.'">'.$row->anio.'</option>';
																}
															}
															?>
														</select>
													</div>
													<div class="form-group">
														<button id="busqueda_anio" name="busqueda_anio" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
														<button id="imprimir_anio" name="imprimir_anio" class="btn btn-default" ><i class="fa fa-print"></i> Imprimir</button>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab_4">
											<div class="row">
												<div class="col-xs-4">
													<div class="form-group">
														<label>Seleccione el Mes:</label>
														<select id="select_pendientes_mes" name="select_pendientes_mes" class="select2" style="width: 100%;">
															<option value="1">Enero</option>
															<option value="2">Febrero</option>
															<option value="3">Marzo</option>
															<option value="4">Abril</option>
															<option value="5">Mayo</option>
															<option value="6">Junio</option>
															<option value="7">Julio</option>
															<option value="8">Agosto</option>
															<option value="9">Septiembre</option>
															<option value="10">Octubre</option>
															<option value="11">Noviembre</option>
															<option value="12">Diciembre</option>
														</select>
													</div>
													<div class="form-group">
														<label>Seleccione el Año</label>
														<select class="select2" id="select_pendientes_anio" name="select_pendientes_anio" style="width: 100%;">
															<?php
															if($DATA_ANIOS != FALSE)
															{
																foreach ($DATA_ANIOS->result() as $row) 
																{
																	echo '<option value="'.$row->anio.'">'.$row->anio.'</option>';
																}
															}
															?>
														</select>
													</div>
													<div class="form-group">
														<button id="busqueda_pendientes" name="busqueda_pendientes" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
														<button id="imprimir_pendientes" name="imprimir_pendientes" class="btn btn-default" ><i class="fa fa-print"></i> Imprimir</button>
													</div>
												</div>
											</div>
										</div>
										<?php
										}
										?>
										<div class="tab-pane" id="tab_5">
											<div class="row">
									          	<div class="box">
										            <div class="box-header">
										            	<h3>Gastos</h3>
										            	<div class="col-lg-offset-10">
										              		<button class="btn btn-primary" data-toggle="modal" data-target="#modal_agregar_gasto"><i class="fa fa-plus"></i> Agregar Gasto</button>
										              	</div>
											        </div>
											    </div>
										        <div class="box">
													<div class="box-body table-responsive">
														<table id="example1" class="table table-bordered table-striped">
															<thead>
																<tr>
																	
																	<th><center>Fecha Gasto</center></th>
																	<th><center>Concepto</center></th>
																	<th><center>Importe</center></th>
																	<th class="no-sort"><center>Opciones</center></th>
																</tr>
															</thead>
															<tbody>
																<?php if($DATA_GASTO != FALSE) {
																	foreach ($DATA_GASTO->result() as $row) {
																?>
																	<tr id="tr_<?= $row->id_gasto; ?>" name="tr_<?= $row->id_gasto; ?>" >
																		<td><center><?= $row->fecha;?></center></td>
																		<td><center><?= $row->concepto ?></center></td>
																		<td><center><?='$'.number_format($row->importe,2,'.', ',')?></center></td>
																		<td>
																			<center>
																				<button data-id="<?= $row->id_gasto; ?>" class="btn btn-danger eliminar_gasto" title="Eliminar Gasto" data-toggle="tooltip" data-placement="top">  <i class="fa fa-close"></i></button>
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
											<div class="row">
												<div class="box box-primary">
										            <div class="box-header">
										            	<h3>Devoluciones</h3>
										            	<div class="col-lg-offset-10">
										              		<button class="btn btn-primary" data-toggle="modal" data-target="#modal_agregar_devoluciones"><i class="fa fa-plus"></i> Agregar Devolucion</button>															
									              		</div>
											        </div>
											    </div>
											    <br>
											    <br>
										        <div class="box box-primary">
													<div class="box-body table-responsive">
														<table id="example1" class="table table-bordered table-striped">
															<thead>
																<tr>
																	
																	<th><center>Fecha Devolucion</center></th>
																	<th><center>Cliente</center></th>
																	<th><center>Importe</center></th>
																	<th class="no-sort"><center>Opciones</center></th>
																</tr>
															</thead>
															<tbody>
																<?php if($DATA_DEVOLUCION != FALSE) {
																	foreach ($DATA_DEVOLUCION->result() as $row) {
																?>
																	<tr id="tr_<?= $row->id_devolucion; ?>" name="tr_<?= $row->id_devolucion; ?>" >
																		<td><center><?= $row->fecha;?></center></td>
																		<td><center><?= $row->nombre_cliente ?></center></td>
																		<td><center><?='$'.number_format($row->importe,2,'.', ',')?></center></td>
																		<td>
																			<center>
																				<button data-id="<?= $row->id_devolucion; ?>" class="btn btn-danger eliminar_devolucion" title="Eliminar Devolucion" data-toggle="tooltip" data-placement="top">  <i class="fa fa-close"></i></button>
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
											<div class="row">
												<div class="box">
										            <div class="box-header">
										            	<h3>Venta de carnets</h3>
										            	<div class="col-lg-offset-10">
										              		<button class="btn btn-primary" data-toggle="modal" data-target="#modal_agregar_venta_carnet"><i class="fa fa-plus"></i> Agregar Venta Carnet</button>
										              	</div>
											        </div>
											    </div>
										        <div class="box">
													<div class="box-body table-responsive">
														<table id="example1" class="table table-bordered table-striped">
															<thead>
																<tr>
																	<th><center>Fecha venta</center></th>
																	<th><center>Paciente</center></th>
																	<th><center>Numero carnets vendidos</center></th>
																	<th><center>Importe</center></th>
																	<th class="no-sort"><center>Opciones</center></th>
																</tr>
															</thead>
															<tbody>
																<?php if($DATA_VENTA_CARNETS != FALSE) {
																	foreach ($DATA_VENTA_CARNETS->result() as $row) {
																?>
																	<tr id="tr_<?= $row->id_venta; ?>" name="tr_<?= $row->id_venta; ?>" >
																		<td><center><?= $row->fecha;?></center></td>
																		<td><center><?= $row->nombre_cliente ?></center></td>
																		<td><center><?= $row->numero_carnets_vendidos ?></center></td>
																		<td><center><?= '$'.number_format(($row->numero_carnets_vendidos * 20),2,'.', ',')?></center></td>
																		<td>
																			<center>
																				<button data-id="<?= $row->id_venta; ?>" class="btn btn-danger eliminar_venta_carnet" title="Eliminar Venta Carnet" data-toggle="tooltip" data-placement="top">  <i class="fa fa-close"></i></button>
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
									</div>
								</div>
				    		</div>
				    	</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12">
				<div class="box">
					<div id="tabla_citas" name="tabla_citas" class="box-body table-responsive">

					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<!-- MODAL PARA AGERGAR GASTO-->
<div class="modal fade" id="modal_agregar_gasto" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" >
            <div class="modal-header">
            	<center><h3 class="modal-title">Agregar Gastos</h3></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <hr>    
            </div>
            <div class="modal-body">
	            <form  name="agregar_gasto" id="agregar_gasto">
			 		<div class="form-group">
			 			<label>Fecha:</label>
		             	<div class="input-group">
		             		<span class="input-group-addon">
						        <i class="fa fa-calendar"></i>
						    </span>
						    <input type="date" class="form-control" id="txt_fecha_gasto" name="txt_fecha_gasto" required="true" value="<?=date('Y-m-d')?>" >
		             	</div>
			 		</div>
			 		<div class="form-group">	
			 			<label >Concepto:</label>
						<input type="text" class="form-control" required id="txt_concepto_gasto" name="txt_concepto_gasto" placeholder="Descripcion breve del gasto" maxlength="50" onKeyUp="this.value=this.value.toUpperCase();" required="true">
			 		</div>
			 		<div class="form-group">
			 			<label >Importe:</label>
						<input type="text" class="form-control" id="txt_importe_gasto" name="txt_importe_gasto" placeholder="Escriba el importe del gasto" maxlength="12" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required="true">
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
<!-- FIN DEL MODAL PARA AGREGAR GASTO -->

<!-- MODAL PARA AGERGAR DEVOLUCIONES-->
<div class="modal fade" id="modal_agregar_devoluciones" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" >
            <div class="modal-header">
            	<center><h3 class="modal-title">Agregar Devoluciones</h3></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <hr>    
            </div>
            <div class="modal-body">
	            <form  name="agregar_devolucion" id="agregar_devolucion">
			 		<div class="form-group">
			 			<label>Fecha:</label>
		             	<div class="input-group">
		             		<span class="input-group-addon">
						        <i class="fa fa-calendar"></i>
						    </span>
						    <input type="date" class="form-control" id="txt_fecha_devolucion" name="txt_fecha_devolucion" required="true" value="<?=date('Y-m-d')?>" >
		             	</div>
			 		</div>
			 		<div class="form-group">
	                	<label>Nombre Paciente:</label>
	                	<select id="select_cliente_devolucion" name="select_cliente_devolucion" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required="true">
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
			 		<div class="form-group">
			 			<label >Importe:</label>
						<input type="text" class="form-control" id="txt_importe_devolucion" name="txt_importe_devolucion" placeholder="Escriba el importe de la devolucion" maxlength="12" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required="true">
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
<!-- FIN DEL MODAL PARA AGREGAR DEVOLUCIONES -->

<!-- MODAL PARA AGERGAR VENTA DE CARNETS-->
<div class="modal fade" id="modal_agregar_venta_carnet" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content" >
            <div class="modal-header">
            	<center><h3 class="modal-title">Agregar venta carnets</h3></center>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <hr>    
            </div>
            <div class="modal-body">
	            <form  name="agregar_venta_carnets" id="agregar_venta_carnets">
			 		<div class="form-group">
			 			<label>Fecha:</label>
		             	<div class="input-group">
		             		<span class="input-group-addon">
						        <i class="fa fa-calendar"></i>
						    </span>
						    <input type="date" class="form-control" id="txt_fecha_venta_carnets" name="txt_fecha_venta_carnets" required="true" value="<?=date('Y-m-d')?>" >
		             	</div>
			 		</div>
			 		<div class="form-group">
	                	<label>Nombre Paciente:</label>
	                	<select id="select_cliente_venta_carnets" name="select_cliente_venta_carnets" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" required="true">
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
			 		<div class="form-group">
			 			<label >Numero carnets:</label>
						<input type="text" class="form-control" id="txt_numero_venta_carnets" name="txt_numero_venta_carnets" placeholder="Escriba el importe de la devolucion" maxlength="12" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required="true">
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
<!-- FIN DEL MODAL PARA AGREGAR VENTA DE CARNETS -->

<script type="text/javascript">
	var base_url = '<?=base_url()?>';
</script>
