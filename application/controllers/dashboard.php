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
            case 'add-new-project':
                $this->add_new_project();
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

    public function add_new_project()
    {
        $this->load->helper('form');
        $data = null;
        $error = null;
        $title = 'Add New Project';
        $this->load->model('dashboard_model');
        $data = $this->session->userdata('user_info');
        $user_id = $data['user_id'];
        $this->template->write_view('content', 'template/user/pages/add-new-project', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();

    }
}
