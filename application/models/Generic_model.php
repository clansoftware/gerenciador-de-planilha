<?php
/**
 * @version 0.9 RTM - (Realese To Manufacture)
 * @see Responsável por manipular o objeto de tabela através de VO
 * @author Santos L. Victor
*/
class Generic_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    function set_db($db_name) {
        return $this->db->query("use $db_name")->result();
    }

    function show_tables () {
        return $this->db->query("show tables")->result_array();
    }

    /**
     * @see Get row by id
     */
    function get_row($table, $id)
    {
        return $this->db->get_where($table, array('id'=>$id))->row_array();
    }

    function get_table_by_fk_id($table, $fk, $id)
    {
        $query = $this->db->query("SELECT 
                                        *
                                    FROM
                                        $table
                                        LEFT JOIN
                                        $fk");
        return $query->result();
    }

    /**
     * @see make module query
     */
    function conset_table($table, $where)
    {
        $query = $this->db->query("SELECT 
                                        *
                                    FROM
                                        $table
                                    WHERE
                                        $where");
        return $query->result_array();
    }
        
    /**
     * @see function to add new table
     */
    function add_row($table, $params)
    {
        $this->db->insert($table, $params);
        return $this->db->insert_id();
    }
    
    /**
     * @see function to update table
     */
    function update_row($table, $id, $params)
    {
        $this->db->where('id',$id);
        return $this->db->update($table, $params);
    }
    
    /**
     * @see function to delete table
     */
    function delete_row($table, $id, $id_usuario)
    {
        return $this->db->delete($table, array('id'=>$id, 'id_usuario'=>$id_usuario));
    }
}
