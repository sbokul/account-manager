<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{

    protected $errors;

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function login_check($data)
    {
        $status = false;

        $conditional_array = array(
            'user_name' => $data['user_name'],
            'user_password' => md5($data['user_password'])
        );

        $query = $this->db->get_where('users', $conditional_array);

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $this->session->set_userdata('user_info', $result[0]);
            $status = true;
        }

        return $status;
    }
}


