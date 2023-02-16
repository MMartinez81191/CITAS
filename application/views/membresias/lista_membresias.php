<div class="content-wrapper">
	<section class="content-header">
		<h1 class="Display1">
			RELACION MEMBRESIAS
		</h1>
		<ol class="breadcrumb">
			<li><u><a href="<?=base_url()?>index.php/main"><i class="fa fa-dashboard"></i> Inicio</a></u></li>
			<li><u><a href="#">Membresias</a></u></li>
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
									<th><center>Numero Membresia</center></th>
									<th><center>Nombre Paciente</center></th>
									<th><center>Membresias Usuadas</center></th>
									<th><center>Fecha</center></th>
									<th class="no-sort"><center>Opciones</center></th>
								</tr>
							</thead>
							<tbody>
								<?php if($DATA_MEMBRESIAS != FALSE) {
									foreach ($DATA_MEMBRESIAS->result() as $row) {
								?>
									<tr id="tr_<?= $row->numero_membresia;?>" name="tr_<?= $row->numero_membresia;?>" >
										<td><center><?= $row->numero_membresia;?></center></td>
										<td><?= $row->nombre_cliente;?></td>
										<td><center><?= $row->membresias_usadas; ?></center></td>
										<td><center><?= $row->fecha; ?></center></td>
										<td>
											<center>
												<button data-id="<?= $row->numero_membresia; ?>" class="btn btn-danger cancelar_membresia" title="Cancelar Membresia" data-toggle="tooltip" data-placement="top">  <i class="fa fa-close"></i></button>
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