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
		              		<a type="button" class="btn btn-block btn-primary" href="<?=base_url()?>index.php/Corte_Parcial"><i class="fa fa-arrow-left"></i> Regresar</a>
		              	</div>
			        </div>
			    </div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
			  	<div class="box">
				    <div class="box-header">
				    	<div class="row">
				    		<div class="col-xs-12">
				    			<form id="recuperar_cantidades" name="recuperar_cantidades">
				    				<div class="form-group">
				    					<label>Fecha Inicial:</label>
				    					<input class="form-control" id="txt_fecha" name="txt_fecha" type="text">

				    				</div>
				    				<div class="form-group">
				    					<label>Fecha Final:</label>
				    					<input class="form-control" id="txt_fecha2" name="txt_fecha2" type="text">
				    				</div>
				    				<div class="form-group">
				    					<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
				    					<button type="cancel" class="btn btn-default"><i class="fa fa-close"></i> Cancelar</button>
				    				</div>
				    			</form>
				    		</div>
				    	</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<form id="generar_corte" name="generar_corte">
							<div class="form-group">
								<label>Cantidad Recaudada:</label>
								<input type="text" class="form-control" id="cantidad_recaudada" name="cantidad_recaudada" readonly="true">
							</div>
							<div class="form-group">
								<label>Cantidad Fisica:</label>
								<input type="text" class="form-control" id="cantidad_fisica" name="cantidad_fisica" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" maxlength="12" required="true">
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary"><i class="fa fa-calculator"></i> Generar Corte</button>
								<button type="cancel" class="btn btn-default"><i class="fa fa-close"></i> Cancelar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<script type="text/javascript">
	var base_url = '<?=base_url()?>';
</script>
