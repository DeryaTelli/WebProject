<?php
class File_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Tüm dosya bilgilerini çek
    public function getRows() {
        $query = $this->db->get('files');
        return $query->result_array();
    }
}
?>
