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
						<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						  <div class="panel panel-default">
						    <div class="panel-heading" role="tab" id="headingOne">
					    		<h4 class="panel-title">
							        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							        	<b><?=$DATA_CLIENTE->nombre_cliente?></b>
							        </a>
					      		</h4>
						    </div>
						    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne" collapsed="true">
						      	<div class="panel-body">
        							<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
												<label>Nombre Paciente:</label>
												<input type="type" class="form-control" id="txt_nombre_cliente" name="txt_nombre_cliente" readonly="true" value="<?=$DATA_CLIENTE->nombre_cliente?>">
											</div>
										</div>
										<div class="col-lg-6">
											<div class="form-group">
												<label>Tipo de cita:</label>
												<input type="type" class="form-control" id="txt_tipo_cita" name="txt_tipo_cita" readonly="true" value="<?=$DATA_CITA->tipo_cita?>" autocomplete="off">
											</div>
										</div>
									</div>
						      	</div>
						    </div>
						  </div>
						</div>

						<form name="actualizar_informacion" id="actualizar_informacion">
							<input type="hidden" id="txt_id_cita" name="txt_id_cita" value="<?=$DATA_CITA->id_cita?>">
							<input type="hidden" id="txt_id_cliente" name="txt_id_cliente" value="<?=$DATA_CLIENTE->id_cliente?>">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label>Enfermedades Paciente (Opcional):</label>
										<input type="text" id="txt_enfermedades_paciente" name="txt_enfermedades_paciente" placeholder="Escriba las enfermedades que padece el paciente" class="form-control" autocomplete="off" value="<?=$DATA_CLIENTE->enfermedades?>">
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Alimentos No Consumidos (Opcional):</label>
										<input id="txt_alimentos_no_consumidos" name="txt_alimentos_no_consumidos" placeholder="Escriba los alimentos no consumidos por el paciente" class="form-control" autocomplete="off" value="<?=$DATA_CLIENTE->alimentos_no_consumidos?>"/>
									</div>
								</div>
							</div>
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
										<input id="txt_dieta" name="txt_dieta" type="text" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Escriba la dieta indicada para el paciente" required="true" value="<?=$DATA_CITA->dieta?>" autocomplete="off"/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label>Indicaciones (Opcional):</label>
										<input type="text" id="txt_idicaciones" name="txt_idicaciones" class="form-control" placeholder="Escriba las indicaciones para el paciente" autocomplete="off" value="<?=$DATA_CITA->indicaciones?>" />
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>Notas Relevantes (Opcional):</label>
										<input type="text" name="txt_notas_relevantes" id="txt_notas_relevantes" class="form-control" placeholder="Escriba informacion relevante de la consulta" autocomplete="off" value="<?=$DATA_CITA->notas_relevantes?>"/>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Guardar</button>
									<a class="btn btn-primary" href="<?=base_url()?>/citas"><i class="fa fa-close"></i> Cancelar</a>
								</div>
							</div>
						</form>
						<hr/>
					    <h3><b>Historial Citas Previas</b></h3>
					    <hr/>
						<div class="row">
							<?php
							if($DATA_CITAS_PREVIAS != FALSE)
							{
								$numero_cita = 1;
								$i = 1;
								foreach ($DATA_CITAS_PREVIAS->result() as $row) 
								{
									if($i == 4)
									{
										echo '<div class="row">';
									}
									
									echo '<div class="col-md-3">';
									echo '<div class="list-group">
											<a href="#" class="list-group-item active"><center>CONSULTA '.$numero_cita.'</center></a>
											<a href="#" class="list-group-item">P.A:'.number_format($row->peso,2,'.', ',').' Kg</a>
											<a href="#" class="list-group-item">G.A:'.$row->dieta.'</a>
											<a href="#" class="list-group-item">NR:'.$row->notas_relevantes.'</a>
											<a href="#" class="list-group-item">Fecha:'.date('d-m-Y', strtotime($row->fecha)).'</a>
										</div>';	
									echo '</div>';
									if($i == 4){
										echo '</div>';
										$i = 1;
									}
									else
									{
										$i++;
									}
									$numero_cita++;
								}
							}
							?>
						</div>		
					</div>
				</div>
			</div>
		</div>
	</section>
</div>