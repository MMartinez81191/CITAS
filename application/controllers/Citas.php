<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Citas extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Citas_model');
		$this->load->model('Clientes_model');
		$this->load->model('Costos_model');
	} 

	public function index()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->session->userdata('logueado') == TRUE)
			{
				$fechaInicio = date('Y-m-d');
				$fechaFinal = date('Y-m-d', strtotime(' + 1 days'));

				$data = array(
					'DATA_CITAS' => $this->Citas_model->get_citas($fechaInicio,$fechaFinal),
					'DATA_CLIENTES' => $this->Clientes_model->get_clientes(),
					'DATA_TIPO_CITAS' => $this->Citas_model->get_tipo_citas(),
					//'DATA_COSTOS' => $this->Costos_model->get_costos(),
				);

				$this->load->view('headers/librerias');
				$this->load->view('headers/menu');
				$this->load->view('citas/lista_citas',$data);
				$this->load->view('footers/librerias');
				$this->load->view('footers/cargar_js');
			}else
			{
				$script = '';
				$this->load->view('inicio/login',$script);
			}
		}
		else{
			redirect(base_url());
		}
	}

	public function set_color($id_tipo_cita)
	{
		
		switch ($id_tipo_cita) {
			case '1':
				$class = 'info';
				break;
			case '2':
				$class = 'danger';
				break;
			case '3':
				$class = 'success';
				break;
			case '5':
				$class = 'warning';
				break;
			default:
				# code...
				break;
		}

		return $class;
	}

	public function obtenerCitas()
	{
		if($this->seguridad() == TRUE)
		{
			$this->load->view('footers/librerias');
			$fechaInicio = $this->uri->segment(3);
			$fechaFinal = $this->uri->segment(4);

			$DATA_CITAS = $this->Citas_model->get_citas($fechaInicio,$fechaFinal);

			?>

			<table id="example2" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th><center>Hora Cita</center></th>
						<th><center># Paciente</center></th>
						<th><center>Nombre Paciente</center></th>
						<th><center>Fecha Cita</center></th>
						<th><center>Tipo Cita</center></th>
						<th class="no-sort"><center>Opciones</center></th>
					</tr>
				</thead>
				<tbody>
					<?php
						$aumento = 5;
	    				for($i=0; $i<144; $i++)
	    				{
	    					$hora_inicial = '08:00:00';
	    					$hora1 = date('h:i a', strtotime($hora_inicial.' + '.$aumento.' minutes'));
							$hora2 = date('h:i a', strtotime('00:00:00'));
	    					if($DATA_CITAS != FALSE)
	    					{
	    						foreach ($DATA_CITAS->result() as $row) 
	    						{
	    							$hora1 = date('h:i a', strtotime($hora_inicial.' + '.$aumento.' minutes'));
	    							$hora2 = date('h:i a', strtotime($row->hora));
	    							//$hora2 = date('h:i a', $row->hora);
	    							
	    							if($hora1 == $hora2)
	    							{
	    								
									?>
	    								<tr class="<?=$this->set_color($row->id_tipo_cita)?>" id="tr_<?= $row->id_cita; ?>" name="tr_<?= $row->id_cita; ?>" >
											<td><center><?= date('h:i a', strtotime($row->hora))?></center></td>
											<td><center><?= $row->numero_turno;?></center></td>
											<td><center><?= $row->nombre_cliente;?></center></td>
											<td><center><?= $row->fecha ?></center></td>
											<td><center><?= $row->tipo_cita ?></center></td>
											<td>
												<center>
													<?php
													if($row->costo_consulta == '-1'){
													?>
														<button data-id="<?= $row->id_cita; ?>" class="btn btn-success cobrar_cita"  data-toggle="modal" data-target="#modal_cobrar_cita" ><i class="fa fa-money"></i><span data-toggle="tooltip" data-placement="top" title="Cobrar Consulta" ></span></button>

														<button data-id="<?= $row->id_cita; ?>" class="btn btn-danger eliminar_cita" title="Eliminar Cita" data-toggle="tooltip" data-placement="top">  <i class="fa fa-close"></i></button>
													<?php
													}
													else
													{
													?>
														<a type="button" href="<?=base_url()?>citas/imprimir_ticket/<?=$row->id_cita?>" class="btn btn-success" target="_blank" ><i class="fa fa-print" data-toggle="tooltip" data-placement="top" title="Imprimir Ticket"  ></i><span></span></a>
														<button  data-id="<?= $row->id_cita; ?>" class="btn btn-primary cargar_modal_peso" title="Agregar Peso" data-toggle="tooltip" data-placement="top">  <i class="fa fa-file-text"></i></button>
													<?php
													}
													?>
												</center>
											</td>
										</tr>
									<?php
										$aumento = $aumento + 5;
	    								break;
	    							}

	    						}	
	    					}
	    					
	    					if($hora1 != $hora2)
							{
	    					?>
								<tr>
	    							<td><center><?=date('h:i a', strtotime($hora_inicial.' + '.$aumento.' minutes'));?></center></td>
									<td><center>-</center></td>
									<td><center>-</center></td>
									<td><center>-</center></td>
									<td><center>-</center></td>
									<td><center>-</center></td>
	    						</tr>
							<?php
								
		    					$aumento = $aumento + 5;
		    				}
	    				}
	    			?>
				</tbody> 
			</table>
			<?php
		}else{
			redirect(base_url());
		}
	}


	public function crear_cita()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request())
			{
				//$response = FALSE;
				$fecha = trim($this->input->post('txt_fecha'));
				$hora = trim($this->input->post('txt_hora'));
				$confirmar_repetido = $this->Citas_model->comprobar_repetidos($fecha,date("H:i", strtotime($hora)));

				if($confirmar_repetido == FALSE)
				{
					$data = array(				
						'id_cliente' => trim($this->input->post('id_cliente')),
						'id_tipo_cita' => trim($this->input->post('id_tipo_cita')),
						'fecha' => $fecha,
						'hora' => date("H:i", strtotime($hora)),
						'activo' => 1,
					);
					
					$this->Citas_model->insert_citas($data);
					$response = FALSE;
					
				}
				else if($confirmar_repetido == TRUE)
				{
					$response = TRUE;
				}
				echo json_encode($response);
			}else{
	            show_404();
	        }
        }else{
			redirect(base_url());
		}
	}

	public function eliminar_cita()
	{
		if($this->seguridad() == TRUE)
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
        }else{
			redirect(base_url());
		}
	}

	public function datos_pagar_cita()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request())
			{
				
				$id_cita = $this->input->post('id_cita');
				$DATA_CITA = $this->Citas_model->get_citas_by_id($id_cita);
				
				$data = array(
					'DATA_CITA' => $DATA_CITA,
					'DATA_TURNO' =>  $this->Citas_model->get_turno($DATA_CITA->fecha),
					//'DATA_COSTOS' => $this->Costos_model->get_costos(),
				);
				echo json_encode($data);
			}
			else
			{
	            show_404();
	        }
        }else{
			redirect(base_url());
		}
	}

	//OBTIENE LOS PRODUCTOS DEPENDIENDO DEL TIPO
	public function get_co()
	{
		$id_tipo_cita = $this->uri->segment(3);
		$membresia = $this->uri->segment(4);

		$DATA_COSTOS = $this->Costos_model->get_costos();
		
		if($DATA_COSTOS != FALSE)
		{
			if ($id_tipo_cita == 2) {
				if ($membresia != 0) {
					echo '<option value="0">';
						echo '$0.00';	
					echo '</option>';
				}
				else
				{
					echo '<option value="400">';
						echo '$400.00';	
					echo '</option>';
				}
			}
			else
			{
				foreach ($DATA_COSTOS->result() as $row) {
					echo '<option value="'.$row->costo.'">';
						echo '$'.number_format($row->costo,2,'.', ',');	
					echo '</option>';
				}
			}
		}
	}

	public function up_membresia()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request()){
				$id_cliente = trim($this->input->post('id_cliente'));
				$data2 = array(
					'membresia' => trim($this->input->post('membresia')), 
				);

				$this->Citas_model->upd_membresia($id_cliente, $data2);
			}else
			{
	            show_404();
	        }
        }else{
			redirect(base_url());
		}
	}

	public function pagar_cita()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request()){
				$id_cita = $this->input->post('id_cita');
				$DATA_CITA = $this->Citas_model->get_citas_by_id($id_cita);
				$numero_turno = $this->Citas_model->get_turno($DATA_CITA->fecha);

				$data = array(				
					'costo_consulta' => trim($this->input->post('costo_consulta')),
					'numero_turno' => $numero_turno,
					'forma_pago' => trim($this->input->post('forma_pago')),
					'peso_actual' => trim($this->input->post('peso_actual')),
					'cobrado' => 1,
					
				);

				$this->Citas_model->pagar_cita($data,$id_cita);
				var_dump($data);
			}else
			{
	            show_404();
	        }
        }else{
			redirect(base_url());
		}
	}

	public function imprimir_ticket()
	{
		if($this->seguridad() == TRUE)
		{
			//Datos necesarios para crear PDF
			$id_cita = $this->uri->segment(3);
			$DATA_CITA = $this->Citas_model->get_citas_by_id($id_cita);

	        $fecha_actual=date("d/m/Y");
	        $hora = date("h:m:s a");
	        $this->load->library('fpdf_manager');
	        $pdf = new fpdf_manager('P','mm',array(80,150));
	        
	        $Nombre_archivo = 'Ticket.pdf';
	        $pdf->SetMargins(1,1,1,1);
	        $pdf->SetTitle("Ticket Pago");
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
			
			
	        $pdf->SetFont('Times','B',8);
	        $pdf->Cell(0,6,'FOLIO: A-'.$DATA_CITA->id_cita,0,1,'R');
			
	        $pdf->SetFont('Times','',10);
	        $pdf->SetFillColor(230,230,230);

	        $pdf->Cell(4,5,'',0,0);
	        $pdf->Cell(72,5,utf8_decode('Datos Consulta'),1,1,'C',1);

    		$pdf->Cell(4,5,'',0,0);
    		$pdf->Cell(72,5,'Nombre:',1,1,'L',1);
    		$pdf->Cell(4,5,'',0,0);
    		$pdf->MultiCell(72,5,utf8_decode($DATA_CITA->nombre_cliente),1);

			$pdf->Cell(4,5,'',0,0);
    		$pdf->Cell(26,5,'Fecha Consulta:',1,0,'L',1);
    		$pdf->Cell(46,5,date("d-m-Y", strtotime($DATA_CITA->fecha)),1,1,'L');

    		$pdf->Cell(4,5,'',0,0);
    		$pdf->Cell(26,5,'Hora Consulta:',1,0,'L',1);
    		$pdf->Cell(46,5, date("g:i a", strtotime($DATA_CITA->hora)) ,1,1,'L');

    		if($DATA_CITA->id_tipo_cita == 2)
    		{
    			$pdf->Cell(4,5,'',0,0);
	    		$pdf->Cell(26,5,'Folio Membresia:',1,0,'L',1);
	    		$pdf->Cell(46,5, "" ,1,1,'L');

	    		$pdf->Cell(4,5,'',0,0);
	    		$pdf->Cell(26,5,'Cita Membresia:',1,0,'L',1);
	    		$pdf->Cell(46,5, "" ,1,1,'L');
    		}

    		$pdf->Cell(4,5,'',0,0);
    		$pdf->Cell(26,5,'Costo Consulta:',1,0,'L',1);
    		$pdf->Cell(46,5,'$'.number_format($DATA_CITA->costo_consulta,2,'.', ','),1,1,'L');

    		$pdf->Cell(4,5,'',0,0);
    		$pdf->Cell(26,5,'Total:',1,0,'L',1);
    		$pdf->Cell(46,5,'$'.number_format($DATA_CITA->costo_consulta,2,'.', ','),1,1,'L');

    		$pdf->Ln();
    		 

	        $pdf->SetFont('Times','B',8);
	        $pdf->Cell(0,4,'Maribel Calles Castro',0,1,'C');
	        $pdf->Cell(0,4,'RFC : CACM620318MQ7 ',0,1,'C');
	        $pdf->SetFont('Times','',8);
	        $pdf->Cell(0,4,'Enrique Garcia Sanchez No. 115 Esquina',0,1,'C');
	        $pdf->Cell(0,4,'Avenida Aguascalientes Planta Baja Col. San Benito',0,1,'C');
	        $pdf->Cell(0,4,'Hermosillo Sonora Tel. (662) 210-02-85',0,1,'C');
	
			

	        $pdf->Ln();
	        
	        $pdf->AddPage();

	        $pdf->setY(17);
	        $pdf->SetFont('Times','B',12);
	        $pdf->Cell(0,5,'Control de Peso',0,1,'C');
	        $pdf->Image(base_url().'images/logo.jpg',30,0,20);
	        $pdf->SetFont('Times','B',10);
	        

        	$pdf->ln();
	        
	        $pdf->SetFont('Times','',10);
	        $pdf->SetFillColor(230,230,230);
	        
	        $pdf->SetFont('Times','',10);
	        $pdf->SetFillColor(230,230,230);

	        $pdf->Cell(4,5,'',0,0);
	        $pdf->Cell(72,5,utf8_decode('Datos Consulta'),1,1,'C',1);
			
			$pdf->Cell(4,5,'',0,0);
    		$pdf->Cell(72,5,'Nombre:',1,1,'L',1);
    		$pdf->Cell(4,5,'',0,0);
    		$pdf->MultiCell(72,5,utf8_decode($DATA_CITA->nombre_cliente),1);
			
    		$pdf->Cell(4,5,'',0,0);
    		$pdf->Cell(26,5,'Costo Consulta:',1,0,'L',1);
    		$pdf->Cell(46,5,'$'.number_format($DATA_CITA->costo_consulta,2,'.', ','),1,1,'L');

    		if($DATA_CITA->id_tipo_cita == 2)
    		{
    			$pdf->Cell(4,5,'',0,0);
	    		$pdf->Cell(26,5,'Folio Membresia:',1,0,'L',1);
	    		$pdf->Cell(46,5, date("g:i a", strtotime($DATA_CITA->hora)) ,1,1,'L');

	    		$pdf->Cell(4,5,'',0,0);
	    		$pdf->Cell(26,5,'Cita Membresia:',1,0,'L',1);
	    		$pdf->Cell(46,5, date("g:i a", strtotime($DATA_CITA->hora)) ,1,1,'L');
    		}

    		$pdf->Cell(4,5,'',0,0);
	        $pdf->SetFont('Times','B',12);
	        $pdf->MultiCell(72,5,'FAVOR DE ENTREGAR ESTE COMPROBANTE A SU NUTRIOLOGO',1,'C');
	        $pdf->SetFont('Times','',6);
	        $pdf->Cell(0,5,'PX-'.$DATA_CITA->numero_turno,0,1,'R');
	        
	        //$pdf->AutoPrint();
			$pdf->Output($Nombre_archivo, 'I');
		}else{
			redirect(base_url());
		}
	}


	//SEGURIDAD PARA EVITAR QUE SE ACCESE A PARTES DEL SISTEMA SIN NIVEL
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

	//PESOS DE CLEINTES
	public function add_peso()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request()){
				
				$id_cita = trim($this->input->post('id_cita'));
				$DATA_CITA = $this->Citas_model->get_citas_by_id($id_cita);

				if($DATA_CITA != FALSE)
				{
					$id_cliente = $DATA_CITA->id_cliente;
					$fecha = $DATA_CITA->fecha;						
					
					$data = array(				
						'id_cliente' => $id_cliente,
						'peso' => trim($this->input->post('peso')),
						'fecha' =>$fecha,
					);
					$this->Clientes_model->insert_pesos($data);	
						
				}
				echo json_encode($data);
			
			}else{
	            show_404();
	        }
        }else{
			redirect(base_url());
		}
	}
}
