<div class="content-wrapper">
	<section class="content-header">
		<h1 class="Display1">
			CORTE PARCIAL
		</h1>
		<ol class="breadcrumb">
			<li><u><a href="<?=base_url()?>index.php/main"><i class="fa fa-dashboard"></i> Inicio</a></u></li>
			<li><u><a href="#">Corte Parcial</a></u></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
	          	<div class="box">
		            <div class="box-header">
		            	<div class="col-lg-offset-10">
		              		<a type="button" class="btn btn-block btn-primary" href="<?=base_url()?>index.php/Corte_Parcial/realizar_corte"><i class="fa fa-money"></i> Realizar Corte</a>
		              	</div>
			        </div>

			    </div>
			    <div class="box">
			    	<div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th><center>Numero de Corte</center></th>
									<th><center>Total Corte</center></th>
									<th><center>Fecha de Inicio Corte</center></th>
									<th><center>Fecha Final de Corte</center></th>
									<th class="no-sort"><center>Opciones</center></th>
								</tr>
							</thead>
							<tbody>
								<?php if($DATA_CORTES != FALSE) {
									foreach ($DATA_CORTES->result() as $row) {
								?>
									<tr id="tr_<?=$row->numero_session;?>" name="tr_<?=$row->numero_session;?>" >
										<td><center><?= $row->numero_session;?></center></td>
										<td><center>
											<?='$'.number_format($row->total_corte,2,'.', ',')?>
										</center></td>
										<td>
											<center>
											<?php
												$fecha_inicio_corte = date("d-m-Y", strtotime($row->fecha_inicio_corte));
												echo $fecha_inicio_corte;
											?>
											</center>
										</td>
										<td>
											<center>
											<?php
												$fecha_final_corte = date("d-m-Y", strtotime($row->fecha_final_corte));
												echo $fecha_final_corte;
											?>
											</center>
										</td>
										<td>
											<center>
												<a href="<?=base_url()?>Corte_Parcial/imprimir_corte" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Imprimir Corte" target="_blanck"><i class="fa fa-print"></i><span></span></a>
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
		<div class="row">

		</div>
	</section>
</div>

<script type="text/javascript">
	var base_url = '<?=base_url()?>';
</script>
