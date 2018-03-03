<?php
class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Login_model');
        $this->load->helper('url_helper');
        //$this->config->set_item('language', $_SESSION['language']);
        $this->load->helper('language');
        $this->lang->load('menu');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    public function index()
    {
        if (isset($_SESSION['logged_in'])){
            //$url=$_GET["url"];
            //redirect($url);
            redirect(base_url('/index.php/movie/show_movies'));
        }
        else {
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->form_validation->set_rules('account', 'Account', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header_login');
                $this->load->view('login/login');
                $this->load->view('templates/footer');
            } else {
                $verifie = $this->Login_model->verifie();
                if ($verifie == null) {
                    $this->load->view('templates/header_login');
                    $this->load->view('login/login');
                    $this->load->view('templates/footer');
                } else {
                    //$_SESSION['id']='az5284';
                    foreach ($verifie as $value){
                    }
                    $data = array(
                        'username' => $value['name'],
                        'logged_in' => TRUE,
                        'rowid'=>$value['rowid'],
                        'language'=>'chinese',
                        'admin'=>$value['admin'],//是否是管理员
                    );
                    $this->session->set_userdata($data);
                    redirect(base_url('/index.php/movie/show_movies'));
                }
            }
        }

    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url('/index.php/login/index/'));
    }


    //主页面 //没用的东西 只是用来参考
    public function main_page(){
        if (!(isset($_SESSION['logged_in'])&&$_SESSION['version']=='base')){
            redirect(base_url('/index.php/login/index/'));
        }
        else{
            $this->config->set_item('language', $_SESSION['language']);
            //$data['user_right']=$this->Login_model->user_right($_SESSION['rowid']);//获得用户权限array
            $data['rowid']=$_SESSION['rowid'];
            $this->lang->load('menu');
            $this->form_validation->set_rules('note', 'Note', 'required');
            if ($this->form_validation->run() == TRUE) {
                $this->Login_model->add_note_public();
            }
            //note_public公开留言
            $start_time=NULL;
            $end_time=NULL;
            if(isset($_GET['start_time'])){
                $start_time=$_GET['start_time'];
            }
            if(isset($_GET['end_time'])){
                $end_time=$_GET['end_time'];
            }
            $this->load->library('pagination');
            $config['base_url'] = base_url().'index.php/login/main_page';
            $config['total_rows'] = $this->Login_model->count_note_public();
            $config['per_page'] = 20;
            // Bootstrap for CodeIgniter pagination.
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '&raquo';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            $config['enable_query_strings']=TRUE;
            $config['page_query_string']=TRUE;
            $config['reuse_query_string'] = TRUE;
            $this->pagination->initialize($config);


            $data['note_public'] = $this->Login_model->fetch_note_public($config['per_page'],$this->input->get('per_page', TRUE),$start_time,$end_time);
            $data['start_time']=$start_time;
            $data['end_time']=$end_time;



            $this->load->view('templates/header_main_page');
            $this->load->view('login/main_page',$data);
            $this->load->view('templates/footer');
        }

    }
}