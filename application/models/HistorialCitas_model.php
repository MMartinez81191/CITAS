<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HistorialCitas_Model extends CI_Model {
    
	//============================================================================
	//CONSTRUCTOR DE LA CLASE
	//============================================================================
    function __construct()
    {
        parent::__construct();
    }

	//============================================================================
	//OBTIENE LA INFORMACION DE TODAS LAS CITAS CON EL ID CLIENTE 
    //ENVIADO COMO PARAMETRO
	//============================================================================
    public function get_data_citas($id_cliente)
    {
    	$this->db->select('citas.*');
    	$this->db->select('tipos_citas.tipo_cita');
    	$this->db->from('citas');
    	$this->db->where('id_cliente',$id_cliente);
    	$this->db->join('tipos_citas','citas.id_tipo_cita = tipos_citas.id_tipo_cita');
        $this->db->order_by('fecha,hora','DESC');

    	$query = $this->db->get();

    	if($query->num_rows() > 0)
    	{
    		return $query;
    	}
    	else
    	{
    		return FALSE;
    	}
    }
}
