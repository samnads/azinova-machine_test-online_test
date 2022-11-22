<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		if ($this->session->id) {
			redirect('http://localhost/azinova', 'refresh');
		} else {
			if ($this->input->post('username')) {
				$this->load->model('Register_model');
				$user = $this->Register_model->get_user_by_username($this->input->post('username')); // get user by username
				if ($user['id']) {
					// username found verify password
					if (password_verify($this->input->post('password'), $user['password'])) {
						// start session
						unset($user['password']);
						$this->session->set_userdata($user);
						redirect('http://localhost/azinova', 'refresh');
					} else {
						$error = 'Password incorrect !';
						echo $error;
					}
				} else {
					$error = 'User with username <b>' . $this->input->post('username') . '</b> not found !';
					echo $error;
				}
			} else {
				$this->load->view('header');
				$this->load->view('login');
				$this->load->view('footer');
			}
		}
	}
}
