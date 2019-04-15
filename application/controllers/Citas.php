<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Citas extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Citas_model');
		$this->load->model('Clientes_model');
	} 

	public function index()
	{
		
		if($this->session->userdata('logueado') == TRUE)
		{
			$data = array(
				'DATA_CITAS' => $this->Citas_model->get_citas(),
				'DATA_CLIENTES' => $this->Clientes_model->get_clientes(),
			);

			$this->load->view('headers/librerias');
			$this->load->view('headers/menu');
			$this->load->view('citas/lista_citas',$data);
			$this->load->view('footers/librerias');
		}else
		{
			$script = '';
			$this->load->view('inicio/login',$script);
		}
	}


	public function crear_cita()
	{
		if($this->input->is_ajax_request()){
			$hora = trim($this->input->post('txt_hora'));
			$data = array(				
				'id_cliente' => trim($this->input->post('id_cliente')),
				'fecha' => trim($this->input->post('txt_fecha')),
				'hora' => date("H:i", strtotime($hora)),
				'activo' => 1,
			);
			$this->Citas_model->insert_citas($data);
			echo json_encode($data);
		}else{
            show_404();
        }
	}

	public function eliminar_cita()
	{
		if($this->input->is_ajax_request()){

			$id_cita = $this->input->post('id_cita');
			$data = array(
				'activo' => 0, 
			);
			$this->Citas_model->delete_citas($id_cita,$data);
			
		}
		else
		{
            show_404();
        }
	}
}
