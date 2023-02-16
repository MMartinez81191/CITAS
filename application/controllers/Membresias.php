<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membresias extends CI_Controller {

	//=========================================================
    //CONSTRUCTOR POR DEFECTO DE LA CLASE
    //=========================================================
	function __construct()
	{
		parent::__construct();
		$this->load->model('Membresias_model');
	} 

	//=========================================================
    //METODO PRINCIPAL QUE SE EJECUTA AL CARGAR LA PAGINA 
    //=========================================================
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

    //=========================================================
    //CANCELA LA MEMBRESIA 
    //=========================================================
	public function cancelar_membresia()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request()){

				$numero_membresia = $this->input->post('numero_membresia');
				$DATA_ID_MEMBRESIA = $this->Membresias_model->get_maximo_id_membresia($numero_membresia);
				if($DATA_ID_MEMBRESIA != FALSE)
				{
					foreach($DATA_ID_MEMBRESIA->result() as $row)
					{
						$id_membresia = $row->id_membresia;	
						$response = $this->Membresias_model->cancelar_membresia($id_membresia);					
					}
					echo json_encode($response);
				}
				else
				{
					echo json_encode(false);
				}

			}else{
	            show_404();
	        }
        }else
		{
			redirect(base_url());
		}
	}

    //=========================================================
    //ADMINISTRA LA SEGURIDAD DEL CONTROLADOR PARA EVITAR
    //ACCESOS NO AUTORIZADOS
    //=========================================================
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
