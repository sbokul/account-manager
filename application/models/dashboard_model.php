<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

    protected $errors;

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function save_project($post_data)
    {
        $status = false;
        $this->db->set($post_data);
        if($this->db->insert('projects'))
            $status = true;
        return $status;
    }

    public function save_user($post_data)
    {
        $status = false;
        $post_data['user_password'] = md5($post_data['user_password']);
        $this->db->set($post_data);
        if($this->db->insert('users'))
            $status = true;
        return $status;
    }

    public function user_update($userid, $data)
    {
        $status = false;
        if ($this->db->update('user_reg', $data, array('user_id' => $userid))) ;
        {
            $status = true;
        }

        return $status;
    }

    public function user_data($user_id)
    {
        $query = $this->db->get_where('users', array('user_id' => $user_id));
        $user_info = $query->row_array();
        return $user_info;
    }

    public function get_projects_number()
    {
        $this->db->select('*');
        $this->db->from('projects');
        $query = $this->db->get();
        $row_count = $query->num_rows();
        return $row_count;
    }

    public function get_projects($no_of_item, $row)
    {
        $this->db->select('*');
        $this->db->from('projects');
        $this->db->order_by("id", "desc");
        $this->db->limit($no_of_item, $row);
        $query = $this->db->get();
        $data = $query->result_array();
        //echo $this->db->last_query();
        return $data;
    }

    public function save_bill($post_data)
    {
        $status = false;
        $this->db->set($post_data);
        if($this->db->insert('bills'))
            $status = true;
        return $status;
    }

    public function save_expense($post_data)
    {
        $status = false;
        $this->db->set($post_data);
        if($this->db->insert('expenses'))
            $status = true;
        return $status;
    }

    public function get_particulars($project_id)
    {
        $this->db->select('particulars');
        $this->db->from('expenses');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $particulars = $query->result_array();
        return $particulars;
    }

    public function get_project_detail($id)
    {
        $this->db->select('*');
        $this->db->from('projects');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $project_detail = $query->result_array();
        return $project_detail[0];
    }

    public function get_project_bill($id)
    {
        $this->db->select('*');
        $this->db->from('bills');
        $this->db->where('project_id', $id);
        $query = $this->db->get();
        $project_bill = $query->result_array();
        return $project_bill;
    }

    public function get_project_expense($id)
    {
        $this->db->select('*');
        $this->db->from('expenses');
        $this->db->where('project_id', $id);
        $query = $this->db->get();
        $project_expense = $query->result_array();
        return $project_expense;
    }

    public function get_total_particulars($particulars_name)
    {
        $this->db->select('*');
        $this->db->from('expenses');
        $this->db->where('particulars', $particulars_name);
        $query = $this->db->get();
        $project_particulars = $query->result_array();
        return $project_particulars;
    }

}



