<script>var base_url = '<?php echo base_url() ?>';</script>

<div class="content-wrapper">
	<section class="content-header">
      <h1>
        ALTA DE PACIENTES DEL SISTEMA
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url()?>index.php/main"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="<?=base_url()?>clientes">Pacientes</a></li>
      </ol>
    </section>
	<section class="content">
		<div class="row">
	        <div class="col-xs-12">
		        <div class="box">
		        	<div class="panel panel-primary">
						<div class="panel-heading"><center><h4>AGREGAR PACIENTES</h4></center></div>
					</div>
					<div class="box-body">
						<form class="form-horizontal" name="agregar_cliente" id="agregar_cliente">
				 			<div class="form-group">				 				
						 		<div class="col-lg-4">	
						 			<label>Nombre:</label>
									<input type="text" class="form-control" required id="txt_nombre" name="txt_nombre" placeholder="Escriba el nombre del cliente" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
						 		</div>

						 		<div class="col-lg-4">
						 			<label>Telefono (Opcional):</label>
									<input type="text" class="form-control" id="txt_telefono" name="txt_telefono" placeholder="Escriba su numero telefonico" maxlength="12" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">
						 		</div>
						 	</div>
						 	<div class="form group" style="margin-left: -15px">
						 		<div class="col-lg-4">
						             	<label>Fecha de nacimento (Opcional):</label>
						                <div class="input-group">
						             		<span class="input-group-addon">
										        <i class="fa fa-calendar"></i>
										    </span>
										    <input type="date" class="form-control" id="txt_fecha_cliente_agregar" name="txt_fecha_cliente_agregar">
										    
						             	</div>
						                <!--<div class="input-group date">
							                <div class="input-group-addon">
							                	<i class="fa fa-calendar"></i>
							                </div>
							                <input type="text" class="form-control pull-right" id="txt_fecha" name="txt_fecha" required="true" autocomplete="off" placeholder="yyyy-mm-dd">
						                </div>-->
						                <!-- /.input group -->
						            </div>
						 		<div class="col-lg-4" style="margin-left: 3px">
						 			<label>Correo: (Opcional)</label>
									<input type="email" class="form-control" id=txt_user name="txt_user" placeholder="example@example.com" maxlength="150">
						 		</div>					 			
						 	</div>
						 	<br/><br/><br/><br/>

						 	<div class="row col-lg-3" style="margin-top: 15px;">
						 		<button type="submit" class="btn btn-primary">Guardar Paciente</button>
						 		<a type="button" href="<?=base_url()?>index.php/clientes" class="btn btn-default">Cancelar</a>
						 	</div>
					 	</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>