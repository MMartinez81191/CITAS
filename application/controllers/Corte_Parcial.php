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
				$response = FALSE;
				$fecha_inicial = trim($this->input->post('fecha_1'));
				$fecha_final = trim($this->input->post('fecha_2'));
				$cantidad_recaudada = trim($this->input->post('cantidad_recaudada'));
				$cantidad_fisica = trim($this->input->post('cantidad_fisica'));
				$DATA_TOTAL = $this->CorteParcial_model->get_citas_intervalo($fecha_inicial,$fecha_final);
				$id_max = $this->CorteParcial_model->get_max_citas($fecha_inicial,$fecha_final)->id_cita;
				$id_min = $this->CorteParcial_model->get_min_citas($fecha_inicial,$fecha_final)->id_cita;
				$numero_session = $this->CorteParcial_model->get_numero_session()->numero_session;
				
				//DETERMINA EL NUMERO DE SESSION
				if($numero_session != FALSE)
				{
					$numero_session = $numero_session + 1;
				}
				else
				{
					$numero_session = 1;
				}
				
				//CALCULA RANDOM DE LOS NUMEROS QUE SE DEBEN DE CONSIDERAR
				$random = range($id_min, $id_max); 
				shuffle($random);

				//CICLO QUE CALCULA LOS NUMEROS QUE SE INSETARAN EN LA BASE DE DATOS
				$acumulado = 0;
				foreach ($random as $id_cita) 
				{ 
				    $DATA_CITA = $this->CorteParcial_model->get_data_cita($id_cita);
				    if($DATA_CITA != FALSE)
				    {
				    	$acumulado = $acumulado + $DATA_CITA->costo_consulta;
				    	$data = array(
				    		'id_cliente' => $DATA_CITA->id_cliente,
				    		'fecha' => $DATA_CITA->fecha,
				    		'hora' => $DATA_CITA->hora,
				    		'costo_consulta' => $DATA_CITA->costo_consulta,
				    		'numero_session' => $numero_session,
				    		'fecha_inicio_corte' => $fecha_inicial,
				    		'fecha_final_corte' => $fecha_final,
				    	);

				    	$this->CorteParcial_model->insert_cortes_caja_tmp($data);
				    	if($acumulado >= $cantidad_fisica)
				    	{
				    		$this->CorteParcial_model->insert_cortes_caja();
				    		$this->CorteParcial_model->update_corte_caja($fecha_inicial,$fecha_final);
				    		$this->CorteParcial_model->delete_corte_caja_tmp();
				    		$response = TRUE;
				    		break;
				    	}
				    }
				    else
				    {
				    	$response = FALSE;
				    }
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
