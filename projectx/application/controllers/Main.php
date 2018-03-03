<?php
class Main extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Login_model');
        $this->load->model('Movie_model');
        $this->load->helper('url_helper');
        //$this->config->set_item('language', $_SESSION['language']);
        $this->load->helper('language');
        $this->lang->load('menu');
        $this->load->helper('form');
        $this->load->library('form_validation');
    }
    public function index(){
        //note_public公开留言
        /*$start_time=NULL;
        $end_time=NULL;
        if(isset($_GET['start_time'])){
            $start_time=$_GET['start_time'];
        }
        if(isset($_GET['end_time'])){
            $end_time=$_GET['end_time'];
        }*/
        $this->load->library('pagination');
        $config['base_url'] = base_url().'index.php/main/index';
        $config['total_rows'] = $this->Movie_model->count_movies();
        $config['per_page'] = 6;
        // Bootstrap for CodeIgniter pagination.
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '上一页';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '下一页';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['enable_query_strings']=TRUE;
        $config['page_query_string']=TRUE;
        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);


        $data['movies'] = $this->Movie_model->fetch_movie($config['per_page'],$this->input->get('per_page', TRUE));;

        $this->load->view('templates/header');
        $this->load->view('movies/index',$data);
        $this->load->view('templates/footer');
    }

}