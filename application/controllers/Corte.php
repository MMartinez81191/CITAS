<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Corte extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Corte_model');
	} 

	public function index()
	{
		if($this->seguridad() == TRUE)
		{
			$data = array(
				'DATA_CITAS' => FALSE,
				'DATA_ANIOS' => $this->Corte_model->get_anios(),
			);

			$this->load->view('headers/librerias');
			$this->load->view('headers/menu');
			$this->load->view('corte/lista_corte',$data);
			$this->load->view('footers/librerias');
			$this->load->view('footers/cargar_js');
		}
		else
		{
			redirect(base_url());
		}
	}

	public function obtener_citas()
	{
		if($this->seguridad() == TRUE)
		{
			$operacion = $this->uri->segment(3);
			
			switch ($operacion) {
				case '1':
					$dia = $this->uri->segment(4);
					$DATA_CITAS = $this->Corte_model->get_citas_dia($dia);
					$DATA_MEMBRESIA = $this->Corte_model->get_citas_dia_membresia($dia);
					break;
				case '2':
					$mes = $this->uri->segment(4);
					$anio = $this->uri->segment(5);
					$DATA_CITAS = $this->Corte_model->get_citas_mes($mes,$anio);
					$DATA_MEMBRESIA = $this->Corte_model->get_citas_mes_membresia($mes,$anio);
					break;
				case '3':
					$anio = $this->uri->segment(4);
					$DATA_CITAS = $this->Corte_model->get_citas_anio($anio);
					$DATA_MEMBRESIA = $this->Corte_model->get_citas_anio_membresia($anio);
					break;
				case '4':
					$mes = $this->uri->segment(4);
					$anio = $this->uri->segment(5);
					$DATA_CITAS = $this->Corte_model->get_citas_pendientes($mes,$anio);
					$DATA_MEMBRESIA = $this->Corte_model->get_citas_pendientes_membresia($mes,$anio);
					break;
				default:
					$DATA_CITAS = FALSE;
					break;
			}

			?>
			<hr>
			<center><h4>Detalle de Consultas</h4></center>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th><center>Pacientes</center></th>
						<th><center>Tipo Consulta</center></th>
						<th><center>Costo</center></th>
						<th><center>Total</center></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$total_corte = 0;
					if($DATA_CITAS != FALSE)
					{
						foreach ($DATA_CITAS->result() as $row) 
						{
							?>
							<tr>
								<td><center><?=$row->pacientes;?></center></td>
								<td><center><?= $row->tipo_cita;?></center></td>
								<td><center><?= '$'.number_format($row->costo,2,'.', ',')?></center></td>
								<td><center><?= '$'.number_format($row->total,2,'.', ',')?></center></td>
							</tr>
							<?php
							$total_corte = $total_corte + $row->total;
						}
					}
					?>
				</tbody> 
					<tr>
						<th colspan="3" style="text-align: right;">Total</th>
						<th><center><?='$'.number_format($total_corte,2,'.', ',')?></center></th>
					</tr>
			</table>

			<hr>
			<center><h4>Detalle de Membresias</h4></center>
			<br>
			<table id="example2" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th><center>Folio Membresia</center></th>
						<th><center>Numero Consulta</center></th>
						<th><center>Importe</center></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$total_corte = 0;
					if($DATA_MEMBRESIA != FALSE)
					{
						foreach ($DATA_MEMBRESIA->result() as $row) 
						{
							?>
							<tr>
								<td><center><?=$row->numero_membresia;?></center></td>
								<td><center><?= $row->numero_cita;?></center></td>
								<td><center><?=number_format($row->costo_consulta,2,'.', ',')?></center></td>
								
							</tr>
							<?php
							$total_corte = $total_corte + $row->costo_consulta;
						}
					}
					?>
				</tbody> 
					<tr>
						<th colspan="2" style="text-align: right;">Total</th>
						<th><center><?='$'.number_format($total_corte,2,'.', ',')?></center></th>
					</tr>
			</table>
			<?php
					/*$total_corte = 0;
					if($DATA_CITAS != FALSE) {
						foreach ($DATA_CITAS->result() as $row) 
						{
							$total_corte = $total_corte + $row->costo_consulta;
					?>
						<tr id="tr_<?= $row->id_cita; ?>" name="tr_<?= $row->id_cita; ?>" >
							<td><center><?= $row->id_cita;?></center></td>
							<td><center><?= $row->nombre_cliente;?></center></td>
							<td><center><?= $row->fecha ?></center></td>
							<td><center><?= date('h:i:s a', strtotime($row->hora))?></center></td>
							<td><center><?='$'.number_format($row->costo_consulta,2,'.', ',')?></center></td>
							<td>
								<center>
								<?php
								switch ($row->forma_pago) {
									case 1:
										echo "Efectivo";
										break;
									case 2:
										echo "Cheque";
										break;
									default:
										echo "Forma de Pago Desconocida";
										break;
								}
								
								?>		
								</center>
							</td>
							<td>
								<center>
									<?php
									if($row->costo_consulta == '-1')
									{
									?>
										<button data-id="<?= $row->id_cita; ?>" class="btn btn-success cobrar_cita"  data-toggle="modal" data-target="#modal_cobrar_cita" ><i class="fa fa-money"></i><span data-toggle="tooltip" data-placement="top" title="Cobrar Consulta" ></span></button>

										<button data-id="<?= $row->id_cita; ?>" class="btn btn-danger eliminar_cita" title="Eliminar Cita" data-toggle="tooltip" data-placement="top">  <i class="fa fa-close"></i></button>
									<?php
									}
									else
									{
									?>
										<a type="button" href="<?=base_url()?>citas/imprimir_ticket/<?=$row->id_cita?>" class="btn btn-success" target="_blank" ><i class="fa fa-print" data-toggle="tooltip" data-placement="top" title="Imprimir Ticket"  ></i><span></span></a>
									<?php
									}
									?>
								</center>
							</td>
						</tr>
					<?php
						}
					} 
					
				</tbody> 
				<tr>
					<th colspan="4" style="text-align: right;">Total</th>
					<th><center><?='$'.number_format($total_corte,2,'.', ',')?></center></th>
				</tr>
			</table>*/
			
		}else
		{
			redirect(base_url());
		}
	}

	public function imprimir_reporte_citas()
	{
		if($this->seguridad() == TRUE)
		{
			//Datos necesarios para crear PDF
	        $fecha_actual=date("d/m/Y");
	        $hora = date("h:m:s a");
	        $this->load->library('fpdf_manager');
	        $pdf = new fpdf_manager();
	        
	        
	        $Nombre_archivo = 'Reporte de Citas.pdf';
            $pdf->SetTitle("Corte de Caja");
	        $pdf->AddPage();
	        /*Encabezado*/
	        $pdf->Image(base_url().'images/logo.jpg',10,8,20);
	        $pdf->SetFont('Arial','B',12);
	        //$pdf->Cell(90,6,'',0,0);
	        $pdf->Cell(0,6,'REPORTE DE CITAS',0,0,'C');
	        $pdf->SetFont('Arial','I',7);
	        $pdf->Cell(0,6,'Fecha de realizacion:'.$fecha_actual,0,0,'R');
	        $pdf->Ln();


	        $pdf->SetFont('Arial','B',11);
	        $pdf->Cell(90,6,"",0,0);
	        $pdf->Cell(97,6,"",0,0,'C');
	        $pdf->Cell(90,6,"",0,0,'R');
	        $pdf->Ln();
	        $pdf->Ln();

	        
	        $pdf->Cell(30,5,"Realizado Por:",0,0,'L');
	        $pdf->SetFont('Arial','',12);
	        $pdf->Cell(222,5,$this->session->userdata('nombre'),0,0,'L');
	        $pdf->Ln();

	        $pdf->SetFont('Arial','',8);
	        $pdf->Cell(65,5,'',0,0,'R');
	        $pdf->Cell(25,5,"",0,0,'L');
	        $pdf->Ln();
	        $pdf->Ln();


			$operacion = $this->uri->segment(3);
			$total_corte = 0;

			switch ($operacion) {
				case '1':
					$dia = $this->uri->segment(4);
					$DATA_CITAS = $this->Corte_model->get_citas_dia($dia);
					$DATA_MEMBRESIA = $this->Corte_model->get_citas_dia_membresia($dia);
					$informacion_cita = 'EL DIA '.$dia;
					break;
				case '2':
					$mes = $this->uri->segment(4);
					$anio = $this->uri->segment(5);
					$DATA_CITAS = $this->Corte_model->get_citas_mes($mes,$anio);
					$DATA_MEMBRESIA = $this->Corte_model->get_citas_mes_membresia($mes,$anio);
					$informacion_cita = 'EL MES '.$mes. ' DEL AÑO '.$anio;
					break;
				case '3':
					$anio = $this->uri->segment(4);
					$DATA_CITAS = $this->Corte_model->get_citas_anio($anio);
					$DATA_MEMBRESIA = $this->Corte_model->get_citas_anio_membresia($anio);
					$informacion_cita = 'EL AÑO '.$anio;
					break;
				case '4':
					$mes = $this->uri->segment(4);
					$anio = $this->uri->segment(5);
					$DATA_CITAS = $this->Corte_model->get_citas_pendientes($mes,$anio);
					$DATA_MEMBRESIA = $this->Corte_model->get_citas_pendientes_membresia($mes,$anio);
					$informacion_cita = 'EL MES '.$mes. ' DEL AÑO '.$anio;
					break;
				default:
					$DATA_CITAS = FALSE;
					break;
			}
	        

	        $pdf->SetFont('Arial','B',12);
	        $pdf->Cell(0,5,utf8_decode('LISTADO DE CITAS REGISTRADAS '.$informacion_cita),0,0,'L');
	        $pdf->Ln();
	        $pdf->SetFont('Arial','',8);
	        $pdf->Ln();

	        
	        if($DATA_CITAS != FALSE)
	        {
	        	
	        	$pdf->SetFillColor(175,175,175); 
	        	$pdf->SetFont('Arial','B',10);
	        	$pdf->Cell(15,5,'',0,0,'C',0,0);
		        $pdf->Cell(40,5,'Pacientes',1,0,'C',1);
		        $pdf->Cell(40,5,'Tipo Cita',1,0,'C',1);
		        $pdf->Cell(40,5,'Costo',1,0,'C',1);
		        $pdf->Cell(40,5,'Total',1,0,'C',1);
		        $pdf->Ln();
		        
	        	foreach($DATA_CITAS->result() as $row)
	        	{
	        		$total_corte = $row->total + $total_corte;
        			$pdf->SetFont('Arial','',7);
			        $pdf->Cell(15,5,'',0,0,'C',0,0);
			        $pdf->Cell(40,5,$row->pacientes,1,0,'C');
			        $pdf->Cell(40,5,$row->tipo_cita,1,0,'L');
			        $pdf->Cell(40,5,'$'.number_format($row->costo,2,'.', ','),1,0,'C');
			        $pdf->Cell(40,5,'$'.number_format($row->total,2,'.', ','),1,0,'C');

			        $pdf->Ln();

			        if($pdf->getY() > 250)
			        {
			        	$pdf->Ln();
				        $pdf->SetY(-30);
				        $pdf->Cell(0,3,$pdf->PageNo(),0,0,'C');
			        	$this->encabezado_pdf($pdf,$fecha_actual);
			        }

	        		
	        	}

	        	$pdf->SetFillColor(155,155,155); 
	        	$pdf->SetFont('Arial','B',10);
		        $pdf->Cell(15,5,'',0,0,'C',0,0);
		        $pdf->Cell(120,5,'Total:',1,0,'R');
		        $pdf->Cell(40,5,'$'.number_format($total_corte,2,'.', ','),1,0,'C');
	        }
	        $pdf->Ln();
	        $pdf->Ln();
	        $pdf->SetFont('Arial','B',12);
	        $pdf->Cell(0,5,utf8_decode('DETALLE MEMBRESIAS REGISTRADAS '.$informacion_cita),0,0,'L');
	        $pdf->SetFont('Arial','',8);
	        $pdf->Ln();
	        $pdf->Ln();


	        if($DATA_MEMBRESIA != FALSE)
	        {
	        	
	        	$pdf->SetFillColor(175,175,175); 
	        	$pdf->SetFont('Arial','B',10);
	        	$pdf->Cell(35,5,'',0,0,'C',0,0);
		        $pdf->Cell(40,5,'Folio Membresia',1,0,'C',1);
		        $pdf->Cell(40,5,'Numero Consulta',1,0,'C',1);
		        $pdf->Cell(40,5,'Importe',1,0,'C',1);
		        
		        $pdf->Ln();
		        $total_corte = 0;
	        	foreach($DATA_MEMBRESIA->result() as $row)
	        	{
	        		$total_corte = $row->costo_consulta + $total_corte;
        			$pdf->SetFont('Arial','',7);
			        $pdf->Cell(35,5,'',0,0,'C',0,0);
			        $pdf->Cell(40,5,$row->numero_membresia,1,0,'C');
			        $pdf->Cell(40,5,$row->numero_cita,1,0,'L');
			        $pdf->Cell(40,5,'$'.number_format($row->costo_consulta,2,'.', ','),1,0,'C');
			        

			        $pdf->Ln();

			        if($pdf->getY() > 250)
			        {
			        	$pdf->Ln();
				        $pdf->SetY(-30);
				        $pdf->Cell(0,3,$pdf->PageNo(),0,0,'C');
			        	$this->encabezado_pdf($pdf,$fecha_actual);
			        }

	        		
	        	}

	        	$pdf->SetFillColor(155,155,155); 
	        	$pdf->SetFont('Arial','B',10);
		        $pdf->Cell(35,5,'',0,0,'C',0,0);
		        $pdf->Cell(80,5,'Total:',1,0,'R');
		        $pdf->Cell(40,5,'$'.number_format($total_corte,2,'.', ','),1,0,'C');
	        }

	        $pdf->Ln();
	        $pdf->SetY(-30);
	        $pdf->Cell(0,3,$pdf->PageNo(),0,0,'C');

			$pdf->Output($Nombre_archivo, 'I');
		}else{
			redirect(base_url());
		}
	}

	public function encabezado_pdf($pdf,$fecha_actual)
	{
		if($this->seguridad() == TRUE)
		{
			$pdf->SetTitle("Corte de Caja");
	        $pdf->AddPage();
	        /*Encabezado*/
	        $pdf->Image(base_url().'images/logo.jpg',10,8,20);
	        $pdf->SetFont('Arial','B',12);
	        //$pdf->Cell(90,6,'',0,0);
	        $pdf->Cell(0,6,'REPORTE DE CITAS',0,0,'C');
	        $pdf->SetFont('Arial','I',7);
	        $pdf->Cell(0,6,'Fecha de realizacion:'.$fecha_actual,0,0,'R');
	        $pdf->Ln();


	        $pdf->SetFont('Arial','B',11);
	        $pdf->Cell(90,6,"",0,0);
	        $pdf->Cell(97,6,"",0,0,'C');
	        $pdf->Cell(90,6,"",0,0,'R');
	        $pdf->Ln();
	        $pdf->Ln();

	        
	        $pdf->Cell(30,5,"Realizado Por:",0,0,'L');
	        $pdf->SetFont('Arial','',12);
	        $pdf->Cell(222,5,$this->session->userdata('nombre'),0,0,'L');
	        $pdf->Ln();

	        $pdf->SetFont('Arial','',8);
	        $pdf->Cell(65,5,'',0,0,'R');
	        $pdf->Cell(25,5,"",0,0,'L');
	        $pdf->Ln();
	        $pdf->Ln();

	        $pdf->SetFillColor(175,175,175); 
	    	$pdf->SetFont('Arial','B',10);
	        $pdf->Cell(40,5,'Fecha de Cita',1,0,'C',1);
	        $pdf->Cell(110,5,'Nombre del Paciente',1,0,'C',1);
	        $pdf->Cell(40,5,'Importe Cobrado',1,0,'C',1);
	        $pdf->Ln();
        }else{
			redirect(base_url());
		}
	}

	public function seguridad()
	{
		if(($this->session->userdata('logueado') == 1) and ($this->session->userdata('nivel') <= 5))
		{
			return true;
		}
		else
		{
			return false;
		}
	}




	
}
