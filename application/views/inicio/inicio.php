<?php
	$nombre = $this->session->userdata('nombre').' '.$this->session->userdata('apellido_p').' '.$this->session->userdata('apellido_m');

	
?>

	
<div class="content-wrapper">
	<section class="content">
		<div class="row">
   			<div class="col-lg-12">
				<div class="col-lg-12 bg-info">
					<div class="box box-solid">
						<div class="box-header with-border">
							<center> 
								<h3 class="box-title display-3">Bienvenido a Control de Citas</h3> <h3 class="Display-3"><?= $nombre; ?></h3>	
							</center>
						</div>									
						<div class="box-body" id="caja">
							<a href="<?=base_url()?>/Main/test">test</a>
							<script type="text/javascript">
								print("<?=base_url()."doc.pdf"?>");
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>



