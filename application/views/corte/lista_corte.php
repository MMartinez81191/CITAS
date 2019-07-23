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
										<li class="active" id="pestania_1" name="pestania_1"><a href="#tab_1" data-toggle="tab">Filtro Por Dia</a></li>
										
										<?php
										if($nivel < 5)
										{
										?>

										<li id="pestania_2" name="pestania_2"><a href="#tab_2" data-toggle="tab">Filtro Por Mes</a></li>
										<li id="pestania_3" name="pestania_3"><a href="#tab_3" data-toggle="tab">Filtro Por Año</a></li>
										<li id="pestania_4" name="pestania_4"><a href="#tab_4" data-toggle="tab">Citas Pendientes de Registrar</a></li>
										
										<?php
										}
										?>
									</ul>
									<div class="tab-content">
										<div class="tab-pane active" id="tab_1">
											<div class="row">
												<div class="col-xs-4">
													<div class="form-group">
														<label>Seleccionar Fecha:</label>
														<div class="input-group date">
															<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
															</div>
															<input type="text" class="form-control pull-right" id="txt_fecha" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask placeholder="yyyy-mm-dd">
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

<script type="text/javascript">
	var base_url = '<?=base_url()?>';
</script>
