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
        $this->db->select('clientes.nombre_cliente, clientes.id_cliente');
        $this->db->select('tipos_citas.id_tipo_cita,tipos_citas.tipo_cita');
        $this->db->from('citas');
        $this->db->join('clientes','clientes.id_cliente = citas.id_cliente');
        $this->db->join('tipos_citas','tipos_citas.id_tipo_cita = citas.id_tipo_cita');
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

    public function upd_membresia($id_cliente, $data2)
    {
        
        $this->db->where('id_cliente',$id_cliente);
        $this->db->update('clientes',$data2);
        
        //echo $this->db->last_query();

        
    }

    //OBTIENE SI EL MAXIMO CLIENTE ES UNA MEMBRESIA
    public function get_tipo_cita_max_id_cliente()
    {
        $this->db->limit(1);
        $this->db->select('membresia');
        $this->db->from('clientes');
        $this->db->where('activo',1);
        $this->db->order_by('id_cliente','DESC');

        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            if($query->row('membresia') == "0")
            {
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return FALSE;
        }        
    }

    //OBTIENE SI LA CITA ES MEMBRESIA O NO
    public function get_tipo_cita($id_cliente)
    {
        $this->db->limit(1);
        $this->db->select('numero_cita');
        $this->db->from('membresias');
        $this->db->where('id_cliente',$id_cliente);
        $this->db->order_by('id_membresia','DESC');

        $query = $this->db->get();
        echo $this->db->last_query();
        if($query->num_rows() > 0)
        {
            $numero_membresia = $query->row('numero_cita');
            if($numero_membresia == 5)
            {
                return FALSE;
            }
            else
            {
                return TRUE;
            }
        }
        else
        {
            return FALSE;
        }        
    }

    //OBTIENE LOS TIPOS DE CITAS DISPONIBLES
    public function get_tipo_citas($membresia)
    {
        $this->db->from('tipos_citas');
        $this->db->where('activo',1);
        if($membresia == TRUE)
        {
            $this->db->where('id_tipo_cita',2);            
        }

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
        $this->db->where('activo',1);

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

    public function get_numero_consulta()
    {
        $this->db->select_max('numero_consulta','numero_consulta');
        $this->db->from('citas');
        $this->db->where('activo',1);

        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            foreach ($query->result() as $row) 
            {
                $numero_consulta = $row->numero_consulta;
            }
            return $numero_consulta + 1;
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
        $this->db->select('clientes.nombre_cliente, clientes.id_cliente, clientes.membresia');
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

    public function comprobar_repetidos($fecha,$hora)
    {
        $this->db->limit(1);
        $this->db->from('citas');
        $this->db->where('fecha',$fecha);
        $this->db->where('hora',$hora);
        $this->db->where('activo',1);

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

    //AREA DE MEMBRESIAS

    //OBTIENE LA INFORMACION DE LA MEMBRESIA DEPENDIENDO DEL NUMERO DE CLIENTE
    public function get_info_membresia($id_cliente)
    {
        
        $this->db->from('membresias');
        $this->db->where('id_cliente',$id_cliente);
        $this->db->order_by('numero_membresia,numero_cita','DESC');
        $this->db->limit(1);

        $query = $this->db->get();
        //echo $this->db->last_query();

        if($query->num_rows() > 0)
        {
            return $query->row();
        }
        else
        {
            return FALSE;
        }
    }
    
    public function get_info_membresia_by_id_cita($id_cita)
    {
        
        $this->db->from('membresias');
        $this->db->where('id_cita',$id_cita);
        $this->db->order_by('numero_membresia,numero_cita','DESC');
        $this->db->limit(1);

        $query = $this->db->get();
        //echo $this->db->last_query();

        if($query->num_rows() > 0)
        {
            return $query->row();
        }
        else
        {
            return FALSE;
        }
    }

    public function get_max_membresia()
    {
        $this->db->select_max('numero_membresia');
        $this->db->from('membresias');

        $query = $this->db->get();

        if($query->num_rows() > 0)
        {
            return $query->row();
        }
        else
        {
            return 0;
        }

    }

    public function insert_membresia($data)
    {
        $this->db->insert('membresias',$data);
    }

    public function get_proximas_citas($id_cliente,$fecha_actual)
    {
        $this->db->select('citas.fecha,citas.hora');
        $this->db->select('tipos_citas.tipo_cita');
        $this->db->from('citas');
        $this->db->join('tipos_citas','tipos_citas.id_tipo_cita = citas.id_tipo_cita');
        $this->db->where('id_cliente',$id_cliente);
        $this->db->where('citas.fecha >=',$fecha_actual);
        $this->db->where('citas.activo',1);
        $this->db->where('citas.cobrado',0);
        $this->db->where('citas.contabilizado',0);

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
