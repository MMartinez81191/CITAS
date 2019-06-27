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
				'DATA_CORTES' => $this->CorteParcial_model->get_cortes(),
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

	public function imprimir_corte()
    {
		if($this->seguridad() == TRUE)
		{
			//Datos necesarios para crear PDF
			$id_cita = $this->uri->segment(3);
			$DATA_CORTES = $this->CorteParcial_model->get_cortes_ticket();

	        $fecha_actual=date("d/m/Y");
	        $hora = date("h:m:s a");
	        $this->load->library('fpdf_manager');
	        $pdf = new fpdf_manager('P','mm',array(34,500));
	        
	        $Nombre_archivo = 'Ticket.pdf';
	        $pdf->SetMargins(1,1,1,1);
	        $pdf->SetTitle("Ticket Pago");
	        $pdf->AddPage();
	        /*Encabezado*/
	        $pdf->setY(2);
	        $pdf->Image(base_url().'images/logo.jpg',25,0,10);
	        $pdf->SetFont('Times','B',5);
	        //$pdf->setY(1);

	        $pdf->Cell(0,3,'Control de Peso',0,1,'C');
	        $pdf->Cell(0,2,'Lic. Nut. Luz Maria',0,1,'L');
        	$pdf->Cell(0,2,'Everardo Ramirez',0,1,'L');

	        $pdf->SetFont('Times','',4);
	        $pdf->Cell(0,3,'________________________________________________________',0,1,'C');
	        
	        $total_citas = 0;
	        $pdf->SetFont('Times','B',4);
	        $pdf->SetFillColor(230,230,230);

	        if($DATA_CORTES != FALSE)
	        {
	        	foreach ($DATA_CORTES->result() as $row) 
	        	{
			        $pdf->Cell(0,2,utf8_decode('Datos Consulta'),1,1,'C',1);
		    		$pdf->Cell(11,2,'Folio:',1,0,'L',1);
		    		$pdf->Cell(21,2,$row->id_corte,1,1,'L');

		    		$pdf->Cell(0,2,'Nombre:',1,1,'L',1);
		    		$pdf->MultiCell(0,2,utf8_decode($row->nombre_cliente),1);

		    		$pdf->Cell(11,2,'Fecha Consulta:',1,0,'L',1);
		    		$pdf->Cell(21,2,date("d-m-Y", strtotime($row->fecha)),1,1,'L');

		    		$pdf->Cell(11,2,'Hora Consulta:',1,0,'L',1);
		    		$pdf->Cell(21,2,date("h:m a", strtotime($row->fecha)),1,1,'L');

		    		$pdf->Cell(11,2,'Costo Consulta:',1,0,'L',1);
		    		$pdf->Cell(21,2,'$'.number_format($row->costo_consulta,2,'.', ','),1,1,'L');

		    		$pdf->ln();

		    		$total_citas = $total_citas + $row->costo_consulta;
	        	}
	        }

			$pdf->Cell(0,2,utf8_decode('Total'),1,1,'C',1);
    		$pdf->Cell(11,2,'Subtotal:',1,0,'L',1);
    		$pdf->Cell(21,2,'$'.number_format($total_citas - ($total_citas * 0.16),2,'.', ','),1,1,'L');

    		$pdf->Cell(11,2,'IVA 16%:',1,0,'L',1);
    		$pdf->Cell(21,2,'$'.number_format(($total_citas * 0.16),2,'.', ','),1,1,'L');

    		$pdf->Cell(11,2,'Total:',1,0,'L',1);
    		$pdf->Cell(21,2,'$'.number_format($total_citas,2,'.', ','),1,1,'L');
        						 
	        /*$pdf->SetFont('Times','B',4);
	        $pdf->Cell(6,3,'Folio:',0,0,'L');
	        $pdf->SetFont('Times','',4);
	        $pdf->Cell(0,3,$DATA_CITA->id_cita.'A',0,1,'L');*/

	        /*$pdf->SetFont('Times','B',4);
	        $pdf->Cell(6,2,'Turno:',0,0,'L');
	        $pdf->SetFont('Times','',4);
	        $pdf->Cell(0,2,'#'.$DATA_CITA->numero_turno,0,1,'L');

	        $pdf->SetFont('Times','B',4);
	        $pdf->Cell(6,2,'Fecha:',0,0,'L');
	        $pdf->SetFont('Times','',4);
	        $pdf->Cell(0,2,$DATA_CITA->fecha,0,1,'L');

	        $pdf->SetFont('Times','B',4);
	        $pdf->Cell(6,2,'Nombre:',0,0,'L');
	        $pdf->SetFont('Times','',4);
	        $pdf->Cell(0,2,$DATA_CITA->nombre_cliente,0,1,'L');

	        $pdf->SetFont('Times','B',4);
	        $pdf->Cell(6,2,'Importe:',0,0,'L');
	        $pdf->SetFont('Times','',4);
	        $pdf->Cell(0,2,'$'.number_format($DATA_CITA->costo_consulta,2,'.', ','),0,1,'L');*/

	        $pdf->Cell(0,2,'__________________________________________________________',0,1,'C');
	        $pdf->SetFont('Times','B',3);
	        $pdf->Cell(0,1,'Maribel Calles Castro',0,1,'C');
	        $pdf->Cell(0,1,'RFC : CACM620318MQ7 ',0,1,'C');
	        $pdf->SetFont('Times','',3);
	        $pdf->Cell(0,1,'Enrrique Garcia Sanchez No. 115 Esquina',0,1,'C');
	        $pdf->Cell(0,1,'Avenida Aguascalientes Planta Baja Col. San Benito',0,1,'C');
	        $pdf->Cell(0,1,'Hermosillo Sonora Tel. (662) 210-02-85',0,1,'C');

	        $pdf->Ln();
			$pdf->Output($Nombre_archivo, 'I');
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
