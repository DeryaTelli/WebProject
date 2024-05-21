<?php

class Comment_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function getComments() {
        $this->db->select('comments.*, user_form.name as user_name, files.title');
        $this->db->from('comments');
        $this->db->join('user_form', 'comments.user_id = user_form.id');
        $this->db->join('files', 'comments.file_id = files.id');
        $this->db->where('comments.read_status', 0); // Sadece okunmamış yorumları çek
        $query = $this->db->get();
        return $query->result_array();
    }

    public function markAsRead($commentId) {
        $data = array('read_status' => 1); // 1: Okundu, 0: Okunmadı
        $this->db->where('id', $commentId);
        return $this->db->update('comments', $data);
    }
    
    
}


?>
