<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Citas_model extends CI_Model {
    

    function __construct()
    {
        parent::__construct();
    }

    public function get_citas($fecha_inicio,$fecha_final)
    {
        
        $this->db->select('citas.*');
        $this->db->select('clientes.nombre_cliente');
        $this->db->from('citas');
        $this->db->join('clientes','clientes.id_cliente = citas.id_cliente');
        $this->db->where('fecha >=', $fecha_inicio);
        $this->db->where('fecha <', $fecha_final);
        $this->db->where('citas.activo',1);

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

    public function get_turno($fecha)
    {
        $this->db->select_max('numero_turno','turno');
        $this->db->from('citas');
        $this->db->where('fecha',$fecha);

        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row) 
            {
                $numero_turno = $row->turno;
            }
            return $numero_turno + 1;
        }
        else
        {
            return 1;
        }
    }

    public function insert_citas($data)
    {
        $this->db->insert('citas',$data);
    }

    public function delete_citas($id_cita,$data)
    {
        $this->db->where('id_cita', $id_cita);
        $this->db->update('citas',$data);
    }

    public function get_citas_by_id($id_cita)
    {
        $this->db->select('citas.*');
        $this->db->select('clientes.nombre_cliente');
        $this->db->from('citas');
        $this->db->join('clientes','clientes.id_cliente = citas.id_cliente');
        $this->db->where('citas.id_cita',$id_cita);
        
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

    public function pagar_cita($data,$id_cita)
    {
        $this->db->where('id_cita',$id_cita);
        $this->db->update('citas',$data);
    }


}
