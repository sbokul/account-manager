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

    public function get_donation_list($user_id, $row, $no_of_item)
    {
        $status = false;
        $this->db->select('*');
        $this->db->from('donations');
        $this->db->where('user_id', $user_id);
        $this->db->order_by("id", "desc");
        $this->db->limit($no_of_item, $row);
        $query = $this->db->get();
        $data = $query->result_array();
        //echo $this->db->last_query();
        return $data;
    }

    public function get_donation_numbers($user_id)
    {
        $this->db->select('*');
        $this->db->from('donations');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $row_count = $query->num_rows();
        return $row_count;
    }

    public function get_transactions_numbers($user_id)
    {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $row_count = $query->num_rows();
        return $row_count;
    }

    public function get_transactions_list($user_id, $row, $no_of_item)
    {
        $status = false;
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->where('user_id', $user_id);
        $this->db->order_by("id", "desc");
        $this->db->limit($no_of_item, $row);
        $query = $this->db->get();
        $data = $query->result_array();
        //echo $this->db->last_query();
        return $data;
    }

    public function get_withdraw_numbers($user_id)
    {
        $this->db->select('*');
        $this->db->from('withdraw_accounts');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $row_count = $query->num_rows();
        return $row_count;
    }

    public function get_withdraw_list($user_id, $row, $no_of_item)
    {
        $status = false;
        $this->db->select('*');
        $this->db->from('withdraw_accounts');
        $this->db->join('admin_users', 'withdraw_accounts.agent_id = admin_users.id');
        $this->db->where('user_id', $user_id);
        $this->db->order_by("withdraw_id", "desc");
        $this->db->limit($no_of_item, $row);
        $query = $this->db->get();
        $data = $query->result_array();
        //echo $this->db->last_query();
        return $data;
    }


    public function get_agents()
    {
        $this->db->select('*');
        $this->db->from('admin_users');
        $this->db->where('user_type', '3');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function save_withdraw($data, $user_id)
    {
        $status = false;
        $withdraw_amount = $data['withdraw_amount'];
        $this->db->simple_query("UPDATE `user_reg` SET `current_balance` = current_balance - $withdraw_amount WHERE `user_reg`.`user_id` = " . $user_id . ";");
        $withdraw_percentage_agent = $withdraw_amount * 7 / 100;
        $withdraw_percentage_coordinator = $withdraw_amount * 3 / 100;
        $withdraw_percentage_deduct = $withdraw_amount * 10 / 100;
        $amount_to_be_paid = $withdraw_amount - $withdraw_percentage_deduct;
        $data['user_id'] = $user_id;
        $data['create_date'] = date('Y-m-d');
        $data['amount_to_be_paid'] = $amount_to_be_paid;
        $this->db->simple_query("UPDATE `admin_users` SET `current_balance` = current_balance + $withdraw_percentage_agent WHERE `id` = " . $data['agent_id'] . ";");
        $agent_parent_id = $this->select_agent_parent_id($data['agent_id']);
        $this->db->simple_query("UPDATE `admin_users` SET `current_balance` = current_balance + $withdraw_percentage_coordinator WHERE `id` = " . $agent_parent_id . ";");

        $agent_data = array(
            'user_id' => $data['agent_id'],
            'head' => 'Got 7% ($'.$withdraw_percentage_agent.') for withdraw',
            'in_out' => 1,
            'type' => 'Withdraw Bonus',
            'create_date' => date('Y-m-d')
        );
        $this->db->set($agent_data);
        $this->db->insert('transaction_admins');

        $coordinator_data = array(
            'user_id' => $agent_parent_id,
            'head' => 'Got 3% ($'.$withdraw_percentage_coordinator.') for withdraw',
            'in_out' => 1,
            'type' => 'Withdraw Bonus',
            'create_date' => date('Y-m-d')
        );
        $this->db->set($coordinator_data);
        $this->db->insert('transaction_admins');
        $withdraw_data = array(
            'user_id' => $data['user_id'],
            'withdraw_amount' => $data['withdraw_amount'],
            'amount_to_be_paid' => $data['amount_to_be_paid'],
            'agent_id' => $data['agent_id'],
            'create_date' => date('Y-m-d')
        );
        $this->db->set($withdraw_data);
        if ($this->db->insert('withdraw_accounts'))
            $status = true;
        $transaction_data = array(
            'user_id' => $user_id,
            'head' => 'Withdraw Fund amount $' . $data['withdraw_amount'],
            'amount' => $data['withdraw_amount'],
            'in_out' => '0',
            'type' => 'Withdraw',
            'create_date' => date('Y-m-d')
        );
        $this->db->set($transaction_data);
        $this->db->insert('transaction');

        return $status;
    }

    private function select_agent_parent_id($agent_id)
    {
        $this->db->select('parent');
        $this->db->from('admin_users');
        $this->db->where('id', $agent_id);
        $this->db->limit(1);
        $query = $this->db->get();
        $data = $query->row_array();
        return $data['parent'];
    }

    public function who_got_donation()
    {
        $status = false;
        $this->db->select('*');
        $this->db->from('donations');
        $this->db->join('user_reg', 'user_reg.user_id = donations.user_id');
        $this->db->where('status', '1');
        $this->db->order_by("tracking_id", "desc");
        $this->db->limit(10);
        $query = $this->db->get();
        $data = $query->result_array();
        //echo $this->db->last_query();
        return $data;
    }

    public function who_given_donation()
    {
        $status = false;
        $this->db->select('*');
        $this->db->from('donations');
        $this->db->join('user_reg', 'user_reg.user_id = donations.user_id');
        $this->db->where('status', '0');
        $this->db->order_by("tracking_id", "desc");
        $this->db->limit(10);
        $query = $this->db->get();
        $data = $query->result_array();
        //echo $this->db->last_query();
        return $data;
    }

    public function who_given_donations($row, $no_of_item)
    {
        $status = false;
        $this->db->select('*');
        $this->db->from('donations');
        $this->db->join('user_reg', 'user_reg.user_id = donations.user_id');
        $this->db->order_by("tracking_id", "desc");
        $this->db->limit($no_of_item, $row);
        $query = $this->db->get();
        $data = $query->result_array();
        //echo $this->db->last_query();
        return $data;
    }

    public function who_given_donation_numbers()
    {
        $row_count = $this->db->count_all('donations');
        return $row_count;
    }

    public function who_got_donations($row, $no_of_item)
    {
        $status = false;
        $this->db->select('*');
        $this->db->from('donations');
        $this->db->join('user_reg', 'user_reg.user_id = donations.user_id');
        $this->db->where('status', '1');
        $this->db->order_by("tracking_id", "desc");
        $this->db->limit($no_of_item, $row);
        $query = $this->db->get();
        $data = $query->result_array();
        //echo $this->db->last_query();
        return $data;
    }

    public function who_got_donation_numbers()
    {
        $this->db->where('status', '1');
        $row_count = $this->db->count_all_results('donations');
        return $row_count;
    }

    public function user_login_data($user_id)
    {
        $status = false;
        $data = array(
            'user_last_login' => date('Y-m-d')
        );
        if ($this->db->update('user_reg', $data, array('user_id' => $user_id)))
            $status = true;
        return $status;
    }

    public function user_data_account($user_id)
    {
        $this->db->select('ur.*, cc.country_name');
        $this->db->from('user_reg ur, int_country_codes cc');
        $this->db->where('ur.user_id', $user_id);
        $this->db->where('cc.id = ur.user_country');
        $query = $this->db->get();
        $user_info = $query->row_array();
        return $user_info;
    }

    public function transation_password_update($user_id, $post_data)
    {
        $status = false;
        $data = array(
            'user_transaction_password' => md5($post_data['user_transaction_password'])
        );
        if ($this->db->update('user_reg', $data, array('user_id' => $user_id)))
            $status = true;
        return $status;
    }

    public function checkTransactionPassword($user_id, $transactionpassword)
    {
        $status = false;
        $data = array(
            'user_id' => $user_id,
            'user_transaction_password' => md5($transactionpassword)
        );
        $query = $this->db->get_where('user_reg', $data);
        if ($query->num_rows() > 0)
            $status = true;
        return $status;
    }

    public function checkPassword($user_id, $password)
    {
        $status = false;
        $data = array(
            'user_id' => $user_id,
            'user_password' => md5($password)
        );
        $query = $this->db->get_where('user_reg', $data);
        if ($query->num_rows() > 0)
            $status = true;
        return $status;
    }

    public function transation_password_change($user_id, $post_data)
    {
        $status = false;
        $data = array(
            'user_transaction_password' => md5($post_data['user_transaction_new_password'])
        );
        if ($this->db->update('user_reg', $data, array('user_id' => $user_id)))
            $status = true;
        return $status;
    }

    public function password_change($user_id, $post_data)
    {
        $status = false;
        $data = array(
            'user_password' => md5($post_data['user_new_password']),
        );
        if ($this->db->update('user_reg', $data, array('user_id' => $user_id)))
            $status = true;
        return $status;
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

    public function transaction_modify_information($user_id, $post_data)
    {
        $status = false;
        if ($this->db->update('user_reg', $post_data, array('user_id' => $user_id)))
            $status = true;
        return $status;
    }

    public function user_payment_inormation($user_id)
    {
        $query = $this->db->get_where('bank_information', array('user_id' => $user_id));
        $bank_info = $query->result_array();
        return $bank_info;
    }

    public function bank_pay_data_update($user_id, $post_data)
    {
        $status = false;
        $params = $post_data;
        $params['user_id'] = $user_id;
        $this->db->set($params);
        if ($this->db->insert('bank_information'))
            $status = true;
        return $status;
    }
}



