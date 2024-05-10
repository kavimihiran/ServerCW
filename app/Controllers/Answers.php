<?php

namespace App\Controllers;

use App\Models\AnswerModel;
use App\Models\CommentsModel;

class Answers extends BaseController
{
    public function createAnswer()
    {

        if ($this->request->getMethod() === 'post') {

            $answerBody = $this->request->getPost('body');
            $questionId = $this->request->getPost('question_Id');

            $answerModel = new AnswerModel();

            $data = [
                'body' => $answerBody,
                'question_id' => $questionId,
            ];

            if ($answerModel->insert($data)) {
                return view('answer', $data);
            } else {

            }
        }
        $answerModel = new AnswerModel();
        $questionId = $this->request->getGet('question_id');
        $answers = $answerModel->getanswers($questionId);

        $commentsModel = new CommentsModel();
        foreach ($answers as &$answer) {
            $answerId = $answer['answer_id'];
            $comments = $commentsModel->getComments($answerId);
            $answer['comments'] = $comments;
        }
        $data['answers'] = $answers;
        return view('answer', $data);
    }
    public function vote()
    {
        $data = $this->request->getJSON(true);
        if (isset($data['answerId'], $data['action'])) {
            $answerId = $data['answerId'];
            $action = $data['action'];
            log_message('info', 'Question ID: ' . $answerId . ', Action: ' . $action);
            $answerModel = new AnswerModel();
            $success = false;
            if ($action === "up") {
                $success = $answerModel->incrementVote($answerId);
            } elseif ($action === "down") {
                $success = $answerModel->decrementVote($answerId);
            }
            if ($success) {
                echo json_encode(['success' => true]);
                return;
            }
        }
        echo json_encode(['success' => false]);
    }
    public function mark()
    {
        $data = $this->request->getJSON(true);
        if (isset($data['answerId'])) {
            $answerId = $data['answerId'];
            $answerModel = new AnswerModel();
            $success = false;
            $success = $answerModel->answerMarked($answerId);
            if ($success) {
                echo json_encode(['success' => true]);
                return;
            }
        }
        echo json_encode(['success' => false]);
    }
    public function comment()
    {
        $commentBody = $this->request->getPost('body');
        $answerId = $this->request->getPost('answerId');
        $commentsModel = new CommentsModel();
        $data = [
            'body' => $commentBody,
            'answer_id' => $answerId,
        ];
        if ($commentsModel->insert($data)) {
            $commentsModel = $commentsModel->getcomments($answerId); 
            if (empty($commentsModel)) {
                return view('answer');
            } else {
                $data['comments'] = $commentsModel;
                return view('answer', $data);
            }
        } else {
        }
    }
}
