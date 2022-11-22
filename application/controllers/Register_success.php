<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register_success extends CI_Controller
{
	public function index()
	{
		$data['name'] = 'NAME';
		$this->load->view('header');
		$this->load->view('register_success',$data);
		$this->load->view('footer');
	}
}
