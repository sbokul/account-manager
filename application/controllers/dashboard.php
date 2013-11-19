<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'libraries/User_Controller.php');

class Dashboard extends User_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');

    }

    function _remap($method)
    {
        // $method contains the second segment of your URI
        switch ($method) {
            case 'index':
                $this->index();
                break;
            case 'donation-list':
                $this->donation_list();
                break;
            case 'make-donation':
                $this->make_donation();
                break;
            case 'save-donation':
                $this->save_donation();
                break;
            case 'upgrade-membership':
                $this->upgrade_membership();
                break;
            case 'upgrade-membership-save':
                $this->upgrade_membership_save();
                break;
            case 'withdraw-fund':
                $this->withdraw_fund();
                break;
            case 'withdraw-list':
                $this->withdraw_list();
                break;
            case 'genealogy':
                $this->genealogy();
                break;
            case 'withdraw-save':
                $this->withdraw_save();
                break;
            case 'transactions':
                $this->transactions();
                break;
            case 'account-overview':
                $this->account_overview();
                break;
            case 'transaction-password':
                $this->transaction_password();
                break;
            case 'transaction-password-save':
                $this->transaction_password_save();
                break;
            case 'change-transaction-password':
                $this->change_transaction_password();
                break;
            case 'user-password':
                $this->user_password();
                break;

            case 'change-password':
                $this->change_password();
                break;
            case 'modify-information':
                $this->modify_information();
                break;
            case 'check-transaction-password':
                $this->check_transaction_password();
                break;
            case 'check-transaction-password-modify':
                $this->check_transaction_password_modify();
                break;
            case 'payment-information':
                $this->payment_information();
                break;
            case 'bank-pay':
                $this->bank_pay();
                break;
            case 'bank-pay-data':
                $this->bank_pay_data();
                break;
            case 'payza-pay':
                $this->payza_pay();
                break;
            case 'payza-pay-data':
                $this->payza_pay_data();
                break;
            case 'check-make-donation':
                $this->check_make_donation();
                break;
            case 'check-withdraw-fund':
                $this->check_withdraw_fund();
                break;
            case 'who-given-donation':
                $this->who_given_donation();
                break;
            case 'who-got-donation':
                $this->who_got_donation();
                break;
            default:
                $this->page_not_found();
                break;
        }
    }

    public function index()
    {
        $this->load->helper('form');
        $data = null;
        $error = null;
        $title = 'Dashboard';
        $this->load->model('dashboard_model');
        $data = $this->session->userdata('user_info');
        $user_id = $data['user_id'];
        $this->template->write_view('content', 'template/user/pages/home', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();

    }

    public function who_given_donation()
    {
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->load->library('pagination');
        $data = null;
        $error = null;
        $title = 'Who Given Donation';
        $this->load->model('userpanel_model');

        $given_donation_numbers = $this->userpanel_model->who_given_donation_numbers($data['user_id']);

        $config['base_url'] = '/userpanel/who-given-donation/';
        $config['total_rows'] = $given_donation_numbers;
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $this->pagination->initialize($config);


        $data = $this->session->userdata('user_info');
        $user_id = $data['user_id'];
        $data = $this->userpanel_model->user_data($data['user_id']);
        $data['given_donation'] = $this->userpanel_model->who_given_donations($offset, 10);
        $this->template->write_view('content', 'template/user/pages/who-given-donations', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function who_got_donation()
    {
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->load->library('pagination');
        $data = null;
        $error = null;
        $title = 'Who Got Donation';
        $this->load->model('userpanel_model');

        $given_donation_numbers = $this->userpanel_model->who_got_donation_numbers($data['user_id']);

        $config['base_url'] = '/userpanel/who-got-donation/';
        $config['total_rows'] = $given_donation_numbers;
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $this->pagination->initialize($config);


        $data = $this->session->userdata('user_info');
        $user_id = $data['user_id'];
        $data = $this->userpanel_model->user_data($data['user_id']);
        $data['got_donation'] = $this->userpanel_model->who_got_donations($offset, 10);
        $this->template->write_view('content', 'template/user/pages/who-got-donations', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function page_not_found()
    {
        $this->load->helper('form');
        $data = null;
        $error = null;
        $title = '404 Page Not Found';
        $this->load->model('userpanel_model');
        $data = $this->session->userdata('user_info');
        $user_id = $data['user_id'];
        $data = $this->userpanel_model->user_data($data['user_id']);
        $this->template->write_view('content', 'template/user/pages/page-not-found', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();

    }

    public function donation_list()
    {
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $title = 'Your Donation';
        $this->load->model('userpanel_model');
        $data = $this->session->userdata('user_info');
        $this->load->library('pagination');

        $donation_numbers = $this->userpanel_model->get_donation_numbers($data['user_id']);

        $data['donation_numbers'] = $donation_numbers - $offset;

        $config['base_url'] = '/userpanel/donation-list/';
        $config['total_rows'] = $donation_numbers;
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $error = null;
        $user_id = $data['user_id'];
        $donation_list = $this->userpanel_model->get_donation_list($data['user_id'], $offset, $no_of_item = 10);
        $data['donation_list'] = $donation_list;
        $this->template->write_view('content', 'template/user/pages/donation-list', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function make_donation()
    {
        $title = 'Make A Donation';
        $this->load->model('userpanel_model');
        $user_data = $this->session->userdata('user_info');
        $error = null;
        $user_id = $user_data['user_id'];
        $data = $this->userpanel_model->user_data($user_id);
        $this->template->write_view('content', 'template/user/pages/make-donation', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function check_make_donation()
    {
        $title = 'Make A Donation';
        $this->load->model('userpanel_model');
        $user_data = $this->session->userdata('user_info');
        $error = null;
        $user_id = $user_data['user_id'];
        $data = $this->userpanel_model->user_data($user_id);
        $data['post_data'] = $this->input->post();
        $this->template->write_view('content', 'template/user/pages/check-make-donation', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function save_donation()
    {
        $this->load->model('userpanel_model');
        $data = $this->session->userdata('user_info');
        $user_id = $data['user_id'];
        $data = $this->userpanel_model->user_data($user_id);

        $post_data = $this->input->post();
        if ($_POST) {
            $this->form_validation->set_rules('no_of_donations', 'No OF Donations', 'required|numeric');
            $this->form_validation->set_rules('user_old_transaction_password', 'Transaction Password', 'required|user_old_transaction_password|callback_checkTransactionPassword');

            if ($this->form_validation->run() == FALSE) {
                $data = null;
                $error = null;
                $title = 'Admin';
                $this->template->write_view('content', 'template/user/pages/make-donation', array('data' => $data, 'error' => $error, 'title' => $title));
                $this->template->render();
            } else {
                if ($post_data['no_of_donations'] > 100) {
                    $msg = array(
                        'status' => false,
                        'class' => 'alert alert-danger',
                        'msg' => 'You only can donate 100 times.'
                    );

                    $data = json_encode($msg);
                    $this->session->set_flashdata('msg', $data);
                    redirect('/userpanel/make-donation');
                }

                $donation_made = $post_data['no_of_donations'] + $data['donation_count'];
                $remaining_donation = 100 - $data['donation_count'];

                if ($donation_made > 100) {
                    $msg = array(
                        'status' => false,
                        'class' => 'alert alert-danger',
                        'msg' => 'Already Donated ' . $data['donation_count'] . ' times. Remaining donation times ' . $remaining_donation . '.'
                    );

                    $data = json_encode($msg);
                    $this->session->set_flashdata('msg', $data);
                    redirect('/userpanel/make-donation');
                }

                $total_amount = $post_data['no_of_donations'] * 10;

                if ($data['current_balance'] >= $total_amount) {
                    if ($this->userpanel_model->save_donation($user_id, $post_data['no_of_donations'])) {
                        $msg = array(
                            'status' => false,
                            'class' => 'alert alert-success',
                            'msg' => 'Donation successfully made.'
                        );

                        $data = json_encode($msg);
                        $this->session->set_flashdata('msg', $data);
                    } else {
                        $msg = array(
                            'status' => false,
                            'class' => 'alert alert-danger',
                            'msg' => 'Problem in saving data. Please try again later.'
                        );

                        $data = json_encode($msg);
                        $this->session->set_flashdata('msg', $data);
                    }
                } else {
                    $msg = array(
                        'status' => false,
                        'class' => 'alert alert-danger',
                        'msg' => 'Don\'t have enough balance to donate.'
                    );

                    $data = json_encode($msg);
                    $this->session->set_flashdata('msg', $data);
                }
                redirect('/userpanel/make-donation');
            }
        }
    }

    public function upgrade_membership()
    {
        $title = 'Upgrade Membership';
        $this->load->model('userpanel_model');
        $user_data = $this->session->userdata('user_info');
        $error = null;
        $user_id = $user_data['user_id'];
        $data = $this->userpanel_model->user_data($user_id);
        $this->template->write_view('content', 'template/user/pages/upgrade-membership', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function upgrade_membership_save()
    {
        $this->load->model('userpanel_model');
        $data = $this->session->userdata('user_info');
        $user_id = $data['user_id'];
        $data = $this->userpanel_model->user_data($user_id);

        if ($data['current_balance'] >= 20) {
            if ($this->userpanel_model->save_upgradation($user_id)) {
                $msg = array(
                    'status' => false,
                    'class' => 'alert alert-success',
                    'msg' => 'Associate status upgraded successfully.'
                );

                $data = json_encode($msg);
                $this->session->set_flashdata('msg', $data);
            } else {
                $msg = array(
                    'status' => false,
                    'class' => 'alert alert-danger',
                    'msg' => 'Problem in saving data. Please try again later.'
                );

                $data = json_encode($msg);
                $this->session->set_flashdata('msg', $data);
            }
        } else {
            $msg = array(
                'status' => false,
                'class' => 'alert alert-danger',
                'msg' => 'Don\'t have enough balance to upgrade.'
            );

            $data = json_encode($msg);
            $this->session->set_flashdata('msg', $data);
        }
        redirect('/userpanel/upgrade-membership');
    }

    public function withdraw_fund()
    {
        $title = 'Withdraw Fund';
        $this->load->model('userpanel_model');
        $user_data = $this->session->userdata('user_info');
        $error = null;
        $user_id = $user_data['user_id'];

        $data = $this->userpanel_model->user_data($user_id);
        $data['agents'] = $this->userpanel_model->get_agents();
        $this->template->write_view('content', 'template/user/pages/withdraw-fund', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function check_withdraw_fund()
    {
        $title = 'Withdraw Fund';
        $this->load->model('userpanel_model');
        $user_data = $this->session->userdata('user_info');
        $error = null;
        $user_id = $user_data['user_id'];
        $data = $this->userpanel_model->user_data($user_id);
        $data['agents'] = $this->userpanel_model->get_agents();
        $data['post_data'] = $this->input->post();
        $this->template->write_view('content', 'template/user/pages/check-withdraw-fund', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function withdraw_save()
    {
        $this->load->model('userpanel_model');
        $data = $this->session->userdata('user_info');
        $user_id = $data['user_id'];
        $data = $this->userpanel_model->user_data($user_id);
        $post_data = $this->input->post();
        if ($_POST) {
            $this->form_validation->set_rules('withdraw_amount', 'Withdraw Amount', 'required|numeric');
            $this->form_validation->set_rules('withdraw_amount', 'Withdraw Amount', 'required|numeric');
            $this->form_validation->set_rules('user_old_transaction_password', 'Transaction Password', 'required|user_old_transaction_password|callback_checkTransactionPassword');

            if ($this->form_validation->run() == FALSE) {
                $data = null;
                $error = null;
                $title = 'Admin';
                $this->template->write_view('content', 'template/user/pages/withdraw-fund', array('data' => $data, 'error' => $error, 'title' => $title));
                $this->template->render();
            } else {
                if ($post_data['withdraw_amount'] <= $data['current_balance']) {
                    if ($this->userpanel_model->save_withdraw($post_data, $user_id)) {
                        $msg = array(
                            'status' => false,
                            'class' => 'alert alert-success',
                            'msg' => 'Withdraw Request sent successfully.'
                        );

                        $data = json_encode($msg);
                        $this->session->set_flashdata('msg', $data);
                    } else {
                        $msg = array(
                            'status' => false,
                            'class' => 'alert alert-danger',
                            'msg' => 'Problem in saving data. Please try again later.'
                        );

                        $data = json_encode($msg);
                        $this->session->set_flashdata('msg', $data);
                    }
                } else {
                    $msg = array(
                        'status' => false,
                        'class' => 'alert alert-danger',
                        'msg' => 'Don\'t have enough balance to withdraw.'
                    );

                    $data = json_encode($msg);
                    $this->session->set_flashdata('msg', $data);
                }
                redirect('/userpanel/withdraw-fund');
            }
        }
    }

    public function transactions()
    {
        $title = 'View Transactions';
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->load->model('userpanel_model');
        $data = $this->session->userdata('user_info');
        $this->load->library('pagination');

        $transactions_numbers = $this->userpanel_model->get_transactions_numbers($data['user_id']);

        $config['base_url'] = '/userpanel/transactions/';
        $config['total_rows'] = $transactions_numbers;
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $error = null;
        $user_id = $data['user_id'];
        $transactions_list = $this->userpanel_model->get_transactions_list($data['user_id'], $offset, $no_of_item = 10);
        $data['transactions_list'] = $transactions_list;
        $this->template->write_view('content', 'template/user/pages/transactions', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function account_overview()
    {
        $title = 'Account Overview';
        $user_data = $this->session->userdata('user_info');
        $error = null;
        $user_id = $user_data['user_id'];
        $this->load->model('userpanel_model');
        $data = $this->userpanel_model->user_data_account($user_id);
        $this->template->write_view('content', 'template/user/pages/accountoverview', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function withdraw_list()
    {
        $title = 'Withdraw List';
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->load->model('userpanel_model');
        $data = $this->session->userdata('user_info');
        $this->load->library('pagination');

        $withdraw_numbers = $this->userpanel_model->get_withdraw_numbers($data['user_id']);

        $config['base_url'] = '/userpanel/withdraw-list/';
        $config['total_rows'] = $withdraw_numbers;
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $this->pagination->initialize($config);

        $error = null;
        $user_id = $data['user_id'];
        $withdraw_list = $this->userpanel_model->get_withdraw_list($data['user_id'], $offset, $no_of_item = 10);
        $data['withdraw_list'] = $withdraw_list;
        $this->template->write_view('content', 'template/user/pages/withdraw-list', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function transaction_password()
    {
        $title = 'Account Overview';
        $user_data = $this->session->userdata('user_info');
        $error = null;
        $user_id = $user_data['user_id'];
        $this->load->model('userpanel_model');
        $data = $this->userpanel_model->user_data($user_id);
        $this->template->write_view('content', 'template/user/pages/transaction-password', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function transaction_password_save()
    {
        $this->load->helper('form');
        $title = 'Account Overview';
        $error = null;
        $user_data = $this->session->userdata('user_info');
        $user_id = $user_data['user_id'];
        $post_data = $this->input->post();
        if ($_POST) {
            $this->form_validation->set_rules('user_transaction_password', 'Transaction Password', 'required');
            $this->form_validation->set_rules('user_transaction_confirm_password', 'Confirm Transaction Password', 'required');
            if ($this->form_validation->run() == FALSE) {
                $data = null;
                $error = null;
                $title = 'Admin';
                $this->template->write_view('content', 'template/user/pages/transaction-password', array('data' => $data, 'error' => $error, 'title' => $title));
                $this->template->render();
            } else {
                $this->load->model('userpanel_model');

                if ($this->input->post('user_transaction_password') == $this->input->post('user_transaction_confirm_password')) {
                    if ($this->userpanel_model->transation_password_update($user_id, $post_data)) {
                        $msg = array(
                            'status' => true,
                            'class' => 'alert alert-success',
                            'msg' => 'Transaction Password Save Successfully.'
                        );

                        $data = json_encode($msg);
                        $this->session->set_flashdata('msg', $data);
                    } else {
                        $msg = array(
                            'status' => false,
                            'class' => 'alert alert-danger',
                            'msg' => 'Failed to Payment.'
                        );

                        $data = json_encode($msg);

                        $this->session->set_flashdata('msg', $data);
                    }
                } else {
                    $msg = array(
                        'status' => false,
                        'class' => 'alert alert-danger',
                        'msg' => 'Transaction Password Not Match'
                    );
                    $data = json_encode($msg);

                    $this->session->set_flashdata('msg', $data);
                }
                redirect('/userpanel/transaction-password');

            }

        }
    }

    public function change_transaction_password()
    {
        $this->load->helper('form');
        $title = 'Account Overview';
        $error = null;
        $user_data = $this->session->userdata('user_info');
        $user_id = $user_data['user_id'];
        $post_data = $this->input->post();
        if ($_POST) {
            $this->form_validation->set_rules('user_old_transaction_password', 'Transaction Password', 'required|user_old_transaction_password|callback_checkTransactionPassword');
            $this->form_validation->set_rules('user_transaction_new_password', 'New Transaction Password', 'required');
            $this->form_validation->set_rules('user_new_transaction_confirm_password', 'Confirm New Transaction Password', 'required');
            if ($this->form_validation->run() == FALSE) {
                $data = null;
                $error = null;
                $title = 'Admin';
                $this->template->write_view('content', 'template/user/pages/transaction-password', array('data' => $data, 'error' => $error, 'title' => $title));
                $this->template->render();
            } else {
                $this->load->model('userpanel_model');

                if ($this->input->post('user_transaction_new_password') == $this->input->post('user_new_transaction_confirm_password')) {
                    if ($this->userpanel_model->checkTransactionPassword($user_id, $this->input->post('user_old_transaction_password'))) {
                        if ($this->userpanel_model->transation_password_change($user_id, $post_data)) {
                            $msg = array(
                                'status' => true,
                                'class' => 'alert alert-success',
                                'msg' => 'Transaction Password Change Successfully.'
                            );

                            $data = json_encode($msg);
                            $this->session->set_flashdata('msg', $data);
                        } else {
                            $msg = array(
                                'status' => false,
                                'class' => 'alert alert-danger',
                                'msg' => 'Failed to Payment.'
                            );

                            $data = json_encode($msg);

                            $this->session->set_flashdata('msg', $data);
                        }
                    } else {
                        $msg = array(
                            'status' => false,
                            'class' => 'alert alert-danger',
                            'msg' => 'Invalid Transaction Password'
                        );
                        $data = json_encode($msg);

                        $this->session->set_flashdata('msg', $data);
                    }
                } else {
                    $msg = array(
                        'status' => false,
                        'class' => 'alert alert-danger',
                        'msg' => 'Transaction Password Not Match'
                    );
                    $data = json_encode($msg);

                    $this->session->set_flashdata('msg', $data);
                }
                redirect('/userpanel/transaction-password');

            }

        }
    }

    public function user_password()
    {
        $title = 'Account Overview';
        $user_data = $this->session->userdata('user_info');
        $error = null;
        $user_id = $user_data['user_id'];
        $this->load->model('userpanel_model');
        $data = $this->userpanel_model->user_data($user_id);
        $this->template->write_view('content', 'template/user/pages/user-password', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function change_password()
    {
        $this->load->helper('form');
        $title = 'Account Overview';
        $error = null;
        $user_data = $this->session->userdata('user_info');
        $user_id = $user_data['user_id'];
        $post_data = $this->input->post();
        if ($_POST) {
            $this->form_validation->set_rules('user_old_password', 'Password', 'required|user_old_transaction_password|callback_checkPassword');
            $this->form_validation->set_rules('user_new_password', 'New  Password', 'required');
            $this->form_validation->set_rules('user_new_confirm_password', 'Confirm New  Password', 'required');
            if ($this->form_validation->run() == FALSE) {
                $data = null;
                $error = null;
                $title = 'Admin';
                $this->template->write_view('content', 'template/user/pages/user-password', array('data' => $data, 'error' => $error, 'title' => $title));
                $this->template->render();
            } else {
                $this->load->model('userpanel_model');

                if ($this->input->post('user_new_password') == $this->input->post('user_new_confirm_password')) {
                    if ($this->userpanel_model->checkPassword($user_id, $this->input->post('user_old_password'))) {
                        if ($this->userpanel_model->password_change($user_id, $post_data)) {
                            $msg = array(
                                'status' => true,
                                'class' => 'alert alert-success',
                                'msg' => 'Password Change Successfully.'
                            );

                            $data = json_encode($msg);
                            $this->session->set_flashdata('msg', $data);
                        } else {
                            $msg = array(
                                'status' => false,
                                'class' => 'alert alert-danger',
                                'msg' => 'Failed to Payment.'
                            );

                            $data = json_encode($msg);

                            $this->session->set_flashdata('msg', $data);
                        }
                    } else {
                        $msg = array(
                            'status' => false,
                            'class' => 'alert alert-danger',
                            'msg' => 'Invalid  Password'
                        );
                        $data = json_encode($msg);

                        $this->session->set_flashdata('msg', $data);
                    }
                } else {
                    $msg = array(
                        'status' => false,
                        'class' => 'alert alert-danger',
                        'msg' => 'Password Not Match'
                    );
                    $data = json_encode($msg);

                    $this->session->set_flashdata('msg', $data);
                }
                redirect('/userpanel/user-password');

            }

        }
    }

    public function modify_information()
    {
        $title = 'Account Overview';
        $user_data = $this->session->userdata('user_info');
        $error = null;
        $user_id = $user_data['user_id'];
        $this->load->model('userpanel_model');
        $data = $this->userpanel_model->user_data_account($user_id);
        $data['country'] = $this->userpanel_model->getCountryList();
        $this->template->write_view('content', 'template/user/pages/modify-information', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function check_transaction_password()
    {
        $title = 'Account Overview';
        $post_data = $this->input->post();
        $this->session->set_userdata('user_modify', $post_data);
        $user_data = $this->session->userdata('user_info');
        $error = null;
        $user_id = $user_data['user_id'];
        $this->load->model('userpanel_model');
        //$data = $this->userpanel_model->user_data_account($user_id);
        //$data['country'] = $this->userpanel_model->getCountryList();
        $this->template->write_view('content', 'template/user/pages/check-transaction-password', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function check_transaction_password_modify()
    {
        $this->load->helper('form');
        $title = 'Account Overview';
        $error = null;
        $user_modify = $this->session->userdata('user_modify');
        $user_data = $this->session->userdata('user_info');
        $user_id = $user_data['user_id'];
        $post_data = $this->input->post();
        if ($_POST) {
            $this->form_validation->set_rules('user_old_transaction_password', 'Transaction Password', 'required|user_old_transaction_password|callback_checkTransactionPassword');
            if ($this->form_validation->run() == FALSE) {
                $data = null;
                $error = null;
                $title = 'Admin';
                $this->template->write_view('content', 'template/user/pages/check-transaction-password', array('data' => $data, 'error' => $error, 'title' => $title));
                $this->template->render();
            } else {
                $this->load->model('userpanel_model');
                if ($this->userpanel_model->transaction_modify_information($user_id, $user_modify)) {
                    $msg = array(
                        'status' => true,
                        'class' => 'alert alert-success',
                        'msg' => 'Modify Information Successfully.'
                    );

                    $data = json_encode($msg);
                    $this->session->set_flashdata('msg', $data);
                } else {
                    $msg = array(
                        'status' => false,
                        'class' => 'alert alert-danger',
                        'msg' => 'Failed to modify.'
                    );

                    $data = json_encode($msg);
                    $this->session->set_flashdata('msg', $data);
                }
                $this->session->unset_userdata('user_modify');
                redirect('/userpanel/account-overview');

            }
        }
    }

    public function payment_information()
    {
        $title = 'Account Overview';
        $post_data = $this->input->post();
        $this->session->set_userdata('user_modify', $post_data);
        $user_data = $this->session->userdata('user_info');
        $error = null;
        $user_id = $user_data['user_id'];
        $this->load->model('userpanel_model');
        $data['bank_info'] = $this->userpanel_model->user_payment_inormation($user_id);
        //var_dump($data['bank_info']);
        //exit(0);
        //$data['country'] = $this->userpanel_model->getCountryList();
        $this->template->write_view('content', 'template/user/pages/payment-information', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function bank_pay()
    {
        $title = 'Account Overview';
        $post_data = $this->input->post();
        $this->session->set_userdata('user_modify', $post_data);
        $user_data = $this->session->userdata('user_info');
        $error = null;
        $user_id = $user_data['user_id'];
        $this->load->model('userpanel_model');
        $data = null;
        $this->template->write_view('content', 'template/user/pages/bank-pay', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function payza_pay()
    {
        $title = 'Account Overview';
        $post_data = $this->input->post();
        $this->session->set_userdata('user_modify', $post_data);
        $user_data = $this->session->userdata('user_info');
        $error = null;
        $user_id = $user_data['user_id'];
        $this->load->model('userpanel_model');
        $data = null;
        //$data['bank_info'] = $this->userpanel_model->user_payment_inormation($user_id);
        //var_dump($data['bank_info']);
        //exit(0);
        //$data['country'] = $this->userpanel_model->getCountryList();
        $this->template->write_view('content', 'template/user/pages/payza-pay', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function bank_pay_data()
    {
        $this->load->helper('form');
        $title = 'Account Overview';
        $error = null;
        //$user_modify = $this->session->userdata('user_modify');
        $user_data = $this->session->userdata('user_info');
        $user_id = $user_data['user_id'];
        $post_data = $this->input->post();
        if ($_POST) {
            $this->form_validation->set_rules('account_number', 'Account Number', 'required');
            $this->form_validation->set_rules('account_name', 'Account Name', 'required');
            $this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
            $this->form_validation->set_rules('branch_name', 'Branch Name', 'required');
            if ($this->form_validation->run() == FALSE) {
                $data = null;
                $error = null;
                $title = 'Admin';
                $this->template->write_view('content', 'template/user/pages/bank-pay', array('data' => $data, 'error' => $error, 'title' => $title));
                $this->template->render();
            } else {
                $this->load->model('userpanel_model');
                if ($this->userpanel_model->bank_pay_data_update($user_id, $post_data)) {
                    $msg = array(
                        'status' => true,
                        'class' => 'alert alert-success',
                        'msg' => 'Information Saved Successfully.'
                    );

                    $data = json_encode($msg);
                    $this->session->set_flashdata('msg', $data);
                } else {
                    $msg = array(
                        'status' => false,
                        'class' => 'alert alert-danger',
                        'msg' => 'Failed to Save.'
                    );

                    $data = json_encode($msg);
                    $this->session->set_flashdata('msg', $data);
                }
                $this->session->unset_userdata('user_modify');
                redirect('/userpanel/payment-information');

            }
        }
    }

    public function payza_pay_data()
    {
        $this->load->helper('form');
        $title = 'Account Overview';
        $error = null;
        //$user_modify = $this->session->userdata('user_modify');
        $user_data = $this->session->userdata('user_info');
        $user_id = $user_data['user_id'];
        $post_data = $this->input->post();
        if ($_POST) {
            $this->form_validation->set_rules('account_number', 'Account Number', 'required');
            if ($this->form_validation->run() == FALSE) {
                $data = null;
                $error = null;
                $title = 'Admin';
                $this->template->write_view('content', 'template/user/pages/bank-pay', array('data' => $data, 'error' => $error, 'title' => $title));
                $this->template->render();
            } else {
                $this->load->model('userpanel_model');
                if ($this->userpanel_model->bank_pay_data_update($user_id, $post_data)) {
                    $msg = array(
                        'status' => true,
                        'class' => 'alert alert-success',
                        'msg' => 'Information Saved Successfully.'
                    );

                    $data = json_encode($msg);
                    $this->session->set_flashdata('msg', $data);
                } else {
                    $msg = array(
                        'status' => false,
                        'class' => 'alert alert-danger',
                        'msg' => 'Failed to Save.'
                    );

                    $data = json_encode($msg);
                    $this->session->set_flashdata('msg', $data);
                }
                $this->session->unset_userdata('user_modify');
                redirect('/userpanel/payment-information');

            }
        }
    }

    function checkTransactionPassword($transactionpassword, $internal = 1)
    {
        $status = true;
        $user_data = $this->session->userdata('user_info');
        $user_id = $user_data['user_id'];
        $this->load->model('userpanel_model');
        if ($this->userpanel_model->checkTransactionPassword($user_id, $transactionpassword) == null) {
            if ($internal == 1)
                $this->form_validation->set_message('transactionpassword_check', 'Invalid Transaction Password');
            $status = false;
        }

        return $status;
    }

    function checkPassword($password, $internal = 1)
    {
        $status = true;
        $this->load->model('admin_model');
        $user_data = $this->session->userdata('user_info');
        $user_id = $user_data['user_id'];
        $this->load->model('userpanel_model');
        if ($this->userpanel_model->checkPassword($user_id, $password) == null) {
            if ($internal == 1)
                $this->form_validation->set_message('check_password', 'Invalid  Password');
            $status = false;
        }

        return $status;
    }
}

if (isset($_GET['user_old_transaction_password'])) {
    $userpanel = new Userpanel();
    $status = $userpanel->checkTransactionPassword($_GET['user_old_transaction_password'], 0);
    if ($status == true)
        echo 'true';
    else
        echo 'false';
    die();
}
if (isset($_GET['user_old_password'])) {
    $userpanel = new Userpanel();
    $status = $userpanel->checkPassword($_GET['user_old_password'], 0);
    if ($status == true)
        echo 'true';
    else
        echo 'false';
    die();
}
