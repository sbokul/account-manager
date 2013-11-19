<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{

    protected $errors;

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function create($params)
    {
        $status = false;
        $params['user_password'] = md5($params['user_password']);
        $this->db->select('user_id');
        $this->db->from('user_reg');
        $this->db->where('user_name', $params['parent_id']);
        $this->db->limit(1);
        $parent_id = $this->db->get();
        $parent_id = $parent_id->result();
        foreach ($parent_id as $row)
            $parent_id = $row->user_id;
        $params['parent_id'] = $parent_id;
        $params['create_date'] = date('Y-m-d');
        $this->db->set($params);
        if ($this->db->insert('user_reg'))
            $status = true;
        return $status;
    }

    public function checkusernameIsUsed($user_name)
    {
        $status = false;
        $query = $this->db->get_where('user_reg', array('user_name' => $user_name));
        if ($query->num_rows() > 0)
            $status = true;
        return $status;
    }
public function checkusernamecheckIsUsed($user_name)
    {   
	   	$conditional_array = array(
            'user_name' => $user_name,
			'user_country'=>14
        );
        $status = false;
        $query = $this->db->get_where('user_reg', $conditional_array);
        if ($query->num_rows() > 0){
            $status = true;
			}
		$conditional_array_admin = array(
            'user_name' => $user_name,
        );	
		$query_admin = $this->db->get_where('admin_users', $conditional_array_admin);	
		if($query_admin->num_rows() > 0){
		  $status = true;
		}	
        return $status;
    }
public function checkEmailCheckIsUsed($email)
    {   
	   	$conditional_array = array(
            'email' => $email,
			'user_country'=>14
        );
        $status = false;
        $query = $this->db->get_where('user_reg', $conditional_array);
        if ($query->num_rows() > 0){
            $status = true;
			}
		$conditional_array_admin = array(
            'email' => $email,
        );	
		$query_admin = $this->db->get_where('admin_users', $conditional_array_admin);	
		if($query_admin->num_rows() > 0){
		  $status = true;
		}	
        return $status;
    }		

    public function checkEmailIsUsed($email)
    {
        $status = false;
        $query = $this->db->get_where('user_reg', array('email' => $email));
        if ($query->num_rows() > 0)
            $status = true;
        return $status;
    }

    public function CheckParentId($parent_id)
    {
        $status = false;
        $query = $this->db->get_where('user_reg', array('user_name' => $parent_id));
        if ($query->num_rows() > 0)
            $status = true;
        return $status;
    }

    public function checkMobileIsUsed($number)
    {
        $status = false;
        $query = $this->db->get_where('user_reg', array('user_mobile' => $number));
        if ($query->num_rows() > 0)
            $status = true;
        return $status;
    }
	public function checkforget($data)
    {
        $status = false;
		$conditional_array = array(
            'user_name' => $data['user_name_check'],
            'email' => $data['email']
        );
        $query = $this->db->get_where('user_reg', $conditional_array);
        if ($query->num_rows() > 0)
            $status = true;
        return $status;
    }

    public function login_check($data)
    {
        $status = false;
        if($data['country'] != 14) {
            return $status;
        }
        $conditional_array = array(
            'user_name' => $data['user_name'],
            'user_password' => md5($data['user_password']),
            'user_country' => $data['country']
        );

        $query = $this->db->get_where('user_reg', $conditional_array);

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $this->session->set_userdata('user_info', $result[0]);

            $login_date = array(
                'user_last_login' => date('Y-m-d')
            );

            $this->db->where('user_id', $result[0]['user_id']);
            $this->db->update('user_reg', $login_date);

            $status = true;
        }

        return $status;
    }

    public function admin_login_check($data)
    {
        $status = false;
        $conditional_array = array(
            'user_name' => $data['user_name'],
            'user_password' => md5($data['user_password'])
        );

        $query = $this->db->get_where('admin_users', $conditional_array);

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $this->session->set_userdata('admin_info', $result[0]);
            $status = true;
        }

        return $status;
    }

    public function forgetpassword($data)
    {
        $result = false;
        $query = $this->db->get_where('regi_user', $data);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
        }

        return $result;
    }

    public function getCountryList()
    {
        $result = false;
        $query = $this->db->get('int_country_codes');
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
        }
        return $result;
    }

    public function getUserIdByUserName($affiliate_user_name)
    {
        $result = 0;
        $data = array(
            'user_name' => $affiliate_user_name
        );
        $query = $this->db->get_where('user_reg', $data);
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
        }
        return $result['user_id'];
    }

    public function getCountryMobileCode($country_id)
    {
        $query = $this->db->get_where('int_country_codes', array('Id' => $country_id));
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
        }
        return $result;
    }
public function checkforgetdata($data)
    {
        $status = false;
        $conditional_array = array(
            'user_name' =>$data['user_name_check'],
            'email' => $data['email_check'],
			'user_country' => 14
        );
      
        $query = $this->db->get_where('user_reg',$conditional_array);
        if ($query->num_rows() > 0) {
                
		$status = true;
        }else{
	   $conditional_array_admin= array(
            'user_name' => $data['user_name_check'],
            'email' => $data['email_check'],
        );
        $query_admin = $this->db->get_where('admin_users', $conditional_array_admin);
		if ($query_admin->num_rows() > 0) {
            $status = true;
        }}
        return $status;
    }
 public function forgetpasswordnew($data)
    {    $conditional_array = array(
            'user_name' =>$data['user_name_check'],
            'email' => $data['email_check'],
			'user_country' => 14
        );
		  $conditional_array_admin = array(
            'user_name' =>$data['user_name_check'],
            'email' => $data['email_check'],
		        );
      
      
        $characters ='#$@'.$data['user_name_check'].'#@034#$%';
		$string="";
        $string = substr( str_shuffle( $characters ), 0, 7);
		$string_array = array(
            'user_password' => md5($string),
        );
		if($this->db->update('user_reg', $string_array, $conditional_array))
		{
		$result=$string;
		}if($this->db->update('admin_users', $string_array, $conditional_array_admin)) {
		$result=$string;
		}  
        return $result;
    }		

}


