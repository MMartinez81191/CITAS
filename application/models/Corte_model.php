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


    //OBTENER CORTE POR DIA
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

    public function get_citas_dia_membresia($dia)
    {
        $this->db->select('citas.id_cita,citas.costo_consulta');
        $this->db->select('membresias.numero_membresia,membresias.numero_cita');
              
        
        $this->db->from('citas');
        
        $this->db->join('tipos_citas','tipos_citas.id_tipo_cita = citas.id_tipo_cita');
        $this->db->join('membresias','membresias.id_cita = citas.id_cita');


        $this->db->where('citas.activo',1);
        $this->db->where('cobrado',1);
        $this->db->where('fecha',$dia);

        $this->db->order_by('numero_membresia,numero_cita');


        
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

    //OBTENER CORTE POR MES
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

    public function get_citas_mes_membresia($mes,$anio)
    {
        $this->db->select('citas.id_cita,citas.costo_consulta');
        $this->db->select('membresias.numero_membresia,membresias.numero_cita');

        $this->db->from('citas');

        $this->db->join('tipos_citas','tipos_citas.id_tipo_cita = citas.id_tipo_cita');
        $this->db->join('membresias','membresias.id_cita = citas.id_cita');

        $this->db->where('citas.activo',1);
        $this->db->where('cobrado',1);
        $this->db->where('month(fecha)',$mes);
        $this->db->where('year(fecha)',$anio);

        $this->db->order_by('numero_membresia,numero_cita');
        
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

    //OBTENER CORTE POR ANIO
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

    public function get_citas_anio_membresia($anio)
    {
        $this->db->select('citas.id_cita,citas.costo_consulta');
        $this->db->select('membresias.numero_membresia,membresias.numero_cita');

        $this->db->from('citas');

        $this->db->join('tipos_citas','tipos_citas.id_tipo_cita = citas.id_tipo_cita');
        $this->db->join('membresias','membresias.id_cita = citas.id_cita');

        $this->db->where('citas.activo',1);
        $this->db->where('cobrado',1);
        $this->db->where('year(fecha)',$anio);

        $this->db->order_by('numero_membresia,numero_cita');
        
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

    //OBTENER CITAS PENDIENTES
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

    public function get_citas_pendientes_membresia($mes,$anio)
    {
        
        $this->db->select('citas.id_cita,citas.costo_consulta');
        $this->db->select('membresias.numero_membresia,membresias.numero_cita');

        $this->db->from('citas');

        $this->db->join('tipos_citas','tipos_citas.id_tipo_cita = citas.id_tipo_cita');
        $this->db->join('membresias','membresias.id_cita = citas.id_cita');
        
        $this->db->where('citas.activo',1);
        $this->db->where('cobrado',0);
        $this->db->where('month(fecha)',$mes);
        $this->db->where('year(fecha)',$anio);

        $this->db->order_by('numero_membresia,numero_cita');
        
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

    //=================================================================
    //GASTOS
    //=================================================================

    public function get_gasto_dia($dia)
    {
        $this->db->from('gastos');
        $this->db->where('fecha',$dia);

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
