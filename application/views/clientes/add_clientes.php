<script>var base_url = '<?php echo base_url() ?>';</script>
<script type="text/javascript">
	function mess() {
		var pass = document.getElementById("password").value;
		var conpas = document.getElementById("confir_password").value;

		if (pass != conpas) {
			swal("Error!", "Contraseñas no coinciden!", "warning");
			return false;
		}else{
			return true;
		}
	}
</script>
<div class="content-wrapper">
	<section class="content-header">
      <h1>
        CREACIÓN DE CLIENTES DEL SISTEMA
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?=base_url()?>index.php/main"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="<?=base_url()?>clientes">Clientes</a></li>
      </ol>
    </section>
	<section class="content">
		<div class="row">
	        <div class="col-xs-12">
		        <div class="box">
		        	<div class="panel panel-primary">
						<div class="panel-heading"><center><h4>AGREGAR CLIENTES</h4></center></div>
					</div>
					<div class="box-body">
						<form class="form-horizontal" onsubmit="return mess()" name="agregar_cliente" id="agregar_cliente">
				 			<div class="form-group">				 				
						 		<div class="col-lg-2">	
						 			<label>Nombre:</label>
									<input type="text" class="form-control" required id="txt_nombre" name="txt_nombre" placeholder="NOMBRE" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
						 		</div>

						 		<div class="col-lg-2">
						 			<label>Telefono:</label>
									<input type="text" class="form-control" required id="txt_telefono" name="txt_telefono" placeholder="TELEFONO" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
						 		</div>
						 	</div>
						 	<div class="form group" style="margin-left: -15px">
						 		<div class="col-lg-2">
						 			<label>Fecha de nacimiento:</label>
									<input type="text" class="form-control" id="txt_fecha_nacimiento" name="txt_fecha_nacimiento" placeholder="" maxlength="150" onKeyUp="this.value=this.value.toUpperCase();">
						 		</div>

						 		<div class="col-lg-2" style="margin-left: 3px">
						 			<label>Correo:</label>
									<input type="email" class="form-control" id=txt_user name="txt_user" placeholder="CORREO ELECTRONICO" maxlength="150" required>
						 		</div>					 			
						 	</div>
						 	<br/><br/><br/><br/>

						 	<div class="row col-lg-3" style="margin-top: 15px;">
						 		<button type="submit" class="btn btn-primary">Guardar Cliente</button>
						 		<a type="button" href="<?=base_url()?>index.php/usuarios" class="btn btn-default">Cancelar</a>
						 	</div>
					 	</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>