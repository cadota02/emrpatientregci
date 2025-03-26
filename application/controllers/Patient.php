<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Patient_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $search = $this->input->get('search'); 
       // $data['patients'] = $this->Patient_model->get_patient_list_all();
        $data['patients'] = $this->Patient_model->get_patients($search);
        $this->load->view('patient/index', $data);
    }

    public function add() {
        //Set validation rules
        $this->form_validation->set_rules('firstname', 'Firstaname', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required|min_length[3]|max_length[255]');
        $this->form_validation->set_rules('sex', 'Sex', 'required|min_length[1]|max_length[1]');
        $this->form_validation->set_rules('birthday', 'Birthday', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[patients.email]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|min_length[10]|max_length[15]');
        
        if($this->form_validation->run() == FALSE) {
            // Load the form with the validation erros
            $this->load->view('patient/add');
        } else {
            $patient_data = [
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'middlename' => $this->input->post('middlename'),
                'birthday' => $this->input->post('birthday'),
                'sex' => $this->input->post('sex'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'created_at' => date('Y-m-d H:i:s')
            ];
          
            if($this->Patient_model->insert_patient($patient_data)) {
                $this->session->set_flashdata('success', 'Patient added successfully');
                redirect('patient/index');
            } else {
                $this->session->set_flashdata('error', 'Failed to add patient.');
                redirect('patient/add');
            }
        }

      
    }
    //get patient details
    public function edit($id) {
        
        $data['patient'] = $this->Patient_model->get_patient_by_id($id);
        if(!$data['patient']) {
          show_404();
        }
        else
        {
            $this->form_validation->set_rules('firstname', 'Firstaname', 'required|min_length[3]|max_length[255]');
            $this->form_validation->set_rules('lastname', 'Lastname', 'required|min_length[3]|max_length[255]');
            $this->form_validation->set_rules('sex', 'Sex', 'required|min_length[1]|max_length[1]');
            $this->form_validation->set_rules('birthday', 'Birthday', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'required|min_length[10]|max_length[15]');

            if($this->form_validation->run()== FALSE)
            {
                $this->load->view('patient/edit', $data);
            }
            else
            {
                $update_data = [
                    'firstname' => $this->input->post('firstname'),
                    'lastname' => $this->input->post('lastname'),
                    'birthday' => $this->input->post('birthday'),
                    'sex' => $this->input->post('sex'),
                    'middlename' => $this->input->post('middlename'),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                if($this->Patient_model->update_patient($id, $update_data)) {
                    $this->session->set_flashdata('success', 'Patient updated successfully');
                    redirect('patient/index');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update patient.');
                    redirect('patient/edit',$data);
                }
            }
        }
    }

    //delete patient
    public function delete($id){
        if($this->Patient_model->delete_patient($id)) {
            $this->session->set_flashdata('success', 'Patient deleted successfully');
         
        } else {
            $this->session->set_flashdata('error', 'Failed to delete patient.');
            
        }
        redirect('patient/index');
    }
   
}

?>