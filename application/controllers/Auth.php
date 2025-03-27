<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('session');

    }
    public function register() {
        $this->load->view('auth/register');
    }

    public function login() {
        $this->load->view('auth/login');
    }

    public function register_user() {
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
        $this->form_validation->set_rules('firstname', 'First Name', 'required');
        $this->form_validation->set_rules('lastname', 'Last Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => false, 'message' => validation_errors()]);
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
               'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'lastname' => $this->input->post('lastname'),
                'firstname' => $this->input->post('firstname'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            );

            $this->User_model->register($data);
          //echo json_encode(['status' => true, 'message' => 'Registration successful!']);
     echo json_encode(['status' => true, 'redirect' => site_url('auth/login')]);
           
        }
    }

    public function process_login() {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user = $this->User_model->login($username, $password);

            if ($user) {
                $this->session->set_userdata([
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'logged_in' => TRUE
                ]);
                redirect('patient');
            } else {
                $this->session->set_flashdata('error', 'Invalid username or password');
                redirect('auth/login');
            }
        }
        //var_dump($_POST); exit;
    }
    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
    public function login_user() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->User_model->login($username, $password);

        if ($user) {
            $this->session->set_userdata('user_id', $user->id);
            echo json_encode(['status' => true, 'message' => 'Login successful!']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Invalid username or password']);
        }
    }
}
