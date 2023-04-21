<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Membresias_model extends CI_Model {
    
    //=========================================================
    //CONSTRUCTOR POR DEFECTO DE LA CLASE
    //=========================================================
    function __construct()
    {
        parent::__construct();
    }

    //=========================================================
    //OBTIENE TODAS LAS MEMBRESIAS PENDIENTES
    //=========================================================
    public function get_membresias()
    {
        $sql = "SELECT membresias.id_membresia,clientes.nombre_cliente,membresias.numero_membresia, COUNT(numero_cita) AS membresias_usadas, citas.fecha 
            FROM membresias
            JOIN clientes ON clientes.id_cliente = membresias.id_cliente
            JOIN citas ON citas.id_cita = membresias.id_cita
            WHERE membresias.activo = 1
            AND numero_membresia NOT IN(SELECT numero_membresia FROM membresias WHERE numero_cita = 5)
            GROUP BY numero_membresia
            HAVING COUNT(numero_cita) < 5
            ORDER BY numero_membresia DESC;";

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

    //=========================================================
    //OBTIENE EL ID DE LA MAXIMA MEMBRESIA UTILIZADA PARA
    //CANCELAR LA MEMBRESIA 
    //=========================================================
    public function get_maximo_id_membresia($numero_membresia)
    {
        $sql = "SELECT id_membresia FROM membresias WHERE numero_membresia = ".$numero_membresia." AND numero_cita = (select max(numero_cita) from membresias WHERE numero_membresia = ".$numero_membresia.")";

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

    //=========================================================
    //CANCELA LA MEMBRESIA 
    //=========================================================
    public function cancelar_membresia($id_membresia)
    {
        $this->db->set('numero_cita', 5);
        $this->db->set('activo',1);
        $this->db->where('id_membresia',$id_membresia);
        $this->db->update('membresias');

        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;            
        }
    }

    //=========================================================
    //OBTIENE EL ID DE CITA DEL MAXIMO ID CITA 
    //=========================================================
    public function get_id_cita($id_membresia)
    {
        $sql = "SELECT id_cita FROM membresias WHERE id_membresia = ".$id_membresia.";";

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

    //=========================================================
    //CANCELA LA CITA 
    //=========================================================
    public function cancelar_cita($id_cita)
    {
        $this->db->set('activo',0);
        $this->db->where('id_cita',$id_cita);
        $this->db->update('citas');

        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;            
        }
    }
}
