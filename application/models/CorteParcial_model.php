<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CorteParcial_Model extends CI_Model {
    

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


//================================================================
    public function get_total_citas($fecha_inicial,$fecha_final)
    {
        $this->db->select_sum('costo_consulta','total_citas');
        $this->db->from('citas');
        $this->db->where('cobrado',1);
        $this->db->where('activo',1);
        $this->db->where('fecha >=',$fecha_inicial);
        $this->db->where('fecha <=',$fecha_final);

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

    public function get_citas_intervalo($fecha_inicial,$fecha_final)
    {
        $this->db->select('id_cita,costo_consulta');
        $this->db->from('citas');
        $this->db->where('cobrado',1);
        $this->db->where('activo',1);
        $this->db->where('fecha >=',$fecha_inicial);
        $this->db->where('fecha <=',$fecha_final);
        $this->db->order_by('id_cita','ASC');

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

    public function get_max_citas($fecha_inicial,$fecha_final)
    {
        $this->db->select_max('id_cita');
        $this->db->from('citas');
        $this->db->where('cobrado',1);
        $this->db->where('activo',1);
        $this->db->where('fecha >=',$fecha_inicial);
        $this->db->where('fecha <=',$fecha_final);

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

    public function get_min_citas($fecha_inicial,$fecha_final)
    {
        $this->db->select_min('id_cita');
        $this->db->from('citas');
        $this->db->where('cobrado',1);
        $this->db->where('activo',1);
        $this->db->where('fecha >=',$fecha_inicial);
        $this->db->where('fecha <=',$fecha_final);

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


    public function get_data_cita($id_cita)
    {
        $this->db->from('citas');
        $this->db->where('id_cita',$id_cita);
        $this->db->where('cobrado',1);
        $this->db->where('activo',1);

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

    public function insert_cortes_caja($data)
    {
        $this->db->insert('cortes_caja',$data);
    }

    public function get_numero_session()
    {
        $this->db->select_max('numero_session');
        $this->db->from('cortes_caja');

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

    public function update_corte_caja($)


//===============================================================
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
        $this->db->select('citas.*');
        $this->db->select('clientes.nombre_cliente');
        $this->db->from('citas');
        $this->db->join('clientes','clientes.id_cliente = citas.id_cliente');
        $this->db->where('citas.activo',1);
        $this->db->where('cobrado',1);
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

    public function get_citas_mes($mes,$anio)
    {
        $this->db->select('citas.*');
        $this->db->select('clientes.nombre_cliente');
        $this->db->from('citas');
        $this->db->join('clientes','clientes.id_cliente = citas.id_cliente');
        $this->db->where('citas.activo',1);
        $this->db->where('cobrado',1);
        $this->db->where('month(fecha)',$mes);
        $this->db->where('year(fecha)',$anio);
        
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
        $this->db->select('citas.*');
        $this->db->select('clientes.nombre_cliente');
        $this->db->from('citas');
        $this->db->join('clientes','clientes.id_cliente = citas.id_cliente');
        $this->db->where('citas.activo',1);
        $this->db->where('cobrado',1);
        $this->db->where('year(fecha)',$anio);
        
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
        $this->db->select('citas.*');
        $this->db->select('clientes.nombre_cliente');
        $this->db->from('citas');
        $this->db->join('clientes','clientes.id_cliente = citas.id_cliente');
        $this->db->where('citas.activo',1);
        $this->db->where('cobrado',0);
        $this->db->where('month(fecha)',$mes);
        $this->db->where('year(fecha)',$anio);
        
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
