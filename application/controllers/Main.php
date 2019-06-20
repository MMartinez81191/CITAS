<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model');
	} 

	public function index()
	{			
		if($this->seguridad() == TRUE)
		{
			if($this->session->userdata('logueado') == TRUE)
			{
				$this->load->view('headers/librerias');
				$this->load->view('headers/menu');
				$this->load->view('inicio/inicio');
				$this->load->view('footers/librerias');
			}else
			{
				redirect(base_url());
			}
		}else
		{
			redirect(base_url());
		}
	}

	public function login()
	{		
		if($this->seguridad() == TRUE)
		{
			$data = array(
				'usuario' => $this->input->post('txt_usuario',true),
				'password' => $this->input->post('txt_password',true),
			);
			$query = $this->Main_model->auntenticar($data);
			if($query == false)
			{	
				$script = array('mensajes_swal' => 'swal("ERROR","Usuario o password Incorrectos", "error");');
				$this->load->view('inicio/login',$script);

			}
			else
			{
				
				foreach ($query->result() as $row) 
				{
					$id_usuario = $row->id_usuario;
					$usuario = $row->usuario_email;
					$nombre = $row->nombre;
					$apellido_p = $row->apellido_p;
					$apellido_m = $row->apellido_m;
					$password = $row->contrasena;
					$nivel = $row->id_nivel;
				}
				$newdata = array(
					'id_usuario' => $id_usuario,
					'usuario' => $usuario,
					'nombre' => $nombre,
					'apellido_p' => $apellido_p,
					'apellido_m' => $apellido_m,
					'password' => $password,
					'nivel' => $nivel,
					'logueado'=> TRUE,
				);

				$this->session->set_userdata($newdata);
				$this->index();			
			}
		}else
		{
			redirect(base_url());
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function seguridad()
	{
		if(($this->session->userdata('logueado') == 1))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

}
