<?php
class Movie_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }
    public function count_movies(){
        $query = $this->db->query('SELECT rowid FROM llx_movie');
        return $query->num_rows();
    }
    public function fetch_movie($limit,$offset,$stars=null,$categ=null){
        $this->db->limit($limit,$offset);
        $this->db->select("m.rowid, m.date_upload,m.designation, m.title, m.description, m.download_count");
        $this->db->from("llx_movie m");
        //$this->db->where("u.rowid=np.fk_user");
        if($stars !=NULL){
            //$this->db->where("np.tms>=",$start_time);
        }
        if($categ!=NULL){
            //$this->db->where("np.tms<=",$end_time);
        }
        $this->db->order_by("m.date_upload",'desc');
        $query=$this->db->get();
        return $query->result_array();
    }
    public function add_note_public(){
        $note=$this->input->post("note");
        $tms=date("Y-m-d h:i::sa");
        $data = array(
            'fk_user'=>$_SESSION['rowid'],
            'tms'=>$tms,
            'note' => $note,
        );
        $this->db->insert('llx_note_public', $data);
    }

}