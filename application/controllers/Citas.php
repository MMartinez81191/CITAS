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
		
		if($this->session->userdata('logueado') == TRUE)
		{
			$fechaInicio = date('Y-m-d');
			$fechaFinal = date('Y-m-d', strtotime(' + 1 days'));

			$data = array(
				'DATA_CITAS' => $this->Citas_model->get_citas($fechaInicio,$fechaFinal),
				'DATA_CLIENTES' => $this->Clientes_model->get_clientes(),
				'DATA_COSTOS' => $this->Costos_model->get_costos(),
			);

			$this->load->view('headers/librerias');
			$this->load->view('headers/menu');
			$this->load->view('citas/lista_citas',$data);
			$this->load->view('footers/librerias');
		}else
		{
			$script = '';
			$this->load->view('inicio/login',$script);
		}
	}


	public function obtenerCitas()
	{
		$fechaInicio = $this->uri->segment(3);
		$fechaFinal = $this->uri->segment(4);

		$DATA_CITAS = $this->Citas_model->get_citas($fechaInicio,$fechaFinal);
		?>
		<table id="example1" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th><center>Turno</center></th>
					<th><center>Nombre Paciente</center></th>
					<th><center>Fecha Cita</center></th>
					<th><center>Hora Cita</center></th>
					<th class="no-sort"><center>Opciones</center></th>
				</tr>
			</thead>
			<tbody>
				<?php if($DATA_CITAS != FALSE) {
					foreach ($DATA_CITAS->result() as $row) {
				?>
					<tr id="tr_<?= $row->id_cita; ?>" name="tr_<?= $row->id_cita; ?>" >
						<td><center><?= $row->numero_turno;?></center></td>
						<td><center><?= $row->nombre_cliente;?></center></td>
						<td><center><?= $row->fecha ?></center></td>
						<td><center><?= date('h:i:s a', strtotime($row->hora))?></center></td>
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
		</table>
		<?php
	}


	public function crear_cita()
	{
		if($this->input->is_ajax_request())
		{
			

			$fecha = trim($this->input->post('txt_fecha'));
			$hora = trim($this->input->post('txt_hora'));
			$confirmar_repetido = $this->Citas_model->comprobar_repetidos($fecha,date("H:i", strtotime($hora)));

			if($confirmar_repetido == FALSE)
			{
				$numero_turno = $this->Citas_model->get_turno($fecha);
				$data = array(				
					'id_cliente' => trim($this->input->post('id_cliente')),
					'numero_turno' => $numero_turno,
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
	}

	public function eliminar_cita()
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
	}

	public function datos_pagar_cita()
	{
		if($this->input->is_ajax_request())
		{
			
			$id_cita = $this->input->post('id_cita');
			$data = array(
				'DATA_CITA' => $this->Citas_model->get_citas_by_id($id_cita),
			);
			echo json_encode($data);
		}
		else
		{
            show_404();
        }
	}

	public function pagar_cita()
	{
		if($this->input->is_ajax_request()){
			$id_cita = $this->input->post('id_cita');
			
			$data = array(				
				'costo_consulta' => trim($this->input->post('costo_consulta')),
				'forma_pago' => trim($this->input->post('forma_pago')),
				'cobrado' => 1,
				
			);

			$this->Citas_model->pagar_cita($data,$id_cita);
			var_dump($data);
		}else
		{
            show_404();
        }
	}

	public function imprimir_ticket()
	{

		//Datos necesarios para crear PDF
		$id_cita = $this->uri->segment(3);
		$DATA_CITA = $this->Citas_model->get_citas_by_id($id_cita);

        $fecha_actual=date("d/m/Y");
        $hora = date("h:m:s a");
        $this->load->library('fpdf_manager');
        $pdf = new fpdf_manager('P','mm',array(34,200));
        
        $Nombre_archivo = 'Ticket.pdf';
        $pdf->SetMargins(1,1,1,1);
        $pdf->SetTitle("Ticket Pago");
        $pdf->AddPage();
        /*Encabezado*/
        $pdf->Image(base_url().'images/logo.png',12,3,10);
        $pdf->SetFont('Times','B',5);
        $pdf->setY(14);
        $pdf->Cell(0,3,'Control de Peso',0,1,'C');
        $pdf->Cell(0,3,'Lic. Nut. Luz Maria Everardo Ramirez',0,1,'C');

        $pdf->SetFont('Times','',4);
        $pdf->Cell(0,3,'---------------------------------------------',0,1,'C');
        
        $pdf->SetFont('Times','B',4);
        $pdf->Cell(6,3,'Folio:',0,0,'L');
        $pdf->SetFont('Times','',4);
        $pdf->Cell(0,3,$DATA_CITA->id_cita.'A',0,1,'L');

        $pdf->SetFont('Times','B',4);
        $pdf->Cell(6,3,'Turno:',0,0,'L');
        $pdf->SetFont('Times','',4);
        $pdf->Cell(0,3,'#'.$DATA_CITA->numero_turno,0,1,'L');

        $pdf->SetFont('Times','B',4);
        $pdf->Cell(6,3,'Fecha:',0,0,'L');
        $pdf->SetFont('Times','',4);
        $pdf->Cell(0,3,$DATA_CITA->fecha,0,1,'L');

        $pdf->SetFont('Times','B',4);
        $pdf->Cell(6,3,'Nombre:',0,0,'L');
        $pdf->SetFont('Times','',4);
        $pdf->Cell(0,3,$DATA_CITA->nombre_cliente,0,1,'L');

        $pdf->SetFont('Times','B',4);
        $pdf->Cell(6,3,'Importe:',0,0,'L');
        $pdf->SetFont('Times','',4);
        $pdf->Cell(0,3,'$'.number_format($DATA_CITA->costo_consulta,2,'.', ','),0,1,'L');

        $pdf->Cell(0,3,'---------------------------------------------',0,1,'C');
        $pdf->SetFont('Times','B',3);
        $pdf->Cell(0,1,'Maribel Calles Castro',0,1,'C');
        $pdf->Cell(0,1,'RFC : CACM620318MQ7 ',0,1,'C');
        $pdf->SetFont('Times','',3);
        $pdf->Cell(0,1,'Enrrique Garcia Sanchez No. 115 Esquina',0,1,'C');
        $pdf->Cell(0,1,'Avenida Aguascalientes Planta Baja Col. San Benito',0,1,'C');
        $pdf->Cell(0,1,'Hermosillo Sonora Tel. (662) 210-02-85',0,1,'C');


        



        
        

        $pdf->Ln();
        $pdf->SetY(-30);
        $pdf->Cell(0,3,$pdf->PageNo(),0,0,'C');

		$pdf->Output($Nombre_archivo, 'I');
	}
}
