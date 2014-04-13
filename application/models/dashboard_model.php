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
        $post_data['create_date'] = date('Y-m-d');
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
        $this->db->where('status', 1);
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
        $this->db->group_by('particulars');
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
        $this->db->order_by("create_date", "asc");
        $query = $this->db->get();
        $project_bill = $query->result_array();
        return $project_bill;
    }

    public function get_bill_data($id)
    {
        $this->db->select('*');
        $this->db->from('bills');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $bill_details = $query->result_array();
        return $bill_details[0];
    }

    public function get_expense_data($id)
    {
        $this->db->select('*');
        $this->db->from('expenses');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $expense_details = $query->result_array();
        return $expense_details[0];
    }

    public function update_bill($data, $id)
    {
        $status = false;
        $this->db->where('id', $id);
        if($this->db->update('bills', $data))
            $status = true;
        return $status;
    }

    public function update_expense($data, $id)
    {
        $status = false;
        $this->db->where('id', $id);
        if($this->db->update('expenses', $data))
            $status = true;
        return $status;
    }

    public function get_project_expense($id)
    {
        $this->db->select('*');
        $this->db->from('expenses');
        $this->db->where('project_id', $id);
        $this->db->order_by("create_date", "asc");
        $query = $this->db->get();
        $project_expense = $query->result_array();
        return $project_expense;
    }

    public function get_total_particulars($particulars_name, $project_id)
    {
        $this->db->select('*');
        $this->db->from('expenses');
        $this->db->where('particulars', $particulars_name);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get();
        $project_particulars = $query->result_array();
        //echo $this->db->last_query();
        return $project_particulars;
    }

    public function check_user_exists($user_name)
    {
        $status = true;
        $conditional_array = array(
            'user_name' => $user_name
        );
        $query = $this->db->get_where('users', $conditional_array);
        if ($query->num_rows() > 0)
            $status = false;
        return $status;
    }

    public function get_users()
    {
        $this->db->select('*');
        $this->db->from('users');
        $query = $this->db->get();
        $users = $query->result_array();
        return $users;
    }

    public function delete_project($id)
    {
        $status = false;
        $data = array(
            'status' => 0
        );
        $this->db->where('id', $id);
        if($this->db->update('projects', $data))
            $status = true;
        return $status;
    }

    public function delete_bill($bill_id)
    {
        $status = false;
        $this->db->where('id', $bill_id);
        if($this->db->delete('bills'))
            $status = true;
        return $status;
    }

    public function delete_expense($expense_id)
    {
        $status = false;
        $this->db->where('id', $expense_id);
        if($this->db->delete('expenses'))
            $status = true;
        return $status;
    }

}



