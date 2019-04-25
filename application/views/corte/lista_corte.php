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
		            <div class="box-body">
		            	
			        </div>
			    </div>
			    <div class="box">
					<div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th><center>Folio</center></th>
									<th><center>Nombre Paciente</center></th>
									<th><center>Fecha Cita</center></th>
									<th><center>Hora Cita</center></th>
									<th><center>Costo Consulta</center></th>
									<th class="no-sort"><center>Opciones</center></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$total_corte = 0;
								if($DATA_CITAS != FALSE) {
									foreach ($DATA_CITAS->result() as $row) 
									{
										$total_corte = $total_corte + $row->costo_consulta;
								?>
									<tr id="tr_<?= $row->id_cita; ?>" name="tr_<?= $row->id_cita; ?>" >
										<td><center><?= $row->id_cita;?></center></td>
										<td><center><?= $row->nombre_cliente;?></center></td>
										<td><center><?= $row->fecha ?></center></td>
										<td><center><?= date('h:i:s a', strtotime($row->hora))?></center></td>
										<td><center><?='$'.number_format($total_corte,2,'.', ',')?></center></td>
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
									}
								} ?>
								
							</tbody> 
							<tr>
								<th colspan="4" style="text-align: right;">Total</th>
								<th><center><?='$'.number_format($total_corte,2,'.', ',')?></center></th>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
