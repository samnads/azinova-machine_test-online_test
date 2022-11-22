<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Content-Type: application/json; charset=utf-8');
class Ajax extends CI_Controller
{
    public function index()
    {
        echo 'Ajax';
    }
    public function get_all_question_ids()
    {
        $this->load->model('Questions_model');
        $question_ids = $this->Questions_model->get_questions_ids(10); // add user to db
        $ids = array();
        foreach ($question_ids as $key => $value) {
            $ids[] = $question_ids[$key]['id'];
        }
        $this->session->set_userdata(array('question_ids' => $ids));
        echo json_encode($ids);
    }
    public function get_question_by_id()
    {
        $this->load->model('Questions_model');
        $data['question'] = $this->Questions_model->get_question_by_id($this->input->post('id')); // get question
        $get_correct_answer = $this->Questions_model->get_correct_answer($data['question']['answer']);
        $data['answers'][$get_correct_answer['id']] = $get_correct_answer['answer'] . "(" . $get_correct_answer['id'] . ")";
        error_reporting(E_ALL ^ E_NOTICE);
        unset($data['question']['answer']);

        $answers_incorrect = $this->Questions_model->get_optional_answers($data['question']['answer']);
        foreach ($answers_incorrect as $key => $value) {
            $data['answers'][$answers_incorrect[$key]['id']] = $answers_incorrect[$key]['answer'];
        }

        //$data['answers'] = $this->Questions_model->get_answer_options_by_question_id($this->input->post('id'));
        echo json_encode($data);
    }
    public function submit()
    {
        $answers = json_decode(file_get_contents('php://input'), true);
        $this->load->model('Questions_model');
        $i = 0;
        $count = 0;
        foreach ($answers as $index => $array) {
            $count++;
            $answer = $this->Questions_model->get_question_id(array('id' => $array['question'], 'answer' => $array['answer'])); // check in db
            if ($answer['id']) {
                $i++;
            }
        }
        $response = array('success' => true, 'total_questions' => $count, 'score' => $i);
        $this->session->set_userdata($response);
        delete_cookie("started");
        echo json_encode($response);
        // validate answers

    }
}
