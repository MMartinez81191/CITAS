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

    public function get_peso_by_id($id_peso)
    {
        
        $this->db->from('pesos');
        $this->db->where('id_peso',$id_peso);
        
        
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

    public function get_clientes_by_id($id_cliente)
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

    public function update_estatura($data,$id_cliente)
    {
        $this->db->where('id_cliente', $id_cliente);
        $this->db->update('clientes',$data);
    }

    public function update_peso($data,$id_peso)
    {
        $this->db->where('id_peso', $id_peso);
        $this->db->update('pesos',$data);
    }

    public function update_cliente($data,$id_cliente)
    {
        $this->db->where('id_cliente', $id_cliente);
        $this->db->update('clientes',$data);
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

    public function delete_peso($id_peso,$data)
    {
        $this->db->where('id_peso', $id_peso);
        $this->db->update('pesos',$data);
    }

    //FUNCION PARA OBTENER LA ESTATURA DE UN CLIENTE
    public function get_estatura($id_cliente)
    {
        $this->db->select('id_cliente,estatura');
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

    public function get_historial($id_cliente)
    {
        $this->db->select('clientes.id_cliente, nombre_cliente, pesos.id_peso, peso, fecha');  
        $this->db->from('pesos');
        $this->db->join('clientes', 'pesos.id_cliente = clientes.id_cliente');
        $this->db->where('clientes.id_cliente',$id_cliente);
        $this->db->where('pesos.activo',1);
        $this->db->order_by('id_peso', 'DESC');
        
        $query = $this->db->get();

        //echo $this->db->last_query();
        if($query->num_rows() > 0)
        {
            return $query;
        }
        else
        {
            return FALSE;
        }
    }

    public function insert_pesos($data)
    {
        $this->db->insert('pesos',$data);
    }
}
