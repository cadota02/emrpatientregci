<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient_model extends CI_Model {

    private $table = 'patients';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    // Get all patients query builder
    public function get_patient_list() {
      $query = $this->db->query("SELECT * FROM patients");
        return $this->$query->result_array();
    }
    public function get_patient_list_all() {
        $query = $this->db->select('id,firstname,middlename,lastname,phone,email');
        $this->db->from($this->table);
          return $this->db->get()->result_array();
    }

    // Insert a new patients
    public function insert_patient($data) {
       
        return $this->db->insert($this->table, $data);
    }
    // Get all patients
    public function get_all_patients() {
        return $this->db->get($this->table)->result_array();
    }
    // Get a patient by id
    public function get_patient_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }
    // Update a patient by id
    public function update_patient($id, $data) {
        $this->db->where('id', $id);
       // $this->set('name', $data['name']);
        return $this->db->update($this->table, $data);
    }
    // Delete a patient by id
    public function delete_patient($id) {
        return $this->db->delete($this->table, ['id' => $id]);
    }
    public function get_patients($search = null) {
        $this->db->select('*');
        $this->db->from('patients');

        if ($search) {
            $this->db->group_start();
            $this->db->like('firstname', $search);
            $this->db->or_like('lastname', $search);
            $this->db->or_like('middlename', $search);
            $this->db->or_like('email', $search);
            $this->db->or_like('phone', $search);
            $this->db->group_end();
        }

        return $this->db->get()->result_array();
    }


}
?>