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
}
