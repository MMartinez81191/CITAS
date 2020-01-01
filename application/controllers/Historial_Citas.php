<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historial_Citas extends CI_Controller {

	//============================================================================
	//CONSTRUCTOR DE LA CLASE
	//============================================================================
	function __construct()
	{
		parent::__construct();
		$this->load->model('HistorialCitas_Model');
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
				$id_cliente = $this->session->userdata('id_cliente');
				$DATA_CITAS = $this->HistorialCitas_Model->get_data_citas($id_cliente);
				$data = array(
					'DATA_CITAS' => $DATA_CITAS,
				);

				$this->load->view('headers/librerias');
				$this->load->view('headers/menu');
				$this->load->view('historial_citas/historial_citas',$data);
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
    //FUNCION QUE CARGA EL CONSTRUCTOR DE DETALLE CITA
    //============================================================================
    public function cargar_detalle_cita()
    {
        if($this->seguridad() == TRUE)
        {
            $id_cita = $this->uri->segment(3);

            $newdata = array(
                'id_cita' => $id_cita,
            );
            $this->session->set_userdata($newdata);

            redirect(base_url().'detalle_cita/');
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
