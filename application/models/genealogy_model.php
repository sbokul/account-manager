<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Genealogy_model extends CI_Model
{

    protected $errors;

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /*public function total_members_count_downline($user_id)
    {
        $this->db->select('*');
        $this->db->from('user_reg');
        $this->db->where('parent_id', $user_id);
        $query = $this->db->get();
        $data = $query->result_array();
        $row_count = $query->num_rows();
        $total_numbers = $row_count;

        if($row_count > 0) {
            foreach($data as $row) {
                $this->db->select('*');
                $this->db->from('user_reg');
                $this->db->where('parent_id', $row['user_id']);
                $query = $this->db->get();
                $data = $query->result_array();
                $row_count = $query->num_rows();
                $total_numbers = $row_count + $total_numbers;
            }
        }
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        echo $total_numbers;
        exit;
        return $row_count;
    }*/

    public function get_sponsored_by($user_id)
    {
        $this->db->select('*');
        $this->db->from('user_reg');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result['user_name'];
    }

    public function count_downline($user_id)
    {
        $this->db->select('*');
        $this->db->from('user_reg');
        $this->db->where('parent_id', $user_id);
        $query = $this->db->get();
        $row_count = $query->num_rows();
        return $row_count;
    }

    public function count_downline_monthly($user_id)
    {
        $query = $this->db->query("SELECT * FROM (`user_reg`) WHERE `parent_id` = '".$user_id."' and MONTH(create_date) = MONTH(NOW()) ");
        $row_count = $query->num_rows();
        //echo $this->db->last_query();
        return $row_count;
    }

    public function count_downline_weekly($user_id)
    {
        $query = $this->db->query("SELECT * FROM (`user_reg`) WHERE `parent_id` = '".$user_id."' and WEEKOFYEAR(create_date) = WEEKOFYEAR(NOW()) ");
        $row_count = $query->num_rows();
        //echo $this->db->last_query();
        return $row_count;
    }

    public function generate_downline($user_id) {
        $downline_array = array();
        $this->db->select('*');
        $this->db->from('user_reg');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $downline_array = $query->row_array();
        $this->db->select('*');
        $this->db->from('user_reg');
        $this->db->where('parent_id', $user_id);
        $query = $this->db->get();
        $data = $query->result_array();
        $downline_array['clilds'] = $data;
        $i = 0;
        foreach($data as $child_data) {
            $child_generated_data = $this->generate_child_array($child_data['user_id']);

            $downline_array['clilds'][$i]['clilds'] = $child_generated_data;
            ++$i;
        }

        $j = 0;
        foreach ($downline_array['clilds'] as $nested_child) {
            $k = 0;
            foreach ($nested_child['clilds'] as $child) {
                $child_generated_data = $this->generate_child_array($child['user_id']);
                $downline_array['clilds'][$j]['clilds'][$k]['clilds'] = $child_generated_data;
                ++$k;
            }
            ++$j;
        }
        return $downline_array;

    }

    private function generate_child_array($user_id) {
        $this->db->select('*');
        $this->db->from('user_reg');
        $this->db->where('parent_id', $user_id);
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

}



