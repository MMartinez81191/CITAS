<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CorteParcial_Model extends CI_Model {
    

    function __construct()
    {
        parent::__construct();
    }

    //LISTA CORTES
    public function get_cortes()
    {
        
        $this->db->select('numero_session,fecha_inicio_corte,fecha_final_corte');
        $this->db->select_sum('costo_consulta','total_corte');
        $this->db->from('cortes_caja');
        $this->db->group_by('numero_session,fecha_inicio_corte,fecha_final_corte');


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

    public function get_cortes_ticket($numero_session)
    {
        $this->db->select('clientes.nombre_cliente');
        $this->db->select('id_corte,fecha,hora,costo_consulta,fecha_inicio_corte,fecha_final_corte');
        $this->db->from('cortes_caja');
        $this->db->join('clientes','clientes.id_cliente = cortes_caja.id_cliente');
        $this->db->where('numero_session',$numero_session);

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
    //REALIZAR CORTES

    public function get_total_citas($fecha_inicial,$fecha_final)
    {
        $this->db->select_sum('costo_consulta','total_citas');
        $this->db->from('citas');
        $this->db->where('cobrado',1);
        $this->db->where('activo',1);
        $this->db->where('contabilizado',0);
        $this->db->where('costo_consulta',130);
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
        $this->db->where('contabilizado',0);
        $this->db->where('costo_consulta',130);
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
        $this->db->select_max('numero_consulta');
        $this->db->from('citas');
        $this->db->where('cobrado',1);
        $this->db->where('activo',1);
        $this->db->where('costo_consulta',130);
        $this->db->where('contabilizado',0);
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
        $this->db->select_min('numero_consulta');
        $this->db->from('citas');
        $this->db->where('cobrado',1);
        $this->db->where('activo',1);
        $this->db->where('contabilizado',0);
        $this->db->where('costo_consulta',130);
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


    public function get_data_cita($numero_consulta)
    {
        $this->db->from('citas');
        $this->db->where('numero_consulta',$numero_consulta);
        $this->db->where('contabilizado',0);
        $this->db->where('cobrado',1);
        $this->db->where('activo',1);
        $this->db->where('costo_consulta',130);

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

    public function insert_cortes_caja_tmp($data)
    {
        $this->db->insert('cortes_caja_tmp',$data);
    }

    public function get_cortes_caja_tmp()
    {
        $this->db->from('cortes_caja_tmp');
        $this->db->order_by('fecha','ASC');
        $this->db->order_by('hora','ASC');
        
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

    public function delete_corte_caja_tmp()
    {
        $this->db->where('id_cliente >',0);
        $this->db->delete('cortes_caja_tmp');
    }

    public function update_citas_pendientes($id_min,$id_max)
    {
        $this->db->set('contabilizado',1);
        $this->db->where('numero_consulta >= ',$id_min);
        $this->db->where('numero_consulta <= ',$id_max);
        $this->db->update('citas');
    }

    public function update_corte_caja($numero_consulta)
    {
        $this->db->set('contabilizado',1);
        $this->db->where('numero_consulta',$numero_consulta);
        $this->db->update('citas');
        //$this->db->where('fecha >=',$fecha_inicial);
        //$this->db->where('fecha <=',$fecha_final);
        
    }
    
}
