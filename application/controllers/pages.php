<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH . 'libraries/My_Controller.php');

class Pages extends My_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->helper('date');
    }

    function _remap($method)
    {
        // $method contains the second segment of your URI
        switch ($method) {
            case 'index':
                $this->index();
                break;
            default:
                $this->page_not_found();
                break;
        }
    }

    public function index()
    {
        $data = null;
        $error = null;
        $title = 'Home';
		$data='home';
        $this->template->write_view('content', 'pages/home', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function page_not_found() {
        echo "Page Not Found";
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */