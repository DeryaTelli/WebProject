<?php
class FileUser extends CI_Model {

    public $tableName;

    function __construct() {
        parent::__construct();
        $this->tableName = 'files';
    }

    public function getRows() {
        $this->db->select('*');
        $this->db->from($this->tableName);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchFiles($keyword) {
        if (!empty($keyword)) {
            $this->db->select('id, file_name, uploaded_on, title');
            $this->db->from($this->tableName);
            $this->db->like('file_name', $keyword);
            $this->db->or_like('title', $keyword);
            $query = $this->db->get();
            return $query->result_array();
        } else {
            return array(); // Arama terimi boş ise boş sonuç döndür
        }
    }
    
    public function addComment($data) {
        $this->db->insert('comments', $data);
    }
    
    public function getRowsWithComments() {
        $this->db->select('files.id, files.file_name, files.title, files.uploaded_on, GROUP_CONCAT(comments.comment ORDER BY comments.created_at DESC) as comments');
        $this->db->from('files');
        $this->db->join('comments', 'comments.file_id = files.id', 'left');
        $this->db->group_by('files.id');
        $query = $this->db->get();
        return $query->result_array();
    }
    
}
