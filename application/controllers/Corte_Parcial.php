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
			$numero_session = $this->uri->segment(3);
			$DATA_CORTES = $this->CorteParcial_model->get_cortes_ticket($numero_session);

	        $fecha_actual=date("d/m/Y");
	        $hora = date("h:m:s a");
	        $this->load->library('fpdf_manager');
	        $pdf = new fpdf_manager('P','mm',array(80,290));
	        
	        $Nombre_archivo = 'Ticket.pdf';
	        $pdf->SetMargins(1,1,1,1);
	        $pdf->SetTitle("Corte Caja");
	        $pdf->AddPage();
	        /*Encabezado*/
	        $pdf->setY(17);
	        $pdf->SetFont('Times','B',12);
	        
	        $pdf->Cell(0,5,'Control de Peso',0,1,'C');
	        $pdf->Image(base_url().'images/logo.jpg',30,0,20);
	        $pdf->SetFont('Times','B',8);
	        
	        $pdf->Cell(2,3,'',0,0);
	        $pdf->Cell(0,3,'LIC. EN CIENCIAS NUTRICIONALES',0,1,'C');
	        $pdf->Cell(2,3,'',0,0);
        	$pdf->Cell(0,3,'JORGE LUIS ESPINOZA CALLES',0,1,'C');
			$pdf->Cell(2,3,'',0,0);
        	$pdf->Cell(0,3,'RESPONSABLE SANITARIO',0,1,'C');
			
	        $pdf->ln();

        	if($DATA_CORTES != FALSE)
	        {
	        	foreach ($DATA_CORTES->result() as $row) 
	        	{
	        		$fecha_inicial = $row->fecha_inicio_corte;
	        		$fecha_final = $row->fecha_final_corte;
	        	}
	        }
	        $pdf->Cell(0,3,'________________________________________________________',0,1,'C');
	        $pdf->ln();
	        
	        $pdf->Cell(0,3,'CORTE DE CAJA',0,1,'C');
        	$pdf->Cell(2,3,'',0,0);
        	$pdf->Cell(40,3,'Fecha de inicio de corte:',0,0,'L');
        	$pdf->Cell(20,3,date('d-m-Y',strtotime($fecha_inicial)),0,1,'L');

        	
        	$pdf->Cell(2,3,'',0,0);
        	$pdf->Cell(40,3,'Fecha final de corte:',0,0,'L');
        	$pdf->Cell(40,3,date('d-m-Y',strtotime($fecha_final)),0,1,'L');
        	

        	if($DATA_CORTES != FALSE)
	        {
	        	foreach ($DATA_CORTES->result() as $row) 
	        	{
	        		$fecha_inicial = $row->fecha_inicio_corte;
	        		$fecha_final = $row->fecha_final_corte;
	        	}
	        }

        	$pdf->ln();
	        $pdf->Cell(0,3,'________________________________________________________',0,1,'C');
	        $pdf->ln();
	        
	        $pdf->Cell(0,5,'CORTE DE CAJA',0,1,'C');
        	$pdf->Cell(2,5,'',0,0);
        	$pdf->Cell(40,5,'Fecha de inicio de corte:',0,0,'L');
        	$pdf->Cell(20,5,date('d-m-Y',strtotime($fecha_inicial)),0,1,'L');

        	
        	$pdf->Cell(2,5,'',0,0);
        	$pdf->Cell(40,5,'Fecha final de corte:',0,0,'L');
        	$pdf->Cell(40,5,date('d-m-Y',strtotime($fecha_final)),0,1,'L');
        	

        	$pdf->ln();
	        $pdf->Cell(0,3,'________________________________________________________',0,1,'C');
	        $pdf->ln();

	        $total_citas = 0;
	        $pdf->SetFont('Times','',10);
	        $pdf->SetFillColor(230,230,230);

	        if($DATA_CORTES != FALSE)
	        {
	        	foreach ($DATA_CORTES->result() as $row) 
	        	{
			        $pdf->Cell(2,5,'',0,0);
			        $pdf->Cell(74,5,utf8_decode('Datos Consulta'),1,1,'C',1);

			        $pdf->Cell(2,5,'',0,0);
		    		$pdf->Cell(28,5,'Folio:',1,0,'L',1);
		    		$pdf->Cell(46,5,$row->id_corte,1,1,'L');

		    		$pdf->Cell(2,5,'',0,0);
		    		$pdf->Cell(74,5,'Nombre:',1,1,'L',1);

		    		$pdf->Cell(2,5,'',0,0);
		    		$pdf->MultiCell(74,5,utf8_decode($row->nombre_cliente),1);

		    		$pdf->Cell(2,5,'',0,0);
		    		$pdf->Cell(28,5,'Fecha Consulta:',1,0,'L',1);
		    		$pdf->Cell(46,5,date("d-m-Y", strtotime($row->fecha)),1,1,'L');

		    		$pdf->Cell(2,5,'',0,0);
		    		$pdf->Cell(28,5,'Costo Consulta:',1,0,'L',1);
		    		$pdf->Cell(46,5,'$'.number_format($row->costo_consulta,2,'.', ','),1,1,'L');

		    		$pdf->ln();

		    		$y = $pdf->getY();
		    		if($y >= 200)
		    		{
		    			$pdf->Cell(0,5,'__________________________________________________________',0,1,'C');
	        	        $pdf->SetFont('Times','B',8);
				        $pdf->Cell(0,4,'Maribel Calles Castro',0,1,'C');
				        $pdf->Cell(0,4,'RFC : CACM620318MQ7 ',0,1,'C');
				        $pdf->SetFont('Times','',8);
				        $pdf->Cell(0,4,'Enrique Garcia Sanchez No. 115 Esquina',0,1,'C');
				        $pdf->Cell(0,4,'Avenida Aguascalientes Planta Baja Col. San Benito',0,1,'C');
				        $pdf->Cell(0,4,'Hermosillo Sonora Tel. (662) 210-02-85',0,1,'C');
				        $pdf->Cell(0,4,$pdf->PageNo(),0,1,'C');
				        
		    			$pdf->AddPage();

		    			/*Encabezado*/
				        $pdf->setY(17);
				        $pdf->SetFont('Times','B',12);
				        $pdf->Cell(0,5,'Control de Peso',0,1,'C');
				        $pdf->Image(base_url().'images/logo.jpg',30,0,20);
				        $pdf->SetFont('Times','B',8);
				        
				        $pdf->Cell(2,3,'',0,0);
				        $pdf->Cell(0,3,'LIC. EN CIENCIAS NUTRICIONALES',0,1,'C');
				        $pdf->Cell(2,3,'',0,0);
			        	$pdf->Cell(0,3,'JORGE LUIS ESPINOZA CALLES',0,1,'C');
						$pdf->Cell(2,3,'',0,0);
			        	$pdf->Cell(0,3,'RESPONSABLE SANITARIO',0,1,'C');
						
				        $pdf->ln();

				        $pdf->Cell(0,3,'________________________________________________________',0,1,'C');
				        $pdf->ln();
				        
				        $pdf->Cell(0,3,'CORTE DE CAJA',0,1,'C');
			        	$pdf->Cell(2,3,'',0,0);
			        	$pdf->Cell(40,3,'Fecha de inicio de corte:',0,0,'L');
			        	$pdf->Cell(20,3,date('d-m-Y',strtotime($fecha_inicial)),0,1,'L');

			        	
			        	$pdf->Cell(2,3,'',0,0);
			        	$pdf->Cell(40,3,'Fecha final de corte:',0,0,'L');
			        	$pdf->Cell(40,3,date('d-m-Y',strtotime($fecha_final)),0,1,'L');
			        	

				        $pdf->Cell(0,3,'________________________________________________________',0,1,'C');
				        $pdf->ln();
				        
				        $pdf->Cell(0,5,'CORTE DE CAJA',0,1,'C');
			        	$pdf->Cell(2,5,'',0,0);
			        	$pdf->Cell(40,5,'Fecha de inicio de corte:',0,0,'L');
			        	$pdf->Cell(20,5,date('d-m-Y',strtotime($fecha_inicial)),0,1,'L');

			        	
			        	$pdf->Cell(2,5,'',0,0);
			        	$pdf->Cell(40,5,'Fecha final de corte:',0,0,'L');
			        	$pdf->Cell(40,5,date('d-m-Y',strtotime($fecha_final)),0,1,'L');
			        	

			        	$pdf->ln();
				        $pdf->Cell(0,3,'________________________________________________________',0,1,'C');
				        $pdf->ln();


		    		}

		    		$total_citas = $total_citas + $row->costo_consulta;
	        	}
	        }


	        $pdf->Cell(2,5,'',0,0);
			$pdf->Cell(74,5,utf8_decode('Total'),1,1,'C',1);

    		$pdf->Cell(2,5,'',0,0);
    		$pdf->Cell(28,5,'Total:',1,0,'L',1);
    		$pdf->Cell(46,5,'$'.number_format($total_citas,2,'.', ','),1,1,'L');
        						 
    		$pdf->Ln();
        	$pdf->SetFont('Times','B',8);
	        $pdf->Cell(0,4,'Maribel Calles Castro',0,1,'C');
	        $pdf->Cell(0,4,'RFC : CACM620318MQ7 ',0,1,'C');
	        $pdf->SetFont('Times','',8);
	        $pdf->Cell(0,4,'Enrique Garcia Sanchez No. 115 Esquina',0,1,'C');
	        $pdf->Cell(0,4,'Avenida Aguascalientes Planta Baja Col. San Benito',0,1,'C');
	        $pdf->Cell(0,4,'Hermosillo Sonora Tel. (662) 210-02-85',0,1,'C');
	        $pdf->Cell(0,4,$pdf->PageNo(),0,1,'C');

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
			$this->load->view('corte_parcial/realizar_corte');
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
				    	$this->CorteParcial_model->update_corte_caja($id_cita);
				    }
				    else
				    {
				    	$response = FALSE;
				    }

				    if($acumulado >= $cantidad_fisica)
			    	{
			    		$DATA_CORTES_TMP = $this->CorteParcial_model->get_cortes_caja_tmp();

			    		if($DATA_CORTES_TMP != FALSE)
			    		{
		    				foreach($DATA_CORTES_TMP->result() as $row)
		    				{
		    					$data = array(
		    						'id_cliente' => $row->id_cliente,
		    						'fecha' => $row->fecha,
		    						'hora' => $row->hora,
		    						'costo_consulta' => $row->costo_consulta,
		    						'numero_session' => $row->numero_session,
		    						'fecha_inicio_corte' => $row->fecha_inicio_corte,
		    						'fecha_final_corte' => $row->fecha_final_corte,
		    					);

		    					$this->CorteParcial_model->insert_cortes_caja($data);
		    				}	


			    			$this->CorteParcial_model->delete_corte_caja_tmp();
			    			$response = TRUE;
			    		}else
			    		{
			    			$response = FALSE;
			    		}
			    		
			    		break;
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
