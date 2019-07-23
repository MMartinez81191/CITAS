<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Corte_model extends CI_Model {
    

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

    public function get_anios()
    {
        $this->db->distinct();
        $this->db->select('year(fecha) AS anio');
        $this->db->from('citas');
        $this->db->where('activo',1);
        $this->db->order_by('anio','asc');

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

    public function get_citas_dia($dia)
    {
        $this->db->select('count(citas.id_tipo_cita) AS pacientes');
        $this->db->select('tipos_citas.tipo_cita');
        $this->db->select('(sum(citas.costo_consulta) / count(citas.id_tipo_cita)) as costo');
        $this->db->select('sum(citas.costo_consulta) AS total');
        
        $this->db->from('citas');
        
        $this->db->join('tipos_citas','tipos_citas.id_tipo_cita = citas.id_tipo_cita');

        $this->db->where('citas.activo',1);
        $this->db->where('cobrado',1);
        $this->db->where('fecha',$dia);

        $this->db->group_by('tipos_citas.tipo_cita');
        $this->db->group_by('citas.costo_consulta');



        
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

    public function get_citas_mes($mes,$anio)
    {
        $this->db->select('count(citas.id_tipo_cita) AS pacientes');
        $this->db->select('tipos_citas.tipo_cita');
        $this->db->select('(sum(citas.costo_consulta) / count(citas.id_tipo_cita)) as costo');
        $this->db->select('sum(citas.costo_consulta) AS total');

        $this->db->from('citas');

        $this->db->join('tipos_citas','tipos_citas.id_tipo_cita = citas.id_tipo_cita');

        $this->db->where('citas.activo',1);
        $this->db->where('cobrado',1);
        $this->db->where('month(fecha)',$mes);
        $this->db->where('year(fecha)',$anio);

        $this->db->group_by('tipos_citas.tipo_cita');
        $this->db->group_by('citas.costo_consulta');
        
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

    public function get_citas_anio($anio)
    {
        $this->db->select('count(citas.id_tipo_cita) AS pacientes');
        $this->db->select('tipos_citas.tipo_cita');
        $this->db->select('(sum(citas.costo_consulta) / count(citas.id_tipo_cita)) as costo');
        $this->db->select('sum(citas.costo_consulta) AS total');

        $this->db->from('citas');

        $this->db->join('tipos_citas','tipos_citas.id_tipo_cita = citas.id_tipo_cita');

        $this->db->where('citas.activo',1);
        $this->db->where('cobrado',1);
        $this->db->where('year(fecha)',$anio);

        $this->db->group_by('tipos_citas.tipo_cita');
        $this->db->group_by('citas.costo_consulta');
        
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

    public function get_citas_pendientes($mes,$anio)
    {
        $this->db->select('count(citas.id_tipo_cita) AS pacientes');
        $this->db->select('tipos_citas.tipo_cita');
        $this->db->select('(sum(citas.costo_consulta) / count(citas.id_tipo_cita)) as costo');
        $this->db->select('sum(citas.costo_consulta) AS total');

        $this->db->from('citas');

        $this->db->join('tipos_citas','tipos_citas.id_tipo_cita = citas.id_tipo_cita');
        
        $this->db->where('citas.activo',1);
        $this->db->where('cobrado',0);
        $this->db->where('month(fecha)',$mes);
        $this->db->where('year(fecha)',$anio);

        $this->db->group_by('tipos_citas.tipo_cita');
        $this->db->group_by('citas.costo_consulta');
        
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
