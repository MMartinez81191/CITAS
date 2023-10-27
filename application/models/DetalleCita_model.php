<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetalleCita_Model extends CI_Model {
    
	//============================================================================
	//CONSTRUCTOR DE LA CLASE
	//============================================================================
    function __construct()
    {
        parent::__construct();
    }

	//============================================================================
	//OBTIENE LA INFORMACION DE LA CITA CON EL ID ENVIADO COMO PARAMETRO
	//============================================================================
    public function get_data_cita($id_cita)
    {
    	$this->db->select('citas.*');
    	$this->db->select('tipos_citas.tipo_cita');
    	$this->db->from('citas');
    	$this->db->where('id_cita',$id_cita);
    	$this->db->join('tipos_citas','citas.id_tipo_cita = tipos_citas.id_tipo_cita');

    	$query = $this->db->get();

    	if($query->num_rows() > 0)
    	{
    		return $query->row();
    	}
    	else
    	{
    		return FALSE;
    	}
    }

	//============================================================================
	//OBTIENE LA INFORMACION DEL CLIENTE CON EL ID ENVIADO COMO PARAMETRO
	//============================================================================
	public function get_data_cliente($id_cliente)
	{
		$this->db->from('clientes');
    	$this->db->where('id_cliente',$id_cliente);

    	$query = $this->db->get();

    	if($query->num_rows() > 0)
    	{
    		return $query->row();
    	}
    	else
    	{
    		return FALSE;
    	}
	}

    //============================================================================
    //OBTIENE EL DETALLE DE LAS CITAS PREVIAS DEL PACIENTE
    //============================================================================
    public function get_data_citas_previas($id_cita,$id_cliente)
    {
        $this->db->select('fecha,peso,dieta,notas_relevantes');
        $this->db->from('citas');
        $this->db->where('id_cliente',$id_cliente);
        $this->db->where('id_cita <',$id_cita);
        $this->db->where('costo_consulta != ','-1');
        $this->db->where('activo',1);
        $this->db->order_by('id_cita','DESC');

        $this->db->limit(32);
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

    //============================================================================
    //ACTUALIZA LA INFORMACION DE LA CITA CON EL ID ENVIADO COMO PARAMETRO
    //============================================================================
    public function update_cita($id_cita,$data_cita)
    {
        $this->db->where('id_cita',$id_cita);
        $this->db->update('citas',$data_cita);
        
        $updated_rows = $this->db->affected_rows();
        return $updated_rows;    
    }

    //============================================================================
    //ACTUALIZA LA INFORMACION DEL CLIENTE CON EL ID ENVIADO COMO PARAMETRO
    //============================================================================
    public function update_cliente($id_cliente,$data_cliente)
    {
        $this->db->where('id_cliente',$id_cliente);
        $this->db->update('clientes',$data_cliente);
        
        $updated_rows = $this->db->affected_rows();
        return $updated_rows;
    }
}
