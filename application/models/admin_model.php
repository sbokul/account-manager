<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
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

    public function user_data($user_id)
    {
        $query = $this->db->get_where('admin_users', array('id' => $user_id));
        $result = $query->row_array();
        return $result;
    }

    public function checkEmailIsUsed($email)
    {
        $status = false;
        $conditional_array = array(
            'email' => $email
        );
        $query = $this->db->get_where('admin_users', $conditional_array);
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

    public function login_check($data)
    {
        $status = false;
        $conditional_array = array(
            'email' => $data['email'],
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

    public function create_coordinator($data, $parent_id, $user_type)
    {
        $status = false;
        $params['user_password'] = md5($data['user_password']);
        $params['user_transaction_password'] = md5($data['user_transaction_password']);
		$params['user_name'] = $data['coordiantorvip_user_name'];
		//$paramsuser['user_name'] = $data['coordiantorvip_user_name'];
		$params['mobile'] = $data['co_user_mobile'];
		$params['email'] = $data['email'];
		$params['address'] = $data['address'];
        $params['parent'] = $parent_id;
        $params['user_type'] = $user_type;
        $params['create_date'] = date('Y-m-d');
        $this->db->set($params);
        if ($this->db->insert('admin_users')) {
            $status = true;
		}
        return $status;
    }

    public function create_agent($data, $parent_id, $user_type)
    {
        $status = false;

        $params['user_password'] = md5($data['user_password']);
        $params['user_transaction_password'] = md5($data['user_transaction_password']);
		$params['user_name'] = $data['coordiantorvip_user_name'];
		//$paramsuser['user_name'] = $data['coordiantorvip_user_name'];
		$params['mobile'] = $data['co_user_mobile'];
        $params['email'] = $data['email'];
        $params['address'] = $data['address'];
        $params['parent'] = $parent_id;
        $params['user_type'] = $user_type;
        $params['create_date'] = date('Y-m-d');
        $this->db->set($params);
        if ($this->db->insert('admin_users')){
            $status = true;
			}
        return $status;
    }

    public function get_coordinator_numbers($user_id)
    {
        $conditional_array = array(
            'parent' => $user_id,
            'user_type' => '2'
        );
        $query = $this->db->get_where('admin_users', $conditional_array);
        $row_count = $query->num_rows();
        return $row_count;
    }

    public function get_agent_numbers($user_id)
    {
        $conditional_array = array(
            'user_type' => '3'
        );
        $query = $this->db->get_where('admin_users', $conditional_array);
        $row_count = $query->num_rows();
        return $row_count;
    }

    public function get_agent_numbers_coordinator($user_id)
    {
        $conditional_array = array(
            'id' => $user_id,
            'user_type' => '3'
        );
        $query = $this->db->get_where('admin_users', $conditional_array);
        $row_count = $query->num_rows();
        return $row_count;
    }

    public function get_coordinator_name($user_id)
    {
        $query = $this->db->get_where('admin_users', array('id' => $user_id));
        $result = $query->result_array();
        return $result;
    }

    public function payment_coordinator($post_data, $user_id)
    {
        $data['payment_id'] = $post_data['payment_id'];
        $data['current_balance'] = $post_data['current_balance'];
        $data['current_balance_update'] = $data['current_balance'] + $data['current_balance'] * 4 / 100;

        $data['user_type'] = 2;
        $status = false;
        if ($this->db->simple_query("UPDATE `admin_users` SET `current_balance` = current_balance - " . $data['current_balance_update'] . " WHERE `admin_users`.`id` = " . $user_id . " ;") && $this->db->simple_query("UPDATE `admin_users` SET `current_balance` = current_balance + " . $data['current_balance_update'] . " WHERE `admin_users`.`id` = " . $data['payment_id'] . ";")) {
            $coordinator_data = array(
                'user_id' => $data['payment_id'],
                'head' => 'Got 4% for transfer',
                'in_out' => 1,
                'transfer_id' => $user_id,
                'type' => 'transfer',
                'create_date' => date('Y-m-d')
            );
            $this->db->set($coordinator_data);
            $this->db->insert('transaction_admins');

            $coordinator_data = array(
                'user_id' => $data['payment_id'],
                'head' => 'Got $'.$data['current_balance'].' from admin',
                'in_out' => 1,
                'transfer_id' => $user_id,
                'type' => 'transfer',
                'create_date' => date('Y-m-d')
            );
            $this->db->set($coordinator_data);
            $this->db->insert('transaction_admins');

            $status = true;
        }
        return $status;

    }

    public function get_coordiantor_list($user_id, $row, $no_of_item)
    {
        $status = false;

        $this->db->select('*');
        $this->db->from('admin_users');
        $this->db->where('parent', $user_id);
        $this->db->where('user_type', '2');
        $this->db->limit($no_of_item, $row);
        $query = $this->db->get();
        $data = $query->result_array();
        //echo $this->db->last_query();
        return $data;
    }

    public function get_agent_list($user_id, $row, $no_of_item)
    {
        $status = false;

        $this->db->select('*');
        $this->db->from('admin_users');
        $this->db->where('user_type', '3');
        $this->db->limit($no_of_item, $row);
        $query = $this->db->get();
        $data = $query->result_array();
        //echo $this->db->last_query();
        return $data;
    }

    public function get_agent_list_coordinator($user_id, $row, $no_of_item)
    {
        $status = false;

        $this->db->select('*');
        $this->db->from('admin_users');
        $this->db->where('parent', $user_id);
        $this->db->where('user_type', '3');
        $this->db->limit($no_of_item, $row);
        $query = $this->db->get();
        $data = $query->result_array();

        //echo $this->db->last_query();
        return $data;
    }

    public function get_agent_name($agent_id)
    {
        $query = $this->db->get_where('admin_users', array('id' => $agent_id));
        $result = $query->result_array();
        return $result;
    }

    public function get_agent_coordinator($agent_id)
    {
        $query = $this->db->get_where('admin_users', array('id' => $agent_id));
        $result = $query->result_array();
        foreach ($result as $agent_parent_id)
            $agent_parent_id = $agent_parent_id['parent'];
        $query = $this->db->get_where('admin_users', array('id' => $agent_parent_id));
        $result = $query->result_array();
        return $result;
    }

    public function payment_agent($post_data, $user_id)
    {
        $data['agnet_payment_id'] = $post_data['agnet_payment_id'];
        $data['agnet_coordinator_payment_id'] = $post_data['agnet_coordinator_payment_id'];
        $data['current_balance'] = $post_data['current_balance'];
        $data['current_balance_update_agent'] = $data['current_balance'] + $data['current_balance'] * 3 / 100;

        $data['current_balance_update_coordinator'] = $data['current_balance'] / 100;
        $status = false;
        if ($this->db->simple_query("UPDATE `admin_users` SET `current_balance` = current_balance - " . $data['current_balance_update_agent'] . "-" . $data['current_balance_update_coordinator'] . " WHERE `admin_users`.`id` = " . $user_id . " ;") && $this->db->simple_query("UPDATE `admin_users` SET `current_balance` = current_balance + " . $data['current_balance_update_coordinator'] . " WHERE `admin_users`.`id` = " . $data['agnet_coordinator_payment_id'] . ";") && $this->db->simple_query("UPDATE `admin_users` SET `current_balance` = current_balance + " . $data['current_balance_update_agent'] . " WHERE `admin_users`.`id` = " . $data['agnet_payment_id'] . ";")) {
            $coordinator_data = array(
                'user_id' => $data['agnet_coordinator_payment_id'],
                'head' => 'Got 1% for transfer',
                'in_out' => 1,
                'transfer_id' => $user_id,
                'type' => 'transfer',
                'create_date' => date('Y-m-d')
            );
            $this->db->set($coordinator_data);
            $this->db->insert('transaction_admins');
            $agent_data = array(
                'user_id' => $data['agnet_payment_id'],
                'head' => 'Got 3% for transfer',
                'in_out' => 1,
                'transfer_id' => $user_id,
                'type' => 'transfer',
                'create_date' => date('Y-m-d')
            );
            $this->db->set($agent_data);
            $this->db->insert('transaction_admins');

            $agent_data = array(
                'user_id' => $data['agnet_payment_id'],
                'head' => 'Got $'.$data['current_balance'].' from coordinator/admin',
                'in_out' => 1,
                'transfer_id' => $user_id,
                'type' => 'transfer',
                'create_date' => date('Y-m-d')
            );
            $this->db->set($agent_data);
            $this->db->insert('transaction_admins');
            $status = true;
        }
        return $status;

    }

    public function payment_coordinator_balance($post_data, $user_id)
    {
        $status = false;
        $current_balance_agent = $post_data['current_balance'];

        $this->db->select('current_balance');
        $this->db->from('admin_users');
        $this->db->where('id', $user_id);
        $this->db->limit(1);
        $query = $this->db->get();
        $data = $query->result_array();
        foreach ($data as $user_balance)
            $user_balance = $user_balance['current_balance'];
        if ($user_balance >= ($current_balance_agent + $current_balance_agent * 3 / 100))
            $status = true;
        return $status;
    }

    public function payment_agent_coordinator($post_data, $user_id)
    {
        $data['payment_id'] = $post_data['agnet_payment_id'];
        $data['current_balance'] = $post_data['current_balance'];
        $data['current_balance_update'] = $data['current_balance'] + $data['current_balance'] * 3 / 100;
        $status = false;
        if ($this->db->simple_query("UPDATE `admin_users` SET `current_balance` = current_balance - " .$data['current_balance']. " WHERE `admin_users`.`id` = " . $user_id . " ;") && $this->db->simple_query("UPDATE `admin_users` SET `current_balance` = current_balance + " . $data['current_balance'] . " WHERE `admin_users`.`id` = " . $data['payment_id'] . ";")) {

            $agent_data = array(
                'user_id' => $data['payment_id'],
                'head' => 'Got $'.$data['current_balance'].' form VIP Coordinator',
                'in_out' => 1,
                'transfer_id' => $user_id,
                'type' => 'transfer',
                'create_date' => date('Y-m-d')
            );
            $this->db->set($agent_data);
            $this->db->insert('transaction_admins');

            $agent_data = array(
                'user_id' => $user_id,
                'head' => 'Sent $'.$data['current_balance'].' to Coordinator',
                'in_out' => 1,
                'transfer_id' => $data['payment_id'],
                'type' => 'transfer',
                'create_date' => date('Y-m-d')
            );
            $this->db->set($agent_data);
            $this->db->insert('transaction_admins');
            $status = true;
        }
        return $status;

    }

    public function get_agent_withdraw_numbers($user_id)
    {
        $conditional_array = array(
            'agent_id' => $user_id,
            'paid_status' => 0
        );
        $query = $this->db->get_where('withdraw_accounts', $conditional_array);
        $row_count = $query->num_rows();
        return $row_count;
    }

    public function get_agent_paid_numbers($user_id)
    {
        $conditional_array = array(
            'agent_id' => $user_id,
            'paid_status' => 1
        );
        $query = $this->db->get_where('withdraw_accounts', $conditional_array);
        $row_count = $query->num_rows();
        return $row_count;
    }

    public function get_agent_withdraw_list($user_id, $row, $no_of_item)
    {
        $status = false;
        $this->db->select('ur.user_name,ur.email,ur.user_country_code,ur.user_mobile,wa.user_id, wa.withdraw_amount,wa.amount_to_be_paid,wa.paid_status,wa.create_date,cc.country_name, wa.withdraw_id');
        $this->db->from('withdraw_accounts wa, user_reg ur, int_country_codes cc');
        $this->db->where('wa.agent_id', $user_id);
        $this->db->where('wa.user_id = ur.user_id');
        $this->db->where('wa.paid_status', 0);
        $this->db->where('cc.id = ur.user_country');
        $this->db->limit($no_of_item, $row);
        $query = $this->db->get();
        $data = $query->result_array();
        //echo $this->db->last_query();
        //var_dump($data);
        //exit(0);
        return $data;
    }

    public function get_agent_paid_list($user_id, $row, $no_of_item)
    {
        $status = false;
        $this->db->select('ur.user_name,ur.email,ur.user_country_code,ur.user_mobile,wa.user_id, wa.withdraw_amount,wa.amount_to_be_paid,wa.paid_status,wa.create_date,cc.country_name');
        $this->db->from('withdraw_accounts wa, user_reg ur, int_country_codes cc');
        $this->db->where('wa.agent_id', $user_id);
        $this->db->where('wa.user_id = ur.user_id');
        $this->db->where('wa.paid_status', 1);
        $this->db->where('cc.id = ur.user_country');
        $this->db->limit($no_of_item, $row);
        $query = $this->db->get();
        $data = $query->result_array();
        //echo $this->db->last_query();
        //var_dump($data);
        //exit(0);
        return $data;
    }

    public function withdraw_status_check($withdraw_id, $user_id)
    {
        $status = false;
        $withdraw = array(
            'withdraw_id' => $withdraw_id
        );

        $query = $this->db->get_where('withdraw_accounts', $withdraw);
        $result = $query->row_array();
        if($result['paid_status'] == 0)
            $status = true;

        return $status;
    }

    public function agent_payment_update($withdraw_id,$user_id)
    {
        $status = false;
        $data = array(
            'paid_status' => 1
        );
		$withdraw = array(
            'withdraw_id' => $withdraw_id       
			 );
		$query =$this->db->get_where('withdraw_accounts', $withdraw);
		$query=$query->row();
        if ($this->db->update('withdraw_accounts', $data, array('withdraw_id' =>$withdraw_id))){
            $status = true;

            $this->db->simple_query("UPDATE `admin_users` SET `current_balance` = current_balance + " .$query->amount_to_be_paid. " WHERE `admin_users`.`id` = " . $user_id . " ;");

            $agent_data = array(
                'user_id' => $user_id,
                'head' => 'Got $'.$query->amount_to_be_paid.' amount for withdraw',
                'in_out' => 1,
                'type' => 'withdraw amount',
                'create_date' => date('Y-m-d')
            );
            $this->db->set($agent_data);
            $this->db->insert('transaction_admins');
			}
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
 public function transfer_agent_user_check($post_data)
    {
        $status = false;
        $conditional_array = array(
            'user_name' => $post_data['user_name'],
            'user_mobile' => $post_data['user_mobile']
        );
        $query = $this->db->get_where('user_reg', $conditional_array);
         if($query->num_rows() > 0)
            $status = true;
          return $status;
    }
 public function transfer_agent_agent_check($post_data)
    {
        $status = false;
        $conditional_array = array(
            'user_name' => $post_data['agent_user_name'],
            'mobile' => $post_data['agent_user_mobile']
        );
        $query = $this->db->get_where('admin_users', $conditional_array);
         if($query->num_rows() > 0)
            $status = true;
          return $status;
    }		
public function checkTransactionPassword($user_id, $transactionpassword)
    {
        $status = false;
        $data = array(
            'id' => $user_id,
            'user_transaction_password' => md5($transactionpassword)
        );
        $query = $this->db->get_where('admin_users', $data);
        if ($query->num_rows() > 0){
            $status = true;
			}
        return $status;
    }
public function transfer_agent_agent_update($post_data, $user_id)
    {
	$data['current_balance']=$post_data['current_balance'];
	$data['agent_user_name']=$post_data['agent_user_name'];
	$check = array(
            'user_name' =>$data['agent_user_name'],
        );
    $query = $this->db->get_where('admin_users', $check);
	$query = $query->row_array();


	$status = false;
        if ($this->db->simple_query("UPDATE `admin_users` SET `current_balance` = current_balance - " .$data['current_balance']." WHERE `admin_users`.`id` = " .$user_id. " ;")&& $this->db->simple_query("UPDATE `admin_users` SET `current_balance` = current_balance + ".$data['current_balance']." WHERE `id` = " .$query['id']. ";")) {
            $transaction_data = array(
                'user_id' => $user_id,
                'head' => 'Got"'.$data['current_balance'].'"for "'.$data['agent_user_name'].'"',
                'in_out' => 1,
                'amount' => $data['current_balance'],
                'type' => 'agent agent transfer',
                'create_date' => date('Y-m-d')
            );
            $this->db->set($transaction_data);
            $this->db->insert('transaction');
            $status = true;
        }
        return $status;

    }
public function transfer_agent_user_update($post_data, $user_id)
    {
	$data['current_balance']=$post_data['current_balance'];
	$data['user_name']=$post_data['user_name'];
	$check = array(
            'user_name' =>$data['user_name'],
        );
    $query = $this->db->get_where('user_reg', $check);
	$query = $query->row_array();


	$status = false;
        if ($this->db->simple_query("UPDATE `admin_users` SET `current_balance` = current_balance - " .$data['current_balance']." WHERE `admin_users`.`id` = " .$user_id. " ;")&& $this->db->simple_query("UPDATE `user_reg` SET `current_balance` = current_balance + ".$data['current_balance']." WHERE `user_id` = " .$query['user_id']. ";")) {
            $transaction_data = array(
                'user_id' => $query['user_id'],
                'head' => 'Got balance $'.$data['current_balance'].' from coordinator',
                'in_out' => 1,
                'amount' => $data['current_balance'],
                'type' => 'By Balance',
                'create_date' => date('Y-m-d')
            );
            $this->db->set($transaction_data);
            $this->db->insert('transaction');
            $status = true;

            $agent_data = array(
                'user_id' => $user_id,
                'head' => 'Sent $'.$data['current_balance'].' to user',
                'in_out' => 1,
                'transfer_id' => $query['user_id'],
                'type' => 'Pay User',
                'create_date' => date('Y-m-d')
            );
            $this->db->set($agent_data);
            $this->db->insert('transaction_admins');

        }
        return $status;

    }	
public function checkagentusernameIsUsed($user_name)
    {
        $status = false;
		$data = array(
            'user_name' => $user_name,
            'user_type' => 3
        );
        $query = $this->db->get_where('admin_users', $data);
        if ($query->num_rows() > 0)
            $status = true;
        return $status;
    }
public function checkcoordinatorusernameIsUsed($user_name)
    {
        $status = false;
		$data = array(
            'user_name' => $user_name,
        );
        $query = $this->db->get_where('admin_users', $data);
        if ($query->num_rows() > 0)
            $status = true;
        return $status;
    }	
public function checkagentMobileIsUsed($number)
    {
        $status = false;
		$data = array(
            'mobile' => $number,
            'user_type' => 3
        );
        $query = $this->db->get_where('admin_users', $data);
        if ($query->num_rows() > 0)
            $status = true;
        return $status;
    }
public function checkcoMobileIsUsed($number)
    {
        $status = false;
		$data = array(
            'mobile' => $number,
        );
        $query = $this->db->get_where('admin_users', $data);
        if ($query->num_rows() > 0)
            $status = true;
        return $status;
    }	
public function transfer_agent_user_balance_check($user_id)
    {
        $query = $this->db->get_where('admin_users', array("id"=>$user_id));
		$result=$query->row();
             return $result;
    }

    public function getMobileInfo($user_name) {
        $query = $this->db->get_where('user_reg', array("user_name" => $user_name));
        $result=$query->row_array();
        return $result['user_mobile'];
    }

}



