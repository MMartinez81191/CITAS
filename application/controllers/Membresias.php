<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membresias extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Membresias_model');
	} 

	public function index()
	{
		if($this->seguridad() == TRUE)
		{
			$data = array(
				'DATA_MEMBRESIAS' => $this->Membresias_model->get_membresias()
			);

			$this->load->view('headers/librerias');
			$this->load->view('headers/menu');
			$this->load->view('membresias/lista_membresias',$data);
			$this->load->view('footers/librerias');
			$this->load->view('footers/cargar_js');
		}else
		{
			redirect(base_url());
		}
		
	}

	public function seguridad()
	{
		if(($this->session->userdata('logueado') == 1) and ($this->session->userdata('nivel') < 4))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
