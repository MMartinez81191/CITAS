<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Corte extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Corte_model');
		//$this->load->model('Citas_model');
		//$this->load->model('Clientes_model');
	} 

	public function index()
	{
		
		if($this->session->userdata('logueado') == TRUE)
		{
			$data = array(
				'DATA_CITAS' => $this->Corte_model->get_citas(),
				//'DATA_CLIENTES' => $this->Clientes_model->get_clientes(),
			);

			$this->load->view('headers/librerias');
			$this->load->view('headers/menu');
			$this->load->view('corte/lista_corte',$data);
			$this->load->view('footers/librerias');
		}else
		{
			$script = '';
			$this->load->view('inicio/login',$script);
		}
	}


	
}
