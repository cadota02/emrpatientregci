<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Patient_model');
        $this->load->library('form_validation');
        $this->load->library('upload');
    }

    public function index() {
        $search = $this->input->get('search'); 
       // $data['patients'] = $this->Patient_model->get_patient_list_all();
        $data['patients'] = $this->Patient_model->get_patients($search);
        $this->load->view('patient/index', $data);
    }

    public function add() {
        $config['upload_path']   = './uploads/patients/'; // Folder to store files
        $config['allowed_types'] = 'jpg|jpeg|png|gif'; // Allowed file types
        $config['max_size']      = 2048; // Max file size in KB (2MB)
        $config['encrypt_name']  = TRUE; // Rename file to avoid conflicts

        $this->upload->initialize($config);

        if ($this->upload->do_upload('profile_image')) {
            $upload_data = $this->upload->data();
            $profile_image = 'uploads/patients/' . $upload_data['file_name']; // Store file path
        } else {
            $profile_image = NULL; // Set NULL if no file uploaded
        }


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
                'created_at' => date('Y-m-d H:i:s'),
                'profile_image'=> $profile_image
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
        if (!$data['patient']) {
            show_404();
        } else {
            $this->form_validation->set_rules('firstname', 'Firstname', 'required|min_length[3]|max_length[255]');
            $this->form_validation->set_rules('lastname', 'Lastname', 'required|min_length[3]|max_length[255]');
            $this->form_validation->set_rules('sex', 'Sex', 'required|min_length[1]|max_length[1]');
            $this->form_validation->set_rules('birthday', 'Birthday', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'required|min_length[10]|max_length[15]');
    
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('patient/edit', $data);
            } else {
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
    
                // Handle Profile Image Upload
                if (!empty($_FILES['profile_image']['name'])) {
                    $config['upload_path'] = './uploads/patients/'; // Folder where images will be stored
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['max_size'] = 2048; // 2MB max size
                    $config['encrypt_name']  = TRUE;
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('profile_image')) {
                        $uploadData = $this->upload->data();
                        $update_data['profile_image'] = 'uploads/patients/' . $uploadData['file_name'];

                        // Delete old image if exists
                        if (!empty($data['patient']['profile_image']) && file_exists('./uploads/patients/'.$data['patient']['profile_image'])) {
                            unlink('./uploads/patients/'.$data['patient']['profile_image']);
                        }
                    } else {
                        $this->session->set_flashdata('error', 'Failed to upload profile image: '.$this->upload->display_errors());
                        redirect('patient/edit/'.$id);
                    }
                }
    
                if ($this->Patient_model->update_patient($id, $update_data)) {
                    $this->session->set_flashdata('success', 'Patient updated successfully');
                    redirect('patient/index');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update patient.');
                    redirect('patient/edit/'.$id);
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
   public function getPatientByID($id)
   {
      $data = $this->Patient_model->get_patient_by_id($id);

       $output =array(
        'name' => $data['firstname'] . ' ' . $data['middlename'] . ' ' . $data['lastname'],
        'birthday' => date('m/d/Y', strtotime($data['birthday'])),
        'sex' => ($data['sex'] == 'M') ? 'Male' : 'Female',
        'email' => $data['email'],
        'phone' => $data['phone'],
       );

       return $this->output
           ->set_content_type('application/json')
           ->set_output(json_encode($output));
   }
}

?>