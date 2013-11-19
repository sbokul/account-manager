<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Userpanel_model extends CI_Model
{

    protected $errors;

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function user_update($userid,$data)
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
        $query = $this->db->get_where('user_reg', array('user_id' => $user_id));
        $user_info = $query->row_array();
        return $user_info;
    }

    public function save_donation($user_id, $no_of_donations)
    {
        $status = false;
        $total_amount = $no_of_donations*10;

        $this->db->simple_query("UPDATE `user_reg` SET `current_balance` = current_balance - $total_amount, `donation_count` = `donation_count` + $no_of_donations WHERE `user_reg`.`user_id` = $user_id;");

        for($i=0; $i < $no_of_donations; ++$i) {
            $this->db->select('tracking_id');
            $this->db->from('donations');
            $this->db->order_by("id", "desc");
            $this->db->limit(1);
            $query = $this->db->get();
            $data = $query->row_array();

            $new_tracking_id = $data['tracking_id'] + 1;

            $params = array(
                'tracking_id' => $new_tracking_id,
                'user_id' => $user_id,
                'amount' => 10,
                'create_date' => date('Y-m-d')
            );
            $this->db->set($params);
            if ($this->db->insert('donations'))
                $status = true;

            $param_transaction = array(
                'user_id' => $user_id,
                'head' => 'Donate $10 tracking id '.$new_tracking_id,
                'amount' => 10,
                'type' => 'Donate',
                'in_out' => 0,
                'create_date' => date('Y-m-d')
            );
            $this->db->set($param_transaction);
            $this->db->insert('transaction');

            if($status == true) {
                $this->bonus_sharing($new_tracking_id);
                $this->bonus_sharing_to_parent($user_id, $new_tracking_id);
            }
        }

        return $status;
    }

    public function save_upgradation($user_id) {
        $status = false;
        if($this->db->simple_query("UPDATE `user_reg` SET `current_balance` = current_balance - 20, `user_status` = 1 WHERE `user_reg`.`user_id` = $user_id;"))
            $status = true;
        return $status;

    }

    private function bonus_sharing($tracking_id) {
        if($tracking_id >= 2 and $tracking_id%2 == 0) {
            $bonus_tracking_id = $tracking_id/2;
            $this->db->select('user_id');
            $this->db->from('donations');
            $this->db->where('tracking_id', $bonus_tracking_id);
            $this->db->limit(1);
            $query = $this->db->get();
            $data = $query->row_array();

            $cur_date = date('Y-m-d');

            $this->db->simple_query("UPDATE `user_reg` SET `current_balance` = current_balance + 15 WHERE `user_reg`.`user_id` = ".$data['user_id'].";");
            $this->db->simple_query("UPDATE `donations` SET `status` = 1, qualify_date = '".$cur_date."' WHERE `donations`.`tracking_id` = ".$bonus_tracking_id.";");

            $params = array(
                'user_id' => $data['user_id'],
                'head' => 'Got $15 bonus for tracking id '.$bonus_tracking_id.'',
                'amount' => 10,
                'tracking_id_for' => $tracking_id,
                'type' => 'Tracking Bonus',
                'in_out' => 1,
                'tracking_id_got' => $bonus_tracking_id,
                'create_date' => date('Y-m-d')
            );

            $this->db->set($params);
            $this->db->insert('transaction');
            return true;
        }
    }

    private function select_parent_info($user_id) {
        $this->db->select('*');
        $this->db->from('user_reg');
        $this->db->where('user_id', $user_id);
        $this->db->limit(1);
        $query = $this->db->get();
        $data = $query->row_array();
        return $data;
    }

    private function select_parent_id($user_id) {
        $this->db->select('parent_id');
        $this->db->from('user_reg');
        $this->db->where('user_id', $user_id);
        $this->db->limit(1);
        $query = $this->db->get();
        $data = $query->row_array();
        if(empty($data['parent_id'])) {
            $parent_id = 0;
        } else {
            $parent_id = $data['parent_id'];
        }

        return $parent_id;
    }

    private function bonus_sharing_to_parent($user_id, $new_tracking_id) {

        ////////////////////////1st Parent/////////////////////////////////////////
        $parent_id = $this->select_parent_id($user_id);
        if($parent_id === 0) {
            return true;
        }
        $parent_data = $this->select_parent_info($parent_id);

        if($parent_data['user_status'] == 1) {
            $params = array(
                'user_id' => $parent_data['user_id'],
                'head' => 'Got 3% bonus for tracking id '.$new_tracking_id.'',
                'amount' => '0.03',
                'tracking_id_for' => $new_tracking_id,
                'in_out' => 1,
                'type' => 'Donation Bonus',
                'tracking_id_got' => 0,
                'create_date' => date('Y-m-d')
            );
            $this->db->set($params);
            $this->db->insert('transaction');
            $this->db->simple_query("UPDATE `user_reg` SET `current_balance` = current_balance + 0.3 WHERE `user_reg`.`user_id` = ".$parent_data['user_id'].";");
        }
            ///////////////////2nd Parent///////////////////////////////////////////////

        $parent_id = $this->select_parent_id($parent_id);
        if($parent_id === 0) {
            return true;
        }
        $parent_data = $this->select_parent_info($parent_id);

        if($parent_data['user_status'] == 1) {
            $params = array(
                'user_id' => $parent_data['user_id'],
                'head' => 'Got 2% bonus for tracking id '.$new_tracking_id.'',
                'amount' => '0.02',
                'tracking_id_for' => $new_tracking_id,
                'in_out' => 1,
                'type' => 'Donation Bonus',
                'tracking_id_got' => 0,
                'create_date' => date('Y-m-d')
            );
            $this->db->set($params);
            $this->db->insert('transaction');
            $this->db->simple_query("UPDATE `user_reg` SET `current_balance` = current_balance + 0.2 WHERE `user_reg`.`user_id` = ".$parent_data['user_id'].";");
        }


        ///////////////////3nd Parent///////////////////////////////////////////////
        $parent_id = $this->select_parent_id($parent_id);
        if($parent_id === 0) {
            return true;
        }
        $parent_data = $this->select_parent_info($parent_id);
        if($parent_data['user_status'] == 1) {
            $params = array(
                'user_id' => $parent_data['user_id'],
                'head' => 'Got 1% bonus for tracking id '.$new_tracking_id.'',
                'amount' => '0.01',
                'tracking_id_for' => $new_tracking_id,
                'in_out' => 1,
                'type' => 'Donation Bonus',
                'tracking_id_got' => 0,
                'create_date' => date('Y-m-d')
            );
            $this->db->set($params);
            $this->db->insert('transaction');
            $this->db->simple_query("UPDATE `user_reg` SET `current_balance` = current_balance + 0.1 WHERE `user_reg`.`user_id` = ".$parent_data['user_id'].";");
        }
        return true;
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

    public function get_donation_numbers($user_id) {
        $this->db->select('*');
        $this->db->from('donations');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        $row_count = $query->num_rows();
        return $row_count;
    }

    public function get_transactions_numbers($user_id) {
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

    public function get_withdraw_numbers($user_id) {
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


    public function get_agents() {
        $this->db->select('*');
        $this->db->from('admin_users');
        $this->db->where('user_type', '3');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }

    public function save_withdraw($data, $user_id) {
        $status = false;
        $withdraw_amount = $data['withdraw_amount'];
        $this->db->simple_query("UPDATE `user_reg` SET `current_balance` = current_balance - $withdraw_amount WHERE `user_reg`.`user_id` = ".$user_id.";");
        $withdraw_percentage_agent = $withdraw_amount*7/100;
        $withdraw_percentage_coordinator = $withdraw_amount*3/100;
        $withdraw_percentage_deduct = $withdraw_amount*10/100;
        $amount_to_be_paid = $withdraw_amount - $withdraw_percentage_deduct;
        $data['user_id'] = $user_id;
        $data['create_date'] = date('Y-m-d');
        $data['amount_to_be_paid'] = $amount_to_be_paid;
        $this->db->simple_query("UPDATE `admin_users` SET `current_balance` = current_balance + $withdraw_percentage_agent WHERE `id` = ".$data['agent_id'].";");
        $agent_parent_id = $this->select_agent_parent_id($data['agent_id']);
        $this->db->simple_query("UPDATE `admin_users` SET `current_balance` = current_balance + $withdraw_percentage_coordinator WHERE `id` = ".$agent_parent_id.";");

        $agent_data = array(
            'user_id' => $data['agent_id'],
            'head' => 'Got 7% for withdraw',
            'in_out' => 1,
            'type' => 'Withdraw Bonus',
            'create_date' => date('Y-m-d')
        );
        $this->db->set($agent_data);
        $this->db->insert('transaction_admins');

        $coordinator_data = array(
            'user_id' => $agent_parent_id,
            'head' => 'Got 3% for withdraw',
            'in_out' => 1,
            'type' => 'Withdraw Bonus',
            'create_date' => date('Y-m-d')
        );
        $this->db->set($coordinator_data);
        $this->db->insert('transaction_admins');

        $this->db->set($data);
        if($this->db->insert('withdraw_accounts'))
            $status = true;
        $transaction_data = array(
            'user_id' => $user_id,
            'head' => 'Withdraw Fund amount $'.$data['withdraw_amount'],
            'amount' => $data['withdraw_amount'],
            'in_out' => '0',
            'type' => 'Withdraw',
            'create_date' => date('Y-m-d')
        );
        $this->db->set($transaction_data);
        $this->db->insert('transaction');

        return $status;
    }

    private function select_agent_parent_id($agent_id) {
        $this->db->select('parent');
        $this->db->from('admin_users');
        $this->db->where('id', $agent_id);
        $this->db->limit(1);
        $query = $this->db->get();
        $data = $query->row_array();
        return $data['parent'];
    }

    public function who_got_donation() {
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

    public function who_given_donation() {
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
public function user_login_data($user_id) {
        $status = false;
		$data = array(
            'user_last_login' => date('Y-m-d')
        );
       if ($this->db->update('user_reg',$data, array('user_id' => $user_id)))
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

public function checkTransactionPassword($user_id,$transactionpassword)
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
public function checkPassword($user_id,$password)
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
            'user_password' => md5($post_data['user_new_password'])
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
public function transaction-modify-information($user_id, $post_data)
    {
        $status = false;
        if ($this->db->update('user_reg', $post_data, array('user_id' => $user_id)))
            $status = true;
        return $status;    
		}										
}



