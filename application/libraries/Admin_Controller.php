<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Admin_Controller extends CI_Controller {

    public function __construct(){
		parent::__construct();
        $user_info = $this->session->userdata('admin_info');

        if(empty($user_info) && $this->uri->segment(2) != 'login')
        {
            $msg = array(
                'status' => false,
                'class' => 'errormsgbox',
                'msg' => 'To access this page please login.'
            );

            $data = json_encode($msg);

            $this->session->set_flashdata('msg', $data);
            redirect('/admin/login');
        }
        $this->template->set_template('admin');
        //$template['active_template'] = 'user';
		$this->set_temlates();
    }
	
	public function set_temlates() {
		$this->template->write_view('header', 'template/admin/header',array());
        $this->template->write_view('left_menu', 'template/admin/left-menu',array());
        $this->template->write_view('left_menu_mobile', 'template/admin/left-menu-mobile',array());
		$this->template->write_view('footer', 'template/admin/footer',array());
	}
}

/* End of file Someclass.php */