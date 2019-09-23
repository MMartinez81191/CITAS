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
    //BALANCE GENERAL
    //=================================================================
    public function get_balance_general($dia)
    {
        $sql = "
                    SELECT 
                        COUNT(costo_consulta) numero_pacientes,
                        0 AS numero,
                        'Consultas' AS descripcion, 
                        costo_consulta AS costo,
                        (COUNT(costo_consulta) * costo_consulta) AS total
                    FROM citas 
                    WHERE  
                        fecha = '".$dia."' AND 
                        id_tipo_cita != 2 AND 
                        cobrado = 1 AND
                        activo = 1
                        GROUP BY costo_consulta
                    UNION
                    SELECT 
                        COUNT(costo_consulta) numero_pacientes,
                        0 AS numero,
                        'Membresias' AS descripcion, 
                        costo_consulta AS costo,
                        (COUNT(costo_consulta) * costo_consulta) AS total 
                    FROM citas 
                    WHERE  
                        fecha = '".$dia."' AND 
                        id_tipo_cita = 2 AND 
                        cobrado = 1 AND
                        activo = 1
                        GROUP BY costo_consulta
                    UNION
                    SELECT 
                        0 AS numero_pacientes,
                        SUM(numero_carnets_vendidos) as numero,
                        'Total de venta de carnets' AS descripcion,
                        20 as costo ,
                        (SUM(numero_carnets_vendidos) * 20) as total
                    FROM venta_carnets 
                    WHERE
                        fecha = '".$dia."' AND 
                        activo = 1
                    UNION
                    SELECT 
                        0 numero_pacientes,
                        COUNT(importe) as numero,
                        'Total gastos' AS descripcion, 
                        count(importe) AS costo ,
                        SUM(importe) AS total 
                    FROM gastos 
                    WHERE 
                        fecha = '".$dia."' AND 
                        activo = 1
                     
                    UNION
                    SELECT 
                        0 AS numero_pacientes, 
                        COUNT(importe) AS numero,
                        'Total devoluciones' AS descripcion,
                        count(importe) as costo,
                        SUM(importe) AS total
                    FROM devoluciones
                    WHERE 
                        activo = 1 AND
                        fecha = '".$dia."';

                    ";
        $query = $this->db->query($sql);
        
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
    public function get_gasto()
    {
        $this->db->from('gastos');
        $this->db->where('activo',1);
        $this->db->order_by('fecha','DESC');

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

    public function get_gasto_dia($dia)
    {
        $this->db->from('gastos');
        $this->db->where('fecha',$dia);
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

    public function insert_gasto($data)
    {
        $this->db->insert('gastos',$data);        
    }

    public function delete_gastos($id_gasto,$data)
    {
        $this->db->where('id_gasto', $id_gasto);
        $this->db->update('gastos',$data);
    }

    //=================================================================
    //DEVOLUCIONES
    //=================================================================
    public function get_devoluciones()
    {
        $this->db->from('devoluciones');
        $this->db->join('clientes','clientes.id_cliente = devoluciones.id_cliente');
        $this->db->where('devoluciones.activo',1);
        $this->db->order_by('fecha','DESC');

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

    public function get_devolucion_dia($dia)
    {

        $this->db->select('COUNT(importe) as numero_devoluciones,importe');
        $this->db->select_sum('importe','importe_suma');
        $this->db->from('devoluciones');
        $this->db->where('fecha',$dia);
        $this->db->where('activo',1);
        $this->db->group_by('importe');

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

    public function get_clientes()
    {
        $this->db->select('id_cliente,nombre_cliente');
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

    public function insert_devolucion($data)
    {
        $this->db->insert('devoluciones',$data);        
    }
    
    public function delete_devolucion($id_devolucion,$data)
    {
        $this->db->where('id_devolucion', $id_devolucion);
        $this->db->update('devoluciones',$data);
    }

    //=================================================================
    //VENTA CARNETS
    //=================================================================
    public function get_venta_carnets()
    {
        $this->db->from('venta_carnets');
        $this->db->join('clientes','clientes.id_cliente = venta_carnets.id_cliente');
        $this->db->where('venta_carnets.activo',1);
        $this->db->order_by('fecha','DESC');

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

    public function get_venta_carnets_dia($dia)
    {

        $this->db->select_sum('numero_carnets_vendidos');
        $this->db->from('venta_carnets');
        $this->db->where('fecha',$dia);
        $this->db->where('activo',1);
        $this->db->group_by('numero_carnets_vendidos');

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

    public function insert_venta_carnet($data)
    {
        $this->db->insert('venta_carnets',$data);        
    }

    public function delete_venta_carnet($id_venta,$data)
    {
        $this->db->where('id_venta', $id_venta);
        $this->db->update('venta_carnets',$data);
    }
}
