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
					break;
				case '2':
					$mes = $this->uri->segment(4);
					$anio = $this->uri->segment(5);
					$DATA_CITAS = $this->Corte_model->get_citas_mes($mes,$anio);
					break;
				case '3':
					$anio = $this->uri->segment(4);
					$DATA_CITAS = $this->Corte_model->get_citas_anio($anio);
					break;
				case '4':
					$mes = $this->uri->segment(4);
					$anio = $this->uri->segment(5);
					$DATA_CITAS = $this->Corte_model->get_citas_pendientes($mes,$anio);
					break;
				default:
					$DATA_CITAS = FALSE;
					break;
			}

			?>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th><center>Folio</center></th>
						<th><center>Nombre Paciente</center></th>
						<th><center>Fecha Cita</center></th>
						<th><center>Hora Cita</center></th>
						<th><center>Costo Consulta</center></th>
						<th><center>Forma de Pago</center></th>
						<th class="no-sort"><center>Opciones</center></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$total_corte = 0;
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
									if($row->costo_consulta == '0'){
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
					} ?>
					
				</tbody> 
				<tr>
					<th colspan="4" style="text-align: right;">Total</th>
					<th><center><?='$'.number_format($total_corte,2,'.', ',')?></center></th>
				</tr>
			</table>
			<?php
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
					$informacion_cita = 'EL DIA '.$dia;
					break;
				case '2':
					$mes = $this->uri->segment(4);
					$anio = $this->uri->segment(5);
					$DATA_CITAS = $this->Corte_model->get_citas_mes($mes,$anio);
					$informacion_cita = 'EL MES '.$mes. ' DEL AÑO '.$anio;
					break;
				case '3':
					$anio = $this->uri->segment(4);
					$DATA_CITAS = $this->Corte_model->get_citas_anio($anio);
					$informacion_cita = 'EL AÑO '.$anio;
					break;
				case '4':
					$mes = $this->uri->segment(4);
					$anio = $this->uri->segment(5);
					$DATA_CITAS = $this->Corte_model->get_citas_pendientes($mes,$anio);
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
		        $pdf->Cell(40,5,'Fecha de Cita',1,0,'C',1);
		        $pdf->Cell(110,5,'Nombre del Paciente',1,0,'C',1);
		        $pdf->Cell(40,5,'Importe Cobrado',1,0,'C',1);
		        $pdf->Ln();
		        
	        	foreach($DATA_CITAS->result() as $row)
	        	{
	        		$total_corte = $row->costo_consulta + $total_corte;
        			$pdf->SetFont('Arial','',7);
			        $pdf->Cell(40,5,$row->fecha,1,0,'C');
			        $pdf->Cell(110,5,$row->nombre_cliente,1,0,'L');
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
		        $pdf->Cell(150,5,'Total:',1,0,'R');
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
