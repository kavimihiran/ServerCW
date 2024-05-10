<?php

namespace App\Controllers;

use App\Models\QuestionModel;

class Questions extends BaseController
{
    public $session;
    public function __construct()
    {
        $this->session = session();
    }
    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            $questions = new QuestionModel();
            $data = [
                'title' => $this->request->getPost('title'),
                'body' => $this->request->getPost('body'),
                'tags' => $this->request->getPost('tags'),
                'username' => $this->session->get('username'),
            ];
            if ($questions->save($data)) {
                $updatequestion = $questions->getId($data['title'], $data['body']);
                return redirect()->to('/answers?title=' . $data['title'] . '&body=' . $data['body'] . '&question_id=' . $updatequestion);
            } else {

            }
        }
        $questionModel = new QuestionModel();
        $data['questions'] = $questionModel->findAll();

        return view('view_home', $data);

    }
    public function MyQuestions()
    {
        if ($this->request->getMethod() === 'post') {
            $questions = new QuestionModel();
            $data = [
                'title' => $this->request->getPost('title'),
                'body' => $this->request->getPost('body'),
                'question_id' => $this->request->getPost('question_id'),

            ];
            $updatequestion = $questions->updateQuestions($data['title'], $data['body'], $data['question_id']);
            if ($updatequestion) {
                
            } else {
                
            }
        }
        $questionModel = new QuestionModel();
        $user = $this->session->get('username');
        $answerModel = $questionModel->getQuestions($user);

        $data['myquestions'] = $answerModel;

        return view('my_questions', $data);

    }
    public function vote()
    {
        $data = $this->request->getJSON(true);
        if (isset($data['questionId'], $data['action'])) {
            $questionId = $data['questionId'];
            $action = $data['action'];
            log_message('info', 'Question ID: ' . $questionId . ', Action: ' . $action);

            $questionModel = new QuestionModel();
            $success = false;

            if ($action === "up") {
                $success = $questionModel->incrementVote($questionId);
            } elseif ($action === "down") {
                $success = $questionModel->decrementVote($questionId);
            }

            if ($success) {
                echo json_encode(['success' => true]);
                return;
            }
        }
        echo json_encode(['success' => false]);
    }
    public function search()
    {
        $query = $this->request->getGet('query');
        $questions = new QuestionModel();
        $search = $questions->search($query);

        $data['questions'] = $search; 
        return view('view_home', $data);

    }
}
