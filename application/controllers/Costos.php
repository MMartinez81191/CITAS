<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Costos extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Costos_model');
	} 

	public function index()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->session->userdata('logueado') == TRUE)
			{
				$data = array(
					'DATA_COSTOS' => $this->Costos_model->get_costos(),
				);

				$this->load->view('headers/librerias');
				$this->load->view('headers/menu');
				$this->load->view('costos/lista_costos',$data);
				$this->load->view('footers/librerias');
				$this->load->view('footers/cargar_js');
			}else
			{
				$script = '';
				$this->load->view('inicio/login',$script);
			}
		}else
		{
			redirect(base_url());
		}
	}

	public function crear_costos()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request())
			{
				$response = TRUE;
				$costo = trim($this->input->post('costo'));
				$confirmar_repetido = $this->Costos_model->comprobar_repetidos($costo);
				if($confirmar_repetido == FALSE)
				{
					$data = array(				
						'costo' => trim($this->input->post('costo')),
					);
					$this->Costos_model->insert_costos($data);
					$response = FALSE;
				}
				else
				{
					$response = TRUE;
				}
				echo json_encode($response);
			}else
			{
	            show_404();
	        }
        }else
		{
			redirect(base_url());
		}
	}

	public function eliminar_costos()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request())
			{
				$id_costo = $this->input->post('id_costo');
				$this->Costos_model->delete_costos($id_costo);
			}
			else
			{
	            show_404();
	        }
        }else
		{
			redirect(base_url());
		}
	}

	public function seguridad()
	{
		if(($this->session->userdata('logueado') == 1) and ($this->session->userdata('nivel') < 5))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
