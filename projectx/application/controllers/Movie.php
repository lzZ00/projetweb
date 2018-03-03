<?php
class Movie extends CI_Controller {

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
    /*public function show_movies(){
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
    }*/
    public function info_movie($rowid=null){
        if($rowid==null){
            echo "网址输入错误";
        }
        $data['rowid']=$rowid;
        $data['movies'] = $this->Movie_model->fetch_movie(4,0);;//获得最新四部电影-->以后设置成关联电影
        $this->load->view('templates/header');
        $this->load->view('movies/info_movie',$data);
        $this->load->view('templates/footer');
    }
    public function show_movies(){
        $this->load->library('pagination');
        $config['base_url'] = base_url().'index.php/main/index';
        $config['total_rows'] = $this->Movie_model->count_movies();
        $config['per_page'] = 25;
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
        $this->load->view('movies/show_movies',$data);
        $this->load->view('templates/footer');
    }

}