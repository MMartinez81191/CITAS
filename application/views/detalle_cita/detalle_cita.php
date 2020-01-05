<?php
$fecha_nacimiento = date("d-m-Y", strtotime($DATA_CLIENTE->fecha_nacimiento));
$dias = explode("-",$fecha_nacimiento, 3);
$dias = mktime(0,0,0,$dias[1],$dias[0],$dias[2]);
$edad = (int)((time()-$dias)/31556926 );

if($DATA_CITA->costo_consulta != '-1')
{ 
	$costo_consulta = number_format($DATA_CITA->costo_consulta,2,'.', ',');
}
else
{
	$costo_consulta = '0.00';
}
?>

<div class="content-wrapper">
	<section class="content-header">
      <h1 class="Display1">
        DETALLE CITA
      </h1>
      <ol class="breadcrumb">
        <li><u><a href="<?=base_url()?>index.php/main"><i class="fa fa-dashboard"></i> Inicio</a></u></li>
        <li><u><a href="<?=base_url()?>citas">Citas</a></u></li>
        <li><u><a href="#">Detalle Citas</a></u></li>
      </ol>
    </section>
	<section class="content">
		<div class="row">
	        <div class="col-xs-12">
		        <div class="box">
					<div class="box-body">
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>Nombre Paciente:</label>
									<input type="type" class="form-control" id="txt_nombre_cliente" name="txt_nombre_cliente" readonly="true" value="<?=$DATA_CLIENTE->nombre_cliente?>">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>Fecha Nacimiento:</label>
									<input type="type" class="form-control" id="txt_edad" name="txt_edad" readonly="true" value="<?=$edad.' '.'años'?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>Fecha Cita:</label>
									<input type="type" class="form-control" id="txt_fecha_cita" name="txt_fecha_cita" readonly="true" value="<?=date('d-m-Y', strtotime($DATA_CITA->fecha))?>">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>Hora Cita:</label>
									<input type="type" class="form-control" id="txt_hora_cita" name="txt_hora_cita" readonly="true" value="<?=date('h:i a', strtotime($DATA_CITA->hora))?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>Tipo de cita:</label>
									<input type="type" class="form-control" id="txt_tipo_cita" name="txt_tipo_cita" readonly="true" value="<?=$DATA_CITA->tipo_cita?>" autocomplete="off">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>Costo cita:</label>
									<input type="type" class="form-control" id="txt_costo_consulta" name="txt_costo_consulta" readonly="true" value="<?=$costo_consulta?>" autocomplete="off">
								</div>
							</div>
						</div>
						<hr/>
						<form name="actualizar_informacion" id="actualizar_informacion">
							<input type="hidden" id="txt_id_cita" name="txt_id_cita" value="<?=$DATA_CITA->id_cita?>">
							<input type="hidden" id="txt_id_cliente" name="txt_id_cliente" value="<?=$DATA_CLIENTE->id_cliente?>">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label>Enfermedades Paciente (Opcional):</label>
										<textarea id="txt_enfermedades_paciente" name="txt_enfermedades_paciente" placeholder="Escriba las enfermedades que padece el paciente" class="form-control" autocomplete="off"><?=$DATA_CLIENTE->enfermedades?></textarea>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Alimentos No Consumidos (Opcional):</label>
										<textarea id="txt_alimentos_no_consumidos" name="txt_alimentos_no_consumidos" placeholder="Escriba los alimentos no consumidos por el paciente" class="form-control" autocomplete="off"><?=$DATA_CLIENTE->alimentos_no_consumidos?></textarea>
									</div>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label>Peso en Kg:</label>
										<input name="txt_peso" id="txt_peso" type="text" class="form-control" maxlength="7" required="true" placeholder="Capture el peso en Kg del paciente" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" value="<?=$DATA_CITA->peso?>" autocomplete="off"/>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Dieta:</label>
										<input id="txt_dieta" name="txt_dieta" type="text" class="form-control" placeholder="Escriba la dieta indicada para el paciente" required="true" value="<?=$DATA_CITA->dieta?>" autocomplete="off"/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label>Indicaciones (Opcional):</label>
										<textarea id="txt_idicaciones" name="txt_idicaciones" class="form-control" placeholder="Escriba las indicaciones para el paciente" autocomplete="off"><?=$DATA_CITA->indicaciones?></textarea>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Notas Relevantes (Opcional):</label>
										<textarea name="txt_notas_relevantes" id="txt_notas_relevantes" class="form-control" placeholder="Escriba informacion relevante de la consulta" autocomplete="off"><?=$DATA_CITA->notas_relevantes?></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
									<button class="btn btn-primary" type="reset"><i class="fa fa-close"></i> Cancelar</button>
								</div>

							</div>
						</form>
						<div class="row">
							<hr/>
							<div class="col-xs-3"></div>
							<div class="col-xs-6">
								<center><h4>Historial Citas Previas</h4></center>
								<div class="table-responsive">
									<table id="example2" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th class="col-lg-4"><center>Fecha</center></th>
												<th class="col-lg-4"><center>Peso</center></th>
												<th class="col-lg-4"><center>Dieta</center></th>
											</tr>
										</thead>
										<tbody>
											<?php
											if($DATA_CITAS_PREVIAS != FALSE)
											{
												foreach ($DATA_CITAS_PREVIAS->result() as $row) 
												{
													echo '<tr>';
														echo '<td><center>'.date('d-m-Y', strtotime($row->fecha)).'</td></center>';

														echo '<td><center>'.number_format($row->peso,2,'.', ',').'</td></center>';

														echo '<td><center>'.$row->dieta.'</td></center>';
													echo '</tr>';
												}
											}
											?>
										</tbody> 
									</table>
								</div>
							</div>
							<div class="col-xs-3"></div>
						</div>		
					</div>
				</div>
			</div>
		</div>
	</section>
</div>