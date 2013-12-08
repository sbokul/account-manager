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
            case 'save-project':
                $this->save_project();
                break;
            case 'add-bill':
                $this->add_bill();
                break;
            case 'save-bill':
                $this->save_bill();
                break;
            case 'add-expense':
                $this->add_expense();
                break;
            case 'save-expense':
                $this->save_expense();
                break;
            case 'project-details':
                $this->project_details();
                break;
            case 'add-new-user':
                $this->add_new_user();
                break;
            case 'save-user':
                $this->save_user();
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
        $this->load->library('pagination');
        $data = $this->session->userdata('user_info');
        $user_id = $data['user_id'];

        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $projects_number = $this->dashboard_model->get_projects_number();

        $config['base_url'] = '/dashboard/index/';
        $config['total_rows'] = $projects_number;
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


        $data['projects'] = $this->dashboard_model->get_projects($config['per_page'], $offset);
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

    public function save_project()
    {

        $post_data = $this->input->post();
        $this->load->model('dashboard_model');
        if ($this->dashboard_model->save_project($post_data)) {
            $msg = array(
                'status' => false,
                'class' => 'alert alert-success',
                'msg' => 'Data saved successfully.'
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
        redirect('/dashboard/add-new-project');
    }

    public function add_bill()
    {
        $id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if($id == 0) {
            redirect('/dashboard');
        }
        $this->load->helper('form');
        $data = null;
        $error = null;
        $title = 'Add Bill';
        $this->load->model('dashboard_model');
        $data = $this->session->userdata('user_info');
        $data['id'] = $id;
        $user_id = $data['user_id'];
        $this->template->write_view('content', 'template/user/pages/add-bill', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function save_bill()
    {
        $post_data = $this->input->post();
        $this->load->model('dashboard_model');
        if ($this->dashboard_model->save_bill($post_data)) {
            $msg = array(
                'status' => false,
                'class' => 'alert alert-success',
                'msg' => 'Data saved successfully.'
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
        redirect('/dashboard');
    }

    public function add_expense()
    {
        $id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if($id == 0) {
            redirect('/dashboard');
        }
        $this->load->helper('form');
        $data = null;
        $error = null;
        $title = 'Add Expense';
        $this->load->model('dashboard_model');
        $data = $this->session->userdata('user_info');
        $data['id'] = $id;

        $particulars = $this->dashboard_model->get_particulars($id);

        $new_array = array();
        foreach ($particulars as $particular) {
            $new_array[] = $particular['particulars'];
        }

        $data['particulars'] = $new_array;


        $user_id = $data['user_id'];
        $this->template->write_view('content', 'template/user/pages/add-expense', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function save_expense()
    {
        $post_data = $this->input->post();
        $id = $post_data['project_id'];
        $this->load->model('dashboard_model');
        if ($this->dashboard_model->save_expense($post_data)) {
            $msg = array(
                'status' => false,
                'class' => 'alert alert-success',
                'msg' => 'Data saved successfully.'
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
        redirect('/dashboard/add-expense/'.$id);
    }

    public function project_details()
    {
        $id = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if($id == 0) {
            redirect('/dashboard');
        }
        $data = null;
        $error = null;
        $title = 'Project Detail';
        $this->load->model('dashboard_model');
        $data = $this->session->userdata('user_info');
        $data['id'] = $id;

        $data['project_detail'] = $this->dashboard_model->get_project_detail($id);

        $data['project_bill'] = $this->dashboard_model->get_project_bill($id);

        $data['project_expense'] = $this->dashboard_model->get_project_expense($id);

        $this->template->write_view('content', 'template/user/pages/project-detail', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();

    }

    public function get_total_particulars($particulars_name)
    {
        $this->load->model('dashboard_model');
        $particulars = $this->dashboard_model->get_total_particulars($particulars_name);
        return $particulars;
    }

    public function add_new_user()
    {
        $this->load->helper('form');
        $data = null;
        $error = null;
        $title = 'Add New User';
        $this->load->model('dashboard_model');
        $data = $this->session->userdata('user_info');
        $user_id = $data['user_id'];
        $this->template->write_view('content', 'template/user/pages/add-new-user', array('data' => $data, 'error' => $error, 'title' => $title));
        $this->template->render();
    }

    public function save_user()
    {
        $post_data = $this->input->post();
        $this->load->model('dashboard_model');
        if ($this->dashboard_model->save_user($post_data)) {
            $msg = array(
                'status' => false,
                'class' => 'alert alert-success',
                'msg' => 'Data saved successfully.'
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
        redirect('/dashboard/add-new-user');
    }

}

if (isset($_GET['particulars'])) {
    $dashboardObj = new Dashboard();
    $data = $dashboardObj->get_total_particulars($_GET['particulars']);

    echo '<div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Particulars</th>
                    <th>Amount</th>
                    <th>Voucher No.</th>
                </tr>
                </thead>
                <tbody>';

    $total_expense = 0;
    foreach ($data as $expense) {
        $total_expense = $total_expense + $expense['amount'];
        echo '<tr>';
        echo '<td>' . $expense['create_date'] . '</td>';
        echo '<td>' . $expense['particulars'] . '</td>';
        echo '<td align="right">' . number_format($expense['amount'], 2) . '</td>';
        echo '<td>' . $expense['voucher_no'] . '</td>';
        echo '</tr>';
    }
    echo '<tr>
            <td></td>
            <td><strong>Total</strong></td>
            <td align="right"><strong class="text-primary">';
    echo number_format($total_expense, 2);
    echo '</strong></td>
            <td></td>
        </tr>
        </tbody>
        </table>
        </div>';
    die();

}
