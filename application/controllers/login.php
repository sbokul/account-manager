<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'libraries/My_Controller.php');

class Login extends My_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {

        $this->load->helper('form');
        $data = null;
        $error = null;
        $title = 'Sign in';
        $this->template->write_view('content', 'pages/home', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function login_check()
    {
        $data = $this->input->post();
        if ($_POST) {
            $this->load->model('user_model');
            if ($this->user_model->login_check($data)) {
                $msg = array(
                    'status' => false,
                    'class' => 'alert alert-success',
                    'msg' => 'Logged in Successfully.'
                );

                $data = json_encode($msg);

                redirect('/dashboard');

                $this->session->set_flashdata('msg', $data);
            } else {
                $msg = array(
                    'status' => false,
                    'class' => 'alert alert-danger',
                    'msg' => 'Login failed please try again.'
                );

                $data = json_encode($msg);

                $this->session->set_flashdata('msg', $data);
            }
        }
        redirect('/');
    }

    public function logout()
    {
        $this->session->unset_userdata('user_info');
        redirect('/');
    }

    public function forgetpassword()
    {
        $data = $this->input->post();
        if ($_POST) {
            $this->load->model('user_model');
            if ($this->user_model->forgetpassword($data)) {
                $data['user_name'] = $this->user_model->forgetpassword($data);
                foreach ($data['user_name'] as $row) {
                    $row['cpassword'];
                    $row['email'];
                }
                $this->load->library('email');
                $this->email->from('info@clippingpathway.com', 'Admin');
                $this->email->to($row['email']);
                $this->email->subject('Your Password ');
                $this->email->message('Your Password:' . $row['cpassword'] . '');
                $this->email->send();
                $msg = array(
                    'status' => true,
                    'class' => 'errormsgbox',
                    'msg' => 'Please Check Your Mail.'
                );

                $data = json_encode($msg);
                $this->session->set_flashdata('msg', $data);

                redirect('/');


            } else {
                $msg = array(
                    'status' => false,
                    'class' => 'errormsgbox',
                    'msg' => 'Wrong Email Try Again.'
                );

                $data = json_encode($msg);

                $this->session->set_flashdata('msg', $data);
            }
        }
        redirect('/');
    }


}
