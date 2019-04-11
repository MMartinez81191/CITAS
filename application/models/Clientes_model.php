<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model {
    

    function __construct()
    {
        parent::__construct();
    }

    public function get_clientes()
    {
        
        $this->db->from('clientes');
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

    public function get_clientes_by_id($id_cliente)
    {
        
        $this->db->from('clientes');
        $this->db->where('id_cliente',$id_cliente);
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

    public function insert_clientes($data)
    {
        $this->db->insert('clientes',$data);
    }

    public function delete_clientes($id_cliente,$data)
    {
        $this->db->where('id_cliente', $id_cliente);
        $this->db->update('clientes',$data);
    }


}
