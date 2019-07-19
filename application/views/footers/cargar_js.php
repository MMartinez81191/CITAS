<?php
		$_curController = $this->router->fetch_class();
		$_curAction = $this->router->fetch_method();
		
		switch ($_curController) {

		    case 'usuarios':
			    echo '<script src="'.base_url().'js/usuarios/usuarios.js"></script>';
		    break;

		    case 'clientes':
			    echo '<script src="'.base_url().'js/clientes/clientes.js"></script>';
		    break;

		    case 'citas':
			    echo '<script src="'.base_url().'js/citas/citas.js"></script>';
		    break;

		    case 'corte':
			    echo '<script src="'.base_url().'js/corte/corte.js"></script>';
		    break;

		    case 'costos':
			    echo '<script src="'.base_url().'js/costos/costos.js"></script>';
		    break;
		    
		    case 'Corte_Parcial':
			    echo '<script src="'.base_url().'js/corte_parcial/corte_parcial.js"></script>';
		    break;

		    
	    }
	    echo '<script src="'.base_url().'js/main/main.js"></script>';
		?>
		<script>var base_url = '<?php echo base_url() ?>';</script>

	</body>
</html>