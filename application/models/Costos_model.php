<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Costos_model extends CI_Model {
    

    function __construct()
    {
        parent::__construct();
    }

    public function get_costos()
    {
        
        $this->db->from('costos');
        $this->db->where('activo',1);
        
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

    public function comprobar_repetidos($costo)
    {
        $this->db->from('costos');
        $this->db->where('costo',$costo);
        
        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function insert_costos($data)
    {
        $this->db->insert('costos',$data);
    }

    public function delete_costos($id_costo)
    {
        $this->db->where('id_costo', $id_costo);
        $this->db->delete('costos');
    }

    public function get_costos_por_tipo_cita($id_tipo_cita,$numero_membresia)
    {
        if($numero_membresia == 0 AND $id_tipo_cita == 2)
        {
            $this->db->select_max('costos.costo');
        }else if($numero_membresia > 0 AND $id_tipo_cita == 2)
        {
            $this->db->select_min('costos.costo');
        }else if($id_tipo_cita != 2)
        {
            $this->db->select('costos.costo');
        }
        $this->db->from('rel_tipo_cita_precio');
        $this->db->join('costos','rel_tipo_cita_precio.id_costo = costos.id_costo');
        $this->db->where('id_tipo_cita',$id_tipo_cita);
        $this->db->order_by('costos.costo','DESC');
        

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
