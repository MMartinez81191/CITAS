<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Clientes_model');
	} 

	public function index()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->session->userdata('logueado') == TRUE)
			{
				$data = array(
					'DATA_CLIENTES' => $this->Clientes_model->get_clientes(),
				);

				$this->load->view('headers/librerias');
				$this->load->view('headers/menu');
				$this->load->view('clientes/lista_clientes',$data);
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

	public function historial()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->session->userdata('logueado') == TRUE)
			{
				$id_cliente = $this->uri->segment(3);
				$data = array(
					'DATA_HISTORIAL' => $this->Clientes_model->get_historial($id_cliente),
					'DATA_ESTATURA' => $this->Clientes_model->get_estatura($id_cliente),
				);

				$this->load->view('headers/librerias');
				$this->load->view('headers/menu');
				$this->load->view('clientes/historial_clientes',$data);
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

	public function add_peso()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request()){
				
				$data = array(				
					'id_cliente' => trim($this->input->post('id_cliente')),
					'peso' => trim($this->input->post('peso')),
					'fecha' => trim($this->input->post('fecha')),
				);
				$this->Clientes_model->insert_pesos($data);
				echo json_encode($data);
			
			}else{
	            show_404();
	        }
        }else{
			redirect(base_url());
		}
	}

	public function add_client()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->session->userdata('logueado') == TRUE)
			{
				$this->load->view('headers/librerias');
				$this->load->view('headers/menu');
				$this->load->view('clientes/add_clientes');
				$this->load->view('footers/librerias');
				$this->load->view('footers/cargar_js');
			}else
			{
				$script = '';
				$this->load->view('inicio/login',$script);
			}
		}else{
			redirect(base_url());
		}
	}

	public function datos_editar_cliente()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request())
			{
				
				$id_cliente = $this->input->post('id_cliente');
				$data = array(
					'DATA_CLIENTE' => $this->Clientes_model->get_clientes_by_id($id_cliente),
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

	public function datos_editar_peso()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request())
			{
				
				$id_peso = $this->input->post('id_peso');
				$data = array(
					'DATA_PESO' => $this->Clientes_model->get_peso_by_id($id_peso),
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

	public function editar_estatura()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request()){
				$id_cliente = trim($this->input->post('id_cliente'));
				
				$data = array(				
					'estatura' => trim($this->input->post('estatura')),
				);

				$this->Clientes_model->update_estatura($data,$id_cliente);
				var_dump($data);
			}else{
	            show_404();
	        }
        }else{
			redirect(base_url());
		}
	}

	public function editar_peso()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request()){
				$id_peso = $this->input->post('id_peso');
				
				$data = array(				
					'peso' => trim($this->input->post('peso')),
				);

				$this->Clientes_model->update_peso($data,$id_peso);
				var_dump($data);
			}else{
	            show_404();
	        }
        }else{
			redirect(base_url());
		}
	}

	public function editar_cliente()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request()){
				$id_cliente = $this->input->post('id_cliente');
				
				$data = array(				
					'nombre_cliente' => trim($this->input->post('nombre_cliente')),
					'correo_cliente' => trim($this->input->post('correo_cliente')),
					'telefono_cliente' => trim($this->input->post('telefono_cliente')),
					'fecha_nacimiento' => trim($this->input->post('fecha_nacimiento')),
				);

				$this->Clientes_model->update_cliente($data,$id_cliente);
				var_dump($data);
			}else{
	            show_404();
	        }
        }else{
			redirect(base_url());
		}
	}

	public function crear_cliente()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request()){
				$data = array(				
					'nombre_cliente' => trim($this->input->post('nombre')),
					'correo_cliente' => trim($this->input->post('correo_cliente')),
					'telefono_cliente' => trim($this->input->post('telefono_cliente')),
					'fecha_nacimiento' => trim($this->input->post('fecha_nacimiento')),
					'fecha_registro' => date('Y-m-d'),
				);
				$this->Clientes_model->insert_clientes($data);
				echo json_encode($data);
			}else{
	            show_404();
	        }
        }else{
			redirect(base_url());
		}
	}

	public function eliminar_cliente()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request()){

				$id_cliente = $this->input->post('id_cliente');
				$data = array(
					'activo' => 0,
				);
				$this->Clientes_model->delete_clientes($id_cliente,$data);

			}
			else
			{
	            show_404();
	        }
        }else{
			redirect(base_url());
		}
	}

	public function eliminar_peso()
	{
		if($this->seguridad() == TRUE)
		{
			if($this->input->is_ajax_request()){

				$id_peso = $this->input->post('id_peso');
				$data = array(
					'activo' => 0,
				);
				$this->Clientes_model->delete_peso($id_peso,$data);

			}
			else
			{
	            show_404();
	        }
        }else{
			redirect(base_url());
		}
	}

	public function imprmir_historial()
	{
		
		if($this->seguridad() == TRUE)
		{
			$id_cliente = $this->uri->segment(3);
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
	        $pdf->Cell(0,6,'HISTORIAL DE PACIENTE',0,0,'C');
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
	        $pdf->Ln();

	        $DATA_CLIENTE = $this->Clientes_model->get_clientes_by_id($id_cliente);
	        $DATA_HISTORIAL = $this->Clientes_model->get_historial($id_cliente);

	        $pdf->SetFont('Arial','',12);
	        $pdf->Cell(0,5,'Nombre del Paciente:'.$DATA_CLIENTE->nombre_cliente,0,1,'');
	        $pdf->Cell(0,5,'Fecha de Nacimimento:'.$DATA_CLIENTE->fecha_nacimiento,0,1,'');
	        $pdf->Cell(0,5,'Correo:'.$DATA_CLIENTE->correo_cliente,0,1,'');
	        $pdf->Cell(0,5,'Estatura:'.$DATA_CLIENTE->estatura.' m',0,1,'');
	        
	        
	        $pdf->Ln();

	        $pdf->SetFillColor(175,175,175); 
        	$pdf->SetFont('Arial','B',10);
        	$pdf->Cell(15,5,'',0,0,'C',0,0);
	        $pdf->Cell(80,5,'Fecha',1,0,'C',1);
	        $pdf->Cell(80,5,'Peso',1,0,'C',1);
	        $pdf->Cell(40,5,'',0,0,'C',0);
	        $pdf->Ln();

	        if($DATA_HISTORIAL != FALSE)
	        {
	        	foreach($DATA_HISTORIAL->result() as $row)
	        	{
        			$pdf->SetFont('Arial','',7);
			        $pdf->Cell(15,5,'',0,0,'C',0,0);
			        $pdf->Cell(80,5,$row->fecha,1,0,'C');
			        $pdf->Cell(80,5,$row->peso.' Kg',1,0,'C');

			        $pdf->Ln();

			        if($pdf->getY() > 250)
			        {
			        	$pdf->Ln();
				        $pdf->SetY(-30);
				        $pdf->Cell(0,3,$pdf->PageNo(),0,0,'C');
			        	$this->encabezado_pdf($pdf,$fecha_actual);
			        }

	        		
	        	}
	        }
	        


	        

	        $pdf->Ln();
	        $pdf->SetY(-30);
	        $pdf->Cell(0,3,$pdf->PageNo(),0,0,'C');

			$pdf->Output($Nombre_archivo, 'I');
		}else{
			redirect(base_url());
		}
	}


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
