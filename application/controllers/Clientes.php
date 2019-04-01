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
		$data = array(
			'DATA_USUARIOS' => $this->Clientes_model->get_clientes(),
		);

		$this->load->view('headers/librerias');
		$this->load->view('headers/menu');
		$this->load->view('clientes/lista_clientes',$data);
		$this->load->view('footers/librerias');
	}

	public function add_client()
	{
		$this->load->view('headers/librerias');
		$this->load->view('headers/menu');
		$this->load->view('clientes/add_clientes');
		$this->load->view('footers/librerias');
	}

	public function crear_cliente()
	{
		if($this->input->is_ajax_request()){
			$data = array(				
				'nombre_cliente' => trim($this->input->post('nombre')),
				'correo_cliente' => trim($this->input->post('cliente_email')),
				'telefono_cliente' => trim($this->input->post('telefono_cliente')),
				'fecha_nacimiento' => trim($this->input->post('fecha_nacimiento')),
			);
			$this->Clientes_model->insert_clientes($data);
			echo json_encode($data);
		}else{
            show_404();
        }
	}

	public function eliminar_cliente()
	{
		if($this->input->is_ajax_request()){

			$id_cliente = $this->input->post('id_cliente');

			$this->Clientes_model->delete_cliente($id_cliente);

		}else{
            show_404();
        }
	}
}
