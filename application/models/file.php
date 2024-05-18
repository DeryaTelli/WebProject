<?php
class file extends CI_Model
{
    public $tableName;

    function __construct()
    {
        parent::__construct();
        $this->tableName = 'files';
    }

    public function getRows($id=''){
        $this->db->select('id,file_name,title,uploaded_on');
        $this->db->from('files');
        if($id){
            $this->db->where('id',$id);
            $query=$this->db->get();
            $result=$query->row_array();
        }else{
            $this->db->order_by('uploaded_on', 'desc');
            $query=$this->db->get();
            $result=$query->result_array();
        }
        return !empty($result)?$result:false;
    }
    public function insert($data=array()){
        $insert=$this->db->insert_batch('files',$data);
        return $insert?true:false;
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('files');
        return $this->db->affected_rows() > 0;
    }

    public function searchFiles($searchTerm) {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->like('title', $searchTerm);
        $this->db->or_like('file_name', $searchTerm);
        $query = $this->db->get();
        return $query->result_array();
    }
    
}
?>