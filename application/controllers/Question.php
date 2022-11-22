<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Question extends CI_Controller
{

	public function index()
	{
		if (get_cookie('started') == 1) {
			delete_cookie("started");
			$this->load->view('header');
			$this->load->view('disqualified');
			$this->load->view('footer');
		} else {
			$cookie = array(
				'name'   => 'started',
				'value'  => 1,
				'expire' => '10400',
				'secure' => TRUE
			);
			set_cookie($cookie);
			$this->load->view('header');
			$this->load->model('Questions_model');
			$questions = $this->Questions_model->get_questions_ids(10); // add user to db
			$ids = array();
			foreach ($questions as $key => $value) {
				$ids[] = $questions[$key]['id'];
			}
			$questions_full = $this->Questions_model->get_questions($ids);
			//print_r($questions);
			$data = array('questions' => $ids, 'questions_full'=> $questions_full);
			$this->load->view('question', $data);
			$this->load->view('footer');
		}
	}
}
