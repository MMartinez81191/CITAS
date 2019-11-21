<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Citas extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Citas_model');
		$this->load->model('Clientes_model');
		$this->load->model('Costos_model');
		$this->load->library('form_validation');
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
					'DATA_FECHA' => $fechaInicio,
					'DATA_TIPO_CITAS' => $this->Citas_model->get_tipo_citas($this->Citas_model->get_tipo_cita_max_id_cliente()),
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

			$this->load->view('footers/cargar_librerias_tablas');
			$fechaInicio = $this->uri->segment(3);
			$fechaFinal = $this->uri->segment(4);
			$fechaActual = date("Y-m-d");

			$DATA_CITAS = $this->Citas_model->get_citas($fechaInicio,$fechaFinal);
			$DATA_FECHA = $fechaInicio;
			$id_nivel = $this->session->userdata('nivel');
			?>
			<div class="box-header">
        		<center>
        			<h3>Citas programadas del dia <?=date('d-m-Y',strtotime($DATA_FECHA))?></h3>
        		</center>
        	</div>
			<div class="box-body table-responsive">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th><center>#</center></th>
							<th><center>Hora Cita</center></th>
							<th><center>Turno</center></th>
							<th><center>Nombre Paciente</center></th>
							<th><center>Tipo Cita</center></th>
							<th><center>Costo</center></th>
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
												<td><center><?=$i + 1?></center></td>
												<td><center><?= date('h:i a', strtotime($row->hora))?></center></td>
												<td><center><?= $row->numero_turno;?></center></td>
												<td><center><?= $row->nombre_cliente;?></center></td>
												<td><center><?= $row->tipo_cita ?></center></td>
												<td><center><?php 
																if($row->costo_consulta != -1)
																{	
																	if(is_numeric($row->costo_consulta))
																	{
																		echo number_format($row->costo_consulta,2,'.', ',');
																	}
																	else
																	{
																		echo $row->costo_consulta;
																	}
																	
																}
																else
																{
																	echo '-';
																} 
																?>
												</center></td>
												<td>
													<center>
														<?php
														if($row->costo_consulta == '-1'){
														?>
															<?php
															if($fechaInicio == $fechaActual)
															{
															?>
															<button data-id="<?= $row->id_cita; ?>" class="btn btn-warning cobrar_cita"  data-toggle="modal" data-target="#modal_cobrar_cita" ><i class="fa fa-money"></i><span data-toggle="tooltip" data-placement="top" title="Cobrar Consulta" ></span></button>
															<?php
															}
															?>
															<button data-id="<?= $row->id_cita; ?>" class="btn btn-danger eliminar_cita" title="Eliminar Cita" data-toggle="tooltip" data-placement="top">  <i class="fa fa-close"></i></button>
														<?php
														}
														else
														{
														?>
															<?php
																if($fechaInicio == $fechaActual)
																{
																	?>
																	<a type="button" href="<?=base_url()?>citas/imprimir_ticket/<?=$row->id_cita?>" class="btn btn-success" target="_blank" ><i class="fa fa-print" data-toggle="tooltip" data-placement="top" title="Imprimir Ticket"  ></i><span></span></a>
																	<?php
																}
															
															?>
															<button  data-id="<?= $row->id_cita; ?>" class="btn btn-primary cargar_modal_peso" title="Actualizar Historial" data-toggle="tooltip" data-placement="top">  <i class="fa fa-file-text"></i></button>
															<?php
																if($row->id_tipo_cita != 2 AND $id_nivel < 5)
																{
																	?>
																	<!--<button data-id="<?= $row->id_cita; ?>"  class="btn btn-warning cobrar_cita"  data-toggle="modal" data-target="#modal_cobrar_cita" ><i class="fa fa-edit"></i><span data-toggle="tooltip" data-placement="top" title="Modificar" ></span></button>-->
																	<button data-id="<?= $row->id_cita; ?>" class="btn btn-danger eliminar_cita"><i class="fa fa-close"></i><span data-toggle="tooltip" data-placement="top" title="Modificar" ></span></button>
																	<?php
																}
															?>
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
										<td><center><?=$i + 1?></center></td>
		    							<td><center><?=date('h:i a', strtotime($hora_inicial.' + '.$aumento.' minutes'));?></center></td>
										<td><center>-</center></td>
										<td><center>-</center></td>
										<td><center>-</center></td>
										<td><center>-</center></td>
										<td><center><button class="btn btn-success btn_add_cita_modal" data-hora="<?=$hora1?>" data-fecha="<?=$DATA_FECHA?>" data-toggle="modal" data-target="#modal_agregar_citas"><i class="fa fa-plus" data-toggle="tooltip" data-placement="top" title="Agregar Cita"  ></i><span></span></button></center></td>
		    						</tr>
								<?php
									
			    					$aumento = $aumento + 5;
			    				}
		    				}
		    			?>
					</tbody> 
				</table>
			</div>
			<?php
		}else{
			redirect(base_url());
		}
	}

	//FUNCION PARA GUARDAR UNA CITA EN LA BASE DE DATOS
	public function crear_cita()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request())
			{
				//$response = FALSE;
				$id_cliente = trim($this->input->post('id_cliente'));
				$id_tipo_cita = trim($this->input->post('id_tipo_cita'));
				$fecha = trim($this->input->post('txt_fecha'));
				$hora = trim($this->input->post('txt_hora'));

				$confirmar_repetido = $this->Citas_model->comprobar_repetidos($fecha,date("H:i", strtotime($hora)));

				if($confirmar_repetido == FALSE AND 
				   !empty($id_cliente) AND
				   !empty($id_tipo_cita) AND
			       !empty($fecha) AND
			       !empty($hora))
				{
					$data = array(				
						'id_cliente' => $id_cliente,
						'id_tipo_cita' => $id_tipo_cita,
						'fecha' => $fecha,
						'hora' => date("H:i", strtotime($hora)),
						'activo' => 1,
					);
					
					$this->Citas_model->insert_citas($data);
					$response = '1';
					
				}
				else 
				{
					if($confirmar_repetido == TRUE)
					{
						$response = '2';
					}
					else if($confirmar_repetido == FALSE OR 
					   empty($id_cliente) OR
					   empty($id_tipo_cita) OR
				       empty($fecha) OR
				       empty($hora))
					{
						$response = '3';
					}
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

	//LLENA EL MODAL CON LOS DATOS QUE SE USARAN PARA PAGAR LA CITA
	public function datos_pagar_cita()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request())
			{
				
				$id_cita = trim($this->input->post('id_cita'));
				if(!empty($id_cita))
				{
					//obtiene la informacion de la cita
					$DATA_CITA = $this->Citas_model->get_citas_by_id($id_cita);

					//obtiene el tipo de la cita y el id del cliente
					$id_tipo_cita = $DATA_CITA->id_tipo_cita;
					$id_cliente = $DATA_CITA->id_cliente;

					//obtiene la informacion de los costos
					$DATA_MEMBRESIA = $this->Citas_model->get_info_membresia($id_cliente);
					
					$numero_cita = 0;
					if($DATA_MEMBRESIA != FALSE){
						$numero_cita = $DATA_MEMBRESIA->numero_cita;
					}

					$DATA_COSTOS = $this->Costos_model->get_costos_por_tipo_cita($id_tipo_cita,$numero_cita);

					$DATA_COSTOS_HTML = "";
					if($DATA_COSTOS != FALSE){
						foreach ($DATA_COSTOS->result() as $row) {
							$DATA_COSTOS_HTML = $DATA_COSTOS_HTML.'<option value="'.$row->costo.'">'.$row->costo.'</option>';
						}
					}
					
					//obtiene la informacion de los turnos
					$DATA_TURNO = $this->Citas_model->get_turno($DATA_CITA->fecha);

					//envio de datos a la vista
					$data = array(
						'DATA_CITA' => $DATA_CITA,
						'DATA_TURNO' => $DATA_TURNO,
						'DATA_COSTOS' => $DATA_COSTOS_HTML,
					);
					echo json_encode($data);
				}else
				{
					echo json_encode("n/a");
				}
			}
			else
			{
	            show_404();
	        }
        }else{
			redirect(base_url());
		}
	}

	//LLENA EL SELECT DE TIPO DE CITAS CUANDO CAMBIA EL CLIENTE Y ESTABLECE SI ES MEMBRESIA O NO
	public function set_select_tipo_cita()
	{
		$id_cliente = $this->uri->segment(3);
		$is_membresia = $this->Citas_model->get_tipo_cita($id_cliente);
		$DATA_MEMBRESIA = $this->Citas_model->get_tipo_citas($is_membresia);
		if($DATA_MEMBRESIA != FALSE)
		{
			foreach ($DATA_MEMBRESIA->result() as $row) 
			{
				echo '<option value="'.$row->id_tipo_cita.'">'.$row->tipo_cita.'</option>';
			}
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
		else
		{
			echo '<option value="0">';
				echo '$0.00';	
			echo '</option>';
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

	public function get_estatura()
	{
		$id_cita = trim($this->input->post('id_cita'));
		$DATA_CITA = $this->Citas_model->get_citas_by_id($id_cita);
		if($DATA_CITA != FALSE)
		{
			$id_cliente = $DATA_CITA->id_cliente;
			$DATA_CLIENTE = $this->Clientes_model->get_estatura($id_cliente);
			if($DATA_CLIENTE != FALSE)
			{
				$response = $DATA_CLIENTE->estatura;
			}
		}
		else
		{
			$response = 0;
		}
		echo json_encode($response);
		
	}

	public function pagar_cita()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request()){
				$id_cita = $this->input->post('id_cita');
				$DATA_CITA = $this->Citas_model->get_citas_by_id($id_cita);
				$numero_consulta = $this->Citas_model->get_numero_consulta();
				$numero_turno = $this->Citas_model->get_turno($DATA_CITA->fecha);
				$costo_consulta = trim($this->input->post('costo_consulta'));
				$forma_pago = trim($this->input->post('forma_pago'));
				$id_tipo_cita = $DATA_CITA->id_tipo_cita;
				$id_cliente = $DATA_CITA->id_cliente;
				
				if(!empty($id_tipo_cita) AND
				   !empty($DATA_CITA) AND
				   !empty($numero_consulta) AND 
				   !empty($numero_turno) AND
				   $costo_consulta != '' AND
				   !empty($forma_pago) AND
				   !empty($id_tipo_cita) AND 
				   !empty($id_cliente))
				{

					//seccion registro de cita
					$data = array(				
						'costo_consulta' => $costo_consulta,
						'numero_consulta' => $numero_consulta,
						'numero_turno' => $numero_turno,
						'forma_pago' => $forma_pago,
						'cobrado' => 1,
						
					);

					$this->Citas_model->pagar_cita($data,$id_cita);
					
					//SECCION MEMBRESIAS
					if($id_tipo_cita == 2)
					{
						$DATA_MEMBRESIA = $this->Citas_model->get_info_membresia($id_cliente);
						if($DATA_MEMBRESIA != FALSE)
						{
							$numero_cita = $DATA_MEMBRESIA->numero_cita;
							if($numero_cita >= 5)
							{
								$DATA_MEMBRESIA = $this->Citas_model->get_max_membresia();
								$numero_membresia = $DATA_MEMBRESIA->numero_membresia + 1;
								$numero_cita = 1;

								$data = array(
									'numero_membresia' => $numero_membresia,
									'id_cita' => $id_cita,
									'id_cliente' => $id_cliente,
									'numero_cita' => $numero_cita,
								);
								$this->Citas_model->insert_membresia($data);
							}
							else
							{
								$numero_membresia = $DATA_MEMBRESIA->numero_membresia;
								$numero_cita = $numero_cita + 1;

								$data = array(
									'numero_membresia' => $numero_membresia,
									'id_cita' => $id_cita,
									'id_cliente' => $id_cliente,
									'numero_cita' => $numero_cita,
								);
								$this->Citas_model->insert_membresia($data);
							}
						}
						else
						{
							$DATA_MEMBRESIA = $this->Citas_model->get_max_membresia();
							$numero_membresia = $DATA_MEMBRESIA->numero_membresia + 1;
							$numero_cita = 1;

							$data = array(
								'numero_membresia' => $numero_membresia,
								'id_cita' => $id_cita,
								'id_cliente' => $id_cliente,
								'numero_cita' => $numero_cita,
							);
							$this->Citas_model->insert_membresia($data);
						}
					}
					$response = TRUE;
					echo json_encode($response);
				}
				else
				{
					$response = FALSE;
					echo json_encode($response);
				}
			}
			else
			{
	            show_404();
	        }
        }else{
			redirect(base_url());
		}
	}

	//METODO QUE PERMITE IMPRIMIR TICKET
	public function imprimir_ticket()
	{
		if($this->seguridad() == TRUE)
		{
			//Datos necesarios para crear PDF
			$id_cita = $this->uri->segment(3);
			$DATA_CITA = $this->Citas_model->get_citas_by_id($id_cita);
			
			//OBTENER INFORMACION MEMBRESIA
			if($DATA_CITA->id_tipo_cita == 2)
			{
				$DATA_MEMBRESIA = $this->Citas_model->get_info_membresia_by_id_cita($id_cita);
				$numero_membresia = $DATA_MEMBRESIA->numero_membresia;
				$numero_cita = $DATA_MEMBRESIA->numero_cita;
			}





	        $fecha_actual=date("d/m/Y");
	        $hora = date("h:m:s a");
	        $this->load->library('fpdf_manager');
	        $pdf = new fpdf_manager('P','mm',array(80,150));
	        
	        $Nombre_archivo = 'Ticket.pdf';
	        $pdf->SetMargins(0,1,1,0);
	        $pdf->SetTitle("Ticket Pago");
	        $pdf->AddPage();
	        /*Encabezado*/
	        $pdf->setY(3);
	        $pdf->SetFont('Times','B',11);
	        $pdf->Cell(2,3,'',0,0);
	        $pdf->Cell(0,5,'Control de Peso',0,1,'L');
	        $pdf->Image(base_url().'images/logo.jpg',65,3,15);
	        $pdf->SetFont('Times','B',7);
	        
	        $pdf->Cell(2,3,'',0,0);
	        $pdf->Cell(0,3,'LIC. EN CIENCIAS NUTRICIONALES',0,1,'L');
	        $pdf->Cell(2,3,'',0,0);
        	$pdf->Cell(0,3,'JORGE LUIS ESPINOZA CALLES',0,1,'L');
			$pdf->Cell(2,3,'',0,0);
        	$pdf->Cell(0,3,'RESPONSABLE SANITARIO',0,0,'L');
			
			
	        $pdf->SetFont('Times','B',7);
	        $pdf->Cell(0,6,'FOLIO: A-'.$DATA_CITA->numero_consulta,0,1,'R');
			
	        $pdf->SetFont('Times','',8);
	        $pdf->SetFillColor(230,230,230);

	        $pdf->Cell(4,4,'',0,0);
	        $pdf->SetFont('Times','B',8);
	        $pdf->Cell(72,4,utf8_decode('Hermosillo Sonora a').'                                             '.date("d-m-Y", strtotime($DATA_CITA->fecha)),1,1,'L',1);
	        $pdf->SetFont('Times','',8);

    		//
    		//$y = $pdf->getY();
    		//$x = $pdf->getX();
	        $pdf->Cell(4,4,'',0,0);
    		$pdf->MultiCell(72,4,utf8_decode('Nombre:'.$DATA_CITA->nombre_cliente.' '),1,'L');

    		//$pdf->setXY($x,$y);
    		//$pdf->Cell(28,4,'Nombre',1,1,'L',1,0);

    		//$y = $pdf->getY();
    		//$pdf->setY($y + 4);
    		
			/*$pdf->Cell(4,5,'',0,0);
    		$pdf->Cell(28,5,'Fecha Consulta:',1,0,'L',1);
    		$pdf->Cell(44,5,date("d-m-Y", strtotime($DATA_CITA->fecha)),1,1,'L');*/

    		/*$pdf->Cell(4,5,'',0,0);
    		$pdf->Cell(28,5,'Hora Consulta:',1,0,'L',1);
    		$pdf->Cell(44,5, date("g:i a", strtotime($DATA_CITA->hora)) ,1,1,'L');*/

    		if($DATA_CITA->id_tipo_cita == 2)
    		{
    			$pdf->Cell(4,4,'',0,0);
	    		$pdf->Cell(28,4,'Folio Membresia:',1,0,'L',1);
	    		$pdf->Cell(44,4, $numero_membresia ,1,1,'L');

	    		$pdf->Cell(4,4,'',0,0);
	    		$pdf->Cell(28,4,'Cita Membresia:',1,0,'L',1);
	    		$pdf->Cell(44,4, $numero_cita ." de 5" ,1,1,'L');
    		}

    		$pdf->Cell(4,4,'',0,0);
    		$pdf->Cell(28,4,'Costo Consulta:',1,0,'L',1);
    		$pdf->Cell(44,4,'$'.number_format($DATA_CITA->costo_consulta,2,'.', ','),1,1,'L');

    		$pdf->Cell(4,4,'',0,0);
    		$pdf->Cell(28,4,'Total:',1,0,'L',1);
    		$pdf->Cell(44,4,'$'.number_format($DATA_CITA->costo_consulta,2,'.', ','),1,1,'L');

	        $pdf->SetFont('Times','B',8);
	        $pdf->Cell(0,3,'Maribel Calles Castro',0,1,'C');
	        $pdf->Cell(0,3,'RFC : CACM620318MQ7 ',0,1,'C');
	        $pdf->Cell(0,3,utf8_decode('Régimen de las personas fisicas con actividades'),0,1,'C');
	        $pdf->Cell(0,3,'empresariales y profesionales',0,1,'C');
	        $pdf->SetFont('Times','',8);
	        $pdf->Cell(0,3,'Enrique Garcia Sanchez No. 115, Col. San Benito ',0,1,'C');
	        $pdf->Cell(0,3,'Hermosillo, Sonora Tel. (662) 210-02-85',0,1,'C');
	
			

	        $pdf->Ln();
	        
	        $pdf->AddPage();

	        //$pdf->setY(17);
	        $pdf->SetFont('Times','B',12);
	        /*$pdf->Cell(0,5,'Control de Peso',0,1,'C');*/
	        //$pdf->Image(base_url().'images/logo.jpg',35,0,15);
	        $pdf->SetFont('Times','B',7);
	        

        	//$pdf->ln();
	        
	        $pdf->SetFont('Times','',9);
	        $pdf->SetFillColor(230,230,230);
	        
	        $pdf->SetFont('Times','',8);
	        $pdf->SetFillColor(230,230,230);

	        $pdf->SetFont('Times','B',8);
	        $pdf->Cell(4,5,'',0,0);
	        $pdf->Cell(72,5,date("d-m-Y", strtotime($DATA_CITA->fecha)).'                                                                   '.'$'.number_format($DATA_CITA->costo_consulta,2,'.',','),1,1,'L',1);
	        $pdf->SetFont('Times','',8);

			$pdf->Cell(4,5,'',0,0);
    		
			$pdf->SetFont('Times','',11);
    		$pdf->MultiCell(72,5,utf8_decode('Nombre: '.$DATA_CITA->nombre_cliente.' '),1,'L');
			

    		if($DATA_CITA->id_tipo_cita == 2)
    		{
    			$pdf->Cell(4,4,'',0,0);
	    		$pdf->Cell(28,4,'Folio Membresia:',1,0,'L',1);
	    		$pdf->Cell(44,4, $numero_membresia ,1,1,'L');

	    		$pdf->Cell(4,4,'',0,0);
	    		$pdf->Cell(28,4,'Cita Membresia:',1,0,'L',1);
	    		$pdf->Cell(44,4, $numero_cita ." de 5" ,1,1,'L');
    		}

    		/*$pdf->Cell(4,5,'',0,0);
	        $pdf->SetFont('Times','B',12);
	        $pdf->MultiCell(72,5,'FAVOR DE ENTREGAR ESTE COMPROBANTE A SU NUTRIOLOGO',1,'C');*/
	        $pdf->SetFont('Times','',5);
	        $pdf->Cell(0,5,'PX-'.$DATA_CITA->numero_turno,0,1,'R');
	        
	        $pdf->AutoPrint();
	        $pdf->Output();
			//$pdf->Output($Nombre_archivo, 'I');
		}else{
			redirect(base_url());
		}
	}

	public function consultar_proximas_citas()
	{
		if($this->seguridad() == TRUE)
		{
			$id_cliente = $this->uri->segment(3);
			$fecha_actual = date('Y-m-d');
			$DATA_CITAS = $this->Citas_model->get_proximas_citas($id_cliente,$fecha_actual);
			
			?>
				<div class="box-body table-responsive">
					<div id="consultar_proximas_citas" name="consultar_proximas_citas">
						<table id="example2" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th><center>Tipo Consulta</center></th>
									<th><center>Fecha Cita</center></th>
									<th><center>Hora Cita</center></th>
								</tr>
							</thead>
							<tbody>
								<?php
								if($DATA_CITAS != FALSE)
								{
									foreach ($DATA_CITAS->result() as $row) 
									{
										echo '<tr>';
											echo '<td>';
												echo '<center>';
													echo $row->tipo_cita;
												echo '</center>';
											echo '</td>';

											echo '<td>';
												echo '<center>';
													echo date('d-m-Y',strtotime($row->fecha));
												echo '</center>';
											echo '</td>';

											echo '<td>';
												echo '<center>';
													echo date('h:m a',strtotime($row->hora));
												echo '</center>';
											echo '<td>';
										echo '</tr>';
									}
								}
								?>
							</tbody>
						</table>
					</div>
				</div>

			<?php
		}
        else
        {
			redirect(base_url());
		}
	}
	
	//OBTIENE LA LISTA DE CLIENTES QUE SE USARAN EN EL SELECT 2	
	public function obtener_clientes(){

      // Search term
      $searchTerm = $this->input->post('searchTerm');

      // Get users
      $response = $this->Clientes_model->get_clientes_select($searchTerm);

      echo json_encode($response);
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

					$data = array(
						'estatura' => trim($this->input->post('estatura')),
					);
					$this->Clientes_model->update_estatura($data,$id_cliente);
				}
				echo json_encode($data);
			
			}
			else
			{
	            show_404();
	        }
        }
        else
        {
			redirect(base_url());
		}
	}

	//==============================================================================
	//MODIFICAR CLIENTES
	//==============================================================================
	public function datos_modificar_cita()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request())
			{
				$id_cita = trim($this->input->post('id_cita'));
				$DATA_CITA = $this->Citas_model->get_citas_by_id($id_cita);
				$id_cliente = $DATA_CITA->id_cliente;

				echo json_encode($DATA_CITA);
				//var_dump($DATA_CITA);
			}
			else
			{
	            show_404();
	        }
        }
        else
        {
			redirect(base_url());
		}
	}

	//OBTIENE LOS TIPOS DE CITAS REGISTRADOS EN LA BASE DE DATOS
	public function get_tipo_citas()
	{
		if($this->seguridad() == TRUE)
		{
			$id_tipo_cita = $this->uri->segment(3);
			$DATA_CITA = $this->Citas_model->get_tipo_citas($this->Citas_model->get_tipo_cita_max_id_cliente());
			
			if($DATA_CITA != FALSE)
			{
				$option = "";
				foreach ($DATA_CITA->result() as $row) 
				{
					$option = $option.'<option value="'.$row->id_tipo_cita.'"';
					if($row->id_tipo_cita == $id_tipo_cita)
					{
						$option = $option. ' selected';						
					}
					$option = $option. '>'.$row->tipo_cita.'</option>';
				}

			}
			echo json_encode($option);
			
		}
        else
        {
			redirect(base_url());
		}
	}

	//FUNCION QUE PEMITE OBTENER EL COSTO DE LAS CONSULTAS EN BASE A EL TIPO DE CITA
	public function get_costos_citas()
	{
		if($this->seguridad() == TRUE)
		{
			$id_tipo_cita = $this->uri->segment(3);
			$numero_cita = $this->uri->segment(4);
			$DATA_COSTOS = $this->Costos_model->get_costos_por_tipo_cita($id_tipo_cita,$numero_cita);

			$DATA_COSTOS_HTML = "";
			if($DATA_COSTOS != FALSE){
				foreach ($DATA_COSTOS->result() as $row) {
					$DATA_COSTOS_HTML = $DATA_COSTOS_HTML.'<option value="'.$row->costo.'">'.$row->costo.'</option>';
				}
			}

			echo json_encode($DATA_COSTOS_HTML);

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
