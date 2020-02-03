<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detalle_Cita extends CI_Controller {

	//============================================================================
	//CONSTRUCTOR DE LA CLASE
	//============================================================================
	function __construct()
	{
		parent::__construct();
		$this->load->model('DetalleCita_model');
	} 

	//============================================================================
	//FUNCION PRINCIPAL QUE SE CARGA AL CARGAR LA PAGINA
	//============================================================================
	public function index()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->session->userdata('logueado') == TRUE)
			{
				$id_cita = $this->session->userdata('id_cita');
				
				$DATA_CITA = $this->DetalleCita_model->get_data_cita($id_cita);
				$id_cliente = $DATA_CITA->id_cliente;
				$DATA_CLIENTE = $this->DetalleCita_model->get_data_cliente($id_cliente);
				$DATA_CITAS_PREVIAS = $this->DetalleCita_model->get_data_citas_previas($id_cita,$id_cliente);

				$data = array(
					'DATA_CITA' => $DATA_CITA,
					'DATA_CLIENTE' => $DATA_CLIENTE,
					'DATA_CITAS_PREVIAS' => $DATA_CITAS_PREVIAS,
				);

				$this->load->view('headers/librerias');
				$this->load->view('headers/menu');
				$this->load->view('detalle_cita/detalle_cita',$data);
				$this->load->view('footers/librerias');
				$this->load->view('footers/cargar_js');
			}else
			{
				$script = '';
				$this->load->view('inicio/login',$script);
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	//============================================================================
	//ACTUALIZA LA INFORMACION DEL DETALLE DE LA CITA
	//============================================================================
	public function actualizar_informacion()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request()){
				$id_cliente = trim($this->input->post('id_cliente'));
				$data_cliente = array(				
					'enfermedades' => trim($this->input->post('enfermedades')),
					'alimentos_no_consumidos' => trim($this->input->post('alimentos_no_consumidos')),
					'estatura' => trim($this->input->post('estatura')),
				);
				$cliente_actualiado = $this->DetalleCita_model->update_cliente($id_cliente,$data_cliente);

				
				$id_cita = trim($this->input->post('id_cita'));
				$data_cita = array(				
					'peso' => trim($this->input->post('peso')),
					'dieta' => trim($this->input->post('dieta')),
					'indicaciones' => trim($this->input->post('indicaciones')),
					'notas_relevantes' => trim($this->input->post('notas_relevantes')),
				);

				$cita_actualizada = $this->DetalleCita_model->update_cita($id_cita,$data_cita);

				$response = FALSE;
				if($cliente_actualiado != 0 AND $cita_actualizada != 0)
				{
					$response = TRUE;
				}
				else
				{
					$response = FALSE;
				}

				echo json_encode($response);
			
			}else{
	            show_404();
	        }
        }else{
			redirect(base_url());
		}
	}

	//============================================================================
	//CARGA TODO EL HISTORIAL DE CITAS DEL PACIENTE
	//============================================================================
	public function cargar_historial()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->session->userdata('logueado') == TRUE)
			{
				$id_cita = $this->session->userdata('id_cita');
				
				$DATA_CITA = $this->DetalleCita_model->get_data_cita($id_cita);
				$id_cliente = $DATA_CITA->id_cliente;
				$DATA_CLIENTE = $this->DetalleCita_model->get_data_cliente($id_cliente);

				$data = array(
					'DATA_CITA' => $DATA_CITA,
					'DATA_CLIENTE' => $DATA_CLIENTE,
				);

				$this->load->view('headers/librerias');
				$this->load->view('headers/menu');
				$this->load->view('detalle_cita/detalle_cita',$data);
				$this->load->view('footers/librerias');
				$this->load->view('footers/cargar_js');
			}else
			{
				$script = '';
				$this->load->view('inicio/login',$script);
			}
		}
		else
		{
			redirect(base_url());
		}
	}
	//============================================================================
	//SEGURIDAD PARA EVITAR QUE SE ACCESE A PARTES DEL SISTEMA SIN NIVEL
	//============================================================================
	public function seguridad()
	{
		if(($this->session->userdata('logueado') == 1) and ($this->session->userdata('nivel') != 3))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
