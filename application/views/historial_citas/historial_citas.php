<div class="content-wrapper">
	<section class="content-header">
      <h1 class="Display1">
        HISTORIAL DE CITAS POR PACIENTE
      </h1>
      <ol class="breadcrumb">
        <li><u><a href="<?=base_url()?>index.php/main"><i class="fa fa-dashboard"></i> Inicio</a></u></li>
        <li><u><a href="<?=base_url()?>Citas">Citas</a></u></li>
        <li><u><a href="#">Historial</a></u></li>
      </ol>
    </section>
	<section class="content">
		<div class="row">
	        <div class="col-xs-12">
		        <div class="box">
					<div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th><center>Tipo Cita</center></th>
									<th><center>Fecha</center></th>
									<th><center>Hora</center></th>
									<th><center>Costo</center></th>
									<th class="no-sort"><center>Opciones</center></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								if($DATA_CITAS != FALSE) 
								{
									foreach ($DATA_CITAS->result() as $row) 
									{
								?>
									<tr>
										<td><center><?= $row->tipo_cita;?></center></td>
										<td><center><?=date('d-m-Y', strtotime($row->fecha));?></center></td>
										<td><center><?=date('h:i a', strtotime($row->hora));?></center></td>
										<td><center><?php 
										if($row->costo_consulta != -1)
										{
											echo $row->costo_consulta;
										}
										else
										{
											echo '0.00';
										}
										?></center></td>
										<td><center><a type="button" class="btn btn-default" href="<?=base_url()?>historial_citas/cargar_detalle_cita/<?=$row->id_cita?>"><i class="fa fa-eye"></i> Ver Detalle</a></center></td>
									</tr>
								<?php
									}
								} 
								?>
							</tbody> 
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>