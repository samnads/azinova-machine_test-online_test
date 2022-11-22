<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

	public function index()
	{
		if ($this->input->post('name')) {
			$this->load->model('Register_model');
			$data = array('name' => $this->input->post('name'), 'username' => $this->input->post('username'), 'email' => $this->input->post('email') ?: NULL, 'password' => $this->input->post('password'));
			$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
			$create_query = $this->Register_model->create_user($data); // add user to db
			$this->load->view('header');
			$this->load->view('register_success',$data);
			$this->load->view('footer');
		} else if ($this->session->id) {
			echo 'logged already';
			redirect('http://localhost/azinova','refresh');
		} else {
			$this->load->view('header');
			$this->load->view('register');
			$this->load->view('footer');
		}
	}
}
