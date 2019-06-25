<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Corte_Parcial extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('CorteParcial_model');
	} 

	public function index()
	{
		if($this->seguridad() == TRUE)
		{
			$data = array(
				//'DATA_CITAS' => FALSE,
				//'DATA_ANIOS' => $this->Corte_model->get_anios(),
			);

			$this->load->view('headers/librerias');
			$this->load->view('headers/menu');
			$this->load->view('corte_parcial/lista_corte',$data);
			$this->load->view('footers/librerias');
		}
		else
		{
			redirect(base_url());
		}
	}

	public function realizar_corte()
	{
		if($this->seguridad() == TRUE)
		{
			$data = array(
				//'DATA_CITAS' => FALSE,
				//'DATA_ANIOS' => $this->Corte_model->get_anios(),
			);

			$this->load->view('headers/librerias');
			$this->load->view('headers/menu');
			$this->load->view('corte_parcial/realizar_corte',$data);
			$this->load->view('footers/librerias');
		}
		else
		{
			redirect(base_url());
		}
	}

	public function recuperar_cantidades()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request())
			{
				$response = "0.00";
				$fecha_inicial = trim($this->input->post('fecha_1'));
				$fecha_final = trim($this->input->post('fecha_2'));
				$DATA_TOTAL = $this->CorteParcial_model->get_total_citas($fecha_inicial,$fecha_final);
				if($DATA_TOTAL != FALSE)
				{
					foreach($DATA_TOTAL->result() as $row)
					{
						$total_citas = $row->total_citas;
					}
					$total_citas = '$'.number_format($total_citas,2,'.', ',');
					$response = $total_citas;
				}
				else
				{
					$response = "$ 0.00";
				}
				echo json_encode($response);
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function generar_corte()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request())
			{
				$fecha_inicial = trim($this->input->post('fecha_1'));
				$fecha_final = trim($this->input->post('fecha_2'));
				$cantidad_recaudada = trim($this->input->post('cantidad_recaudada'));
				$cantidad_fisica = trim($this->input->post('cantidad_fisica'));


				$DATA_TOTAL = $this->CorteParcial_model->get_citas_intervalo($fecha_inicial,$fecha_final);

				$id_max = $this->CorteParcial_model->get_max_citas($fecha_inicial,$fecha_final)->id_cita;
				$id_min = $this->CorteParcial_model->get_min_citas($fecha_inicial,$fecha_final)->id_cita;
				
				//var_dump($id_max);
				//var_dump($id_min);

				$rand = range($id_min, $id_max); 
				shuffle($rand);

				foreach ($rand as $val) { 
				    echo $val . '<br />'; 
				}
				if($DATA_TOTAL != FALSE)
				{

					

					/*foreach($DATA_TOTAL->result() as $row)
					{
						$total_citas = $row->total_citas;
					}
					$total_citas = '$'.number_format($total_citas,2,'.', ',');
					$response = $total_citas;*/
				}
				else
				{
					$response = FALSE;
				}
				echo json_encode($response);
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function seguridad()
	{
		if(($this->session->userdata('logueado') == 1))
		{
			return true;
		}
		else
		{
			return false;
		}
	}




	
}
