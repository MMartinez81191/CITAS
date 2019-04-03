<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Citas_model extends CI_Model {
    

    function __construct()
    {
        parent::__construct();
    }

    public function get_citas()
    {
        
        $this->db->select('citas.*');
        $this->db->select('clientes.nombre_cliente');
        $this->db->from('citas');
        $this->db->join('clientes','clientes.id_cliente = citas.id_cliente');



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

    public function insert_citas($data)
    {
        $this->db->insert('citas',$data);
        echo $this->db->last_query();
    }

    public function delete_clientes($id_cliente)
    {
        $this->db->where('id_cliente', $id_cliente);
        $this->db->delete('clientes');
    }


}
