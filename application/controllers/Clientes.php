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
				$this->load->view('clientes/lista_clientes');
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

	function getLists(){
        $nivel_usuario = $this->session->userdata('nivel');
        $data = $row = array();
        
        // Fetch member's records
        $memData = $this->Clientes_model->getRows($_POST);
        
        $i = $_POST['start'];
        foreach($memData as $member){
            $i++;
           // $created = date( 'jS M Y', strtotime($member->created));
           // $status = ($member->status == 1)?'Active':'Inactive';
            if($nivel_usuario < 3)
            {
            	$data[] = 
            	array(
    				'<center>'.$i.'</center>', 
    				'<center>'.$member->nombre_cliente.'</center>',
					'
					<center>
						<button data-id="'.$member->id_cliente.'" class="btn btn-primary editar_user"  data-toggle="modal" data-target="#modal_cliente_editar" ><i class="fa fa-edit"></i><span data-toggle="tooltip" data-placement="top" title="Modificar Paciente" ></span></button>

						<!--<a type="button" href="'.base_url().'clientes/historial/'.$member->id_cliente.'" class="btn btn-primary"><i class="fa fa-file-text" data-toggle="tooltip" data-placement="top" title="Historial"  ></i><span></span></a>-->
						
						<a type="button" href="'.base_url().'clientes/cargar_historial/'.$member->id_cliente.'" class="btn btn-default"><i class="fa fa-user" data-toggle="tooltip" data-placement="top" title="Historial Citas"  ></i><span></span></a>

						<a type="button" href="'.base_url().'clientes/imprimir_expediente/'.$member->id_cliente.'" class="btn btn-primary" target="_blanck"><i class="fa fa-print" data-toggle="tooltip" data-placement="top" title="Expediente"  ></i><span></span></a>

						<button data-id="'.$member->id_cliente.'" class="btn btn-danger eliminar_cliente" title="Eliminar Paciente" data-toggle="tooltip" data-placement="top">  <i class="fa fa-close"></i></button>
					</center>
					'
				);
            }
            else
            {
	            $data[] = 
	            	array(
        				'<center>'.$i.'</center>', 
        				'<center>'.$member->nombre_cliente.'</center>',
						'
						<center>
							<button data-id="'.$member->id_cliente.'" class="btn btn-primary editar_user"  data-toggle="modal" data-target="#modal_cliente_editar" ><i class="fa fa-edit"></i><span data-toggle="tooltip" data-placement="top" title="Modificar Paciente" ></span></button>

							<a type="button" href="'.base_url().'clientes/historial/'.$member->id_cliente.'" class="btn btn-primary"><i class="fa fa-file-text" data-toggle="tooltip" data-placement="top" title="Historial"  ></i><span></span></a>

							<a type="button" href="'.base_url().'clientes/imprimir_expediente/'.$member->id_cliente.'" class="btn btn-primary" target="_blanck"><i class="fa fa-print" data-toggle="tooltip" data-placement="top" title="Expediente"  ></i><span></span></a>
						</center>
						'
					);
	        }
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Clientes_model->countAll(),
            "recordsFiltered" => $this->Clientes_model->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
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

	//============================================================================
	//FUNCION QUE CARGA EL CONSTRUCTOR DE HISTORIAL CITAS
	//============================================================================
	public function cargar_historial()
	{
		if($this->seguridad() == TRUE)
		{
			$id_cliente = $this->uri->segment(3);

			$newdata = array(
				'id_cliente' => $id_cliente,
			);
			$this->session->set_userdata($newdata);

			redirect(base_url().'historial_citas/');
		}
        else
        {
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

	public function imprimir_expediente()
	{
		if($this->seguridad() == TRUE)
		{
			$id_cliente = $this->uri->segment(3);
			//Datos necesarios para crear PDF
	        $fecha_actual=date("d/m/Y");
	        $hora = date("h:m:s a");
	        $this->load->library('fpdf_manager');
	        $pdf = new fpdf_manager();
	        $DATA_CLIENTE = $this->Clientes_model->get_clientes_by_id($id_cliente);
	        $DATA_HISTORIAL = $this->Clientes_model->get_historial($id_cliente);
	        
	        //CALCULAR LA EDAD
	        $fecha_nacimiento = date("d-m-Y", strtotime($DATA_CLIENTE->fecha_nacimiento));
			$dias = explode("-",$fecha_nacimiento, 3);
		    $dias = mktime(0,0,0,$dias[1],$dias[0],$dias[2]);
		    $edad = (int)((time()-$dias)/31556926 );
		    


	        $Nombre_archivo = 'Historial de Pacientes.pdf';
            $pdf->SetTitle("Expediente");
	        $pdf->AddPage();
	        /*Encabezado*/
	        $pdf->Image(base_url().'images/logo.jpg',10,8,30);
	        $pdf->SetFont('Arial','B',16);
	        //$pdf->Cell(90,6,'',0,0);
	        $pdf->Cell(0,7,utf8_decode($DATA_CLIENTE->nombre_cliente),0,0,'C');
	        $pdf->SetFont('Arial','B',10);
	        $pdf->Cell(0,7,utf8_decode('Edad:'.$edad . ' años'),0,0,'R');
	        $pdf->SetFont('Arial','B',7);
	        $pdf->ln();
	        $pdf->SetFont('Arial','B',16);
	        $pdf->Cell(0,12,'NOTA EVOLUTORIA DE CONSULTA',0,0,'C');
	        $pdf->SetFont('Arial','I',7);
	        
	        $pdf->ln();
	        $pdf->Ln();
	        
	        
	        

	        $pdf->SetFillColor(175,175,175); 
        	$pdf->SetFont('Arial','B',10);

        	$pdf->Cell(38,5,'DATOS',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 1',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 2',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 3',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 4',1,0,'C',1);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'P.A.:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'G.A.:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'FECHA:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();
	        $pdf->ln();

	        $pdf->Cell(38,5,'DATOS',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 5',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 6',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 7',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 8',1,0,'C',1);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'P.A.:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'G.A.:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'FECHA:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();
	        $pdf->ln();

	        $pdf->Cell(38,5,'DATOS',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 9',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 10',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 11',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 12',1,0,'C',1);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'P.A.:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'G.A.:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'FECHA:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();
	        $pdf->ln();

	        $pdf->Cell(38,5,'DATOS',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 13',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 14',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 15',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 16',1,0,'C',1);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'P.A.:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'G.A.:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'FECHA:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();
	        $pdf->ln();

	        $pdf->Cell(38,5,'DATOS',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 17',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 18',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 19',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 20',1,0,'C',1);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'P.A.:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'G.A.:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'FECHA:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();
	        $pdf->ln();

	        $pdf->Cell(38,5,'DATOS',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 21',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 22',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 23',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 24',1,0,'C',1);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'P.A.:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'G.A.:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'FECHA:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();
	        $pdf->ln();

	        $pdf->Cell(38,5,'DATOS',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 25',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 26',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 27',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 28',1,0,'C',1);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'P.A.:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'G.A.:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'FECHA:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();
	        $pdf->Ln();

	        $pdf->Cell(38,5,'DATOS',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 29',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 30',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 31',1,0,'C',1);
	        $pdf->Cell(38,5,'CONSULTA 32',1,0,'C',1);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'P.A.:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'L',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'G.A.:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();

	        $pdf->Cell(38,5,'FECHA:',1,0,'L',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Cell(38,5,'',1,0,'C',0);
	        $pdf->Ln();


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
