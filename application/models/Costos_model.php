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
}
