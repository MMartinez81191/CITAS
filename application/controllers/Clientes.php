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
