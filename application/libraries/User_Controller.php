<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class User_Controller extends CI_Controller {

    public function __construct(){
		parent::__construct();
        $user_info = $this->session->userdata('user_info');

        if(empty($user_info))
        {
            $msg = array(
                'status' => false,
                'class' => 'alert alert-danger',
                'msg' => 'To access this page please login.'
            );

            $data = json_encode($msg);

            $this->session->set_flashdata('msg', $data);
            redirect('/login');
        }
        $this->template->set_template('user');
        //$template['active_template'] = 'user';
		$this->set_templates();
    }
	
	public function set_templates(){
        $user_info = $this->session->userdata('user_info');
        $this->load->model('dashboard_model');
        $user_id = $user_info['user_id'];
        $data['user_info'] = $this->dashboard_model->user_data($user_id);
		$this->template->write_view('header', 'template/user/header',array('data' => $data));
		$this->template->write_view('left_menu', 'template/user/left-menu',array());
        $this->template->write_view('left_menu_mobile', 'template/user/left-menu-mobile',array());
		$this->template->write_view('footer', 'template/user/footer',array());
	}
}

/* End of file Someclass.php */