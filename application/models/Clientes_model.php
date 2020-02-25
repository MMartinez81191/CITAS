<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model {
    

    /*function __construct()
    {
        parent::__construct();
    }*/


    function __construct() {
        // Set table name
        $this->table = 'clientes';
        // Set orderable column fields
        $this->column_order = array('nombre_cliente');
        // Set searchable column fields
        $this->column_search = array('nombre_cliente');
        // Set default order
        $this->order = array('id_cliente' => 'desc');
    }
    
    /*
     * Fetch members data from the database
     * @param $_POST filter data based on the posted parameters
     */
    public function getRows($postData){
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    /*
     * Count all records
     */
    public function countAll(){
        $this->db->from($this->table);
        $this->db->where('activo',1);
        return $this->db->count_all_results();
    }
    
    /*
     * Count records based on the filter params
     * @param $_POST filter data based on the posted parameters
     */
    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    /*
     * Perform the SQL queries needed for an server-side processing requested
     * @param $_POST filter data based on the posted parameters
     */
    private function _get_datatables_query($postData){
         
        $this->db->from($this->table);
 
        $i = 0;
        // loop searchable columns 
        foreach($this->column_search as $item){
            // if datatable send POST for search
            if($postData['search']['value']){
                // first loop
                if($i===0){
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                }else{
                    $this->db->or_like($item, $postData['search']['value']);
                }
                
                // last loop
                if(count($this->column_search) - 1 == $i){
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }
         
        if(isset($postData['order'])){
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }


    //METODO PARA SER UTILIZADO EN EL SELECT DE CLIENTES EL CUAL LO HACE POR PAGINACION EN AJAX
    function get_clientes_select($searchTerm="")
    {
        $this->db->select('*');
        $this->db->where("nombre_cliente like '%".$searchTerm."%' ");
        $this->db->where('activo',1);
        $this->db->order_by('id_cliente','DESC');
        $fetched_records = $this->db->get('clientes');
        $clientes = $fetched_records->result_array();

        // Initialize Array with fetched data
        $data = array();
        foreach($clientes as $cliente)
        {
            $data[] = array("id"=>$cliente['id_cliente'], "text"=>$cliente['nombre_cliente']);
        }
        return $data;
    }    




    public function get_clientes()
    {
        
        $this->db->from('clientes');
        $this->db->where('activo',1);
        $this->db->order_by('id_cliente','DESC');
        
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
